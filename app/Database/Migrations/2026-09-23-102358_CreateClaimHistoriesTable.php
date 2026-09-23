<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateClaimHistoriesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'warranty_claim_id' => [
                'type'     => 'BIGINT',
                'unsigned' => true,
            ],
            'user_id' => [
                'type'     => 'BIGINT',
                'unsigned' => true,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'note' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'changed_at' => [
                'type' => 'DATETIME',
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
        $this->forge->addKey('warranty_claim_id');
        $this->forge->addKey('user_id');

        $this->forge->addForeignKey(
            'warranty_claim_id',
            'warranty_claims',
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

        $this->forge->createTable('claim_histories');
    }

    public function down()
    {
        $this->forge->dropTable('claim_histories', true);
    }
}
