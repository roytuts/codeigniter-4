<?php

namespace App\Models;
use CodeIgniter\Model;

class ProductModel extends Model {
	
	protected $product = 'product';
	
	function get_product_list() {        
		$query = $this->db->table($this->product)->get();
        
		return $query->getResult();
    }
	
}