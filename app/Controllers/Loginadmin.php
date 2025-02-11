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
                $data = [
                    'id' => $admin['id'],
                    'nama_admin' => $admin['nama_admin'],
                    'username' => $admin['username'],
                    'status' => $admin['status'],
                    'alamat' => $admin['alamat'],
                    'email' => $admin['email']
                ];

                session()->set($data);
                return redirect()->to('/dashboard');
            } 
            else {
                $info = 'Password anda salah!';
                session()->setFlashData('alert', $info);
                return redirect()->to('/login');
            }
        }
        else {
            $info = 'Username atau password anda tidak sesuai!';
            session()->setFlashData('alert', $info);
            return redirect()->to('/login');
        }
    }

    public function keluar() {
        session()->destroy();
        return redirect()->to('/login');
    }   
}
