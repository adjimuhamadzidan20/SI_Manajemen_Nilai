<?php

namespace App\Models;

use CodeIgniter\Model;

class DaftarkelasModel extends Model
{
   protected $table      = 'dt_kelas';
   protected $primaryKey = 'id_kelas';
   protected $allowedFields = ['kd_kelas', 'id_jurusan', 'kelas', 'id_periode'];
   protected $useAutoIncrement = true;
   protected $protectFields    = true;

   public function dataKelasAll() {
      return $this->findAll();
   }

   public  function kelas($kelas) {
      $db = db_connect();
      $query = "SELECT kelas FROM dt_kelas WHERE id_kelas = $kelas";

      $sql = $db->query($query);
      $hasil = $sql->getRowArray();
      return $hasil['kelas'];
   }

    public  function idKelas($kelas) {
      $db = db_connect();
      $query = "SELECT id_kelas FROM dt_kelas WHERE id_kelas = $kelas";

      $sql = $db->query($query);
      $hasil = $sql->getRowArray();
      return $hasil['id_kelas'];
   }

   public function dataKelas($thn_ajaran) {
      $db = db_connect();
      $query = "SELECT dt_kelas.id_kelas, dt_kelas.kd_kelas, dt_kelas.id_jurusan, dt_jurusan.nama_jurusan, dt_kelas.kelas, 
      dt_periode_ajaran.id_periode, dt_periode_ajaran.tahun_ajaran FROM dt_kelas INNER JOIN dt_jurusan ON dt_kelas.id_jurusan 
      = dt_jurusan.id_jurusan INNER JOIN dt_periode_ajaran ON dt_kelas.id_periode = dt_periode_ajaran.id_periode WHERE 
      dt_periode_ajaran.tahun_ajaran = $thn_ajaran";

      $sql = $db->query($query);
      $hasil = $sql->getResultArray();
      return $hasil;
   }

   public function dataKelasDetail($kelas) {
      $db = db_connect();
      $query = "SELECT dt_kelas.id_kelas, dt_kelas.kd_kelas, dt_kelas.id_jurusan, dt_jurusan.nama_jurusan, dt_jurusan.nama_panjang, 
      kelas, dt_periode_ajaran.id_periode, dt_periode_ajaran.tahun_ajaran FROM dt_kelas INNER JOIN dt_jurusan ON dt_kelas.id_jurusan
      = dt_jurusan.id_jurusan INNER JOIN dt_periode_ajaran ON dt_kelas.id_periode = dt_periode_ajaran.id_periode WHERE 
      dt_kelas.kelas = '$kelas'";

      $sql = $db->query($query);
      $hasil = $sql->getResultArray();
      return $hasil;
   }

   public function jumlahDataKelas($thn_ajaran) {
      $db = db_connect();
      $query = "SELECT dt_kelas.id_kelas, dt_kelas.kd_kelas, dt_kelas.id_jurusan, dt_kelas.kelas, dt_periode_ajaran.id_periode, 
      dt_periode_ajaran.tahun_ajaran FROM dt_kelas INNER JOIN dt_periode_ajaran ON dt_kelas.id_periode = dt_periode_ajaran.id_periode 
      WHERE dt_periode_ajaran.tahun_ajaran = $thn_ajaran";

      $sql = $db->query($query);
      $hasil = $sql->getNumRows();
      return $hasil;
   }

   public function detailKelas($thn_ajaran, $kelas, $jurusan) {
      $db = db_connect();
      $query = "SELECT dt_kelas.id_kelas, dt_kelas.kd_kelas, dt_kelas.id_jurusan, dt_jurusan.nama_jurusan, dt_kelas.kelas, 
      dt_periode_ajaran.id_periode, dt_periode_ajaran.tahun_ajaran FROM dt_kelas INNER JOIN dt_jurusan ON dt_kelas.id_jurusan 
      = dt_jurusan.id_jurusan INNER JOIN dt_periode_ajaran ON dt_kelas.id_periode = dt_periode_ajaran.id_periode WHERE 
      dt_periode_ajaran.id_periode = $thn_ajaran AND dt_kelas.id_kelas = $kelas AND dt_jurusan.id_jurusan = $jurusan";

      $sql = $db->query($query);
      $hasil = $sql->getResultArray();
      return $hasil;
   }

   public function generateKode() {
      $db = db_connect();
      $sql = $db->query("SELECT MAX(kd_kelas) AS kode FROM dt_kelas");
      $hasil = $sql->getRowArray();
      return $hasil['kode']; 
   }

   public function tambahDataKelas($kode, $keahlian, $kelas, $periode) {
      $data = $this->insert([
         'kd_kelas' => $kode,
         'id_jurusan' => $keahlian,
         'kelas' => $kelas,
         'id_periode' => $periode
      ]);

      return $data;
   }

   public function ubahDataKelas($id, $kode, $keahlian, $kelas, $periode) {
      $data = [
         'id_kelas' => $id,
         'kd_kelas' => $kode,
         'id_jurusan' => $keahlian,
         'kelas' => $kelas,
         'id_periode' => $periode
      ];

      return $this->update($id, $data);
   }

   public function hapusDataKelas($id) {
      return $this->delete($id);
   }

}