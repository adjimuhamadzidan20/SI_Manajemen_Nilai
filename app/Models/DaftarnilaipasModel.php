<?php

namespace App\Models;

use CodeIgniter\Model;

class DaftarnilaipasModel extends Model
{
    protected $table      = 'dt_nilai_pas';
    protected $primaryKey = 'id_pas';
    protected $allowedFields = ['id_siswa', 'id_mapel', 'kelas', 'id_jurusan', 'id_periode', 'semester', 'nilai_pas'];
    
    protected $useAutoIncrement = true;
    protected $protectFields    = true;

    public function dataNilai($semester, $idPeriode, $kelas, $idJurusan, $idMapel) {
        $db = db_connect();
        $query = "SELECT dt_nilai_pas.id_pas, dt_nilai_pas.id_siswa, dt_siswa.nis, dt_siswa.nisn, dt_siswa.nama_siswa, 
        dt_nilai_pas.id_mapel, dt_mapel.nama_mapel, dt_nilai_pas.kelas, dt_nilai_pas.id_jurusan, dt_jurusan.nama_jurusan, 
        dt_nilai_pas.id_periode, dt_periode_ajaran.tahun_ajaran, dt_nilai_pas.semester, dt_nilai_pas.nilai_pas FROM 
        dt_nilai_pas INNER JOIN dt_siswa ON dt_nilai_pas.id_siswa = dt_siswa.id_siswa INNER JOIN dt_mapel ON 
        dt_nilai_pas.id_mapel = dt_mapel.id_mapel INNER JOIN dt_jurusan ON dt_nilai_pas.id_jurusan = dt_jurusan.id_jurusan 
        INNER JOIN dt_periode_ajaran ON dt_nilai_pas.id_periode = dt_periode_ajaran.id_periode WHERE semester = '$semester' 
        AND dt_nilai_pas.id_periode = $idPeriode AND dt_nilai_pas.kelas = '$kelas' AND dt_nilai_pas.id_jurusan = $idJurusan 
        AND dt_nilai_pas.id_mapel = $idMapel";

        $sql = $db->query($query);
        $hasil = $sql->getResultArray();
        return $hasil;
    }

    public function tambahDataNilaiPas($pesertaDidik, $namaMapel, $kelas, $jurusan, $periodeAjaran, 
    $semester, $nilaiPas) {

        $data = $this->insert([
            'id_siswa' => $pesertaDidik,
            'id_mapel' => $namaMapel,
            'kelas' => $kelas,
            'id_jurusan' => $jurusan,
            'id_periode' => $periodeAjaran,
            'semester' => $semester,
            'nilai_pas' => $nilaiPas
        ]);

        return $data;
    }

    public function ubahDataNilaiPas($id, $pesertaDidik, $namaMapel, $kelas, $jurusan, $periodeAjaran,
    $semester, $nilaiPas) {

        $data = $this->update($id, [
            'id_tugas' => $id,
            'id_siswa' => $pesertaDidik,
            'id_mapel' => $namaMapel,
            'kelas' => $kelas,
            'id_jurusan' => $jurusan,
            'id_periode' => $periodeAjaran,
            'semester' => $semester,
            'nilai_pas' => $nilaiPas
        ]);

        return $data;
    }
}