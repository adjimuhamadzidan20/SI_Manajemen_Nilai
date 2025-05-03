<?php

namespace App\Models;

use CodeIgniter\Model;

class PeriodeajaranModel extends Model
{
      protected $table      = 'dt_periode_ajaran';
      protected $primaryKey = 'id_periode';
      protected $allowedFields = ['kd_ajaran', 'semester_pertama', 'semester_kedua', 'tahun_ajaran'];
      protected $useAutoIncrement = true;
      protected $protectFields    = true;

      public function dataPeriode() {
         return $this->findAll();
      }

      public function jumlah() {
         $db = db_connect();
         $query = "SELECT COUNT(*) periode FROM dt_periode_ajaran";

         $sql = $db->query($query);
         $hasil = $sql->getRowArray();
         return $hasil['periode'];
      }   

      public function tahunPeriode($periode) {
         $db = db_connect();
         $sql = $db->query("SELECT tahun_ajaran FROM dt_periode_ajaran WHERE id_periode = $periode");
         $hasil = $sql->getRowArray();
         return $hasil['tahun_ajaran'];  
      }

      public function idPeriode($periode) {
         $db = db_connect();
         $sql = $db->query("SELECT id_periode FROM dt_periode_ajaran WHERE id_periode = $periode");
         $hasil = $sql->getRowArray();
         return $hasil['id_periode'];  
      }

      public function generateKode() {
         $db = db_connect();
         $sql = $db->query("SELECT MAX(kd_ajaran) AS kode FROM dt_periode_ajaran");
         $hasil = $sql->getRowArray();
         return $hasil['kode']; 
      }

      public function tambahDataPeriode($kode, $semester_1, $semester_2, $tahunAjar) {
         $db = db_connect();
         $sql = $db->query("SELECT tahun_ajaran FROM dt_periode_ajaran WHERE tahun_ajaran = '$tahunAjar'");
         $periode = $sql->getRowArray();
         
         if ($periode) {
            return false;
         }
         else {
            $data = $this->insert([
               'kd_ajaran' => $kode,
               'semester_pertama' => $semester_1,
               'semester_kedua' => $semester_2,
               'tahun_ajaran' => $tahunAjar
            ]);

            return $data;
         }
      }

      public function ubahDataPeriode($id, $kode, $semester_1, $semester_2, $tahunAjar) {
         $data = [
            'id_periode' => $id,
            'kd_ajaran' => $kode,
            'semester_pertama' => $semester_1,
            'semester_kedua' => $semester_2,
            'tahun_ajaran' => $tahunAjar
         ];

         return $this->update($id, $data);
      }

      public function hapusDataPeriode($id) {
         return $this->delete($id);
      }
}