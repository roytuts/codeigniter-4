<?php

/**
* Author: https://roytuts.com
*/

namespace App\Controllers;

class Form extends BaseController {
	
	public function index() {
        helper(['form', 'url']);

		if($this->request->getPost('submit')) {
			$validation =  \Config\Services::validation();
			
			$validation->setRules([
				'username' => ['label' => 'Username', 'rules' => 'required|min_length[5]|max_length[30]'],
				'password' => ['label' => 'Password', 'rules' => 'required|min_length[10]|max_length[20]'],
				'passconf' => ['label' => 'Password Confirm', 'rules' => 'required|min_length[10]|max_length[20]|matches[password]'],
				'email' => ['label' => 'Email Address', 'rules' => 'required|valid_email|max_length[150]']
			]);
			
			if (!$validation->withRequest($this->request)->run()) {
				echo view('form', ['errors' => $validation->getErrors()]);
			} else {
				echo view('form', ['success' => 'Validation for fields successfully passed!']);
			}
		} else {
			echo view('form');
		}
    }
	
}
