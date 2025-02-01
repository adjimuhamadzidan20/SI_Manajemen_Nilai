<?php

namespace App\Controllers;
use App\Models\DaftarkelasModel;
use App\Models\DaftarjurusanModel;
use App\Models\PeriodeajaranModel;

class Daftarkelas extends BaseController
{   
    public function index()
    {   
        $periodeModel = new PeriodeajaranModel();

        $data = [
            'periode' => $periodeModel->dataPeriode() 
        ];

        echo view('partials/header');   
        echo view('daftar_kelas_view', $data);
        echo view('partials/footer');
    }

    public function periode($thn_ajaran) {
        $kelasModel = new DaftarkelasModel();
        $jurusanModel = new DaftarjurusanModel();
        $periodeModel = new PeriodeajaranModel();

        $dataKode = $kelasModel->generateKode();
        $noUrut = substr($dataKode, 2, 3);
        $kdSekarang = intval($noUrut) + 1;

        $data = [
            'kelas' => $kelasModel->dataKelas($thn_ajaran),
            'jurusan' => $jurusanModel->dataJurusan(),
            'kode' => 'KE'. sprintf('%03s', $kdSekarang),
            'periode' => $periodeModel->dataPeriode(), 
            'tahun_ajaran' => $periodeModel->tahunPeriode($thn_ajaran),
            'id_periode' => $periodeModel->idPeriode($thn_ajaran)
        ];

        echo view('partials/header');   
        echo view('daftar_kelas_isi_view', $data);
        echo view('partials/footer');
    }

    public function tambah() {
        $kelasModel = new DaftarkelasModel();

        $kode = $this->request->getPost('kd_kelas');
        $keahlian = $this->request->getPost('keahlian');
        $kelas = $this->request->getPost('kelas');
        $periode = $this->request->getPost('tahun');

        $kelasModel->tambahDataKelas($kode, $keahlian, $kelas, $periode);
        return redirect()->to('/daftar_kelas/periode_kelas/'. $periode);
    }

    public function ubah() {
        $kelasModel = new DaftarkelasModel();

        $id = $this->request->getPost('id');
        $kode = $this->request->getPost('kd_kelas');
        $keahlian = $this->request->getPost('keahlian');
        $kelas = $this->request->getPost('kelas');
        $periode = $this->request->getPost('tahun');

        $kelasModel->ubahDataKelas($id, $kode, $keahlian, $kelas, $periode);
        return redirect()->to('/daftar_kelas/periode_kelas/'. $periode);
    }

    public function hapus($id) {
        $kelasModel = new DaftarkelasModel();
        $kelasModel->hapusDataKelas($id);
        return redirect()->to('/daftar_kelas');
    }


}
