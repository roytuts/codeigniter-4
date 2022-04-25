<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\RequestInterface;

use App\Libraries\JwtLibrary;

class User extends ResourceController {
	
    protected $modelName = 'App\Models\UserModel';
    protected $format    = 'json';
	
	private $jwtLib;
	
	public function __construct() {
		$this->jwtLib = new JwtLibrary();
	}

	// fetch all teachers
    public function register() {
		// get posted JSON
		//$json = json_decode(file_get_contents("php://input", true));
		$json = $this->request->getJSON();
		
		$username = $json->username;
		$password = $json->password;

		$data = array(
			'username' => $username,
			'password' => $password
		);
		
		$user = $this->model->where('username', $username)->first();
		
		if($user) {
			$response = array(
				'status'   => 409,
				'messages' => array(
					'success' => 'User already exists'
				)
			);
			
			return $this->failResourceExists($response);
		} else {		
			$this->model->insert($data);
			
			$response = array(
				'status'   => 201,
				'messages' => array(
					'success' => 'User registered successfully'
				)
			);
			
			return $this->respondCreated($response);
		}
    }
	
	public function login() {
		// get posted JSON
		//$json = json_decode(file_get_contents("php://input", true));
		$json = $this->request->getJSON();
		
		$username = $json->username;
		$password = $json->password;
		
        $data = $this->model->where(array('username' => $username, 'password' => $password))->first();
		
        if($data) {
			$headers = array('alg'=>'HS256','typ'=>'JWT');
			$payload = array('username'=>$username, 'exp'=>(time() + 60));

			$jwt = $this->jwtLib->generate_jwt($headers, $payload);
		
            return $this->respond(array('token' => $jwt));
        } else {
            return $this->failNotFound('No user found');
        }
    }

}
