<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateWarrantiesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'sale_id' => [
                'type'     => 'BIGINT',
                'unsigned' => true,
            ],
            'warranty_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'start_date' => [
                'type' => 'DATE',
            ],
            'end_date' => [
                'type' => 'DATE',
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'qr_token' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('sale_id');
        $this->forge->addUniqueKey('warranty_number');
        $this->forge->addUniqueKey('qr_token');

        $this->forge->addForeignKey(
            'sale_id',
            'sales',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        $this->forge->createTable('warranties');
    }

    public function down()
    {
        $this->forge->dropTable('warranties', true);
    }
}
