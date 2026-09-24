<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table            = 'products';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;

    protected $allowedFields = [
        'name',
        'brand',
        'model',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules = [
        'name'  => 'required|max_length[150]',
        'brand' => 'required|max_length[100]',
        'model' => 'required|max_length[100]',
    ];

    protected $validationMessages = [
        'name' => [
            'required'   => 'Nama produk wajib diisi.',
            'max_length' => 'Nama produk maksimal 150 karakter.',
        ],
        'brand' => [
            'required'   => 'Brand wajib diisi.',
            'max_length' => 'Brand maksimal 100 karakter.',
        ],
        'model' => [
            'required'   => 'Model wajib diisi.',
            'max_length' => 'Model maksimal 100 karakter.',
        ],
    ];

    protected $skipValidation = false;
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
