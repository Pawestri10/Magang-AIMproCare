<?php

namespace App\Models;

use CodeIgniter\Model;

class ClaimHistoryModel extends Model
{
    protected $table            = 'claim_histories';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    protected $allowedFields = [
        'warranty_claim_id',
        'user_id',
        'status',
        'note',
        'changed_at',
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
        'warranty_claim_id' => 'required|is_natural_no_zero',
        'user_id'           => 'permit_empty|is_natural_no_zero',
        'status'            => 'required|max_length[50]',
        'note'              => 'permit_empty',
        'changed_at'        => 'required|valid_date[Y-m-d H:i:s]',
    ];
}
