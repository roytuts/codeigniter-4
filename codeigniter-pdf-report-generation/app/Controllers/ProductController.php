<?php

namespace App\Controllers;

use App\Models\ProductModel;

use App\Libraries\PdfLibrary;

class ProductController extends BaseController {
	
    public function index()	{
		$model = new ProductModel();
		
		$data['salesinfo'] = $model->get_product_list();
		
		return view('product', $data);
	}
	
	public function generate_pdf() {
		$pdf = new PdfLibrary(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		
		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('https://roytuts.com');
		$pdf->SetTitle('Sales Information for Products');
		$pdf->SetSubject('Report generated using Codeigniter and TCPDF');
		$pdf->SetKeywords('TCPDF, PDF, MySQL, Codeigniter');

		// set default header data
		//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set font
		$pdf->SetFont('times', 'BI', 12);
		
		// ---------------------------------------------------------
		
		
		//Generate HTML table data from MySQL - start
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
		//Generate HTML table data from MySQL - end
		
		// add a page
		$pdf->AddPage();
		
		// output the HTML content
		$pdf->writeHTML($html, true, false, true, false, '');
		
		// reset pointer to the last page
		$pdf->lastPage();

		//Close and output PDF document
		$pdf->Output(md5(time()).'.pdf', 'D');
	}
	
}
