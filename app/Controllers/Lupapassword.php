<?php

namespace App\Controllers;
use App\Models\LupapasswordModel;

class Lupapassword extends BaseController
{
    public function index()
    {
        return view('lupa_password_view');
    }

    public function ganti_password() {
        $resetPass = new LupapasswordModel();

        $email = $this->request->getPost('email');
        $passwordBaru = $this->request->getPost('password_baru');
        $hasil = $resetPass->gantiPass($email, md5($passwordBaru));
        
        if ($hasil) {
            $info = 'Password anda telah terubah!';
            session()->setFlashData('success', $info);
            return redirect()->to('/login');
        } 
        else {
            $info = 'Password anda gagal terubah!';
            session()->setFlashData('error', $info);
            return redirect()->to('/login');
        } 
    }
}
