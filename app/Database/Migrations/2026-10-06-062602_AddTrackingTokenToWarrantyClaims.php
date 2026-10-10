<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTrackingTokenToWarrantyClaims extends Migration
{
    public function up()
    {
        $this->forge->addColumn('warranty_claims', [
            'tracking_token' => [
                'type'       => 'VARCHAR',
                'constraint' => 64,
                'null'       => true,
                'after'      => 'claim_number',
            ],
        ]);

        $claims = $this->db
            ->table('warranty_claims')
            ->select('id')
            ->get()
            ->getResultArray();

        foreach ($claims as $claim) {
            do {
                $trackingToken = bin2hex(random_bytes(32));

                $exists = $this->db
                    ->table('warranty_claims')
                    ->where('tracking_token', $trackingToken)
                    ->countAllResults();
            } while ($exists > 0);

            $this->db
                ->table('warranty_claims')
                ->where('id', $claim['id'])
                ->update([
                    'tracking_token' => $trackingToken,
                ]);
        }

        $this->forge->addUniqueKey('tracking_token');
    }

    public function down()
    {
        $this->forge->dropColumn('warranty_claims', 'tracking_token');
    }
}
