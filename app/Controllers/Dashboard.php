<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'linkActive' => 'dashboard',
            'tab_name' => 'Dashboard'
        ];

        echo view('partials/header', $data);
        echo view('dashboard_view', $data);
        echo view('partials/footer');
    }
}
