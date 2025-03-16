<?php

namespace App\Models;

use CodeIgniter\Model;

class DaftarnilaisiswaModel extends Model
{
    protected $table      = 'dt_nilai_tugas';
    protected $primaryKey = 'id_tugas';
    protected $allowedFields = [
        'id_siswa',
        'id_mapel',
        'kelas',
        'id_jurusan',
        'id_periode',
        'semester',
        'nilai_1',
        'nilai_2',
        'nilai_3',
        'nilai_4',
        'nilai_5',
        'nilai_6',
        'nilai_7',
        'nilai_8',
        'nilai_9',
        'na_materi',
        'LM_1',
        'LM_2',
        'LM_3',
        'na_sumatif',
        'pts',
        'pat',
        'nilai_akhir',
        'nilai_rapor',
        'deskripsi'
    ];

    protected $useAutoIncrement = true;
    protected $protectFields    = true;

    public function dataNilai($semester, $idPeriode, $kelas, $idJurusan, $idMapel)
    {
        $db = db_connect();
        $query = "SELECT dt_nilai_murid.id_nilai, dt_nilai_murid.id_siswa, dt_siswa.nis, dt_siswa.nisn, dt_siswa.nama_siswa, 
        dt_nilai_murid.id_mapel, dt_mapel.nama_mapel, dt_nilai_murid.kelas, dt_nilai_murid.id_jurusan, dt_jurusan.nama_jurusan, 
        dt_nilai_murid.id_periode, dt_periode_ajaran.tahun_ajaran, dt_nilai_murid.semester, dt_nilai_murid.nilai_1, 
        dt_nilai_murid.nilai_2, dt_nilai_murid.nilai_3, dt_nilai_murid.nilai_4, dt_nilai_murid.nilai_5, dt_nilai_murid.nilai_6,
        dt_nilai_murid.nilai_7, dt_nilai_murid.nilai_8, dt_nilai_murid.nilai_9, dt_nilai_murid.na_materi, dt_nilai_murid.LM_1, 
        dt_nilai_murid.LM_2, dt_nilai_murid.LM_3, dt_nilai_murid.na_sumatif, dt_nilai_murid.pts, dt_nilai_murid.pat, 
        dt_nilai_murid.nilai_akhir, dt_nilai_murid.nilai_rapor, dt_nilai_murid.deskripsi FROM dt_nilai_murid 
        INNER JOIN dt_siswa ON dt_nilai_murid.id_siswa = dt_siswa.id_siswa 
        INNER JOIN dt_mapel ON dt_nilai_murid.id_mapel = dt_mapel.id_mapel 
        INNER JOIN dt_jurusan ON dt_nilai_murid.id_jurusan = dt_jurusan.id_jurusan 
        INNER JOIN dt_periode_ajaran ON dt_nilai_murid.id_periode = dt_periode_ajaran.id_periode 
        WHERE semester = '$semester' AND dt_nilai_murid.id_periode = $idPeriode AND dt_nilai_murid.kelas = '$kelas'
        AND dt_nilai_murid.id_jurusan = $idJurusan AND dt_nilai_murid.id_mapel = $idMapel";

        $sql = $db->query($query);
        $hasil = $sql->getResultArray();
        return $hasil;
    }

    public function jumlahData($semester, $idPeriode, $kelas, $idJurusan, $idMapel)
    {
        $db = db_connect();
        $query = "SELECT dt_nilai_murid.id_nilai, dt_nilai_murid.id_siswa, dt_siswa.nis, dt_siswa.nisn, dt_siswa.nama_siswa, 
        dt_nilai_murid.id_mapel, dt_mapel.nama_mapel, dt_nilai_murid.kelas, dt_nilai_murid.id_jurusan, dt_jurusan.nama_jurusan, 
        dt_nilai_murid.id_periode, dt_periode_ajaran.tahun_ajaran, dt_nilai_murid.semester, dt_nilai_murid.nilai_1, 
        dt_nilai_murid.nilai_2, dt_nilai_murid.nilai_3, dt_nilai_murid.nilai_4, dt_nilai_murid.nilai_5, dt_nilai_murid.nilai_6,
        dt_nilai_murid.nilai_7, dt_nilai_murid.nilai_8, dt_nilai_murid.nilai_9, dt_nilai_murid.na_materi, dt_nilai_murid.LM_1, 
        dt_nilai_murid.LM_2, dt_nilai_murid.LM_3, dt_nilai_murid.na_sumatif, dt_nilai_murid.pts, dt_nilai_murid.pat, 
        dt_nilai_murid.nilai_akhir, dt_nilai_murid.nilai_rapor, dt_nilai_murid.deskripsi FROM dt_nilai_murid 
        INNER JOIN dt_siswa ON dt_nilai_murid.id_siswa = dt_siswa.id_siswa 
        INNER JOIN dt_mapel ON dt_nilai_murid.id_mapel = dt_mapel.id_mapel 
        INNER JOIN dt_jurusan ON dt_nilai_murid.id_jurusan = dt_jurusan.id_jurusan 
        INNER JOIN dt_periode_ajaran ON dt_nilai_murid.id_periode = dt_periode_ajaran.id_periode 
        WHERE semester = '$semester' AND dt_nilai_murid.id_periode = $idPeriode AND dt_nilai_murid.kelas = '$kelas'
        AND dt_nilai_murid.id_jurusan = $idJurusan AND dt_nilai_murid.id_mapel = $idMapel";

        $sql = $db->query($query);
        $hasil = $sql->getNumRows();
        return $hasil;
    }

