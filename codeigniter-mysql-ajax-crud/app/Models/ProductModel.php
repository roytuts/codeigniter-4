<?php

namespace App\Models;
use CodeIgniter\Model;

class ProductModel extends Model {
	
	protected $product = 'product';
	
	function get_product_list() {        
		$query = $this->db->table($this->product)->get();
        
		return $query->getResult();
    }
	
	function delete_product_by_id($id) {		
		if($this->db->table($this->product)->where('id', $id)->delete()) {
			return true;
		} else {
			return false;
		}
	}
	
	function save_product($data) {		
		if($this->db->table($this->product)->insert($data)) {
			return true;
		} else {
			return false;
		}
	}
	
	function update_product($id, $data) {		
		if($this->db->table($this->product)->where('id', $id)->update($data)) {
			return true;
		} else {
			return false;
		}
	}
	
}
