<?php
namespace App\Models;
use CodeIgniter\Model;

class ProductModel extends Model {

	protected $table      = 'product';
    protected $primaryKey = 'id';
	
	protected $returnType     = 'array';

    protected $allowedFields = ['name', 'price', 'sale_price', 'sales_count', 'sale_date'];

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
	
}
