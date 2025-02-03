<?php

namespace App\Controllers;
use App\Models\LoginadminModel;

class Loginadmin extends BaseController
{
    public function index()
    {
        return view('login_admin_view');
    }

    public function masuk() {
        $adminModel = new LoginadminModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $admin = $adminModel->masukAdmin($username);

        if ($admin) {
            if ($admin['password'] == md5($password)) {
                return redirect()->to('/dashboard');
            } 
            else {
                return redirect()->to('/login');
            }
        }
        else {
            return redirect()->to('/login');
        }

    }

    // public function keluar() {

    // }
}
