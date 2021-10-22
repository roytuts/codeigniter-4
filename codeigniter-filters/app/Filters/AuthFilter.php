<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

use App\Libraries\AuthLibrary;

class AuthFilter implements FilterInterface {
	
    public function before(RequestInterface $request, $arguments = null) {
        $authLib = new AuthLibrary();
		
		//echo 'Before Filter';
		
		if (!$authLib->is_logged_in()) {
            return redirect()->to(site_url('auth/login'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {
        //echo 'After Filter';
		//print_r ($response);
    }
	
}