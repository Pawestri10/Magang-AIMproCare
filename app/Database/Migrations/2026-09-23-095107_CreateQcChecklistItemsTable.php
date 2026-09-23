<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateQcChecklistItemsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'qc_inspection_id' => [
                'type'     => 'BIGINT',
                'unsigned' => true,
            ],
            'item_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
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
        $this->forge->addKey('qc_inspection_id');

        $this->forge->addForeignKey(
            'qc_inspection_id',
            'qc_inspections',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        $this->forge->createTable('qc_checklist_items');
    }

    public function down()
    {
        $this->forge->dropTable('qc_checklist_items', true);
    }
}
