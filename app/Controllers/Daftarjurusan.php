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
            'kode' => 'JU'. sprintf('%03s', $kdSekarang) 
        ];

        echo view('partials/header');   
        echo view('daftar_jurusan_view', $data);
        echo view('partials/footer');
    }

    public function tambah() {
        $jurusanModel = new DaftarjurusanModel();

        $kode = $this->request->getPost('kd_jurusan');
        $jurusan = $this->request->getPost('nama_jurusan');
        $namaPanjang = $this->request->getPost('nama_panjang');

        $jurusanModel->tambahDataJurusan($kode, $jurusan, $namaPanjang);
        return redirect()->to('/daftar_jurusan');
    }

    public function ubah() {
        $jurusanModel = new DaftarjurusanModel();

        $id = $this->request->getPost('id');
        $kode = $this->request->getPost('kd_jurusan');
        $jurusan = $this->request->getPost('nama_jurusan');
        $namaPanjang = $this->request->getPost('nama_panjang');

        $jurusanModel->ubahDataJurusan($id, $kode, $jurusan, $namaPanjang);
        return redirect()->to('/daftar_jurusan');
    }

    public function hapus($id) {
        $jurusanModel = new DaftarjurusanModel();
        $jurusanModel->hapusDataJurusan($id);
        return redirect()->to('/daftar_jurusan');
    }
}
