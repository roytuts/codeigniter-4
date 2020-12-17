<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
* Author: https://roytuts.com
*/

class Site extends BaseConfig {
	
    public $defaultTitle = 'Roy Tutorials';
    public $defaultSuccessMsg = 'Success';
	public $defaultErrorMsg = 'Error';
	public $displayMsg = 1;
	public $authRequired = false;

}