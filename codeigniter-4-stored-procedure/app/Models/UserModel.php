<?php

namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model {
	
	function insert_user($name, $email, $phone, $address) {
		$sql = "CALL sp_insert_user(?, ?, ?, ?)";
		$result = $this->db->query($sql, [$name, $email, $phone, $address]);
		
		if ($result) {
			return true;
		}
		
		return false;
	}
	
}