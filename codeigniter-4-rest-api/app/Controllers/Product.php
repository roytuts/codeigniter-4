<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
//use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\RequestInterface;

class Product extends ResourceController {
	//use ResponseTrait;
	
    protected $modelName = 'App\Models\ProductModel';
    protected $format    = 'json';

	// fetch all products
    public function index() {
        return $this->respond($this->model->findAll());
    }

    // save new product info
    public function create() {
		// get posted JSON
		//$json = json_decode(file_get_contents("php://input", true));
		$json = $this->request->getJSON();
		
		$name = $json->name;
		$price = $json->price;
		$sale_price = $json->sale_price;
		$sales_count = $json->sales_count;
		$sale_date = $json->sale_date;
		
		$data = array(
			'name' => $name,
			'price' => $price,
			'sale_price' => $sale_price,
			'sales_count' => $sales_count,
			'sale_date' => $sale_date
		);
		
        $this->model->insert($data);
		
        $response = array(
			'status'   => 201,
			'messages' => array(
				'success' => 'Product created successfully'
			)
		);
		
		return $this->respondCreated($response);
    }

    // fetch single product
    public function show($id = null) {
        $data = $this->model->where('id', $id)->first();
		
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No product found');
        }
    }

    // update product by id
    public function update($id = NULL){		
		//$json = json_decode(file_get_contents("php://input", true));
		$json = $this->request->getJSON();
		
		$price = $json->price;
		$sale_price = $json->sale_price;
		
		$data = array(
			'id' => $id,
			'price' => $price,
			'sale_price' => $sale_price
		);
		
        $this->model->update($id, $data);
        
		$response = array(
			'status'   => 200,
			'messages' => array(
				'success' => 'Product updated successfully'
			)
		);
	  
		return $this->respond($response);
    }

    // delete product by id
    public function delete($id = NULL){
        $data = $this->model->find($id);
		
        if($data) {
            $this->model->delete($id);
			
            $response = array(
                'status'   => 200,
                'messages' => array(
                    'success' => 'Product successfully deleted'
                )
            );
			
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('No product found');
        }
    }
}