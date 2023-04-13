<?php

namespace App\Controllers;

class Home extends BaseController {
	
    /*public function index() {
		helper(['curl']);
		
		$rest_api_base_url = 'https://reqres.in';
		
		//GET - list of users
		$get_endpoint = '/api/users';
		
		$response = perform_http_request('GET', $rest_api_base_url . $get_endpoint);
		
		$data['users'] = $response;
		
		//GET - single user
		$get_endpoint = '/api/users/2';
		
		$response = perform_http_request('GET', $rest_api_base_url . $get_endpoint);
		
		$data['user'] = $response;
		
		//POST - create new user
		$post_endpoint = '/api/users';
		
		$request_data = json_encode(array("name" => "Soumitra", "job" => "Blog Author", "avatar" => "https://roytuts.com/about/"));
		
		$response = perform_http_request('POST', $rest_api_base_url . $post_endpoint, $request_data);
		
		$data['new_user'] = $response;
		
		//PUT - update user
		$put_endpoint = '/api/users/707';
		
		$request_data = json_encode(array("name" => "Soumitra", "job" => "Roy Tutorials Author", "avatar" => "https://roytuts.com/about/"));
		
		$response = perform_http_request('PUT', $rest_api_base_url . $put_endpoint, $request_data);
		
		$data['update_user'] = $response;
		
		//View
        return view('consume_rest_api', $data);
    }*/
	
	//CodeIgniter 4 cURL
	public function index() {
		$rest_api_base_url = 'https://reqres.in';
		
		// Instance
        $curl = \Config\Services::curlrequest(['baseURI' => $rest_api_base_url]);		
		
		//GET - list of users
		$get_endpoint = '/api/users';
		
		$response = $curl->get($get_endpoint, ['verify' => false]); //disable SSL: verify => false 
		
		$data['users'] = $response->getBody();
		
		//GET - single user
		$get_endpoint = '/api/users/2';
		
		$response = $curl->get($get_endpoint, ['verify' => false]); //disable SSL: verify => false 
		
		$data['user'] = $response->getBody();
		
		//POST - create new user
		$post_endpoint = '/api/users';
		
		$request_data = json_encode(array("name" => "Soumitra", "job" => "Blog Author", "avatar" => "https://roytuts.com/about/"));
		
		$response = $curl->post($post_endpoint, ['json' => ["name" => "Soumitra", "job" => "Blog Author", "avatar" => "https://roytuts.com/about/"], 'verify' => false]); //disable SSL: verify => false 
		
		$data['new_user'] = $response->getBody();
		
		//PUT - update user
		$put_endpoint = '/api/users/707';
		
		$request_data = json_encode(array("name" => "Soumitra", "job" => "Roy Tutorials Author", "avatar" => "https://roytuts.com/about/"));
		
		$response = $curl->put($put_endpoint, ['json' => ["name" => "Soumitra", "job" => "Roy Tutorials Author", "avatar" => "https://roytuts.com/about/"], 'verify' => false]); //disable SSL: verify => false 
		
		$data['update_user'] = $response->getBody();
		
		//View
        return view('consume_rest_api', $data);
    }
	
}
