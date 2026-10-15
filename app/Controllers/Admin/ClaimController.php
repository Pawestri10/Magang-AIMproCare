<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\WarrantyClaimModel;
use App\Services\WakitaService;

class ClaimController extends BaseController
{
    protected WarrantyClaimModel $warrantyClaimModel;

    public function __construct()
    {
        $this->warrantyClaimModel = new WarrantyClaimModel();
    }

    public function index()
    {
        $search = trim(
            (string) $this->request->getGet('search')
        );

        $status = trim(
            (string) $this->request->getGet('status')
        );

        $allowedStatuses = [
            'Pengajuan Baru',
            'Sedang Diverifikasi',
            'Klaim Diterima',
            'Klaim Ditolak',
            'Barang Diterima',
            'Sedang Diperiksa',
            'Sedang Diproses',
            'Selesai',
        ];

        if (
            $status !== '' &&
            !in_array($status, $allowedStatuses, true)
        ) {
            $status = '';
        }

        $claims = $this->warrantyClaimModel->findAdminClaims(
            $search !== '' ? $search : null,
            $status !== '' ? $status : null,
            10
        );

        $pager = $this->warrantyClaimModel->pager;
        $pager->setPath(site_url('admin/claims'));
        $pager->only(['search', 'status']);

        $claimIds = array_map(
            static fn(array $claim): int => (int) $claim['id'],
            $claims
        );

        $claimDetails = $this->warrantyClaimModel
            ->findAdminClaimDetails($claimIds);

        $claimHistories = $this->warrantyClaimModel
            ->findAdminHistories($claimIds);


        return view('admin/claims/index', [
            'claims' => $claims,
            'claimDetails' => $claimDetails,
            'claimHistories' => $claimHistories,
            'pager' => $pager,
            'perPage' => 10,
            'totalClaims' => $pager->getTotal('default'),
            'search' => $search,
            'status' => $status,
            'statuses' => $allowedStatuses,
        ]);
    }

