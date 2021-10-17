<?php

namespace App\Libraries;

/**
 * Description of HTML Library
 *
 * @author https://roytuts.com
 */
class HTMLLibrary {
	
	function __construct() {
		require_once APPPATH . "ThirdParty/HTMLPurifier/HTMLPurifier.auto.php";
	}
	
    public function purifierConfig() {
        $config = \HTMLPurifier_Config::createDefault();
		$purifier = new \HTMLPurifier($config);
		
		return $purifier;
    }
	
}