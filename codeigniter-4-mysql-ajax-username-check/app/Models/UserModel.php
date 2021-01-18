<?php

namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model {

	protected $table = 'user';
	
	function get_username($username) {
		$sql = "SELECT * FROM user WHERE login_username = ? LIMIT 1";
		$query = $this->db->query($sql, [$username]);
		
		$row = $query->getRow();
		
		if ($row) {
			return true;
		}
		
		return false;
	}
	
}