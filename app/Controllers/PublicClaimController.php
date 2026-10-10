<?php

namespace App\Controllers;

use App\Models\WarrantyModel;
use App\Models\WarrantyClaimModel;
use App\Models\ClaimHistoryModel;
use App\Services\ClaimNumberService;

class PublicClaimController extends BaseController
{
    protected WarrantyModel $warrantyModel;
    protected WarrantyClaimModel $warrantyClaimModel;
    protected ClaimHistoryModel $claimHistoryModel;
    protected ClaimNumberService $claimNumberService;

    public function __construct()
    {
        $this->warrantyModel = new WarrantyModel();
        $this->warrantyClaimModel = new WarrantyClaimModel();
        $this->claimHistoryModel = new ClaimHistoryModel();
        $this->claimNumberService = new ClaimNumberService();
    }

    public function index()
    {
        return view('public/claim/index');
    }

    public function store()
    {
        $identifier = trim(
            (string) $this->request->getPost('identifier')
        );

        $complaint = trim(
            (string) $this->request->getPost('complaint')
        );

        $damageStartedAt = trim(
            (string) $this->request->getPost('damage_started_at')
        );

        $whatsapp = trim(
            (string) $this->request->getPost('whatsapp')
        );

        $deliveryMethod = trim(
            (string) $this->request->getPost('delivery_method')
        );

        $shippingAddress = trim(
            (string) $this->request->getPost('shipping_address')
        );

        $agreement = $this->request->getPost('agreement');

        if ($identifier === '') {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Nomor garansi atau nomor seri wajib diisi.'
                );
        }

