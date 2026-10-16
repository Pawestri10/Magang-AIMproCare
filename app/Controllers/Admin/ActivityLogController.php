<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ActivityLogModel;

class ActivityLogController extends BaseController
{
    protected ActivityLogModel $activityLogModel;

    public function __construct()
    {
        $this->activityLogModel = new ActivityLogModel();
    }

    public function index()
    {
        $search = trim((string) $this->request->getGet('search'));
        $action = trim((string) $this->request->getGet('action'));
        $startDate = trim((string) $this->request->getGet('start_date'));
        $endDate = trim((string) $this->request->getGet('end_date'));

        $allowedActions = $this->activityLogModel
            ->select('action')
            ->distinct()
            ->orderBy('action', 'ASC')
            ->findAll();

        $builder = $this->activityLogModel
            ->select('activity_logs.*, users.name AS user_name')
            ->join('users', 'users.id = activity_logs.user_id');

        if ($search !== '') {
            $builder
                ->groupStart()
                ->like('users.name', $search)
                ->orLike('activity_logs.action', $search)
                ->orLike('activity_logs.description', $search)
                ->groupEnd();
        }

        if ($action !== '') {
            $builder->where('activity_logs.action', $action);
        }

        if ($startDate !== '') {
            $builder->where('activity_logs.created_at >=', $startDate . ' 00:00:00');
        }

        if ($endDate !== '') {
            $builder->where('activity_logs.created_at <=', $endDate . ' 23:59:59');
        }

        $totalLogs = $builder->countAllResults(false);

        $logs = $builder
            ->orderBy('activity_logs.created_at', 'DESC')
            ->orderBy('activity_logs.id', 'DESC')
            ->paginate(10);

        return view('admin/activity_logs/index', [
            'logs' => $logs,
            'pager' => $this->activityLogModel->pager,
            'totalLogs' => $totalLogs,
            'search' => $search,
            'action' => $action,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'allowedActions' => $allowedActions,
        ]);
    }
}
