<?php

namespace App\Models;

use CodeIgniter\Model;

class DaftarjurusanModel extends Model
{
    protected $table      = 'dt_jurusan';
    protected $primaryKey = 'id_jurusan';
    protected $allowedFields = ['kd_jurusan', 'nama_jurusan', 'nama_panjang'];
    protected $useAutoIncrement = true;
    protected $protectFields    = true;

    public function dataJurusan() {
       return $this->findAll();
    }

    public  function jurusan($idjurusan) {
        $db = db_connect();
        $query = "SELECT nama_jurusan FROM dt_jurusan WHERE id_jurusan = $idjurusan";

        $sql = $db->query($query);
        $hasil = $sql->getRowArray();
        return $hasil['nama_jurusan'];
    }

    public  function idJurusan($idjurusan) {
        $db = db_connect();
        $query = "SELECT id_jurusan FROM dt_jurusan WHERE id_jurusan = $idjurusan";

        $sql = $db->query($query);
        $hasil = $sql->getRowArray();
        return $hasil['id_jurusan'];
    }

    public function generateKode() {
        $db = db_connect();
        $sql = $db->query("SELECT MAX(kd_jurusan) AS kode FROM dt_jurusan");
        $hasil = $sql->getRowArray();
        return $hasil['kode']; 
    }

    public function tambahDataJurusan($kode, $namaJurusan, $namaPanjang) {
        $db = db_connect();
        $query = "SELECT nama_jurusan FROM dt_jurusan WHERE nama_jurusan = '$namaJurusan'";
        $sql = $db->query($query);
        $jurusan = $sql->getRowArray();

        if ($jurusan) {
            return false;
        }
        else {
            $data = $this->insert([
                'kd_jurusan' => $kode,
                'nama_jurusan' => $namaJurusan,
                'nama_panjang' => $namaPanjang
            ]);

            return $data;
        }
    }

    public function ubahDataJurusan($id, $kode, $namaJurusan, $namaPanjang) {

        $data = [
            'id_jurusan' => $id,
            'kd_jurusan' => $kode,
            'nama_jurusan' => $namaJurusan,
            'nama_panjang' => $namaPanjang
        ];

        return $this->update($id, $data);
    }

    public function hapusDataJurusan($id) {
        return $this->delete($id);
    }


}