<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $useSoftDeletes = true;

    protected $protectFields = true;
    protected $allowedFields = [
        'name',
        'whatsapp',
        'email',
        'address',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [
        'name'     => 'required|max_length[150]',
        'whatsapp' => 'required|max_length[25]',
        'email'    => 'permit_empty|valid_email|max_length[150]',
        'address'  => 'required',
    ];

    protected $validationMessages = [
        'name' => [
            'required'   => 'Nama pembeli wajib diisi.',
            'max_length' => 'Nama pembeli maksimal 150 karakter.',
        ],
        'whatsapp' => [
            'required'   => 'Nomor WhatsApp wajib diisi.',
            'max_length' => 'Nomor WhatsApp maksimal 25 karakter.',
        ],
        'email' => [
            'valid_email' => 'Format email tidak valid.',
            'max_length'  => 'Email maksimal 150 karakter.',
        ],
        'address' => [
            'required' => 'Alamat wajib diisi.',
        ],
    ];
}
