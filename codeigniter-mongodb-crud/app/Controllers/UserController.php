<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController {
 
  private $usermodel;
 
  public function __construct() {
	$this->usermodel = new UserModel();
  }
 
  public function index() {
	$data['users'] = $this->usermodel->get_user_list();
	return view('users', $data);
  }
 
  public function create() {
	helper(['form', 'url']);

	if($this->request->getPost('submit')) {
	   $validation =  \Config\Services::validation();
	  
	   $validation->setRules([
		  'name' => ['label' => 'Full Name', 'rules' => 'trim|required'],
		  'email' => ['label' => 'Email Address', 'rules' => 'trim|required|valid_email']
	   ]);
	  
	   if (!$validation->withRequest($this->request)->run()) {
		  echo view('user_create', ['errors' => $validation->getErrors()]);
	   } else {
		  $result = $this->usermodel->create_user($this->request->getPost('name'), $this->request->getPost('email'));
		 
		  if($result === true) {
				return redirect()->to(site_url());
		  } else {
				echo view('user_create', ['error' => 'Error occurred during saving data']);
		  }                                                       
	   }
	} else {
		echo view('user_create');
	}
  }
 
  function update($_id) {
	 helper(['form', 'url']);

	 if($this->request->getPost('submit')) {
	   $validation =  \Config\Services::validation();
	  
	   $validation->setRules([
		  'name' => ['label' => 'Full Name', 'rules' => 'trim|required'],
		  'email' => ['label' => 'Email Address', 'rules' => 'trim|required|valid_email']
	   ]);
	  
	   if (!$validation->withRequest($this->request)->run()) {
		  echo view('user_update', ['errors' => $validation->getErrors()]);
	   } else {
		  $result = $this->usermodel->update_user($_id, $this->request->getPost('name'), $this->request->getPost('email'));
		 
		  if($result === true) {
				return redirect()->to(site_url());
		  } else {
				echo view('user_update', ['error' => 'Error occurred during updating data']);
		  }                                                       
	   }
	 } else {
	   $data['user'] = $this->usermodel->get_user($_id);
	   echo view('user_update', $data);
	 }
  }
 
  function delete($_id) {
	if ($_id) {
		$this->usermodel->delete_user($_id);
	}
	return redirect()->to(site_url());
  }
 
}
