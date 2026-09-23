<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateQcDocumentationsTable extends Migration
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
            'type' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'file_path' => [
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
        $this->forge->addKey('qc_inspection_id');

        $this->forge->addForeignKey(
            'qc_inspection_id',
            'qc_inspections',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        $this->forge->createTable('qc_documentations');
    }

    public function down()
    {
        $this->forge->dropTable('qc_documentations', true);
    }
}
