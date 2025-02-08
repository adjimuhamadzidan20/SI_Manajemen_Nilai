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
            'mapel' => $mapelModel->dataMapel($thn_ajaran),
            'linkActive' => 'daftar_nilai' 
        ];

        echo view('partials/header');   
        echo view('daftar_nilaipas_view', $data);
        echo view('partials/footer');
    }

    public function tambah() {
        $nilaiPasModel = new DaftarnilaipasModel();

        $namaMapel = $this->request->getPost('nama_mapel');
        $pesertaDidik = $this->request->getPost('peserta_didik');
        $idMapel = $this->request->getPost('id_mapel');
        $kelas = $this->request->getPost('kelas');
        $jurusan = $this->request->getPost('jurusan');
        $periodeAjaran = $this->request->getPost('periode');
        $semester = $this->request->getPost('semester');
        $nilaiPas = $this->request->getPost('nilai_pas');

        $return = $nilaiPasModel->tambahDataNilaiPas($pesertaDidik, $idMapel, $kelas, $jurusan, 
        $periodeAjaran, $semester, $nilaiPas);

        if ($return) {
            $pesan = 'Nilai PAS berhasil ditambahkan!';
            session()->setFlashData('success', $pesan);
        } 
        else {
            $pesan = 'Nilai PAS gagal ditambahkan!';
            session()->setFlashData('error', $pesan);
        }

        return redirect()->to('/daftar_nilai_pas/peserta_didik/'.$kelas.'/'.$jurusan.'/'.$namaMapel.'/'.$idMapel.'/'.
        $periodeAjaran.'/'.$semester);
    }

     public function ubah() {
        $nilaiPasModel = new DaftarnilaipasModel();

        $namaMapel = $this->request->getPost('nama_mapel');
        $id = $this->request->getPost('id');
        $pesertaDidik = $this->request->getPost('peserta_didik');
        $idMapel = $this->request->getPost('id_mapel');
        $kelas = $this->request->getPost('kelas');
        $jurusan = $this->request->getPost('jurusan');
        $periodeAjaran = $this->request->getPost('periode');
        $semester = $this->request->getPost('semester');
        $nilaiPas = $this->request->getPost('nilai_pas');

        $return = $nilaiPasModel->ubahDataNilaiPas($id, $pesertaDidik, $idMapel, $kelas, $jurusan, 
        $periodeAjaran, $semester, $nilaiPas);

        if ($return) {
            $pesan = 'Nilai PAS berhasil diubah!';
            session()->setFlashData('success', $pesan);
        } 
        else {
            $pesan = 'Nilai PAS gagal diubah!';
            session()->setFlashData('error', $pesan);
        }

        return redirect()->to('/daftar_nilai_pas/peserta_didik/'.$kelas.'/'.$jurusan.'/'.$namaMapel.'/'.$idMapel.'/'.
        $periodeAjaran.'/'.$semester);
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
            'linkActive' => 'daftar_nilai' 
        ];

        echo view('partials/header');
        echo view('nilaipas_siswa', $data);
        echo view('partials/footer');
    }
}
