<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateWarrantyClaimsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'warranty_id' => [
                'type'     => 'BIGINT',
                'unsigned' => true,
            ],
            'claim_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'complaint' => [
                'type' => 'TEXT',
            ],
            'damage_started_at' => [
                'type' => 'DATE',
            ],
            'damage_photo_path' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'damage_video_path' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'whatsapp' => [
                'type'       => 'VARCHAR',
                'constraint' => 25,
            ],
            'delivery_method' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'shipping_address' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'agreement' => [
                'type' => 'BOOLEAN',
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
        $this->forge->addKey('warranty_id');
        $this->forge->addUniqueKey('claim_number');

        $this->forge->addForeignKey(
            'warranty_id',
            'warranties',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        $this->forge->createTable('warranty_claims');
    }

    public function down()
    {
        $this->forge->dropTable('warranty_claims', true);
    }
}
