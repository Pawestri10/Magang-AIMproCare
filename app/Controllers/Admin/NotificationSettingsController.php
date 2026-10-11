<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SettingModel;

class NotificationSettingsController extends BaseController
{
    protected SettingModel $settingModel;

    protected array $templates = [
        'warranty_activated' => [
            'label' => 'Garansi Berhasil Diaktifkan',
            'description' => 'Dikirim setelah garansi berhasil diaktifkan.',
            'default' => 'Halo {nama}, garansi produk {produk} dengan nomor {nomor_garansi} berhasil diaktifkan.',
        ],
        'warranty_card_issued' => [
            'label' => 'Kartu Garansi Terbit',
            'description' => 'Dikirim ketika kartu garansi diterbitkan.',
            'default' => 'Halo {nama}, kartu garansi produk {produk} telah diterbitkan. Nomor garansi: {nomor_garansi}.',
        ],
        'warranty_expiring' => [
            'label' => 'Garansi Segera Berakhir',
            'description' => 'Pengingat sebelum masa garansi berakhir.',
            'default' => 'Halo {nama}, masa garansi produk {produk} dengan nomor {nomor_garansi} akan segera berakhir pada {tanggal_berakhir}.',
        ],
        'claim_submitted' => [
            'label' => 'Klaim Berhasil Diajukan',
            'description' => 'Dikirim setelah pengajuan klaim berhasil disimpan.',
            'default' => 'Halo {nama}, pengajuan klaim {nomor_klaim} berhasil kami terima. Status: {status}.',
        ],
        'claim_status_changed' => [
            'label' => 'Status Klaim Berubah',
            'description' => 'Dikirim ketika status klaim berubah.',
            'default' => 'Halo {nama}, status klaim {nomor_klaim} telah berubah menjadi {status}. Catatan: {catatan}.',
        ],
        'claim_completed' => [
            'label' => 'Klaim Selesai',
            'description' => 'Dikirim ketika proses klaim selesai.',
            'default' => 'Halo {nama}, proses klaim {nomor_klaim} telah selesai. Terima kasih.',
        ],
    ];

    public function __construct()
    {
        $this->settingModel = new SettingModel();
    }

    public function index()
    {
        $templates = [];

        foreach ($this->templates as $key => $template) {
            $templates[$key] = [
                'label' => $template['label'],
                'description' => $template['description'],
                'content' => $this->settingModel->getValue(
                    'wa_template_' . $key,
                    $template['default']
                ),
            ];
        }

        $encryptedApiKey = $this->settingModel->getValue(
            'wakita_api_key'
        );

        return view('admin/notification_settings/index', [
            'templates' => $templates,
            'apiKeyConfigured' => is_string($encryptedApiKey)
                && $encryptedApiKey !== '',
            'expiryReminderDays' => $this->settingModel->getValue(
                'wa_expiry_reminder_days',
                ''
            ),
        ]);
    }

    public function save()
    {
        $rules = [
            'expiry_reminder_days' => [
                'label' => 'Hari pengingat garansi',
                'rules' => 'required|is_natural|less_than_equal_to[365]',
            ],
        ];

        foreach (array_keys($this->templates) as $key) {
            $rules['template_' . $key] = [
                'label' => 'Template ' . $this->templates[$key]['label'],
                'rules' => 'required|max_length[2000]',
            ];
        }

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $days = (string) $this->request->getPost(
            'expiry_reminder_days'
        );

        $db = \Config\Database::connect();

        try {
            $db->transBegin();

            foreach ($this->templates as $key => $template) {
                $saved = $this->settingModel->setValue(
                    'wa_template_' . $key,
                    trim((string) $this->request->getPost(
                        'template_' . $key
                    ))
                );

                if (! $saved) {
                    throw new \RuntimeException(
                        'Template gagal disimpan: ' . $key
                    );
                }
            }

            $saved = $this->settingModel->setValue(
                'wa_expiry_reminder_days',
                $days
            );

            if (! $saved) {
                throw new \RuntimeException(
                    'Pengaturan pengingat gagal disimpan.'
                );
            }

            if (! $db->transStatus()) {
                throw new \RuntimeException(
                    'Transaksi penyimpanan pengaturan gagal.'
                );
            }

            $db->transCommit();
        } catch (\Throwable $e) {
            $db->transRollback();

            log_message(
                'error',
                'Penyimpanan pengaturan notifikasi gagal: '
                    . $e->getMessage()
            );

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Pengaturan gagal disimpan. Silakan periksa log aplikasi.'
                );
        }

        return redirect()
            ->to(site_url('admin/notification-settings'))
            ->with(
                'success',
                'Pengaturan template notifikasi berhasil disimpan.'
            );
    }

    public function saveApiKey()
    {
        $apiKey = trim(
            (string) $this->request->getPost('api_key')
        );

        if ($apiKey === '') {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'API key tidak boleh kosong.'
                );
        }

        if (strlen($apiKey) > 1000) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'API key terlalu panjang.'
                );
        }

        try {
            $encrypter = \Config\Services::encrypter();

            $encryptedApiKey = base64_encode(
                $encrypter->encrypt($apiKey)
            );

            $saved = $this->settingModel->setValue(
                'wakita_api_key',
                $encryptedApiKey
            );

            if (! $saved) {
                throw new \RuntimeException(
                    'API key gagal disimpan.'
                );
            }
        } catch (\Throwable $e) {
            log_message(
                'error',
                'Penyimpanan API key WAKITA gagal: '
                    . $e->getMessage()
            );

            return redirect()
                ->back()
                ->with(
                    'error',
                    'API key gagal disimpan. Silakan periksa konfigurasi encryption.'
                );
        }

        return redirect()
            ->to(site_url('admin/notification-settings'))
            ->with(
                'success',
                'API key WAKITA berhasil diperbarui.'
            );
    }
}
