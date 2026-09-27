<?php

namespace App\Models;

use CodeIgniter\Model;

class QcChecklistItemModel extends Model
{
    protected $table            = 'qc_checklist_items';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    protected $allowedFields = [
        'qc_inspection_id',
        'item_name',
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
        'qc_inspection_id' => 'required|is_natural_no_zero',
        'item_name'        => 'required|max_length[150]',
        'result'           => 'required|max_length[50]',
        'notes'            => 'permit_empty',
    ];

    protected $validationMessages = [
        'qc_inspection_id' => [
            'required'           => 'Pemeriksaan QC wajib tersedia.',
            'is_natural_no_zero' => 'Pemeriksaan QC tidak valid.',
        ],

        'item_name' => [
            'required'   => 'Item checklist wajib tersedia.',
            'max_length' => 'Item checklist maksimal 150 karakter.',
        ],

        'result' => [
            'required'   => 'Hasil checklist wajib diisi.',
            'max_length' => 'Hasil checklist maksimal 50 karakter.',
        ],

        'notes' => [
            'permit_empty' => 'Catatan checklist boleh dikosongkan.',
        ],
    ];
}
