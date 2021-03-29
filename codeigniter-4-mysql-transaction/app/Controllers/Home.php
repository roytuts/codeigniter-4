<?php

namespace App\Controllers;
use App\Models\UserModel;

class Home extends BaseController {
	
	public function index()	{
		$model = new UserModel();
		
		$insert_result = $model->insert_user('roytuts', 'Soumitra');
		
		$update_result = $model->update_user(1, 'roytuts.com', 1, 'Soumitra Roy');
		
		$delete_result = $model->delete_user(1, 1);
		
		$success = ''; $error = '';
		
		if($insert_result) {
			$success .= 'Successfully inserted.';
		} else {
			$error .= 'Something went wrong during insertion.';
		}
		
		if($update_result) {
			$success .= ' Successfully updated.';
		} else {
			$error .= ' Something went wrong during updation.';
		}
		
		if($delete_result) {
			$success .= ' Successfully deleted.';
		} else {
			$error .= ' Something went wrong during deletion.';
		}
		
		return view('welcome_message', ['success' => $success, 'error' => $error]);
	}
	
}
