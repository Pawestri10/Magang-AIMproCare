<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSalesTable extends Migration
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
            'customer_id' => [
                'type'     => 'BIGINT',
                'unsigned' => true,
            ],
            'purchase_date' => [
                'type' => 'DATE',
            ],
            'invoice_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'purchase_location' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'marketplace_order_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'warranty_duration' => [
                'type' => 'INT',
            ],
            'warranty_start_date' => [
                'type' => 'DATE',
            ],
            'purchase_receipt_path' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
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
        $this->forge->addUniqueKey('product_unit_id');
        $this->forge->addKey('customer_id');

        $this->forge->addForeignKey(
            'product_unit_id',
            'product_units',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        $this->forge->addForeignKey(
            'customer_id',
            'customers',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        $this->forge->createTable('sales');
    }

    public function down()
    {
        $this->forge->dropTable('sales', true);
    }
}
