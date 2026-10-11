<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
    protected $table            = 'settings';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $protectFields = true;

    protected $allowedFields = [
        'key',
        'value',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getValue(string $key, ?string $default = null): ?string
    {
        $setting = $this->where('key', $key)->first();

        return $setting['value'] ?? $default;
    }

    public function setValue(string $key, string $value): bool
    {
        $setting = $this->where('key', $key)->first();

        if ($setting) {
            return (bool) $this->update($setting['id'], [
                'value' => $value,
            ]);
        }

        return (bool) $this->insert([
            'key'   => $key,
            'value' => $value,
        ]);
    }
}
