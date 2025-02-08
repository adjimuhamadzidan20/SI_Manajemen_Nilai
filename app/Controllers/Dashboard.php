<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'linkActive' => 'dashboard'
        ];

        echo view('partials/header');
        echo view('dashboard_view', $data);
        echo view('partials/footer');
    }
}
