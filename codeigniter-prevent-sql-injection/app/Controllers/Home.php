<?php

namespace App\Controllers;

use App\Models\BlogModel;

class Home extends BaseController {
	
    public function index($search = '') {
		$model = new BlogModel();
		
		$data['blog_list'] = $model->get_blog_search_list($search);
		
        return view('blog_list', $data);
    }
	
	public function create() {
		helper(['form', 'url']);

		if($this->request->getPost('submit')) {
			$validation =  \Config\Services::validation();
			
			$validation->setRules([
				'title' => ['label' => 'Title', 'rules' => 'required'],
				'content' => ['label' => 'Content', 'rules' => 'required']
			]);
			
			if (!$validation->withRequest($this->request)->run()) {
				echo view('blog_add', ['errors' => $validation->getErrors()]);
			} else {
				$model = new BlogModel();
				
				$model->save_new_blog($this->request->getPost('title'), $this->request->getPost('content'));
				
				echo view('blog_add', ['success' => 'Blog successfully saved']);
			}
		} else {
			echo view('blog_add');
		}
	}
	
}
