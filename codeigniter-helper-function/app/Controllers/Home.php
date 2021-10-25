<?php

namespace App\Controllers;

class Home extends BaseController {
	
    public function index() {
		//helper(['month_year']);
		helper('month_year');
		
		$data['months'] = generate_months();
		$data['years'] = generate_years();
		
        return view('welcome_message', $data);
    }
	
}
