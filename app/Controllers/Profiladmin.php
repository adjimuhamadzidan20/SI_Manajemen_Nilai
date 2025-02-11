<?php

namespace App\Controllers;
use App\Models\LoginadminModel;

class Profiladmin extends BaseController
{
    public function index()
    {
        $adminModel = new LoginadminModel();
        $id = session()->get('id');

        $data = [
            'dtadmin' => $adminModel->dataAdmin($id),
            'linkActive' => 'profil' 
        ];

        echo view('partials/header');
        echo view('profil_view', $data);
        echo view('partials/footer');
    }

    public function ubah_pass() {
        $adminModel = new LoginadminModel();

        $id = $this->request->getPost('id');
        $password = $this->request->getPost('password');
        $return = $adminModel->ubahPassword($id, $password);

        if ($return) {
            $pesan = 'Password berhasil diubah!';
            session()->setFlashData('success', $pesan);
        } 
        else {
            $pesan = 'Password gagal diubah!';
            session()->setFlashData('error', $pesan);
        }

        return redirect()->to('/profil_admin');
    }

    public function ubah_user() {
        $adminModel = new LoginadminModel();

        $id = $this->request->getPost('id');
        $username = $this->request->getPost('username');
        $return = $adminModel->ubahUsername($id, $username);

        if ($return) {
            $pesan = 'Username berhasil diubah!';
            session()->setFlashData('success', $pesan);
        } 
        else {
            $pesan = 'Username gagal diubah!';
            session()->setFlashData('error', $pesan);
        }

        return redirect()->to('/profil_admin');
    }

    public function ubah_nama() {
        $adminModel = new LoginadminModel();

        $id = $this->request->getPost('id');
        $namaAdmin = $this->request->getPost('nama_admin');
        $return = $adminModel->ubahNamaAdmin($id, $namaAdmin);

        if ($return) {
            $pesan = 'Username berhasil diubah!';
            session()->setFlashData('success', $pesan);
        } 
        else {
            $pesan = 'Username gagal diubah!';
            session()->setFlashData('error', $pesan);
        }

        return redirect()->to('/profil_admin');
    }

    public function ubah_alamat() {
        $adminModel = new LoginadminModel();

        $id = $this->request->getPost('id');
        $alamat = $this->request->getPost('alamat');
        $return = $adminModel->ubahAlamat($id, $alamat);

        if ($return) {
            $pesan = 'Alamat berhasil diubah!';
            session()->setFlashData('success', $pesan);
        } 
        else {
            $pesan = 'Alamat gagal diubah!';
            session()->setFlashData('error', $pesan);
        }

        return redirect()->to('/profil_admin');
    }

    public function ubah_email() {
        $adminModel = new LoginadminModel();

        $id = $this->request->getPost('id');
        $email = $this->request->getPost('email');
        $return = $adminModel->ubahEmail($id, $email);

        if ($return) {
            $pesan = 'Email berhasil diubah!';
            session()->setFlashData('success', $pesan);
        } 
        else {
            $pesan = 'Email gagal diubah!';
            session()->setFlashData('error', $pesan);
        }

        return redirect()->to('/profil_admin');
    }
}
