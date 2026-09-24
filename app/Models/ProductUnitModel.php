<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductUnitModel extends Model
{
    protected $table            = 'product_units';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    protected $allowedFields = [
        'product_id',
        'serial_number',
        'status',
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
        'product_id'    => 'required|is_natural_no_zero',
        'serial_number' => 'required|max_length[100]',
        'status'        => 'required|in_list[Draft,Menunggu QC,Perlu Pemeriksaan Ulang,Tidak Lolos QC,Siap Dijual,Terjual,Dikembalikan]',
    ];

    protected $validationMessages = [
        'product_id' => [
            'required'             => 'Produk wajib dipilih.',
            'is_natural_no_zero'   => 'Produk tidak valid.',
        ],
        'serial_number' => [
            'required'   => 'Nomor serial wajib diisi.',
            'max_length' => 'Nomor serial maksimal 100 karakter.',
        ],
        'status' => [
            'required' => 'Status unit wajib diisi.',
            'in_list'  => 'Status unit tidak valid.',
        ],
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
