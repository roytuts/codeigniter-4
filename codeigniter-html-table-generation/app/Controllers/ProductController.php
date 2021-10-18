<?php

namespace App\Controllers;

use App\Models\ProductModel;

use App\Libraries\PdfLibrary;

class ProductController extends BaseController {
	
    public function index()	{
		//$model = new ProductModel();
		
		//$data['salesinfo'] = $model->get_product_list();
		
		$table = new \CodeIgniter\View\Table();
		
		$template = array(
			'table_open' => '<table border="1" cellpadding="2" cellspacing="1">'
		);

		$table->setTemplate($template);

		$table->setHeading('Product Id', 'Price', 'Sale Price', 'Sales Count', 'Sale Date');
		
		$model = new ProductModel();
		
		$salesinfo = $model->get_product_list();
			
		foreach ($salesinfo as $sf):
			$table->addRow($sf->id, $sf->price, $sf->sale_price, $sf->sales_count, $sf->sale_date);
		endforeach;
		
		$html = $table->generate();
		
		$data['table'] = $html;
		
		return view('product', $data);
	}
	
}
