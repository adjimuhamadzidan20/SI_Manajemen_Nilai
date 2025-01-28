<?php

namespace App\Models;

use CodeIgniter\Model;

class DaftarsiswaModel extends Model
{
    protected $table      = 'dt_siswa';
    protected $primaryKey = 'id_siswa';
    protected $allowedFields = ['kd_siswa', 'nis', 'nisn', 'nama_siswa', 'id_kelas', 'id_jurusan', 'id_periode'];
    protected $useAutoIncrement = true;
    protected $protectFields    = true;

    public function dataSiswa($thn_ajaran, $kelas, $jurusan) {
        $db = db_connect();
        $query = "SELECT dt_siswa.id_siswa, dt_siswa.kd_siswa, dt_siswa.nis, dt_siswa.nisn, dt_siswa.nama_siswa, dt_siswa.id_kelas, 
        dt_kelas.kelas, dt_jurusan.id_jurusan, dt_jurusan.nama_jurusan, dt_siswa.id_periode, dt_periode_ajaran.tahun_ajaran FROM
        dt_siswa INNER JOIN dt_periode_ajaran ON dt_siswa.id_periode = dt_periode_ajaran.id_periode INNER JOIN dt_kelas ON 
        dt_siswa.id_kelas = dt_kelas.id_kelas INNER JOIN dt_jurusan ON dt_siswa.id_jurusan = dt_jurusan.id_jurusan WHERE
        dt_periode_ajaran.id_periode = $thn_ajaran AND dt_kelas.id_kelas = $kelas AND dt_jurusan.id_jurusan = $jurusan";

        $sql = $db->query($query);
        $hasil = $sql->getResultArray();
        return $hasil;
    }   

    public function pesertaDidik($kelas, $jurusan) {
        $db = db_connect();
        $query = "SELECT dt_siswa.id_siswa, dt_siswa.kd_siswa, dt_siswa.nis, dt_siswa.nisn, dt_siswa.nama_siswa, 
        dt_siswa.id_kelas, dt_kelas.kelas, dt_jurusan.id_jurusan, dt_jurusan.nama_jurusan, dt_siswa.id_periode, 
        dt_periode_ajaran.tahun_ajaran FROM dt_siswa INNER JOIN dt_periode_ajaran ON dt_siswa.id_periode = 
        dt_periode_ajaran.id_periode INNER JOIN dt_kelas ON dt_siswa.id_kelas = dt_kelas.id_kelas INNER JOIN dt_jurusan 
        ON dt_siswa.id_jurusan = dt_jurusan.id_jurusan WHERE dt_kelas.kelas = '$kelas' AND dt_jurusan.id_jurusan = $jurusan";

        $sql = $db->query($query);
        $hasil = $sql->getResultArray();
        return $hasil;
    }

    public function generateKode() {
        $db = db_connect();
        $sql = $db->query("SELECT MAX(kd_siswa) AS kode FROM dt_siswa");
        $hasil = $sql->getRowArray();
        return $hasil['kode']; 
    }

    public function tambahDataSiswa($kode, $nis, $nisn, $namaMurid, $kelas, $jurusan, $tahunAjaran) {
        $data = $this->insert([
            'kd_siswa' => $kode,
            'nis' => $nis,
            'nisn' => $nisn,
            'nama_siswa' => $namaMurid,
            'id_kelas' => $kelas,
            'id_jurusan' => $jurusan,
            'id_periode' => $tahunAjaran
        ]);

        return $data;
    }

    public function ubahDataSiswa($id, $kode, $nis, $nisn, $namaMurid, $kelas, $jurusan, $tahunAjaran) {
        $data = [
            'id_siswa' => $id,
            'kd_siswa' => $kode,
            'nis' => $nis,
            'nisn' => $nisn,
            'nama_siswa' => $namaMurid,
            'id_kelas' => $kelas,
            'id_jurusan' => $jurusan,
            'id_periode' => $tahunAjaran
        ];

        return $this->update($id, $data);
    }

    public function hapusDataSiswa($id) {
        return $this->delete($id);
    }

}