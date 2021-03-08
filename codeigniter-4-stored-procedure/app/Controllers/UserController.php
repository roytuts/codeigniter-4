<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController {
	
	public function index() {
		helper(['form', 'url']);
		
		if($this->request->getPost('submit')) {
			$validation =  \Config\Services::validation();
			
			$validation->setRules([
				'name' => ['label' => 'Full Name', 'rules' => 'required|min_length[3]|max_length[30]'],
				'phone' => ['label' => 'Phone No.', 'rules' => 'required|min_length[8]|max_length[20]'],
				'address' => ['label' => 'Contact Address', 'rules' => 'required|min_length[10]|max_length[200]'],
				'email' => ['label' => 'Email Address', 'rules' => 'required|valid_email|max_length[150]']
			]);
			
			if (!$validation->withRequest($this->request)->run()) {
				echo view('sp_view', ['errors' => $validation->getErrors()]);
			} else {
				$model = new UserModel();
				
				$result = $model->insert_user($this->request->getPost('name'), $this->request->getPost('email'), $this->request->getPost('phone'), $this->request->getPost('address'));
				
				if($result) {
					echo view('sp_view', ['success' => 'User information successfully saved']);
				} else {
					echo view('sp_view', ['errors' => 'Oops! something wrong']);
				}
			}
		} else {
			echo view('sp_view');
		}
	}
}
