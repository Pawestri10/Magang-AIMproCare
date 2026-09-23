<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductUnitsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'product_id' => [
                'type'       => 'BIGINT',
                'unsigned'   => true,
            ],
            'serial_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
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
        $this->forge->addKey('product_id');
        $this->forge->addUniqueKey('serial_number');

        $this->forge->addForeignKey(
            'product_id',
            'products',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        $this->forge->createTable('product_units');
    }

    public function down()
    {
        $this->forge->dropTable('product_units', true);
    }
}
