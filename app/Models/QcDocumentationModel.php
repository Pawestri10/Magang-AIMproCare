<?php

namespace App\Models;

use CodeIgniter\Model;

class QcDocumentationModel extends Model
{
    protected $table            = 'qc_documentations';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    protected $allowedFields = [
        'qc_inspection_id',
        'type',
        'file_path',
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
        'qc_inspection_id' => 'required|is_natural_no_zero',
        'type'             => 'required|max_length[50]',
        'file_path'        => 'required|max_length[255]',
    ];

    protected $validationMessages = [
        'qc_inspection_id' => [
            'required' => 'Data pemeriksaan wajib tersedia.',
        ],
        'type' => [
            'required' => 'Jenis dokumentasi wajib tersedia.',
        ],
        'file_path' => [
            'required' => 'Path file wajib tersedia.',
        ],
    ];
}
