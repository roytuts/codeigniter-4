<?php

namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model {

	protected $table      = 'user';
    protected $primaryKey = 'id';
	
	protected $returnType     = 'array';

    protected $allowedFields = ['username', 'password'];

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
	
}
