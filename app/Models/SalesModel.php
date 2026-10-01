<?php

namespace App\Models;

use CodeIgniter\Model;

class SalesModel extends Model
{
    protected $table            = 'sales';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    protected $allowedFields = [
        'product_unit_id',
        'customer_id',
        'purchase_date',
        'invoice_number',
        'purchase_location',
        'marketplace_order_number',
        'warranty_duration',
        'warranty_duration_unit',
        'warranty_start_date',
        'purchase_receipt_path',
        'notes',
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
        'product_unit_id' => 'required|is_natural_no_zero',
        'customer_id' => 'required|is_natural_no_zero',
        'purchase_date' => 'required|valid_date[Y-m-d]',
        'invoice_number' => 'required|max_length[100]',
        'purchase_location' => 'required|max_length[150]',
        'marketplace_order_number' => 'permit_empty|max_length[100]',
        'warranty_duration' => 'required|is_natural_no_zero',
        'warranty_duration_unit' => 'required|in_list[Bulan,Tahun]',
        'warranty_start_date' => 'required|valid_date[Y-m-d]',
        'purchase_receipt_path' => 'permit_empty|max_length[255]',
        'notes' => 'permit_empty',
    ];

    protected $validationMessages = [
        'product_unit_id' => [
            'required' => 'Unit produk wajib dipilih.',
            'is_natural_no_zero' => 'Unit produk tidak valid.',
        ],
        'customer_id' => [
            'required' => 'Pembeli wajib dipilih.',
            'is_natural_no_zero' => 'Pembeli tidak valid.',
        ],
        'purchase_date' => [
            'required' => 'Tanggal pembelian wajib diisi.',
            'valid_date' => 'Tanggal pembelian tidak valid.',
        ],
        'invoice_number' => [
            'required' => 'Nomor invoice atau nota wajib diisi.',
            'max_length' => 'Nomor invoice atau nota maksimal 100 karakter.',
        ],
        'purchase_location' => [
            'required' => 'Marketplace atau lokasi pembelian wajib diisi.',
            'max_length' => 'Marketplace atau lokasi pembelian maksimal 150 karakter.',
        ],
        'marketplace_order_number' => [
            'max_length' => 'Nomor pesanan marketplace maksimal 100 karakter.',
        ],
        'warranty_duration' => [
            'required' => 'Durasi garansi wajib diisi.',
            'is_natural_no_zero' => 'Durasi garansi tidak valid.',
        ],
        'warranty_duration_unit' => [
            'required' => 'Satuan durasi garansi wajib dipilih.',
            'in_list' => 'Satuan durasi garansi harus Bulan atau Tahun.',
        ],
        'warranty_start_date' => [
            'required' => 'Tanggal mulai garansi wajib diisi.',
            'valid_date' => 'Tanggal mulai garansi tidak valid.',
        ],
        'purchase_receipt_path' => [
            'max_length' => 'Path nota pembelian maksimal 255 karakter.',
        ],
    ];
}
