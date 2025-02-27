<?php

namespace App\Controllers;
use App\Models\PeriodeajaranModel;

class Periodeajaran extends BaseController
{
    public function index()
    {
        $periodeModel = new PeriodeajaranModel();

        $dataKode = $periodeModel->generateKode();
        $noUrut = substr($dataKode, 2, 3);
        $kdSekarang = intval($noUrut) + 1;

        $data = [
            'periode' => $periodeModel->dataPeriode(),
            'kode' => 'PA'. sprintf('%03s', $kdSekarang),
            'linkActive' => 'periode' 
        ];

        echo view('partials/header');
        echo view('periode_ajaran_view', $data);
        echo view('partials/footer');
    }

    public function tambah() {
        $periodeModel = new PeriodeajaranModel();

        $kode = $this->request->getPost('kd_ajaran');
        $semester1 = $this->request->getPost('semester_1');
        $semester2 = $this->request->getPost('semester_2');
        $tahunAjaran = $this->request->getPost('tahun_ajaran');
        $return = $periodeModel->tambahDataPeriode($kode, $semester1, $semester2, $tahunAjaran);

        if ($return) {
            $pesan = 'Tahun ajaran berhasil ditambahkan!';
            session()->setFlashData('success', $pesan);
        } 
        else {
            $pesan = 'Tahun ajaran sudah ada!';
            session()->setFlashData('info', $pesan);
        }
        
        return redirect()->to('/periode_ajar');  
    }

    public function ubah() {
        $periodeModel = new PeriodeajaranModel();

        $id = $this->request->getPost('id');
        $kode = $this->request->getPost('kd_ajaran');
        $semester1 = $this->request->getPost('semester_1');
        $semester2 = $this->request->getPost('semester_2');
        $tahunAjaran = $this->request->getPost('tahun_ajaran');
        $return = $periodeModel->ubahDataPeriode($id, $kode, $semester1, $semester2, $tahunAjaran);

        if ($return) {
            $pesan = 'Tahun ajaran berhasil diubah!';
            session()->setFlashData('success', $pesan);
        } 
        else {
            $pesan = 'Tahun ajaran gagal diubah!';
            session()->setFlashData('error', $pesan);
        }

        return redirect()->to('/periode_ajar');
    }

    public function hapus($id) {
        $periodeModel = new PeriodeajaranModel();
        $return = $periodeModel->hapusDataPeriode($id);

        if ($return) {
            $pesan = 'Tahun ajaran berhasil terhapus!';
            session()->setFlashData('success', $pesan);
        } 
        else {
            $pesan = 'Tahun ajaran gagal terhapus!';
            session()->setFlashData('error', $pesan);
        }

        return redirect()->to('/periode_ajar');
    }
}
