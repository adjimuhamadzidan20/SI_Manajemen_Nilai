<?php

namespace App\Models;

use CodeIgniter\Model;

class DaftarmapelModel extends Model
{
    protected $table      = 'dt_mapel';
    protected $primaryKey = 'id_mapel';
    protected $allowedFields = ['kd_mapel', 'nama_mapel', 'kelas', 'guru'];
    protected $useAutoIncrement = true;
    protected $protectFields    = true;

    public function dataMapel() {
        return $this->findAll();
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

    public function tambahDataMapel($kode, $namaMapel, $kelas, $guruMapel) {
        $data = $this->insert([
            'kd_mapel' => $kode,
            'nama_mapel' => $namaMapel,
            'kelas' => $kelas,
            'guru' => $guruMapel
        ]);

        return $data;
    }

    public function ubahDataMapel($id, $kode, $namaMapel, $kelas, $guruMapel) {
        $data = [
            'id_mapel' => $id,
            'kd_mapel' => $kode,
            'nama_mapel' => $namaMapel,
            'kelas' => $kelas,
            'guru' => $guruMapel
        ];

        return $this->update($id, $data);
    }

    public function hapusDataMapel($id) {
        return $this->delete($id);
    }
}