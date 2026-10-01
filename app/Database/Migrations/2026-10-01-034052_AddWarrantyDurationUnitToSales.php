<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddWarrantyDurationUnitToSales extends Migration
{
    public function up()
    {
        $this->forge->addColumn('sales', [
            'warranty_duration_unit' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
                'null'       => true,
                'after'      => 'warranty_duration',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('sales', 'warranty_duration_unit');
    }
}
