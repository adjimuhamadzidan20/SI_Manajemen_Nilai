<?php

namespace App\Controllers;
use App\Models\PeriodeajaranModel;
use App\Models\DaftarjurusanModel;
use App\Models\DaftarkelasModel;
use App\Models\DaftarmapelModel;
use App\Models\DaftarsiswaModel;
use App\Models\DaftarnilaiptsModel;

class Daftarnilai_pts extends BaseController
{
    public function nilai_pts_periode($thn_ajaran) {
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
        echo view('daftar_nilaipts_view', $data);
        echo view('partials/footer');
    }

    public function tambah() {
        $nilaiPtsModel = new DaftarnilaiptsModel();

        $pesertaDidik = $this->request->getPost('peserta_didik');
        $namaMapel = $this->request->getPost('mapel');
        $kelas = $this->request->getPost('kelas');
        $jurusan = $this->request->getPost('jurusan');
        $periodeAjaran = $this->request->getPost('periode');
        $semester = $this->request->getPost('semester');
        $nilaiPts = $this->request->getPost('nilai_pts');

        $nilaiPtsModel->tambahDataNilaiPts($pesertaDidik, $namaMapel, $kelas, $jurusan, 
        $periodeAjaran, $semester, $nilaiPts);

        return redirect()->to('/daftar_nilai');
    }

     public function ubah() {
        $nilaiPtsModel = new DaftarnilaiptsModel();

        $id = $this->request->getPost('id');
        $pesertaDidik = $this->request->getPost('peserta_didik');
        $namaMapel = $this->request->getPost('mapel');
        $kelas = $this->request->getPost('kelas');
        $jurusan = $this->request->getPost('jurusan');
        $periodeAjaran = $this->request->getPost('periode');
        $semester = $this->request->getPost('semester');
        $nilaiPts = $this->request->getPost('nilai_pts');

        $nilaiPtsModel->ubahDataNilaiPts($id, $pesertaDidik, $namaMapel, $kelas, $jurusan, 
        $periodeAjaran, $semester, $nilaiPts);

        return redirect()->to('/daftar_nilai');
    }

    public function peserta_didik($kelas, $jurusan, $namaMapel, $idMapel, $idPeriode, $semester) {
        $siswaModel = new DaftarsiswaModel();
        $kelasModel = new DaftarkelasModel();
        $jurusanModel = new DaftarjurusanModel();
        $mapelModel = new DaftarmapelModel();
        $nilaiPtsModel = new DaftarnilaiptsModel();
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
            'nilai' => $nilaiPtsModel->dataNilai($semester, $idPeriode, $kelas, $jurusan, $idMapel), 
        ];

        echo view('partials/header');
        echo view('nilaipts_siswa', $data);
        echo view('partials/footer');
    }
}
