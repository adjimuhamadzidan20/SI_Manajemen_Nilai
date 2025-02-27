<?php

namespace App\Models;

use CodeIgniter\Model;

class DaftarnilaiptsModel extends Model
{
    protected $table      = 'dt_nilai_pts';
    protected $primaryKey = 'id_pts';
    protected $allowedFields = ['id_siswa', 'id_mapel', 'kelas', 'id_jurusan', 'id_periode', 'semester', 'nilai_pts'];
    
    protected $useAutoIncrement = true;
    protected $protectFields    = true;

    public function dataNilai($semester, $idPeriode, $kelas, $idJurusan, $idMapel) {
        $db = db_connect();
        $query = "SELECT dt_nilai_pts.id_pts, dt_nilai_pts.id_siswa, dt_siswa.nis, dt_siswa.nisn, dt_siswa.nama_siswa, 
        dt_nilai_pts.id_mapel, dt_mapel.nama_mapel, dt_nilai_pts.kelas, dt_nilai_pts.id_jurusan, dt_jurusan.nama_jurusan, 
        dt_nilai_pts.id_periode, dt_periode_ajaran.tahun_ajaran, dt_nilai_pts.semester, dt_nilai_pts.nilai_pts FROM 
        dt_nilai_pts INNER JOIN dt_siswa ON dt_nilai_pts.id_siswa = dt_siswa.id_siswa INNER JOIN dt_mapel ON 
        dt_nilai_pts.id_mapel = dt_mapel.id_mapel INNER JOIN dt_jurusan ON dt_nilai_pts.id_jurusan = dt_jurusan.id_jurusan 
        INNER JOIN dt_periode_ajaran ON dt_nilai_pts.id_periode = dt_periode_ajaran.id_periode WHERE semester = '$semester' 
        AND dt_nilai_pts.id_periode = $idPeriode AND dt_nilai_pts.kelas = '$kelas' AND dt_nilai_pts.id_jurusan = $idJurusan 
        AND dt_nilai_pts.id_mapel = $idMapel";

        $sql = $db->query($query);
        $hasil = $sql->getResultArray();
        return $hasil;
    }

    public function jumlahData($semester, $idPeriode, $kelas, $idJurusan, $idMapel) {
        $db = db_connect();
        $query = "SELECT dt_nilai_pts.id_pts, dt_nilai_pts.id_siswa, dt_siswa.nis, dt_siswa.nisn, dt_siswa.nama_siswa, 
        dt_nilai_pts.id_mapel, dt_mapel.nama_mapel, dt_nilai_pts.kelas, dt_nilai_pts.id_jurusan, dt_jurusan.nama_jurusan, 
        dt_nilai_pts.id_periode, dt_periode_ajaran.tahun_ajaran, dt_nilai_pts.semester, dt_nilai_pts.nilai_pts FROM 
        dt_nilai_pts INNER JOIN dt_siswa ON dt_nilai_pts.id_siswa = dt_siswa.id_siswa INNER JOIN dt_mapel ON 
        dt_nilai_pts.id_mapel = dt_mapel.id_mapel INNER JOIN dt_jurusan ON dt_nilai_pts.id_jurusan = dt_jurusan.id_jurusan 
        INNER JOIN dt_periode_ajaran ON dt_nilai_pts.id_periode = dt_periode_ajaran.id_periode WHERE semester = '$semester' 
        AND dt_nilai_pts.id_periode = $idPeriode AND dt_nilai_pts.kelas = '$kelas' AND dt_nilai_pts.id_jurusan = $idJurusan 
        AND dt_nilai_pts.id_mapel = $idMapel";

        $sql = $db->query($query);
        $hasil = $sql->getNumRows();
        return $hasil;
    }

    public function tambahDataNilaiPts($pesertaDidik, $namaMapel, $kelas, $jurusan, $periodeAjaran, 
    $semester, $nilaiPts) {
        $db = db_connect();
        $query = "SELECT id_siswa FROM dt_nilai_pts WHERE id_siswa = $pesertaDidik";
        $sql = $db->query($query);
        $namaPesertaDidik = $sql->getNumRows();
        
        if ($namaPesertaDidik) {
            return false;
        }
        else {
            $data = $this->insert([
                'id_siswa' => $pesertaDidik,
                'id_mapel' => $namaMapel,
                'kelas' => $kelas,
                'id_jurusan' => $jurusan,
                'id_periode' => $periodeAjaran,
                'semester' => $semester,
                'nilai_pts' => $nilaiPts
            ]);

            return $data;
        }
    }

    public function ubahDataNilaiPts($id, $pesertaDidik, $namaMapel, $kelas, $jurusan, $periodeAjaran,
    $semester, $nilaiPts) {

        $data = $this->update($id, [
            'id_tugas' => $id,
            'id_siswa' => $pesertaDidik,
            'id_mapel' => $namaMapel,
            'kelas' => $kelas,
            'id_jurusan' => $jurusan,
            'id_periode' => $periodeAjaran,
            'semester' => $semester,
            'nilai_pts' => $nilaiPts
        ]);

        return $data;
    }
}