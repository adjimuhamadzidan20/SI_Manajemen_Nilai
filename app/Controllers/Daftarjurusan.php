<?php

namespace App\Controllers;
use App\Models\DaftarjurusanModel;

class Daftarjurusan extends BaseController
{   
    public function index()
    {   
        $jurusanModel = new DaftarjurusanModel();

        $dataKode = $jurusanModel->generateKode();
        $noUrut = substr($dataKode, 2, 3);
        $kdSekarang = intval($noUrut) + 1;

        $data = [
            'jurusan' => $jurusanModel->dataJurusan(),
            'kode' => 'JU'. sprintf('%03s', $kdSekarang),
            'linkActive' => 'daftar_jurusan'  
        ];

        echo view('partials/header');   
        echo view('daftar_jurusan_view', $data);
        echo view('partials/footer');
    }

    public function tambah() {
        $jurusanModel = new DaftarjurusanModel();

        $kode = htmlspecialchars($this->request->getPost('kd_jurusan'));
        $jurusan = htmlspecialchars($this->request->getPost('nama_jurusan'));
        $namaPanjang = htmlspecialchars($this->request->getPost('nama_panjang'));
        $return = $jurusanModel->tambahDataJurusan($kode, $jurusan, $namaPanjang);
        
        if ($return) {
            $pesan = 'Data jurusan berhasil ditambahkan!';
            session()->setFlashData('success', $pesan);
        } 
        else {
            $pesan = 'Nama jurusan sudah ada!';
            session()->setFlashData('info', $pesan);
        }
        
        return redirect()->to('/daftar_jurusan');
    }

    public function ubah() {
        $jurusanModel = new DaftarjurusanModel();

        $id = htmlspecialchars($this->request->getPost('id'));
        $kode = htmlspecialchars($this->request->getPost('kd_jurusan'));
        $jurusan = htmlspecialchars($this->request->getPost('nama_jurusan'));
        $namaPanjang = htmlspecialchars($this->request->getPost('nama_panjang'));
        $return = $jurusanModel->ubahDataJurusan($id, $kode, $jurusan, $namaPanjang);

        if ($return) {
            $pesan = 'Data jurusan berhasil diubah!';
            session()->setFlashData('success', $pesan);
        } 
        else {
            $pesan = 'Data jurusan gagal diubah!';
            session()->setFlashData('error', $pesan);
        }

        return redirect()->to('/daftar_jurusan');
    }

    public function hapus($id) {
        $jurusanModel = new DaftarjurusanModel();
        $return = $jurusanModel->hapusDataJurusan($id);

        if ($return) {
            $pesan = 'Data jurusan berhasil terhapus!';
            session()->setFlashData('success', $pesan);
        } 
        else {
            $pesan = 'Data jurusan gagal terhapus!';
            session()->setFlashData('error', $pesan);
        }

        return redirect()->to('/daftar_jurusan');
    }
}
