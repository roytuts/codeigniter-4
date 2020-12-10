<?php namespace App\Controllers;

use App\Models\ItemModel;

class Item extends BaseController {
	
	public function index() {
		return redirect()->to(site_url('item/item_list'));
	}
	
	function item_list($sort_by = 'name', $sort_order = 'ASC') {        
		$model = new ItemModel();
		
		$data['item_list'] = $model->get_item_list($sort_by, $sort_order);
		
        $data['sort_by'] = $sort_by;
        $data['sort_order'] = $sort_order;
        
		return view('items', $data);
    }

}
