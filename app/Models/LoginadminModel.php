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

    	// return $this->where('username', $username)->first();
        return $hasil;
    }


}

?>