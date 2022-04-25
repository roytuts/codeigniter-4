<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\RequestInterface;

use App\Libraries\JwtLibrary;

class Teacher extends ResourceController {
	
    protected $modelName = 'App\Models\TeacherModel';
    protected $format    = 'json';
	
	private $jwtLib;
	
	public function __construct() {
		$this->jwtLib = new JwtLibrary();
	}

	// fetch all teachers
    public function index() {
		$bearer_token = $this->jwtLib->get_bearer_token();
		
		//echo $bearer_token;

		$is_jwt_valid = $this->jwtLib->is_jwt_valid($bearer_token);

		if($is_jwt_valid) {
			return $this->respond($this->model->findAll());
		} else {
			return $this->failUnauthorized('Unauthorized Access');
		}
    }

}
