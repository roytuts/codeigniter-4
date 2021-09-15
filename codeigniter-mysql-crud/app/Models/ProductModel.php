<?php

namespace App\Models;
use CodeIgniter\Model;

class ProductModel extends Model {
	
	protected $product = 'product';
	
	function get_product($id) {        
		$query = $this->db->table($this->product)->where('id', $id)->get();
        
		return $query->getRow();
    }
	
	function get_product_list() {        
		$query = $this->db->table($this->product)->get();
        
		return $query->getResult();
    }
	
	function save_product_info($data) {
		$this->db->table($this->product)->insert($data);
	}
	
	function update_product_info($data) {
		$this->db->table($this->product)->replace($data);
		//$this->db->table($this->product)->where('id', $data['id'])->update($data);
	}
	
	function delete_product_info($id) {
		$this->db->table($this->product)->where('id', $id)->delete();
	}
	
}