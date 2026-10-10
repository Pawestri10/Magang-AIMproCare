<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AllowNullUserIdInClaimHistories extends Migration
{
    public function up()
    {
        $this->db->query(
            'ALTER TABLE claim_histories
             MODIFY user_id BIGINT UNSIGNED NULL'
        );
    }

    public function down()
    {
        $this->db->query(
            'ALTER TABLE claim_histories
             MODIFY user_id BIGINT UNSIGNED NOT NULL'
        );
    }
}
