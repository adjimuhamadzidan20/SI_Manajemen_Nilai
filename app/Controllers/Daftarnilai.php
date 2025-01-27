<?php

namespace App\Controllers;
use App\Models\PeriodeajaranModel;
use App\Models\DaftarjurusanModel;
use App\Models\DaftarkelasModel;
use App\Models\DaftarmapelModel;
use App\Models\DaftarsiswaModel;
use App\Models\DaftarnilaitugasModel;

class Daftarnilai extends BaseController
{
    public function index()
    {
        $periodeModel = new PeriodeajaranModel();

        $data = [
            'periode' => $periodeModel->dataPeriode()
        ];

        echo view('partials/header');
        echo view('daftar_nilai_view', $data);
        echo view('partials/footer');
    }

    public function tambah() {
        $nilaiTugasModel = new DaftarnilaitugasModel();

        $pesertaDidik = $this->request->getPost('peserta_didik');
        $namaMapel = $this->request->getPost('mapel');
        $kelas = $this->request->getPost('kelas');
        $jurusan = $this->request->getPost('jurusan');
        $periodeAjaran = $this->request->getPost('periode');
        $semester = $this->request->getPost('semester');
        $nilai_1 = $this->request->getPost('tp_1');
        $nilai_2 = $this->request->getPost('tp_2');
        $nilai_3 = $this->request->getPost('tp_3');
        $nilai_4 = $this->request->getPost('tp_4');
        $nilai_5 = $this->request->getPost('tp_5');
        $nilai_6 = $this->request->getPost('tp_6');
        $nilai_7 = $this->request->getPost('tp_7');
        $nilai_8 = $this->request->getPost('tp_8');
        $nilai_9 = $this->request->getPost('tp_9');

        $nilaiTugasModel->tambahDataNilaiTugas($pesertaDidik, $namaMapel, $kelas, $jurusan, $periodeAjaran, 
        $semester, $nilai_1, $nilai_2, $nilai_3, $nilai_4, $nilai_5, $nilai_6, $nilai_7, $nilai_8, $nilai_9);

        return redirect()->to('/daftar_nilai');
    }

     public function ubah() {
        $nilaiTugasModel = new DaftarnilaitugasModel();

        $id = $this->request->getPost('id');
        $pesertaDidik = $this->request->getPost('peserta_didik');
        $namaMapel = $this->request->getPost('mapel');
        $kelas = $this->request->getPost('kelas');
        $jurusan = $this->request->getPost('jurusan');
        $periodeAjaran = $this->request->getPost('periode');
        $semester = $this->request->getPost('semester');
        $nilai_1 = $this->request->getPost('tp_1');
        $nilai_2 = $this->request->getPost('tp_2');
        $nilai_3 = $this->request->getPost('tp_3');
        $nilai_4 = $this->request->getPost('tp_4');
        $nilai_5 = $this->request->getPost('tp_5');
        $nilai_6 = $this->request->getPost('tp_6');
        $nilai_7 = $this->request->getPost('tp_7');
        $nilai_8 = $this->request->getPost('tp_8');
        $nilai_9 = $this->request->getPost('tp_9');

        $nilaiTugasModel->ubahDataNilaiTugas($id, $pesertaDidik, $namaMapel, $kelas, $jurusan, $periodeAjaran, 
        $semester, $nilai_1, $nilai_2, $nilai_3, $nilai_4, $nilai_5, $nilai_6, $nilai_7, $nilai_8, $nilai_9);

        return redirect()->to('/daftar_nilai');
    }

    public function peserta_didik($kelas, $jurusan, $namaMapel, $idMapel, $idPeriode, $semester) {
        $siswaModel = new DaftarsiswaModel();
        $kelasModel = new DaftarkelasModel();
        $jurusanModel = new DaftarjurusanModel();
        $mapelModel = new DaftarmapelModel();
        $nilaiTugasModel = new DaftarnilaitugasModel();
        $periodeModel = new PeriodeajaranModel();

        $data = [
            'siswa' => $siswaModel->pesertaDidik($kelas, $jurusan),

            'id_kelas' => $kelasModel->idKelas($kelas),
            'kelas' => $kelasModel->kelas($kelas),

            'id_jurusan' => $jurusanModel->idJurusan($jurusan),
            'nama_jurusan' => $jurusanModel->jurusan($jurusan),

            'id_mapel' => $mapelModel->dataMapelDetailID($idMapel),
            'nama_mapel' => $mapelModel->dataMapelDetail($namaMapel),
            
            'tahun_ajaran' => $periodeModel->tahunPeriode($idPeriode),
            'id_periode' => $periodeModel->idPeriode($idPeriode),

            'semester' => $semester,
            'nilai' => $nilaiTugasModel->dataNilai($semester), 
        ];

        echo view('partials/header');
        echo view('nilaitugas_siswa', $data);
        echo view('partials/footer');
    }

    public function mapel_nilai($kelas, $namaMapel = "", $idMapel = "") {
        $kelasModel = new DaftarkelasModel();
        $jurusanModel = new DaftarjurusanModel();
        $periodeModel = new PeriodeajaranModel();
        $mapelModel = new DaftarmapelModel();

        $dataKode = $kelasModel->generateKode();
        $noUrut = substr($dataKode, 2, 3);
        $kdSekarang = intval($noUrut) + 1;

        $data = [
            'kelas' => $kelasModel->dataKelasDetail($kelas),
            'jurusan' => $jurusanModel->dataJurusan(),
            'kode' => 'KE'. sprintf('%03s', $kdSekarang),
            'periode' => $periodeModel->dataPeriode(), 
            'mapel' => $mapelModel->dataMapel(),
            'nama_mapel' => $mapelModel->dataMapelDetail($namaMapel),
            'id_mapel' => $mapelModel->dataMapelDetailID($idMapel),
        ];

        echo view('partials/header');   
        echo view('nilaitugas_kelas', $data);
        echo view('partials/footer');
    }

    public function nilai_tugas_periode($thn_ajaran) {
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
        echo view('daftar_nilaitugas_view', $data);
        echo view('partials/footer');
    }

    public function nilai_pts_periode($thn_ajaran) {
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
        echo view('daftar_nilaipts_view', $data);
        echo view('partials/footer');
    }

    public function nilai_pas_periode($thn_ajaran) {
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
        echo view('daftar_nilaipas_view', $data);
        echo view('partials/footer');
    }
}
