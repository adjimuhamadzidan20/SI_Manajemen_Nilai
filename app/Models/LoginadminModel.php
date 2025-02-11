<?php  

namespace App\Models;

use CodeIgniter\Model;

class LoginadminModel extends Model
{
	protected $table      = 'dt_admin';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password', 'nama_admin', 'status', 'alamat', 'email'];

    protected $useAutoIncrement = true;
    protected $protectFields    = true;

    public function masukAdmin($username) {
        $db = db_connect();
        $query = "SELECT * FROM dt_admin WHERE username = '$username'";
        $sql = $db->query($query);
        $hasil = $sql->getRowArray();

        return $hasil;
    }

    public function dataAdmin($id) {
        $db = db_connect();
        $query = "SELECT * FROM dt_admin WHERE id = $id";
        $sql = $db->query($query);
        $hasil = $sql->getResultArray();

        return $hasil;
    }

    public function ubahPassword($id, $password) {
        $data = [
            'id' => $id,
            'password' => md5($password)
        ];

        $hasil = $this->update($id, $data);
        return $hasil;
    }

    public function ubahUsername($id, $username) {
        $data = [
            'id' => $id,
            'username' => $username
        ];

        $hasil = $this->update($id, $data);
        return $hasil;
    }

    public function ubahNamaAdmin($id, $nama) {
        $data = [
            'id' => $id,
            'nama_admin' => $nama
        ];

        $hasil = $this->update($id, $data);
        return $hasil;
    }

    public function ubahAlamat($id, $alamat) {
        $data = [
            'id' => $id,
            'alamat' => $alamat
        ];

        $hasil = $this->update($id, $data);
        return $hasil;
    }

    public function ubahEmail($id, $email) {
        $data = [
            'id' => $id,
            'email' => $email
        ];

        $hasil = $this->update($id, $data);
        return $hasil;
    }
}

?>