        if ($complaint === '') {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Keluhan wajib diisi.'
                );
        }

        if ($whatsapp === '') {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Nomor WhatsApp wajib diisi.'
                );
        }

        if ($deliveryMethod === '') {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Metode penyerahan atau pengiriman wajib dipilih.'
                );
        }

        if ($agreement !== '1') {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Persetujuan ketentuan klaim wajib diberikan.'
                );
        }

        $warranty = $this->warrantyModel->findPublicByIdentifier(
            $identifier
        );

        if (!$warranty) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Nomor garansi atau nomor seri tidak ditemukan.'
                );
        }

        $warrantyId = (int) $warranty['id'];

        $damagePhoto = $this->request->getFile('damage_photo');
        $damageVideo = $this->request->getFile('damage_video');

        $photoValidation = $this->validateImageUpload(
            $damagePhoto,
            true
        );

        if ($photoValidation !== null) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', $photoValidation);
        }

        $videoValidation = $this->validateVideoUpload(
            $damageVideo
        );

        if ($videoValidation !== null) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', $videoValidation);
        }

        $damageStartedDate = \DateTimeImmutable::createFromFormat(
            'Y-m-d',
            $damageStartedAt
        );

        $dateErrors = \DateTimeImmutable::getLastErrors();

        if (
            $damageStartedDate === false ||
            (
                is_array($dateErrors) &&
                (
                    $dateErrors['warning_count'] > 0 ||
                    $dateErrors['error_count'] > 0
                )
            )
        ) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Tanggal mulai kerusakan tidak valid.'
                );
        }

        $year = $damageStartedDate->format('Y');

        $claimNumber = $this->claimNumberService->generate(
            $year
        );

        $trackingToken = $this->generateTrackingToken();

        $uploadDirectory = WRITEPATH . 'uploads/claims';

        if (!is_dir($uploadDirectory)) {
            mkdir($uploadDirectory, 0750, true);
        }

        $photoFileName = $damagePhoto->getRandomName();

        $photoPath = 'uploads/claims/' . $photoFileName;

        $videoPath = null;
        $videoFileName = null;

        if (
            $damageVideo &&
            $damageVideo->getError() !== UPLOAD_ERR_NO_FILE
        ) {
            $videoFileName = $damageVideo->getRandomName();
            $videoPath = 'uploads/claims/' . $videoFileName;
        }

        if (!$damagePhoto->move(
            $uploadDirectory,
            $photoFileName
        )) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Foto kerusakan gagal disimpan.'
                );
        }

        if (
            $damageVideo &&
            $videoFileName !== null
        ) {
            if (!$damageVideo->move(
                $uploadDirectory,
                $videoFileName
            )) {
                $photoStoredPath = WRITEPATH . $photoPath;

                if (is_file($photoStoredPath)) {
                    unlink($photoStoredPath);
                }

                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'Video kerusakan gagal disimpan.'
                    );
            }
        }

        $db = \Config\Database::connect();

        try {
            $db->transBegin();

            $claimId = $this->warrantyClaimModel->insert([
                'warranty_id' => $warrantyId,
                'claim_number' => $claimNumber,
                'tracking_token' => $trackingToken,
                'complaint' => $complaint,
                'damage_started_at' => $damageStartedAt,
                'damage_photo_path' => $photoPath,
                'damage_video_path' => $videoPath,
                'whatsapp' => $whatsapp,
                'delivery_method' => $deliveryMethod,
                'shipping_address' => $shippingAddress !== ''
                    ? $shippingAddress
                    : null,
                'agreement' => true,
                'status' => 'Pengajuan Baru',
            ]);

            if (!$claimId) {
                throw new \RuntimeException(
                    'Klaim gagal disimpan.'
                );
            }

            $historyId = $this->claimHistoryModel->insert([
                'warranty_claim_id' => $claimId,
                'user_id' => null,
                'status' => 'Pengajuan Baru',
                'note' => 'Klaim diajukan oleh pembeli melalui halaman public.',
                'changed_at' => date('Y-m-d H:i:s'),
            ]);

            if (!$historyId) {
                throw new \RuntimeException(
                    'Riwayat klaim gagal disimpan.'
                );
            }

            if (!$db->transStatus()) {
                throw new \RuntimeException(
                    'Transaksi klaim gagal.'
                );
            }

            $db->transCommit();
        } catch (\Throwable $e) {
            $db->transRollback();

            $photoStoredPath = WRITEPATH . $photoPath;

            if (is_file($photoStoredPath)) {
                unlink($photoStoredPath);
            }

            if ($videoPath !== null) {
                $videoStoredPath = WRITEPATH . $videoPath;

                if (is_file($videoStoredPath)) {
                    unlink($videoStoredPath);
                }
            }

            log_message(
                'error',
                'Pengajuan klaim gagal: ' . $e->getMessage()
            );

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Pengajuan klaim gagal. Tidak ada perubahan data yang disimpan.'
                );
        }

        return redirect()
            ->to('/klaim-garansi/berhasil/' . $trackingToken)
            ->with(
                'success',
                'Klaim berhasil diajukan dengan nomor ' . $claimNumber . '.'
            );
    }

    private function validateImageUpload(
        $file,
        bool $required = false
    ): ?string {
        $maxSize = 1 * 1024 * 1024;

        $allowedExtensions = [
            'jpg',
            'jpeg',
            'png',
            'webp',
        ];

        $allowedMimeTypes = [
            'image/jpeg',
            'image/png',
            'image/webp',
        ];

        if (
            $file === null ||
            $file->getError() === UPLOAD_ERR_NO_FILE
        ) {
            return $required
                ? 'Foto kerusakan wajib diunggah.'
                : null;
        }

        if (!$file->isValid()) {
            return 'Foto kerusakan gagal diunggah.';
        }

        if ($file->getError() !== UPLOAD_ERR_OK) {
            return 'Upload foto kerusakan gagal.';
        }

        $clientExtension = strtolower(
            ltrim($file->getClientExtension(), '.')
        );

        $detectedExtension = strtolower(
            ltrim($file->getExtension(), '.')
        );

        if (
            !in_array(
                $clientExtension,
                $allowedExtensions,
                true
            )
        ) {
            return 'Format foto kerusakan tidak diizinkan.';
        }

        if (
            $detectedExtension === '' ||
            !in_array(
                $detectedExtension,
                $allowedExtensions,
                true
            ) ||
            $clientExtension !== $detectedExtension
        ) {
            return 'Extension foto kerusakan tidak valid.';
        }

        if (
            !in_array(
                $file->getMimeType(),
                $allowedMimeTypes,
                true
            )
        ) {
            return 'Tipe foto kerusakan tidak valid.';
        }

        if ($file->getSize() > $maxSize) {
            return 'Foto kerusakan melebihi ukuran maksimum 1 MB.';
        }

        $originalName = strtolower(
            $file->getClientName()
        );

        if (
            preg_match(
                '/\.(php|phtml|phar|php[0-9]?|cgi|pl|py|sh|exe|dll|bat|cmd)(\.|$)/',
                $originalName
            )
        ) {
            return 'Nama file foto kerusakan tidak aman.';
        }

        return null;
    }

    private function validateVideoUpload($file): ?string
    {
        if (
            $file === null ||
            $file->getError() === UPLOAD_ERR_NO_FILE
        ) {
            return null;
        }

        $maxSize = 5 * 1024 * 1024;

        $allowedExtensions = [
            'mp4',
            'mov',
            'webm',
        ];

        $allowedMimeTypes = [
            'video/mp4',
            'video/quicktime',
            'video/webm',
        ];

        if (!$file->isValid()) {
            return 'Video kerusakan gagal diunggah.';
        }

        if ($file->getError() !== UPLOAD_ERR_OK) {
            return 'Upload video kerusakan gagal.';
        }

        $clientExtension = strtolower(
            ltrim($file->getClientExtension(), '.')
        );

        $detectedExtension = strtolower(
            ltrim($file->getExtension(), '.')
        );

        if (
            !in_array(
                $clientExtension,
                $allowedExtensions,
                true
            )
        ) {
            return 'Format video kerusakan tidak diizinkan.';
        }

        if (
            $detectedExtension === '' ||
            !in_array(
                $detectedExtension,
                $allowedExtensions,
                true
            ) ||
            $clientExtension !== $detectedExtension
        ) {
            return 'Extension video kerusakan tidak valid.';
        }

        if (
            !in_array(
                $file->getMimeType(),
                $allowedMimeTypes,
                true
            )
        ) {
            return 'Tipe video kerusakan tidak valid.';
        }

        if ($file->getSize() > $maxSize) {
            return 'Video kerusakan melebihi ukuran maksimum 5 MB.';
        }

        $originalName = strtolower(
            $file->getClientName()
        );

        if (
            preg_match(
                '/\.(php|phtml|phar|php[0-9]?|cgi|pl|py|sh|exe|dll|bat|cmd)(\.|$)/',
                $originalName
            )
        ) {
            return 'Nama file video kerusakan tidak aman.';
        }

        return null;
    }

    public function success(string $trackingToken)
    {
        if (!preg_match('/^[a-f0-9]{64}$/', $trackingToken)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $claim = $this->warrantyClaimModel
            ->findPublicTrackingByToken($trackingToken);

        if ($claim === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        unset($claim['id']);

        return view('public/claim/success', [
            'claim' => $claim,
            'trackingToken' => $trackingToken,
        ]);
    }

    private function generateTrackingToken(): string
    {
        do {
            $token = bin2hex(random_bytes(32));

            $exists = $this->warrantyClaimModel
                ->where('tracking_token', $token)
                ->countAllResults();
        } while ($exists > 0);

        return $token;
    }

    public function track(string $trackingToken)
    {
        if (!preg_match('/^[a-f0-9]{64}$/', $trackingToken)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $claim = $this->warrantyClaimModel
            ->findPublicTrackingByToken($trackingToken);

        if ($claim === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $history = $this->claimHistoryModel
            ->select([
                'claim_histories.status',
                'claim_histories.changed_at',
            ])
            ->where(
                'claim_histories.warranty_claim_id',
                $claim['id']
            )
            ->orderBy(
                'claim_histories.changed_at',
                'ASC'
            )
            ->findAll();

        unset($claim['id']);

        return view('public/claim/track', [
            'claim' => $claim,
            'history' => $history,
        ]);
    }
}
