<?php

namespace App\Controllers;

use App\Models\ProductModel;

class Product extends BaseController {
	
	public function index()	{
		$model = new ProductModel();
		
		$data['product_list'] = $model->get_product_list();
		
		return view('products', $data);
	}
	
	public function deleteProduct($id = null) {
		if (!empty($id)) {
			$model = new ProductModel();
			
			$results = $model->delete_product_by_id($id);
			
			if ($results === true) {
				echo '<span style="color:green;">Product successfully deleted</span>';
			} else {
				echo '<span style="color:red;">Something went wrong during product deletion</span>';
			}
		} else {
			echo '<span style="color:red;">You must provide product id for deletion</span>';
		}
	}
	
	public function createProduct()	{
		helper(['form']);
		
		return view('product_create');
	}
	
	public function saveProduct() {
		helper(['form', 'url']);

		if($this->request->getPost('save')) {
			$validation =  \Config\Services::validation();
			
			$validation->setRules([
				'name' => ['label' => 'Name', 'rules' => 'required|min_length[3]|max_length[20]'],
				'code' => ['label' => 'Code', 'rules' => 'required|min_length[2]|max_length[10]'],
				'price' => ['label' => 'Price', 'rules' => 'required|decimal']
			]);
			
			if (!$validation->withRequest($this->request)->run()) {
				echo view('product_create', ['errors' => $validation->getErrors()]);
			} else {
				$code = $this->request->getPost('code');
				$name = $this->request->getPost('name');
				$price = $this->request->getPost('price');
				
				$data = array('name' => $name, 'code' => $code, 'price' => $price);
				
				$model = new ProductModel();
			
				$results = $model->save_product($data);
			
				echo view('product_create', ['success' => 'Product successfully saved!']);
			}
		} else {
			echo view('product_create');
		}
	}
	
	public function updateProduct() {
		$id = $this->request->getPost('id');
		$code = $this->request->getPost('code');
		$name = $this->request->getPost('name');
		$price = $this->request->getPost('price');
		
		if (!empty($id) && !empty($code) && !empty($name) && !empty($price)) {
			$data = array('name' => $name, 'code' => $code, 'price' => $price);
			
			$model = new ProductModel();
			
			$results = $model->update_product($id, $data);
			
			if ($results === true) {
				echo '<span style="color:green;">Product successfully updated</span>';
			} else {
				echo '<span style="color:red;">Something went wrong during product updation</span>';
			}
		} else {
			echo '<span style="color:red;">You must provide product details for updation</span>';
		}
	}
	
}
