<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function admin()
    {
        return '
            <h1>Dashboard Administrator</h1>
            <a href="/logout">Logout</a>
        ';
    }

    public function qc()
    {
        return '
            <h1>Dashboard Petugas QC</h1>
            <a href="/logout">Logout</a>
        ';
    }
}
