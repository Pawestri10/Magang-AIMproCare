<?php

namespace App\Services;

use App\Models\ActivityLogModel;

class ActivityLogService
{
    protected ActivityLogModel $activityLogModel;

    public function __construct()
    {
        $this->activityLogModel = new ActivityLogModel();
    }

    public function log(string $action, string $description): bool
    {
        $session = session();

        $userId = $session->get('user_id');

        if (!$userId) {
            return false;
        }

        return (bool) $this->activityLogModel->insert([
            'user_id'     => $userId,
            'action'      => $action,
            'description' => $description,
        ]);
    }
}
