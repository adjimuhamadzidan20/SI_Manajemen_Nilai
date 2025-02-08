<?php

namespace App\Controllers;
use App\Models\DaftarsiswaModel;
use App\Models\PeriodeajaranModel;
use App\Models\DaftarkelasModel;

class Daftarsiswa extends BaseController
{
    public function index()
    {
        $periodeModel = new PeriodeajaranModel();
        $kelasModel = new DaftarkelasModel();

        $data = [
            'periode' => $periodeModel->dataPeriode(),
            'kelas' => $kelasModel->dataKelasAll(),
            'linkActive' => 'daftar_siswa' 
        ];

        echo view('partials/header');
        echo view('daftar_murid_view', $data);
        echo view('partials/footer');
    }

    public function rinci_kelas($thn_ajaran) {
        $kelasModel = new DaftarkelasModel();
        $periodeModel = new PeriodeajaranModel();

        $data = [
            'kelas' => $kelasModel->dataKelas($thn_ajaran),
            'jumlah' => $kelasModel->jumlahDataKelas($thn_ajaran),
            'tahun_ajaran' => $periodeModel->tahunPeriode($thn_ajaran),
            'linkActive' => 'daftar_siswa'
        ];

        echo view('partials/header');
        echo view('daftar_murid_rinci_view', $data);
        echo view('partials/footer');
    }

    public function rinci_siswa($thn_ajaran, $kelas, $jurusan) {
        $siswaModel = new DaftarsiswaModel();
        $kelasModel = new DaftarkelasModel();

        $dataKode = $siswaModel->generateKode();
        $noUrut = substr($dataKode, 2, 3);
        $kdSekarang = intval($noUrut) + 1;

        $data = [
            'siswa' => $siswaModel->dataSiswa($thn_ajaran, $kelas, $jurusan),
            'kelas' => $kelasModel->detailKelas($thn_ajaran, $kelas, $jurusan),
            'kode' => 'PD'. sprintf('%03s', $kdSekarang),
            'linkActive' => 'daftar_siswa'
        ];

        echo view('partials/header');
        echo view('daftar_murid_isi_view', $data);
        echo view('partials/footer');
    }

    public function tambah() {
        $siswaModel = new DaftarsiswaModel();

        $kode = $this->request->getPost('kd_siswa');
        $nis = $this->request->getPost('nis');
        $nisn = $this->request->getPost('nisn');
        $namaMurid = $this->request->getPost('nama_murid');
        $kelas = $this->request->getPost('kelas');
        $jurusan = $this->request->getPost('jurusan');
        $tahunAjaran = $this->request->getPost('tahun');
        $return = $siswaModel->tambahDataSiswa($kode, $nis, $nisn, $namaMurid, $kelas, $jurusan, $tahunAjaran);

        if ($return) {
            $pesan = 'Peserta didik berhasil ditambahkan!';
            session()->setFlashData('success', $pesan);
        } 
        else {
            $pesan = 'Peserta didik gagal ditambahkan!';
            session()->setFlashData('error', $pesan);
        }

        return redirect()->to('/daftar_siswa/rinci_siswa/'.$tahunAjaran.'/'.$kelas.'/'.$jurusan);
    }

    public function ubah() {
        $siswaModel = new DaftarsiswaModel();

        $id = $this->request->getPost('id');
        $kode = $this->request->getPost('kd_siswa');
        $nis = $this->request->getPost('nis');
        $nisn = $this->request->getPost('nisn');
        $namaMurid = $this->request->getPost('nama_murid');
        $kelas = $this->request->getPost('kelas');
        $jurusan = $this->request->getPost('jurusan');
        $tahunAjaran = $this->request->getPost('tahun');
        $return = $siswaModel->ubahDataSiswa($id, $kode, $nis, $nisn, $namaMurid, $kelas, $jurusan, $tahunAjaran);

        if ($return) {
            $pesan = 'Peserta didik berhasil diubah!';
            session()->setFlashData('success', $pesan);
        } 
        else {
            $pesan = 'Peserta didik gagal diubah!';
            session()->setFlashData('error', $pesan);
        }

        return redirect()->to('/daftar_siswa/rinci_siswa/'.$tahunAjaran.'/'.$kelas.'/'.$jurusan);
    }

    public function hapus($id) {
        $siswaModel = new DaftarsiswaModel();
        $return = $siswaModel->hapusDataSiswa($id);

        if ($return) {
            $pesan = 'Peserta didik berhasil terhapus!';
            session()->setFlashData('success', $pesan);
        } 
        else {
            $pesan = 'Peserta didik gagal terhapus!';
            session()->setFlashData('error', $pesan);
        }

        return redirect()->to('/daftar_siswa');
    }

}
