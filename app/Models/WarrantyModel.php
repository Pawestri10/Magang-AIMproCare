<?php

namespace App\Models;

use CodeIgniter\Model;

class WarrantyModel extends Model
{
    protected $table            = 'warranties';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    protected $allowedFields = [
        'sale_id',
        'warranty_number',
        'start_date',
        'end_date',
        'status',
        'qr_token',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'sale_id'          => 'required|is_natural_no_zero',
        'warranty_number'  => 'required|max_length[100]',
        'start_date'      => 'required|valid_date[Y-m-d]',
        'end_date'        => 'required|valid_date[Y-m-d]',
        'status'          => 'required|max_length[50]',
        'qr_token'        => 'required|max_length[255]',
    ];

    protected $validationMessages = [
        'sale_id' => [
            'required'           => 'Transaksi penjualan wajib dipilih.',
            'is_natural_no_zero' => 'Transaksi penjualan tidak valid.',
        ],
        'warranty_number' => [
            'required'   => 'Nomor garansi wajib diisi.',
            'max_length' => 'Nomor garansi maksimal 100 karakter.',
        ],
        'start_date' => [
            'required'   => 'Tanggal mulai garansi wajib diisi.',
            'valid_date' => 'Tanggal mulai garansi tidak valid.',
        ],
        'end_date' => [
            'required'   => 'Tanggal berakhir garansi wajib diisi.',
            'valid_date' => 'Tanggal berakhir garansi tidak valid.',
        ],
        'status' => [
            'required'   => 'Status garansi wajib diisi.',
            'max_length' => 'Status garansi maksimal 50 karakter.',
        ],
        'qr_token' => [
            'required'   => 'QR token wajib diisi.',
            'max_length' => 'QR token maksimal 255 karakter.',
        ],
    ];

    public function findPublicByIdentifier(string $identifier): ?array
    {
        return $this
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
            ->groupStart()
            ->where('warranties.warranty_number', $identifier)
            ->orWhere('product_units.serial_number', $identifier)
            ->groupEnd()
            ->first();
    }


    public function findExpiringWarranties(int $reminderDays): array
    {
        $targetDate = date(
            'Y-m-d',
            strtotime('+' . $reminderDays . ' days')
        );

        return $this
            ->select([
                'warranties.id AS warranty_id',
                'warranties.warranty_number',
                'warranties.end_date',
                'customers.name AS customer_name',
                'customers.whatsapp AS customer_whatsapp',
                'products.name AS product_name',
            ])
            ->join('sales', 'sales.id = warranties.sale_id')
            ->join('customers', 'customers.id = sales.customer_id')
            ->join('product_units', 'product_units.id = sales.product_unit_id')
            ->join('products', 'products.id = product_units.product_id')
            ->where('warranties.status', 'Garansi Aktif')
            ->where('warranties.end_date', $targetDate)
            ->findAll();
    }
}