    public function updateStatus(int $claimId)
    {
        $allowedStatuses = [
            'Pengajuan Baru',
            'Sedang Diverifikasi',
            'Klaim Diterima',
            'Klaim Ditolak',
            'Barang Diterima',
            'Sedang Diperiksa',
            'Sedang Diproses',
            'Selesai',
        ];

        $newStatus = trim(
            (string) $this->request->getPost('status')
        );

        $note = trim(
            (string) $this->request->getPost('note')
        );

        if (! in_array($newStatus, $allowedStatuses, true)) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Status klaim tidak valid.'
                );
        }

        if ($note === '') {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Catatan perubahan status wajib diisi.'
                );
        }

        $claim = $this->warrantyClaimModel->find($claimId);

        if ($claim === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $currentStatus = $claim['status'];

        if ($currentStatus === $newStatus) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Status klaim belum berubah.'
                );
        }

        $db = \Config\Database::connect();

        $claimHistoryModel = new \App\Models\ClaimHistoryModel();
        $activityLogService = new \App\Services\ActivityLogService();

        try {
            $db->transBegin();

            $updated = $this->warrantyClaimModel->update(
                $claimId,
                [
                    'status' => $newStatus,
                ]
            );

            if (! $updated) {
                throw new \RuntimeException(
                    'Status klaim gagal diperbarui.'
                );
            }

            $historyId = $claimHistoryModel->insert([
                'warranty_claim_id' => $claimId,
                'user_id'           => session()->get('user_id'),
                'status'             => $newStatus,
                'note'               => $note,
                'changed_at'         => date('Y-m-d H:i:s'),
            ]);

            if (! $historyId) {
                throw new \RuntimeException(
                    'Riwayat perubahan klaim gagal disimpan.'
                );
            }

            $activityLogged = $activityLogService->log(
                'Perubahan Status Klaim',
                'Admin mengubah status klaim '
                    . $claim['claim_number']
                    . ' dari "'
                    . $currentStatus
                    . '" menjadi "'
                    . $newStatus
                    . '".'
            );

            if (! $activityLogged) {
                throw new \RuntimeException(
                    'Activity Log gagal disimpan.'
                );
            }

            if (! $db->transStatus()) {
                throw new \RuntimeException(
                    'Transaksi perubahan status gagal.'
                );
            }

            $db->transCommit();
        } catch (\Throwable $e) {
            $db->transRollback();

            log_message(
                'error',
                'Perubahan status klaim gagal: '
                    . $e->getMessage()
            );

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Perubahan status klaim gagal. Tidak ada perubahan data yang disimpan.'
                );
        }

        try {
            $claimDetails = $this->warrantyClaimModel
                ->findAdminClaimDetails([$claimId]);

            $whatsapp = '';

            if (
                isset($claimDetails[$claimId]) &&
                is_array($claimDetails[$claimId])
            ) {
                $whatsapp = (string) (
                    $claimDetails[$claimId]['whatsapp'] ?? ''
                );
            }

            if ($whatsapp !== '') {
                $templateKey = $newStatus === 'Selesai'
                    ? 'claim_completed'
                    : 'claim_status_changed';

                $wakitaService = new WakitaService();

                $notificationResult = $wakitaService->sendTemplate(
                    $templateKey,
                    $whatsapp,
                    [
                        'nama' => $claimDetails[$claimId]['customer_name'] ?? 'Pelanggan',
                        'nomor_klaim' => $claim['claim_number'],
                        'status' => $newStatus,
                        'catatan' => $note,
                    ]
                );

                if (! ($notificationResult['success'] ?? false)) {
                    log_message(
                        'warning',
                        'Notifikasi perubahan status klaim gagal. Nomor klaim: '
                            . $claim['claim_number']
                    );
                }
            } else {
                log_message(
                    'warning',
                    'Nomor WhatsApp pelanggan tidak ditemukan untuk klaim: '
                        . $claim['claim_number']
                );
            }
        } catch (\Throwable $e) {
            log_message(
                'error',
                'Kesalahan notifikasi perubahan status klaim '
                    . $claim['claim_number']
                    . ': '
                    . $e->getMessage()
            );
        }

        return redirect()
            ->back()
            ->with(
                'success',
                'Status klaim berhasil diubah menjadi '
                    . $newStatus
                    . '.'
            );
    }


    public function evidence(int $claimId, string $type)
    {
        $allowedTypes = [
            'photo' => 'damage_photo_path',
            'video' => 'damage_video_path',
        ];

        if (! isset($allowedTypes[$type])) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $claim = $this->warrantyClaimModel->find($claimId);

        if ($claim === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $relativePath = $claim[$allowedTypes[$type]] ?? '';

        if (
            ! is_string($relativePath) ||
            ! str_starts_with($relativePath, 'uploads/claims/')
        ) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $baseDirectory = realpath(WRITEPATH . 'uploads/claims');
        $filePath = realpath(WRITEPATH . $relativePath);

        if (
            $baseDirectory === false ||
            $filePath === false ||
            dirname($filePath) !== $baseDirectory ||
            ! is_file($filePath)
        ) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $allowedMimeTypes = [
            'photo' => [
                'image/jpeg',
                'image/png',
                'image/webp',
            ],
            'video' => [
                'video/mp4',
                'video/quicktime',
                'video/webm',
            ],
        ];

        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($filePath);

        if (! in_array($mimeType, $allowedMimeTypes[$type], true)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $content = file_get_contents($filePath);

        if ($content === false) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return $this->response
            ->setStatusCode(200)
            ->setContentType($mimeType)
            ->setHeader(
                'Content-Disposition',
                'inline; filename="' . basename($filePath) . '"'
            )
            ->setHeader('X-Content-Type-Options', 'nosniff')
            ->setHeader('Cache-Control', 'private, no-store')
            ->setBody($content);
    }
}
