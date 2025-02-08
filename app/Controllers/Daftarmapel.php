<?php

namespace App\Controllers;
use App\Models\DaftarmapelModel;
use App\Models\DaftarjurusanModel;
use App\Models\PeriodeajaranModel;

class Daftarmapel extends BaseController
{
    public function index()
    {
        $periodeModel = new PeriodeajaranModel();

        $data = [
            'periode' => $periodeModel->dataPeriode(),
            'linkActive' => 'daftar_mapel'  
        ];
        
        echo view('partials/header');
        echo view('daftar_mapel_view', $data);
        echo view('partials/footer');
    }

    public function periode($thn_ajaran) {
        $jurusanModel = new DaftarjurusanModel();
        $periodeModel = new PeriodeajaranModel();
        $mapelModel = new DaftarmapelModel();

        $dataKode = $mapelModel->generateKode();
        $noUrut = substr($dataKode, 2, 3);
        $kdSekarang = intval($noUrut) + 1;

        $data = [
            'mapel' => $mapelModel->dataMapel($thn_ajaran),
            'jurusan' => $jurusanModel->dataJurusan(),
            'kode' => 'MA'. sprintf('%03s', $kdSekarang),
            'periode' => $periodeModel->dataPeriode(), 
            'tahun_ajaran' => $periodeModel->tahunPeriode($thn_ajaran),
            'id_periode' => $periodeModel->idPeriode($thn_ajaran),
            'linkActive' => 'daftar_mapel'
        ];

        echo view('partials/header');   
        echo view('daftar_mapel_isi_view', $data);
        echo view('partials/footer');
    }

    public function tambah() {
        $mapelModel = new DaftarmapelModel();

        $kode = $this->request->getPost('kd_mapel');
        $mapel = $this->request->getPost('mapel');
        $kelas = $this->request->getPost('kelas');
        $jurusan = $this->request->getPost('jurusan');
        $tahunAjaran = $this->request->getPost('periode');
        $guru = $this->request->getPost('guru');
        $return = $mapelModel->tambahDataMapel($kode, $mapel, $kelas, $jurusan, $tahunAjaran, $guru);

        if ($return) {
            $pesan = 'Mata pelajaran berhasil ditambahkan!';
            session()->setFlashData('success', $pesan);
        } 
        else {
            $pesan = 'Mata pelajaran gagal ditambahkan!';
            session()->setFlashData('error', $pesan);
        }

        return redirect()->to('/daftar_mapel/periode_mapel/'. $tahunAjaran);
    }

    public function ubah() {
        $mapelModel = new DaftarmapelModel();

        $id = $this->request->getPost('id');
        $kode = $this->request->getPost('kd_mapel');
        $mapel = $this->request->getPost('mapel');
        $kelas = $this->request->getPost('kelas');
        $jurusan = $this->request->getPost('jurusan');
        $tahunAjaran = $this->request->getPost('periode');
        $guru = $this->request->getPost('guru');
        $return = $mapelModel->ubahDataMapel($id, $kode, $mapel, $kelas, $jurusan, $tahunAjaran, $guru);

        if ($return) {
            $pesan = 'Mata pelajaran berhasil diubah!';
            session()->setFlashData('success', $pesan);
        } 
        else {
            $pesan = 'Mata pelajaran gagal diubah!';
            session()->setFlashData('error', $pesan);
        }

        return redirect()->to('/daftar_mapel/periode_mapel/'. $tahunAjaran);
    }

    public function hapus($id) {
        $mapelModel = new DaftarmapelModel();
        $return = $mapelModel->hapusDataMapel($id);

        if ($return) {
            $pesan = 'Mata pelajaran berhasil terhapus!';
            session()->setFlashData('success', $pesan);
        } 
        else {
            $pesan = 'Mata pelajaran gagal terhapus!';
            session()->setFlashData('error', $pesan);
        }

        return redirect()->to('/daftar_mapel');
    }
}
