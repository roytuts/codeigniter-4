<?php

namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model {

	protected $table_account = 'user_account';
	protected $table_info = 'user_info';
	
	function insert_user($user_name, $full_name) {
		$this->db->transBegin();
		
		$data_account = array(
			'user_name' => $user_name
		);
		
		$this->db->table($this->table_account)->insert($data_account);
		
		$id = $this->db->insertID();
		
		$data_info = array(
			'full_name' => $full_name,
			'account_id' => $id
		);
		
		$this->db->table($this->table_info)->insert($data_info);
		
		if ($this->db->transStatus() === FALSE)	{
			$this->db->transRollback();
			
			return false;
		} else {
			$this->db->transCommit();
			
			return true;
		}
	}
	
	function update_user($account_id, $user_name, $info_id, $full_name) {
		$this->db->transStart();
		
		$data_account = array(
			'user_name' => $user_name
		);
		
		$this->db->table($this->table_account)->where('account_id', $account_id)->update($data_account);
		
		$data_info = array(
			'full_name' => $full_name
		);
		
		$this->db->table($this->table_info)->where('info_id', $info_id)->update($data_info);
		
		$this->db->transComplete();

		if ($this->db->transStatus() === FALSE) {
			return false;
		}
		
		return true;
	}
	
	function delete_user($account_id, $info_id) {
		$this->db->transStart();
		
		$this->db->table($this->table_info)->where('info_id', $info_id)->delete();
		
		$this->db->table($this->table_account)->where('account_id', $account_id)->delete();		
		
		$this->db->transComplete();

		if ($this->db->transStatus() === FALSE) {
			return false;
		}
		
		return true;
	}
	
}