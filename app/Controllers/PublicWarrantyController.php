<?php

namespace App\Controllers;

use App\Models\WarrantyModel;

class PublicWarrantyController extends BaseController
{
    protected WarrantyModel $warrantyModel;

    public function __construct()
    {
        $this->warrantyModel = new WarrantyModel();
    }

    public function index()
    {
        return view('public/warranty/index');
    }

    public function search()
    {
        $identifier = trim((string) $this->request->getPost('identifier'));

        if ($identifier === '') {
            return redirect()
                ->to('/cek-garansi')
                ->with('error', 'Nomor seri atau nomor garansi wajib diisi.');
        }

        $warranty = $this->warrantyModel->findPublicByIdentifier($identifier);

        if (!$warranty) {
            return redirect()
                ->to('/cek-garansi')
                ->with('error', 'Data garansi tidak ditemukan.');
        }

        $warranty = $this->preparePublicWarranty($warranty);

        return view('public/warranty/result', [
            'warranty' => $warranty,
        ]);
    }

    public function show(string $token)
    {
        $token = trim($token);

        if ($token === '' || ! preg_match('/^[a-f0-9]{64}$/', $token)) {
            return redirect()
                ->to('/cek-garansi')
                ->with('error', 'QR warranty tidak valid.');
        }

        $warranty = $this->warrantyModel
            ->select([
                'warranties.id',
                'warranties.warranty_number',
                'warranties.start_date AS warranty_start_date',
                'warranties.end_date AS warranty_end_date',
                'warranties.status AS warranty_status',
                'product_units.serial_number',
                'products.name AS product_name',
                'products.brand',
                'products.model',
                'customers.name AS customer_name',
                'customers.whatsapp AS customer_whatsapp',
                'qc_inspections.result AS qc_result',
            ])
            ->join('sales', 'sales.id = warranties.sale_id')
            ->join('product_units', 'product_units.id = sales.product_unit_id')
            ->join('products', 'products.id = product_units.product_id')
            ->join('customers', 'customers.id = sales.customer_id')
            ->join(
                'qc_inspections',
                'qc_inspections.product_unit_id = product_units.id',
                'left'
            )
            ->where('warranties.qr_token', $token)
            ->first();

        if (!$warranty) {
            return redirect()
                ->to('/cek-garansi')
                ->with('error', 'QR warranty tidak ditemukan.');
        }

        $warranty = $this->preparePublicWarranty($warranty);

        return view('public/warranty/result', [
            'warranty' => $warranty,
        ]);
    }

    private function preparePublicWarranty(array $warranty): array
    {
        $today = new \DateTimeImmutable('today');
        $endDate = new \DateTimeImmutable($warranty['warranty_end_date']);

        if ($endDate < $today) {
            $warranty['remaining_warranty'] = 'Garansi telah berakhir';
        } else {
            $daysRemaining = $today->diff($endDate)->days;

            $warranty['remaining_warranty'] = $daysRemaining === 0
                ? 'Berakhir hari ini'
                : $daysRemaining . ' hari lagi';
        }

        $warranty['customer_name'] = $this->maskName(
            $warranty['customer_name']
        );

        $warranty['customer_whatsapp'] = $this->maskWhatsapp(
            $warranty['customer_whatsapp']
        );

        return $warranty;
    }

    private function maskName(string $name): string
    {
        $name = trim($name);

        if ($name === '') {
            return '-';
        }

        $parts = preg_split('/\s+/', $name);

        $maskedParts = array_map(
            static function (string $part): string {
                $length = mb_strlen($part);

                if ($length <= 1) {
                    return '*';
                }

                return mb_substr($part, 0, 1) .
                    str_repeat('*', $length - 1);
            },
            $parts
        );

        return implode(' ', $maskedParts);
    }

    private function maskWhatsapp(string $whatsapp): string
    {
        $whatsapp = trim($whatsapp);

        if ($whatsapp === '') {
            return '-';
        }

        $length = strlen($whatsapp);

        if ($length <= 4) {
            return str_repeat('*', $length);
        }

        return substr($whatsapp, 0, 3) .
            str_repeat('*', $length - 5) .
            substr($whatsapp, -2);
    }
}
