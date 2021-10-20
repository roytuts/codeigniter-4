<?php

namespace App\Controllers;

use App\Libraries\AuthLibrary;

class Auth extends BaseController {
	
	private $msg;
	private $authLib;
	
	public function __construct() {
        $this->authLib = new AuthLibrary();
    }
	
    private function display_msg($msg) {
        $this->msg .= $msg . nl2br("\n");
    }
	
	function index() {
		if (!$this->authLib->is_logged_in()) {
            return redirect()->to(site_url('auth/login'));
        } else {
			echo view('home');
		}
	}
	
	function login() {
		$session = session();
		
        if ($this->request->getPost('login')) {
			$validation =  \Config\Services::validation();
			
			$validation->setRules([
				'username' => ['label' => 'Username', 'rules' => 'trim|required|max_length[100]'],
				'password' => ['label' => 'Password', 'rules' => 'trim|required|max_length[25]']
			]);
			
			if (!$validation->withRequest($this->request)->run()) {
				//Error
				echo view('login', ['errors' => $validation->getErrors()]);
			} else {
				$username = $this->request->getPost('username');
                $password = $this->request->getPost('password');
                if ($this->authLib->login($username, $password)) {
					//Success
					$config = new \Config\CustomConfig();
					$key = $config->msgKey;
                    $session->setFlashdata($key, lang('Message.login_success'));
                    $session->keepFlashdata($key);
                    return redirect()->to(site_url());
                } else {
                    $errors = $this->authlib->get_msg();
                    $this->display_msg($errors);
					
					echo view('login', ['errors' => $this->msg]);
                }
			}
        } else {		
			$config = new \Config\CustomConfig();
			$key = $config->msgKey;
			
			echo view('login', ['msg' => $session->getFlashdata($key)]);
		}
    }
	
    function logout() {
        if ($this->authLib->is_logged_in()) {
            $this->authLib->logout();
        }
		
        return redirect()->to(site_url());
    }
	
}
