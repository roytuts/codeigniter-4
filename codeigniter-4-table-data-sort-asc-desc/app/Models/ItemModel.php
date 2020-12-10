<?php

namespace App\Models;
use CodeIgniter\Model;

class ItemModel extends Model {

	protected $table = 'item';
	
	function get_item_list($sort_by, $sort_order) {
        $sort_order = ($sort_order == 'DESC') ? 'DESC' : 'ASC';
		
        $sort_columns = array('name', 'desc', 'price');
        
		$sort_by = (in_array($sort_by, $sort_columns)) ? '`' . $sort_by . '`' : '`name`';
		
        $sql = 'SELECT `id`, `name`, `desc`, `price` FROM ' . $this->table . 
				' ORDER BY ' . $sort_by . ' ' . $sort_order;
        
		$query = $this->db->query($sql);
        
		return $query->getResult();
    }
	
}