<?php

namespace App\Models;
use CodeIgniter\Model;

class TeacherModel extends Model {

	protected $table      = 'teacher';
    protected $primaryKey = 'id';
	
	protected $returnType     = 'array';

    protected $allowedFields = ['name', 'expertise'];

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
	
}