    public function tambahDataNilai(
        $pesertaDidik,
        $namaMapel,
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
    ) {
        // menampung data nilai (TP) / na materi
        $totalNilaiTP = [$nilai_1, $nilai_2, $nilai_3, $nilai_4, $nilai_5, $nilai_6, $nilai_7, $nilai_8, $nilai_9];
        $jumlahNilaiTP = (int) $nilai_1 + (int) $nilai_2 + (int) $nilai_3 + (int) $nilai_4 + (int) $nilai_5 +
            (int) $nilai_6 + (int) $nilai_7 + (int) $nilai_8 + (int) $nilai_9;

        $filterNilaiTP = array_filter($totalNilaiTP);
        $totalTP = count($filterNilaiTP);

        if ($jumlahNilaiTP == 0 && $totalTP == 0) {
            $na_materi = 0;
        } else {
            $na_materi = $jumlahNilaiTP / $totalTP;
        }

        // menampung data nilai masing" lingkup materi (LM)
        $totalNilaiTPLM1 = [$nilai_1, $nilai_2, $nilai_3];
        $totalNilaiTPLM2 = [$nilai_4, $nilai_5, $nilai_6];
        $totalNilaiTPLM3 = [$nilai_7, $nilai_8, $nilai_9];

        $jumlahNilaiLM1 = (int) $nilai_1 + (int) $nilai_2 + (int) $nilai_3;
        $jumlahNilaiLM2 = (int) $nilai_4 + (int) $nilai_5 + (int) $nilai_6;
        $jumlahNilaiLM3 = (int) $nilai_7 + (int) $nilai_8 + (int) $nilai_9;

        $filterNilaiLM1 = array_filter($totalNilaiTPLM1);
        $filterNilaiLM2 = array_filter($totalNilaiTPLM2);
        $filterNilaiLM3 = array_filter($totalNilaiTPLM3);

        $totalLM1 = count($filterNilaiLM1);
        $totalLM2 = count($filterNilaiLM2);
        $totalLM3 = count($filterNilaiLM3);

        if ($jumlahNilaiLM1 == 0 && $totalLM1 == 0) {
            $LM1 = 0;
        } else {
            $LM1 = $jumlahNilaiLM2 / $totalLM1;
        }

        if ($jumlahNilaiLM2 == 0 && $totalLM2 == 0) {
            $LM2 = 0;
        } else {
            $LM2 = $jumlahNilaiLM2 / $totalLM2;
        }

        if ($jumlahNilaiLM3 == 0 && $totalLM3 == 0) {
            $LM3 = 0;
        } else {
            $LM3 = $jumlahNilaiLM3 / $totalLM3;
        }

        // nilai na_sumatif
        $totalNilaiLM = [$LM1, $LM2, $LM3];
        $jumlahNilaiLM = (int) $LM1 + (int) $LM2 + (int) $LM3;
        $filterNilaiLM = array_filter($totalNilaiLM);
        $totalNilaiLM = count($filterNilaiLM);

        if ($jumlahNilaiLM == 0 && $totalNilaiLM == 0) {
            $na_sumatif = 0;
        } else {
            $na_sumatif = $jumlahNilaiLM / $totalNilaiLM;
        }

        // nilai akhir
        $dataNilaiAkhir = [$nilaipts, $nilaipas];
        $filterNilai = array_filter($dataNilaiAkhir);
        $jumlahNilaiAkhir = count($filterNilai);
        $totalNilaiAkhir = (int) $nilaipts + (int) $nilaipas;

        if ($totalNilaiAkhir == 0 && $totalNilaiAkhir == 0) {
            $nilaiAkhir = 0;
        } else {
            $nilaiAkhir = $totalNilaiAkhir / $jumlahNilaiAkhir;
        }

        // nilai rapor
        $dataNilaiRapor = [$na_materi, $na_sumatif, $nilaiAkhir];
        $filterNilaiRapor = array_filter($dataNilaiRapor);
        $jumlahNilaiRapor = count($filterNilaiRapor);
        $totalNilaiRapor = (int) $na_materi + (int) $na_sumatif + (int) $nilaiAkhir;

        if ($totalNilaiRapor == 0 && $totalNilaiRapor == 0) {
            $nilaiRapor = 0;
        } else {
            $nilaiRapor = $totalNilaiRapor / $jumlahNilaiRapor;
        }

        // deskripsi nilai
        if ($nilaiRapor <= 70) {
            $deskripsi = 'Masih kurang dalam pemahaman pada mata pelajaran ini, perlu ditingkatkan kembali agar dapat menjadi lebih baik lagi';
        } else if ($nilaiRapor <= 78) {
            $deskripsi = 'Cukup dalam pemahaman pada mata pelajaran ini, tingkatkan kembali agar dapat menjadi lebih baik lagi';
        } else if ($nilaiRapor <= 85) {
            $deskripsi = 'Baik dalam pemahaman pada mata pelajaran ini, tingkatkan kembali agar dapat menjadi lebih baik lagi';
        } else if ($nilaiRapor <= 95) {
            $deskripsi = 'Sudah sangat baik dalam pemahaman pada mata pelajaran ini, tetap ditingkatkan kembali agar dapat menjadi lebih baik lagi';
        }

        $db = db_connect();
        $query = "SELECT id_siswa FROM dt_nilai_tugas WHERE id_siswa = $pesertaDidik";
        $sql = $db->query($query);
        $namaPesertaDidik = $sql->getNumRows();

        if ($namaPesertaDidik) {
            return false;
        } else {
            $data = $this->insert([
                'id_siswa' => $pesertaDidik,
                'id_mapel' => $namaMapel,
                'kelas' => $kelas,
                'id_jurusan' => $jurusan,
                'id_periode' => $periodeAjaran,
                'semester' => $semester,
                'nilai_1' => $nilai_1,
                'nilai_2' => $nilai_2,
                'nilai_3' => $nilai_3,
                'nilai_4' => $nilai_4,
                'nilai_5' => $nilai_5,
                'nilai_6' => $nilai_6,
                'nilai_7' => $nilai_7,
                'nilai_8' => $nilai_8,
                'nilai_9' => $nilai_9,
                'nilai_9' => $nilai_9,
                'na_materi' => round($na_materi),
                'LM_1' => round($LM1),
                'LM_2' => round($LM2),
                'LM_3' => round($LM3),
                'na_sumatif' => round($na_sumatif),
                'pts' => $nilaipts,
                'pat' => $nilaipas,
                'nilai_akhir' => round($nilaiAkhir),
                'nilai_rapor' => round($nilaiRapor),
                'deskripsi' => $deskripsi
            ]);

            return $data;
        }
    }

