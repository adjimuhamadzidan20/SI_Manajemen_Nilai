<?php

namespace App\Controllers;

use App\Models\PeriodeajaranModel;
use App\Models\DaftarjurusanModel;
use App\Models\DaftarkelasModel;
use App\Models\DaftarmapelModel;
use App\Models\DaftarsiswaModel;
use App\Models\DaftarnilaisiswaModel;

class Daftarnilai_siswa extends BaseController
{
    public function nilai_siswa_periode($thn_ajaran)
    {
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
            'kode' => 'KE' . sprintf('%03s', $kdSekarang),
            'periode' => $periodeModel->dataPeriode(),
            'tahun_ajaran' => $periodeModel->tahunPeriode($thn_ajaran),
            'id_periode' => $periodeModel->idPeriode($thn_ajaran),
            'mapel' => $mapelModel->dataMapel($thn_ajaran),
            'linkActive' => 'daftar_nilai',
            'tab_name' => 'Daftar Nilai'
        ];

        echo view('partials/header', $data);
        echo view('daftar_nilaisiswa_view', $data);
        echo view('partials/footer');
    }

    public function tambah()
    {
        $nilaiSiswaModel = new DaftarnilaisiswaModel();

        $namaMapel = htmlspecialchars($this->request->getPost('nama_mapel'));
        $pesertaDidik = htmlspecialchars($this->request->getPost('peserta_didik'));
        $idMapel = htmlspecialchars($this->request->getPost('id_mapel'));
        $kelas = htmlspecialchars($this->request->getPost('kelas'));
        $jurusan = htmlspecialchars($this->request->getPost('jurusan'));
        $periodeAjaran = htmlspecialchars($this->request->getPost('periode'));
        $semester = htmlspecialchars($this->request->getPost('semester'));
        $nilai_1 = htmlspecialchars($this->request->getPost('tp_1'));
        $nilai_2 = htmlspecialchars($this->request->getPost('tp_2'));
        $nilai_3 = htmlspecialchars($this->request->getPost('tp_3'));
        $nilai_4 = htmlspecialchars($this->request->getPost('tp_4'));
        $nilai_5 = htmlspecialchars($this->request->getPost('tp_5'));
        $nilai_6 = htmlspecialchars($this->request->getPost('tp_6'));
        $nilai_7 = htmlspecialchars($this->request->getPost('tp_7'));
        $nilai_8 = htmlspecialchars($this->request->getPost('tp_8'));
        $nilai_9 = htmlspecialchars($this->request->getPost('tp_9'));
        $nilaipts = htmlspecialchars($this->request->getPost('pts'));
        $nilaipas = htmlspecialchars($this->request->getPost('pas'));

        $return = $nilaiSiswaModel->tambahDataNilai(
            $pesertaDidik,
            $idMapel,
            $kelas,
            $jurusan,
            $periodeAjaran,
            $semester,
            $nilai_1,
            $nilai_2,
            $nilai_3,
            $nilai_4,
            $nilai_5,
            $nilai_6,
            $nilai_7,
            $nilai_8,
            $nilai_9,
            $nilaipts,
            $nilaipas
        );

        if ($return) {
            $pesan = 'Nilai berhasil ditambahkan!';
            session()->setFlashData('success', $pesan);
        } else {
            $pesan = 'Nama peserta didik sudah ada!';
            session()->setFlashData('info', $pesan);
        }

        return redirect()->to('/daftar_nilai_siswa/peserta_didik/' . $kelas . '/' . $jurusan . '/' . $namaMapel . '/' . $idMapel . '/' .
            $periodeAjaran . '/' . $semester);
    }

    public function ubah()
    {
        $nilaiSiswaModel = new DaftarnilaisiswaModel();

        $namaMapel = htmlspecialchars($this->request->getPost('nama_mapel'));
        $id = htmlspecialchars($this->request->getPost('id'));
        $pesertaDidik = htmlspecialchars($this->request->getPost('peserta_didik'));
        $idMapel = htmlspecialchars($this->request->getPost('id_mapel'));
        $kelas = htmlspecialchars($this->request->getPost('kelas'));
        $jurusan = htmlspecialchars($this->request->getPost('jurusan'));
        $periodeAjaran = htmlspecialchars($this->request->getPost('periode'));
        $semester = htmlspecialchars($this->request->getPost('semester'));
        $nilai_1 = htmlspecialchars($this->request->getPost('tp_1'));
        $nilai_2 = htmlspecialchars($this->request->getPost('tp_2'));
        $nilai_3 = htmlspecialchars($this->request->getPost('tp_3'));
        $nilai_4 = htmlspecialchars($this->request->getPost('tp_4'));
        $nilai_5 = htmlspecialchars($this->request->getPost('tp_5'));
        $nilai_6 = htmlspecialchars($this->request->getPost('tp_6'));
        $nilai_7 = htmlspecialchars($this->request->getPost('tp_7'));
        $nilai_8 = htmlspecialchars($this->request->getPost('tp_8'));
        $nilai_9 = htmlspecialchars($this->request->getPost('tp_9'));
        $nilaipts = htmlspecialchars($this->request->getPost('pts'));
        $nilaipas = htmlspecialchars($this->request->getPost('pas'));

        $return = $nilaiSiswaModel->ubahDataNilai(
            $id,
            $pesertaDidik,
            $idMapel,
            $kelas,
            $jurusan,
            $periodeAjaran,
            $semester,
            $nilai_1,
            $nilai_2,
            $nilai_3,
            $nilai_4,
            $nilai_5,
            $nilai_6,
            $nilai_7,
            $nilai_8,
            $nilai_9,
            $nilaipts,
            $nilaipas
        );

        if ($return) {
            $pesan = 'Nilai berhasil diubah!';
            session()->setFlashData('success', $pesan);
        } else {
            $pesan = 'Nilai gagal diubah!';
            session()->setFlashData('error', $pesan);
        }

        return redirect()->to('/daftar_nilai_siswa/peserta_didik/' . $kelas . '/' . $jurusan . '/' . $namaMapel . '/' . $idMapel . '/' .
            $periodeAjaran . '/' . $semester);
    }

    public function peserta_didik($kelas, $jurusan, $namaMapel, $idMapel, $idPeriode, $semester)
    {
        $siswaModel = new DaftarsiswaModel();
        $kelasModel = new DaftarkelasModel();
        $jurusanModel = new DaftarjurusanModel();
        $mapelModel = new DaftarmapelModel();
        $nilaiSiswaModel = new DaftarnilaisiswaModel();
        $periodeModel = new PeriodeajaranModel();

        $data = [
            'siswa' => $siswaModel->pesertaDidik($kelas, $jurusan),
            'siswa_jumlah' => $siswaModel->jumlahPesertaDidik($kelas, $jurusan),

            // 'id_kelas' => $kelasModel->idKelas($kelas),
            'kelas' => $kelasModel->kelas($kelas),

            'id_jurusan' => $jurusanModel->idJurusan($jurusan),
            'nama_jurusan' => $jurusanModel->jurusan($jurusan),

            'id_mapel' => $mapelModel->dataMapelDetailID($idMapel),
            'nama_mapel' => $mapelModel->dataMapelDetail($namaMapel),

            'tahun_ajaran' => $periodeModel->tahunPeriode($idPeriode),
            'id_periode' => $periodeModel->idPeriode($idPeriode),

            'semester' => $semester,
            'nilai' => $nilaiSiswaModel->dataNilai($semester, $idPeriode, $kelas, $jurusan, $idMapel),
            'jumlah' => $nilaiSiswaModel->jumlahData($semester, $idPeriode, $kelas, $jurusan, $idMapel),
            'linkActive' => 'daftar_nilai',
            'tab_name' => 'Daftar Nilai' 
        ];

        echo view('partials/header', $data);
        echo view('nilai_siswa_view', $data);
        echo view('partials/footer');
    }
}
