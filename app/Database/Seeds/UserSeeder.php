<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'       => 'Administrator',
                'email'      => 'admin@aimpro.care',
                'password'   => password_hash('admin123', PASSWORD_DEFAULT),
                'role'       => 'Administrator',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'       => 'Petugas QC',
                'email'      => 'qc@aimpro.care',
                'password'   => password_hash('qc123', PASSWORD_DEFAULT),
                'role'       => 'Petugas QC',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
