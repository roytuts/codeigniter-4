<?php

namespace App\Controllers;

use App\Models\ProductModel;

class Product extends BaseController {
	
	public function index()	{
		$model = new ProductModel();
		
		$data['product_list'] = $model->get_product_list();
		
		return view('products', $data);
	}
	
	public function delete_products() {
		if ('post' === $this->request->getMethod() && $this->request->getPost('ids')) {
			
			$ids = explode(',', $this->request->getPost('ids'));
			
			$model = new ProductModel();
			
			$results = $model->delete_products_by_ids($ids);
			
			if ($results === true) {
				echo '<span style="color:green;">Product(s) successfully deleted</span>';
			} else {
				echo '<span style="color:red;">Something went wrong during product deletion</span>';
			}
		} else {
			echo '<span style="color:red;">You must select at least one product row for deletion</span>';
		}
	}
	
}
