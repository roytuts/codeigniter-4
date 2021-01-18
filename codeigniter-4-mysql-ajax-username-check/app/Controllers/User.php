<?php

namespace App\Controllers;
use App\Models\UserModel;

class User extends BaseController {
	
	public function __construct() {
		helper(['form', 'url']);
	}
	
	public function index()	{
		return view('username');
	}

	public function check_username_availability() {
		$requestBody = json_decode($this->request->getBody());

		$username = $requestBody->username;
			
		if ('post' === $this->request->getMethod() && $username) {
			$model = new UserModel();
			
			$result = $model->get_username($username);
			
			if ($result === true) {
				echo '<span style="color:red;">Username already taken</span>';
			} else {
				echo '<span style="color:green;">Username Available</span>';
			}
		} else {
			echo '<span style="color:red;">You must enter username</span>';
		}
	}
	
}