    public function ubahDataNilai(
        $id,
        $pesertaDidik,
        $namaMapel,
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
    ) {
        // nilai materi / lingkup materi (TP)
        $totalNilaiTP = [$nilai_1, $nilai_2, $nilai_3, $nilai_4, $nilai_5, $nilai_6, $nilai_7, $nilai_8, $nilai_9];
        $jumlahNilaiTP = (int) $nilai_1 + (int) $nilai_2 + (int) $nilai_3 + (int) $nilai_4 + (int) $nilai_5 +
            (int) $nilai_6 + (int) $nilai_7 + (int) $nilai_8 + (int) $nilai_9;

        $filterNilaiTP = array_filter($totalNilaiTP);
        $totalTP = count($filterNilaiTP);

        if ($jumlahNilaiTP == 0 && $totalTP == 0) {
            $na_materi = 0;
        } else {
            $na_materi = $jumlahNilaiTP / $totalTP;
        }

        // menampung data nilai masing" lingkup materi (LM)
        $totalNilaiTPLM1 = [$nilai_1, $nilai_2, $nilai_3];
        $totalNilaiTPLM2 = [$nilai_4, $nilai_5, $nilai_6];
        $totalNilaiTPLM3 = [$nilai_7, $nilai_8, $nilai_9];

        $jumlahNilaiLM1 = (int) $nilai_1 + (int) $nilai_2 + (int) $nilai_3;
        $jumlahNilaiLM2 = (int) $nilai_4 + (int) $nilai_5 + (int) $nilai_6;
        $jumlahNilaiLM3 = (int) $nilai_7 + (int) $nilai_8 + (int) $nilai_9;

        $filterNilaiLM1 = array_filter($totalNilaiTPLM1);
        $filterNilaiLM2 = array_filter($totalNilaiTPLM2);
        $filterNilaiLM3 = array_filter($totalNilaiTPLM3);

        $totalLM1 = count($filterNilaiLM1);
        $totalLM2 = count($filterNilaiLM2);
        $totalLM3 = count($filterNilaiLM3);

        if ($jumlahNilaiLM1 == 0 && $totalLM1 == 0) {
            $LM1 = 0;
        } else {
            $LM1 = $jumlahNilaiLM2 / $totalLM1;
        }

        if ($jumlahNilaiLM2 == 0 && $totalLM2 == 0) {
            $LM2 = 0;
        } else {
            $LM2 = $jumlahNilaiLM2 / $totalLM2;
        }

        if ($jumlahNilaiLM3 == 0 && $totalLM3 == 0) {
            $LM3 = 0;
        } else {
            $LM3 = $jumlahNilaiLM3 / $totalLM3;
        }

        // nilai sumatif
        $totalNilaiLM = [$LM1, $LM2, $LM3];
        $jumlahNilaiLM = (int) $LM1 + (int) $LM2 + (int) $LM3;
        $filterNilaiLM = array_filter($totalNilaiLM);
        $totalNilaiLM = count($filterNilaiLM);

        if ($jumlahNilaiLM == 0 && $totalNilaiLM == 0) {
            $na_sumatif = 0;
        } else {
            $na_sumatif = $jumlahNilaiLM / $totalNilaiLM;
        }

        // nilai akhir
        $dataNilaiAkhir = [$nilaipts, $nilaipas];
        $filterNilai = array_filter($dataNilaiAkhir);
        $jumlahNilaiAkhir = count($filterNilai);
        $totalNilaiAkhir = (int) $nilaipts + (int) $nilaipas;

        if ($totalNilaiAkhir == 0 && $totalNilaiAkhir == 0) {
            $nilaiAkhir = 0;
        } else {
            $nilaiAkhir = $totalNilaiAkhir / $jumlahNilaiAkhir;
        }

        // nilai rapor
        $dataNilaiRapor = [$na_materi, $na_sumatif, $nilaiAkhir];
        $filterNilaiRapor = array_filter($dataNilaiRapor);
        $jumlahNilaiRapor = count($filterNilaiRapor);
        $totalNilaiRapor = (int) $na_materi + (int) $na_sumatif + (int) $nilaiAkhir;

        if ($totalNilaiRapor == 0 && $totalNilaiRapor == 0) {
            $nilaiRapor = 0;
        } else {
            $nilaiRapor = $totalNilaiRapor / $jumlahNilaiRapor;
        }

        // deskripsi nilai
        if ($nilaiRapor <= 70) {
            $deskripsi = 'Masih kurang dalam pemahaman pada mata pelajaran ini, perlu ditingkatkan kembali agar dapat menjadi lebih baik lagi';
        } else if ($nilaiRapor <= 78) {
            $deskripsi = 'Cukup dalam pemahaman pada mata pelajaran ini, tingkatkan kembali agar dapat menjadi lebih baik lagi';
        } else if ($nilaiRapor <= 85) {
            $deskripsi = 'Baik dalam pemahaman pada mata pelajaran ini, tingkatkan kembali agar dapat menjadi lebih baik lagi';
        } else if ($nilaiRapor <= 95) {
            $deskripsi = 'Sudah sangat baik dalam pemahaman pada mata pelajaran ini, tetap ditingkatkan kembali agar dapat menjadi lebih baik lagi';
        }

        $data = $this->update($id, [
            'id_tugas' => $id,
            'id_siswa' => $pesertaDidik,
            'id_mapel' => $namaMapel,
            'kelas' => $kelas,
            'id_jurusan' => $jurusan,
            'id_periode' => $periodeAjaran,
            'semester' => $semester,
            'nilai_1' => $nilai_1,
            'nilai_2' => $nilai_2,
            'nilai_3' => $nilai_3,
            'nilai_4' => $nilai_4,
            'nilai_5' => $nilai_5,
            'nilai_6' => $nilai_6,
            'nilai_7' => $nilai_7,
            'nilai_8' => $nilai_8,
            'nilai_9' => $nilai_9,
            'nilai_9' => $nilai_9,
            'na_materi' => round($na_materi),
            'LM_1' => round($LM1),
            'LM_2' => round($LM2),
            'LM_3' => round($LM3),
            'na_sumatif' => round($na_sumatif),
            'pts' => $nilaipts,
            'pat' => $nilaipas,
            'nilai_akhir' => round($nilaiAkhir),
            'nilai_rapor' => round($nilaiRapor),
            'deskripsi' => $deskripsi
        ]);

        return $data;
    }
}
