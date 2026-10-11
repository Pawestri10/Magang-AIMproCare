<?php

namespace App\Commands;

use App\Models\NotificationModel;
use App\Models\SettingModel;
use App\Models\WarrantyModel;
use App\Services\WakitaService;
use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class SendWarrantyExpiryReminders extends BaseCommand
{
    protected $group       = 'Warranty';
    protected $name        = 'warranty:send-expiry-reminders';
    protected $description = 'Mengirim pengingat WhatsApp untuk garansi yang akan berakhir.';

    public function run(array $params)
    {
        date_default_timezone_set('Asia/Jakarta');

        $settingModel = new SettingModel();
        $warrantyModel = new WarrantyModel();
        $notificationModel = new NotificationModel();
        $wakitaService = new WakitaService();

        $configuredDays = $settingModel->getValue(
            'wa_expiry_reminder_days',
            '7'
        );

        if (
            !is_numeric($configuredDays)
            || (int) $configuredDays < 0
            || (int) $configuredDays > 365
        ) {
            CLI::error('Pengaturan hari pengingat tidak valid.');
            return;
        }

        $reminderDays = (int) $configuredDays;
        $today = date('Y-m-d');

        $warranties = $warrantyModel->findExpiringWarranties(
            $reminderDays
        );

        if (empty($warranties)) {
            CLI::write(
                'Tidak ada garansi yang perlu diingatkan hari ini.',
                'yellow'
            );
            return;
        }

        $sentCount = 0;
        $failedCount = 0;
        $skippedCount = 0;

        foreach ($warranties as $warranty) {
            $warrantyId = (int) $warranty['warranty_id'];

            $alreadyProcessed = $notificationModel
                ->where('template', 'warranty_expiring')
                ->where('warranty_id', $warrantyId)
                ->where('reminder_date', $today)
                ->where('status', 'success')
                ->first();

            if ($alreadyProcessed !== null) {
                $skippedCount++;
                continue;
            }

            $result = $wakitaService->sendTemplate(
                'warranty_expiring',
                (string) ($warranty['customer_whatsapp'] ?? ''),
                [
                    'nama' => $warranty['customer_name'] ?? 'Pelanggan',
                    'produk' => $warranty['product_name'] ?? 'produk',
                    'nomor_garansi' => $warranty['warranty_number'],
                    'tanggal_berakhir' => date(
                        'd/m/Y',
                        strtotime($warranty['end_date'])
                    ),
                    'sisa_hari' => max(
                        0,
                        (int) floor(
                            (strtotime($warranty['end_date']) - strtotime($today)) / 86400
                        )
                    ),
                ],

                [
                    'warranty_id' => $warrantyId,
                    'reminder_date' => $today,
                ]
            );

            $success = (bool) ($result['success'] ?? false);

            if ($success) {
                $sentCount++;
                CLI::write(
                    'Berhasil: ' . $warranty['warranty_number'],
                    'green'
                );
            } else {
                $failedCount++;
                CLI::error(
                    'Gagal: ' . $warranty['warranty_number']
                );
            }
        }

        CLI::newLine();
        CLI::write('Proses pengingat garansi selesai.');
        CLI::write('Berhasil: ' . $sentCount);
        CLI::write('Gagal: ' . $failedCount);
        CLI::write('Dilewati: ' . $skippedCount);
    }
}
