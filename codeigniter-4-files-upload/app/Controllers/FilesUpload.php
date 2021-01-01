<?php namespace App\Controllers;

class FilesUpload extends BaseController {
	
	public function __construct() {
		helper(['form', 'url']);
	}
	
	public function index() {
		return redirect()->to(site_url('filesupload/upload_single_file'));
	}
	
	public function upload_single_file() {
		if($this->request->getPost('file_upload')) {
			if($file = $this->request->getFile('single_file')) {
				if ($file->isValid() && !$file->hasMoved()) {
					$newName = $file->getRandomName();
					$file->move(WRITEPATH . 'uploads', $newName);
					
					echo view('file_upload', ['success' => 'File Uploaded Successfully']);
				} else {
					$error = $file->getErrorString() . '(' . $file->getError() . ')';
					
					echo view('file_upload', ['error' => $error]);
				}
			} else {
				echo view('file_upload', ['error' => 'Select a file for upload']);
			}
		} else {
			echo view('file_upload');
		}
	}

	public function upload_multiple_files() {
		if($this->request->getPost('files_upload')) {
			if($files = $this->request->getFileMultiple('multiple_files'))	{
				$errors = array();
				foreach($files as $file) {
				  if ($file->isValid() && ! $file->hasMoved()) {
					   $newName = $file->getRandomName();
					   $file->move(WRITEPATH . 'uploads', $newName);
				  } else {
					  array_push($errors, $file->getErrorString() . '(' . $file->getError() . ')');
				  }
				}
				
				if(empty($errors)) {
					echo view('files_upload', ['success' => 'All Files Uploaded Successfully']);
				} else {
					echo view('files_upload', ['errors' => $errors]);
				}
			} else {
				echo view('files_upload', ['error' => 'Select at least one file for upload']);
			}
		} else {
			echo view('files_upload');
		}
	}
}
