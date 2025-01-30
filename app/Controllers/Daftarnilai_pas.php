<?php

namespace App\Controllers;
use App\Models\PeriodeajaranModel;
use App\Models\DaftarjurusanModel;
use App\Models\DaftarkelasModel;
use App\Models\DaftarmapelModel;
use App\Models\DaftarsiswaModel;
use App\Models\DaftarnilaipasModel;

class Daftarnilai_pas extends BaseController
{
    public function nilai_pas_periode($thn_ajaran) {
        $kelasModel = new DaftarkelasModel();
        $jurusanModel = new DaftarjurusanModel();
        $periodeModel = new PeriodeajaranModel();
        $mapelModel = new DaftarmapelModel();

        $dataKode = $kelasModel->generateKode();
        $noUrut = substr($dataKode, 2, 3);
        $kdSekarang = intval($noUrut) + 1;

        $data = [
            'kelas' => $kelasModel->dataKelas($thn_ajaran),
            'jurusan' => $jurusanModel->dataJurusan(),
            'kode' => 'KE'. sprintf('%03s', $kdSekarang),
            'periode' => $periodeModel->dataPeriode(), 
            'tahun_ajaran' => $periodeModel->tahunPeriode($thn_ajaran),
            'id_periode' => $periodeModel->idPeriode($thn_ajaran),
            'mapel' => $mapelModel->dataMapel()
        ];

        echo view('partials/header');   
        echo view('daftar_nilaipas_view', $data);
        echo view('partials/footer');
    }

    public function tambah() {
        $nilaiPasModel = new DaftarnilaipasModel();

        $pesertaDidik = $this->request->getPost('peserta_didik');
        $namaMapel = $this->request->getPost('mapel');
        $kelas = $this->request->getPost('kelas');
        $jurusan = $this->request->getPost('jurusan');
        $periodeAjaran = $this->request->getPost('periode');
        $semester = $this->request->getPost('semester');
        $nilaiPas = $this->request->getPost('nilai_pas');

        $nilaiPasModel->tambahDataNilaiPas($pesertaDidik, $namaMapel, $kelas, $jurusan, 
        $periodeAjaran, $semester, $nilaiPas);

        return redirect()->to('/daftar_nilai');
    }

     public function ubah() {
        $nilaiPasModel = new DaftarnilaipasModel();

        $id = $this->request->getPost('id');
        $pesertaDidik = $this->request->getPost('peserta_didik');
        $namaMapel = $this->request->getPost('mapel');
        $kelas = $this->request->getPost('kelas');
        $jurusan = $this->request->getPost('jurusan');
        $periodeAjaran = $this->request->getPost('periode');
        $semester = $this->request->getPost('semester');
        $nilaiPas = $this->request->getPost('nilai_pas');

        $nilaiPasModel->ubahDataNilaiPas($id, $pesertaDidik, $namaMapel, $kelas, $jurusan, 
        $periodeAjaran, $semester, $nilaiPas);

        return redirect()->to('/daftar_nilai');
    }

    public function peserta_didik($kelas, $jurusan, $namaMapel, $idMapel, $idPeriode, $semester) {
        $siswaModel = new DaftarsiswaModel();
        $kelasModel = new DaftarkelasModel();
        $jurusanModel = new DaftarjurusanModel();
        $mapelModel = new DaftarmapelModel();
        $nilaiPasModel = new DaftarnilaipasModel();
        $periodeModel = new PeriodeajaranModel();

        $data = [
            'siswa' => $siswaModel->pesertaDidik($kelas, $jurusan),

            // 'id_kelas' => $kelasModel->idKelas($kelas),
            'kelas' => $kelasModel->kelas($kelas),

            'id_jurusan' => $jurusanModel->idJurusan($jurusan),
            'nama_jurusan' => $jurusanModel->jurusan($jurusan),

            'id_mapel' => $mapelModel->dataMapelDetailID($idMapel),
            'nama_mapel' => $mapelModel->dataMapelDetail($namaMapel),
            
            'tahun_ajaran' => $periodeModel->tahunPeriode($idPeriode),
            'id_periode' => $periodeModel->idPeriode($idPeriode),

            'semester' => $semester,
            'nilai' => $nilaiPasModel->dataNilai($semester, $idPeriode, $kelas, $jurusan, $idMapel), 
        ];

        echo view('partials/header');
        echo view('nilaipas_siswa', $data);
        echo view('partials/footer');
    }
}
