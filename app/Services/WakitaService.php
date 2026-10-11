<?php

namespace App\Services;

use App\Models\NotificationModel;
use App\Models\SettingModel;

class WakitaService
{
    private SettingModel $settingModel;
    private NotificationModel $notificationModel;

    private string $baseUrl = 'https://wakita.aminsproject.com/api/v1';

    private array $logMetadata = [];

    public function __construct()
    {
        $this->settingModel = new SettingModel();
        $this->notificationModel = new NotificationModel();
    }

    public function sendTemplate(
        string $templateKey,
        string $recipient,
        array $variables = [],
        array $logMetadata = []
    ): array {
        $this->logMetadata = $logMetadata;

        $recipient = trim($recipient);

        $allowedTemplates = [
            'warranty_activated',
            'warranty_card_issued',
            'warranty_expiring',
            'claim_submitted',
            'claim_status_changed',
            'claim_completed',
        ];

        if (!in_array($templateKey, $allowedTemplates, true)) {
            return [
                'success' => false,
                'message' => 'Template tidak valid.',
            ];
        }

        $recipient = preg_replace('/\D+/', '', $recipient) ?? '';

        if ($recipient === '' || strlen($recipient) > 25) {
            return $this->logResult(
                $recipient,
                $templateKey,
                false,
                'Nomor penerima tidak valid.',
                null
            );
        }

        $template = $this->settingModel->getValue(
            'wa_template_' . $templateKey
        );

        if ($template === null || trim($template) === '') {
            return $this->logResult(
                $recipient,
                $templateKey,
                false,
                'Template notifikasi belum dikonfigurasi.',
                null
            );
        }

        $message = $this->renderTemplate($template, $variables);

        $encryptedApiKey = $this->settingModel->getValue(
            'wakita_api_key'
        );

        if (!$encryptedApiKey) {
            return $this->logResult(
                $recipient,
                $templateKey,
                false,
                'API key WAKITA belum dikonfigurasi.',
                null
            );
        }

        try {
            $encryptedBytes = base64_decode($encryptedApiKey, true);

            if ($encryptedBytes === false) {
                throw new \RuntimeException('Format API key tidak valid.');
            }

            $apiKey = \Config\Services::encrypter()
                ->decrypt($encryptedBytes);

            if (!is_string($apiKey) || trim($apiKey) === '') {
                throw new \RuntimeException('API key kosong.');
            }
        } catch (\Throwable $e) {
            log_message('error', 'WAKITA: gagal membaca API key terenkripsi.');

            return $this->logResult(
                $recipient,
                $templateKey,
                false,
                'API key tidak dapat dibaca. Periksa konfigurasi encryption.',
                null
            );
        }

        $payload = json_encode([
            'number'  => $recipient,
            'message' => $message,
        ]);

        if ($payload === false) {
            return $this->logResult(
                $recipient,
                $templateKey,
                false,
                'Pesan gagal disiapkan.',
                null
            );
        }

        $curl = curl_init($this->baseUrl . '/send');

        if ($curl === false) {
            return $this->logResult(
                $recipient,
                $templateKey,
                false,
                'Tidak dapat memulai koneksi HTTP.',
                null
            );
        }

        curl_setopt_array($curl, [
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_HTTPHEADER => [
                'X-API-Key: ' . $apiKey,
                'Content-Type: application/json',
                'Accept: application/json',
            ],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_SSL_VERIFYHOST => 2,
        ]);

        $responseBody = curl_exec($curl);
        $curlError = curl_error($curl);
        $httpCode = (int) curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        if ($responseBody === false) {
            log_message('error', 'WAKITA request gagal: ' . $curlError);

            return $this->logResult(
                $recipient,
                $templateKey,
                false,
                'Koneksi ke WAKITA gagal: ' . $curlError,
                null
            );
        }

        $responseData = json_decode($responseBody, true);

        $success = $httpCode >= 200
            && $httpCode < 300
            && is_array($responseData)
            && ($responseData['success'] ?? false) === true;

        return $this->logResult(
            $recipient,
            $templateKey,
            $success,
            (string) $responseBody,
            $httpCode
        );
    }

    private function renderTemplate(
        string $template,
        array $variables
    ): string {
        $replacements = [];

        foreach ($variables as $key => $value) {
            if (
                (is_string($key) || is_int($key))
                && (is_scalar($value) || $value === null)
            ) {
                $replacements['{' . $key . '}'] =
                    (string) ($value ?? '');
            }
        }

        return strtr($template, $replacements);
    }

    private function logResult(
        string $recipient,
        string $templateKey,
        bool $success,
        string $response,
        ?int $httpCode
    ): array {
        $status = $success ? 'success' : 'failed';

        $logResponse = $httpCode === null
            ? $response
            : 'HTTP ' . $httpCode . ' - ' . $response;

        $logData = [
            'recipient' => $recipient,
            'template' => $templateKey,
            'sent_at' => date('Y-m-d H:i:s'),
            'status' => $status,
            'gateway_response' => $logResponse,
        ];

        if (isset($this->logMetadata['warranty_id'])) {
            $logData['warranty_id'] =
                (int) $this->logMetadata['warranty_id'];
        }

        if (isset($this->logMetadata['reminder_date'])) {
            $logData['reminder_date'] =
                $this->logMetadata['reminder_date'];
        }

        try {
            $this->notificationModel->insert($logData);
        } catch (\Throwable $e) {
            log_message(
                'error',
                'WAKITA: pencatatan notifikasi gagal: ' . $e->getMessage()
            );
        }

        return [
            'success' => $success,
            'message' => $success
                ? 'Gateway menerima pesan.'
                : 'Pengiriman gagal. Periksa respons gateway.',
            'http_code' => $httpCode,
        ];
    }
}
