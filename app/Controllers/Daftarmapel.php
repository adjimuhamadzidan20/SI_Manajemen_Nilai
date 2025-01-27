<?php

namespace App\Controllers;
use App\Models\DaftarmapelModel;

class Daftarmapel extends BaseController
{
    public function index()
    {
        $mapelModel = new DaftarmapelModel();

        $dataKode = $mapelModel->generateKode();
        $noUrut = substr($dataKode, 2, 3);
        $kdSekarang = intval($noUrut) + 1;

        $data = [
            'mapel' => $mapelModel->dataMapel(),
            'kode' => 'MA'. sprintf('%03s', $kdSekarang)
        ];
        
        echo view('partials/header');
        echo view('daftar_mapel_view', $data);
        echo view('partials/footer');
    }

    public function tambah() {
        $mapelModel = new DaftarmapelModel();

        $kode = $this->request->getPost('kd_mapel');
        $mapel = $this->request->getPost('mapel');
        $kelas = $this->request->getPost('kelas');
        $guru = $this->request->getPost('guru');

        $mapelModel->tambahDataMapel($kode, $mapel, $kelas, $guru);
        return redirect()->to('/daftar_mapel');
    }

    public function ubah() {
        $mapelModel = new DaftarmapelModel();

        $id = $this->request->getPost('id');
        $kode = $this->request->getPost('kd_mapel');
        $mapel = $this->request->getPost('mapel');
        $kelas = $this->request->getPost('kelas');
        $guru = $this->request->getPost('guru');

        $mapelModel->ubahDataMapel($id, $kode, $mapel, $kelas, $guru);
        return redirect()->to('/daftar_mapel');
    }

    public function hapus($id) {
        $mapelModel = new DaftarmapelModel();
        $mapelModel->hapusDataMapel($id);
        return redirect()->to('/daftar_mapel');
    }
}
