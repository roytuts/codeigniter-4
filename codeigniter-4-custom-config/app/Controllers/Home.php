<?php namespace App\Controllers;

class Home extends BaseController {
	
	public function index()	{
		$config = new \Config\Site();
		
		$data['default_title'] = $config->defaultTitle;
		$data['auth_required'] = $config->authRequired;
		
		return view('welcome_message', $data);
	}

}
