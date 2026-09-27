<?php

namespace App\Models;

use CodeIgniter\Model;

class QcInspectionModel extends Model
{
    protected $table            = 'qc_inspections';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    protected $allowedFields = [
        'product_unit_id',
        'user_id',
        'inspection_date',
        'physical_condition',
        'completeness',
        'result',
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
        'product_unit_id'   => 'required|is_natural_no_zero',
        'user_id'           => 'required|is_natural_no_zero',
        'inspection_date'   => 'required|valid_date[Y-m-d]',
        'physical_condition' => 'required|max_length[100]',
        'completeness'      => 'required|max_length[100]',
        'result'            => 'required|in_list[Lolos QC,Tidak Lolos QC,Perlu Pemeriksaan Ulang]',
        'notes'             => 'permit_empty',
    ];

    protected $validationMessages = [
        'product_unit_id' => [
            'required'           => 'Unit produk wajib dipilih.',
            'is_natural_no_zero' => 'Unit produk tidak valid.',
        ],

        'user_id' => [
            'required'           => 'Petugas QC wajib tersedia.',
            'is_natural_no_zero' => 'Petugas QC tidak valid.',
        ],

        'inspection_date' => [
            'required'   => 'Tanggal pemeriksaan wajib diisi.',
            'valid_date' => 'Tanggal pemeriksaan tidak valid.',
        ],

        'physical_condition' => [
            'required'   => 'Kondisi fisik wajib diisi.',
            'max_length' => 'Kondisi fisik maksimal 100 karakter.',
        ],

        'completeness' => [
            'required'   => 'Kelengkapan wajib diisi.',
            'max_length' => 'Kelengkapan maksimal 100 karakter.',
        ],

        'result' => [
            'required' => 'Hasil pemeriksaan wajib dipilih.',
            'in_list'  => 'Hasil pemeriksaan tidak valid.',
        ],

        'notes' => [
            'permit_empty' => 'Catatan QC boleh dikosongkan.',
        ],
    ];
}
