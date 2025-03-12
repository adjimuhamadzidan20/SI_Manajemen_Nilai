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

        $username =  htmlspecialchars($this->request->getPost('username'));
        $password = htmlspecialchars($this->request->getPost('password'));
        $remember = htmlspecialchars($this->request->getPost('remember'));
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

                if ($remember) {
                    setcookie('ID', $admin['id'], time()+60, '/');
                    setcookie('Key', hash('sha256', $admin['username']), time()+60, '/');
                }

                session()->set($data);
                return redirect()->to('/dashboard');
            } 
            else {
                $info = 'Password anda salah!';
                session()->setFlashData('error', $info);
                return redirect()->to('/login');
            }
        }
        else {
            $info = 'Username atau password anda tidak sesuai!';
            session()->setFlashData('error', $info);
            return redirect()->to('/login');
        }
    }

    public function keluar() {
        session()->destroy();

        setcookie('ID', '', time() - 3600, '/');
        setcookie('Key', '', time() - 3600, '/');
        
        return redirect()->to('/login');
    }   
}
