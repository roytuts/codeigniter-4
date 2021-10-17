<?php

namespace App\Controllers;

use App\Libraries\HTMLLibrary;

class HTMLPurifierController extends BaseController {
	
	function __construct() {
		//require_once APPPATH . "/ThirdParty/HTMLPurifier/HTMLPurifier.auto.php";
	}
	
    public function index()	{
		$htmlLibrary = new HTMLLibrary();
		
		//$config = \HTMLPurifier_Config::createDefault();
		//$purifier = new \HTMLPurifier($config);
		
		$dirty_html = "<!doctype html>
			 <html lang=en>
			 <head>
			 <meta charset=utf-8>
			 <title>HTML Template</title>
			 <style type=text/css>
			 @import url(0.css);
			 </style>
			 </head>
			 <body>
			 <center><h1>
			 A simple HTML template
			 </h1></center>
			 <!-- START YOUR TEXT -->
			 ...your text goes here... <p>
			 See <a href=quick-html.html>this</a>.
			 <!-- END YOUR TEXT -->
			 <p> 2020/02/05
			 </body></html>";
		
		//data['clean_html'] = $purifier->purify($dirty_html);
		
		$data['clean_html'] = $htmlLibrary->purifierConfig()->purify($dirty_html);
		
		return view('html_purifier', $data);
	}
	
}
