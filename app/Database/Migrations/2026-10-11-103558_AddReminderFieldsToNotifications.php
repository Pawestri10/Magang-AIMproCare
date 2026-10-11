<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddReminderFieldsToNotifications extends Migration
{
    public function up()
    {
        $this->forge->addColumn('notifications', [
            'warranty_id' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'id',
            ],
            'reminder_date' => [
                'type' => 'DATE',
                'null' => true,
                'after' => 'warranty_id',
            ],
        ]);

        $this->db->query(
            'CREATE INDEX idx_notifications_expiry_reminder
         ON notifications (template, warranty_id, reminder_date, status)'
        );
    }

    public function down()
    {
        $this->db->query(
            'DROP INDEX idx_notifications_expiry_reminder ON notifications'
        );

        $this->forge->dropColumn(
            'notifications',
            ['warranty_id', 'reminder_date']
        );
    }
}
