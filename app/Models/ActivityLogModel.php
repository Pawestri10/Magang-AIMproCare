<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivityLogModel extends Model
{
    protected $table            = 'activity_logs';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    protected $allowedFields = [
        'user_id',
        'action',
        'description',
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
        'user_id' => 'required|is_natural_no_zero',
        'action' => 'required|max_length[100]',
        'description' => 'required|max_length[255]',
    ];

    protected $validationMessages = [
        'user_id' => [
            'required' => 'User wajib diisi.',
            'is_natural_no_zero' => 'User tidak valid.',
        ],
        'action' => [
            'required' => 'Aktivitas wajib diisi.',
            'max_length' => 'Aktivitas maksimal 100 karakter.',
        ],
        'description' => [
            'required' => 'Deskripsi aktivitas wajib diisi.',
            'max_length' => 'Deskripsi maksimal 255 karakter.',
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
