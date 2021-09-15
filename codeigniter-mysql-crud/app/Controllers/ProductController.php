<?php

namespace App\Controllers;

use App\Models\ProductModel;

class ProductController extends BaseController {
	
	public function index()	{
		$model = new ProductModel();
		
		$data['product_list'] = $model->get_product_list();
		
		return view('products', $data);
	}
	
	public function create()	{
		helper(['form', 'url']);

		if($this->request->getPost('submit')) {
			$validation =  \Config\Services::validation();
			
			$validation->setRules([
				'name' => ['label' => 'Name', 'rules' => 'required|min_length[3]|max_length[30]'],
				'price' => ['label' => 'Price', 'rules' => 'required|decimal'],
				'sale_price' => ['label' => 'Selling Price', 'rules' => 'required|decimal'],
				'sales_count' => ['label' => 'Sales Count', 'rules' => 'required|integer'],
				'sale_date' => ['label' => 'Selling Date', 'rules' => 'required|valid_date']
			]);
			
			if (!$validation->withRequest($this->request)->run()) {
				echo view('product_add', ['errors' => $validation->getErrors()]);
			} else {
				$model = new ProductModel();
				
				$data = array(
					'name' => $this->request->getPost('name'),
					'price' => $this->request->getPost('price'),
					'sale_price' => $this->request->getPost('sale_price'),
					'sales_count' => $this->request->getPost('sales_count'),
					'sale_date' => $this->request->getPost('sale_date')
				);
				
				$model->save_product_info($data);
				
				return redirect()->to(site_url());
			}
		} else {
			echo view('product_add');
		}
	}
	
	public function update()	{
		helper(['form', 'url']);

		if($this->request->getPost('submit')) {
			$validation =  \Config\Services::validation();
			
			$validation->setRules([
				'id' => ['label' => 'Id', 'rules' => 'required'],
				'name' => ['label' => 'Name', 'rules' => 'required|min_length[3]|max_length[30]'],
				'price' => ['label' => 'Price', 'rules' => 'required|decimal'],
				'sale_price' => ['label' => 'Selling Price', 'rules' => 'required|decimal'],
				'sales_count' => ['label' => 'Sales Count', 'rules' => 'required|integer'],
				'sale_date' => ['label' => 'Selling Date', 'rules' => 'required|valid_date']
			]);
			
			if (!$validation->withRequest($this->request)->run()) {
				echo view('product_add', ['errors' => $validation->getErrors()]);
			} else {
				$model = new ProductModel();
				
				$data = array(
					'id' => $this->request->getPost('id'),
					'name' => $this->request->getPost('name'),
					'price' => $this->request->getPost('price'),
					'sale_price' => $this->request->getPost('sale_price'),
					'sales_count' => $this->request->getPost('sales_count'),
					'sale_date' => $this->request->getPost('sale_date')
				);
				
				$model->update_product_info($data);
				
				return redirect()->to(site_url());
			}
		} else if($this->request->getGet('id')) {
			$model = new ProductModel();
			
			$data['product_info'] = $model->get_product($this->request->getGet('id'));
			
			echo view('product_update', $data);
		} else {
			return redirect()->to(site_url());
		}
	}
	
	public function delete_product() {
		
		if($this->request->getGet('id')) {
			$model = new ProductModel();
			$model->delete_product_info($this->request->getGet('id'));
			//$model->where('id', $id)->delete();
		}
		
		return redirect()->to(site_url());
	}
	
}
