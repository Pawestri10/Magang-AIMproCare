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
}
