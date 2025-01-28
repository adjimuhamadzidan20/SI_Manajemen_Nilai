<?php

namespace App\Models;

use CodeIgniter\Model;

class DaftarnilaitugasModel extends Model
{
    protected $table      = 'dt_nilai_tugas';
    protected $primaryKey = 'id_tugas';
    protected $allowedFields = ['id_siswa', 'id_mapel', 'kelas', 'id_jurusan', 'id_periode', 'semester', 'nilai_1', 'nilai_2', 
    'nilai_3', 'nilai_4', 'nilai_5', 'nilai_6', 'nilai_7', 'nilai_8', 'nilai_9', 'na_materi', 'LM_1', 'LM_2', 'LM_3', 
    'na_sumatif'];
    
    protected $useAutoIncrement = true;
    protected $protectFields    = true;

    public function dataNilai($semester, $idPeriode, $kelas, $idJurusan, $idMapel) {
        $db = db_connect();
        $query = "SELECT dt_nilai_tugas.id_tugas, dt_nilai_tugas.id_siswa, dt_siswa.nisn, dt_siswa.nama_siswa, 
        dt_nilai_tugas.id_mapel, dt_mapel.nama_mapel, dt_nilai_tugas.kelas, dt_nilai_tugas.id_jurusan, dt_jurusan.nama_jurusan, 
        dt_nilai_tugas.id_periode, dt_periode_ajaran.tahun_ajaran, dt_nilai_tugas.semester, dt_nilai_tugas.nilai_1, 
        dt_nilai_tugas.nilai_2, dt_nilai_tugas.nilai_3, dt_nilai_tugas.nilai_4, dt_nilai_tugas.nilai_5, dt_nilai_tugas.nilai_6,
        dt_nilai_tugas.nilai_7, dt_nilai_tugas.nilai_8, dt_nilai_tugas.nilai_9, dt_nilai_tugas.na_materi, dt_nilai_tugas.LM_1, 
        dt_nilai_tugas.LM_2, dt_nilai_tugas.LM_3, dt_nilai_tugas.na_sumatif FROM dt_nilai_tugas 
        INNER JOIN dt_siswa ON dt_nilai_tugas.id_siswa = dt_siswa.id_siswa 
        INNER JOIN dt_mapel ON dt_nilai_tugas.id_mapel = dt_mapel.id_mapel 
        INNER JOIN dt_jurusan ON dt_nilai_tugas.id_jurusan = dt_jurusan.id_jurusan 
        INNER JOIN dt_periode_ajaran ON dt_nilai_tugas.id_periode = dt_periode_ajaran.id_periode 
        WHERE semester = '$semester' AND dt_nilai_tugas.id_periode = $idPeriode AND dt_nilai_tugas.kelas = '$kelas'
        AND dt_nilai_tugas.id_jurusan = $idJurusan AND dt_nilai_tugas.id_mapel = $idMapel";

        $sql = $db->query($query);
        $hasil = $sql->getResultArray();
        return $hasil;
    }

    public function tambahDataNilaiTugas($pesertaDidik, $namaMapel, $kelas, $jurusan, $periodeAjaran,
    $semester, $nilai_1, $nilai_2, $nilai_3, $nilai_4, $nilai_5, $nilai_6, $nilai_7, $nilai_8, $nilai_9) {

        // menampung data nilai (TP)
        $totalNilaiTP = [$nilai_1, $nilai_2, $nilai_3, $nilai_4, $nilai_5, $nilai_6, $nilai_7, $nilai_8, $nilai_9];
        
        // menjumlahkan seluruh nilai (TP)
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

        // menjumlahkan seluruh nilai per-masing lingkup materi (LM)
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

        $totalNilaiLM = [$LM1, $LM2, $LM3];
        $jumlahNilaiLM = (int) $LM1 + (int) $LM2 + (int) $LM3;
        $filterNilaiLM = array_filter($totalNilaiLM);
        $totalNilaiLM = count($filterNilaiLM);

        if ($jumlahNilaiLM == 0 && $totalNilaiLM == 0) {
            $na_sumatif = 0;
        } else {
            $na_sumatif = $jumlahNilaiLM / $totalNilaiLM;
        }
        
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
        ]);

        return $data;
    }

    public function ubahDataNilaiTugas($id, $pesertaDidik, $namaMapel, $kelas, $jurusan, $periodeAjaran,
    $semester, $nilai_1, $nilai_2, $nilai_3, $nilai_4, $nilai_5, $nilai_6, $nilai_7, $nilai_8, $nilai_9) {

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

        $totalNilaiLM = [$LM1, $LM2, $LM3];
        $jumlahNilaiLM = (int) $LM1 + (int) $LM2 + (int) $LM3;
        $filterNilaiLM = array_filter($totalNilaiLM);
        $totalNilaiLM = count($filterNilaiLM);

        if ($jumlahNilaiLM == 0 && $totalNilaiLM == 0) {
            $na_sumatif = 0;
        } else {
            $na_sumatif = $jumlahNilaiLM / $totalNilaiLM;
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
        ]);

        return $data;
    }

    // public function dataMapelDetail($mapel) {
    //     $db = db_connect();
    //     $query = "SELECT nama_mapel FROM dt_mapel WHERE nama_mapel = '$mapel'";

    //     $sql = $db->query($query);
    //     $hasil = $sql->getRowArray();
    //     return $hasil['nama_mapel'];
    // }      

    // public function generateKode() {
    //     $db = db_connect();
    //     $sql = $db->query("SELECT MAX(kd_mapel) AS kode FROM dt_mapel");
    //     $hasil = $sql->getRowArray();
    //     return $hasil['kode']; 
    // }


    // public function ubahDataMapel($id, $kode, $namaMapel, $kelas, $guruMapel) {
    //     $data = [
    //         'id_mapel' => $id,
    //         'kd_mapel' => $kode,
    //         'nama_mapel' => $namaMapel,
    //         'kelas' => $kelas,
    //         'guru' => $guruMapel
    //     ];

    //     return $this->update($id, $data);
    // }

    // public function hapusDataMapel($id) {
    //     return $this->delete($id);
    // }
}