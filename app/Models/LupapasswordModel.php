<?php  

namespace App\Models;

use CodeIgniter\Model;

class LupapasswordModel extends Model
{
	protected $table      = 'dt_admin';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password', 'nama_admin', 'status', 'alamat', 'email'];

    protected $useAutoIncrement = true;
    protected $protectFields    = true;

    public function gantiPass($email, $passwordBaru) {
        $db = db_connect();
        $query = "UPDATE dt_admin SET password = '$passwordBaru' WHERE email = '$email'";
        $hasil = $db->query($query);
        return $hasil;
    }
}

?>