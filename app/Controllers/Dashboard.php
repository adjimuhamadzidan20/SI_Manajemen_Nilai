<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        echo view('partials/header');
        echo view('dashboard_view');
        echo view('partials/footer');
    }
}
