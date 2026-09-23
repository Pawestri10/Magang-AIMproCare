<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNotificationsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'recipient' => [
                'type'       => 'VARCHAR',
                'constraint' => 25,
            ],
            'template' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'sent_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
            ],
            'gateway_response' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
        ]);
        $this->forge->addKey('id', true);

        $this->forge->createTable('notifications');
    }

    public function down()
    {
        $this->forge->dropTable('notifications', true);
    }
}
