<?php

namespace App\Models;
use CodeIgniter\Model;

class AuthModel extends Model {
	
	protected $login = 'login';
	
	function get_login_details($username, $password) {        
		$query = $this->db->table($this->login)->where(['username' => $username, 'password' => $password])->limit(1)->get();
        
		return $query->getRow();
    }

}

