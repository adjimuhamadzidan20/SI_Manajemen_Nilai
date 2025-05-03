<?php

namespace App\Models;

use CodeIgniter\Model;

class DaftarmapelModel extends Model
{
    protected $table      = 'dt_mapel';
    protected $primaryKey = 'id_mapel';
    protected $allowedFields = ['kd_mapel', 'nama_mapel', 'kelas', 'id_jurusan', 'id_periode', 'guru'];
    protected $useAutoIncrement = true;
    protected $protectFields    = true;

    public function dataMapel($thn_ajaran) {
        $db = db_connect();
        $query = "SELECT dt_mapel.id_mapel, dt_mapel.kd_mapel, dt_mapel.nama_mapel, dt_mapel.kelas, dt_mapel.id_jurusan, 
        dt_jurusan.nama_jurusan, dt_mapel.id_periode, dt_periode_ajaran.tahun_ajaran, dt_mapel.guru FROM dt_mapel 
        INNER JOIN dt_jurusan ON dt_mapel.id_jurusan = dt_jurusan.id_jurusan INNER JOIN dt_periode_ajaran ON 
        dt_mapel.id_periode = dt_periode_ajaran.id_periode WHERE dt_periode_ajaran.id_periode = $thn_ajaran";

        $sql = $db->query($query);
        $hasil = $sql->getResultArray();
        return $hasil;
    }

    public function jumlah() {
        $db = db_connect();
        $query = "SELECT COUNT(*) mapel FROM dt_mapel";

        $sql = $db->query($query);
        $hasil = $sql->getRowArray();
        return $hasil['mapel'];
    }

    public function jumlahData($thn_ajaran) {
        $db = db_connect();
        $query = "SELECT dt_mapel.id_mapel, dt_mapel.kd_mapel, dt_mapel.nama_mapel, dt_mapel.kelas, dt_mapel.id_jurusan, 
        dt_jurusan.nama_jurusan, dt_mapel.id_periode, dt_periode_ajaran.tahun_ajaran, dt_mapel.guru FROM dt_mapel 
        INNER JOIN dt_jurusan ON dt_mapel.id_jurusan = dt_jurusan.id_jurusan INNER JOIN dt_periode_ajaran ON 
        dt_mapel.id_periode = dt_periode_ajaran.id_periode WHERE dt_periode_ajaran.id_periode = $thn_ajaran";

        $sql = $db->query($query);
        $hasil = $sql->getNumRows();
        return $hasil;
    }

    public function dataMapelDetail($mapel) {
        $db = db_connect();
        $query = "SELECT nama_mapel FROM dt_mapel WHERE nama_mapel = '$mapel'";

        $sql = $db->query($query);
        $hasil = $sql->getRowArray();
        return $hasil['nama_mapel'];
    }

    public function dataMapelDetailID($id) {
        $db = db_connect();
        $query = "SELECT id_mapel FROM dt_mapel WHERE id_mapel = $id";

        $sql = $db->query($query);
        $hasil = $sql->getRowArray();
        return $hasil['id_mapel'];
    }            

    public function generateKode() {
        $db = db_connect();
        $sql = $db->query("SELECT MAX(kd_mapel) AS kode FROM dt_mapel");
        $hasil = $sql->getRowArray();
        return $hasil['kode']; 
    }

    public function tambahDataMapel($kode, $namaMapel, $kelas, $jurusan, $tahunAjaran, $guruMapel) {
        $db = db_connect();
        $query = "SELECT kelas, id_jurusan FROM dt_mapel WHERE kelas = '$kelas' AND id_jurusan = $jurusan";
        $sql = $db->query($query);
        $dataMapel = $sql->getRowArray();

        if ($dataMapel) {
            return false;
        }
        else {
            $data = $this->insert([
                'kd_mapel' => $kode,
                'nama_mapel' => $namaMapel,
                'kelas' => $kelas,
                'id_jurusan' => $jurusan,
                'id_periode' => $tahunAjaran,
                'guru' => $guruMapel
            ]);

            return $data;
        }
    }

    public function ubahDataMapel($id, $kode, $namaMapel, $kelas, $jurusan, $tahunAjaran, $guruMapel) {
        $data = [
            'id_mapel' => $id,
            'kd_mapel' => $kode,
            'nama_mapel' => $namaMapel,
            'kelas' => $kelas,
            'id_jurusan' => $jurusan,
            'id_periode' => $tahunAjaran,
            'guru' => $guruMapel
        ];

        return $this->update($id, $data);
    }

    public function hapusDataMapel($id) {
        return $this->delete($id);
    }
}