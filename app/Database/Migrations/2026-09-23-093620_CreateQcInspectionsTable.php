<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateQcInspectionsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'product_unit_id' => [
                'type'     => 'BIGINT',
                'unsigned' => true,
            ],
            'user_id' => [
                'type'     => 'BIGINT',
                'unsigned' => true,
            ],
            'inspection_date' => [
                'type' => 'DATE',
            ],
            'physical_condition' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'completeness' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'result' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'notes' => [
                'type' => 'TEXT',
                'null' => true,
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
        $this->forge->addKey('product_unit_id');
        $this->forge->addKey('user_id');

        $this->forge->addForeignKey(
            'product_unit_id',
            'product_units',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        $this->forge->addForeignKey(
            'user_id',
            'users',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        $this->forge->createTable('qc_inspections');
    }

    public function down()
    {
        $this->forge->dropTable('qc_inspections', true);
    }
}
