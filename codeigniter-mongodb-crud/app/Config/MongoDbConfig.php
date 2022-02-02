<?php
 
namespace Config;
 
use CodeIgniter\Config\BaseConfig;
 
/**
* Author: https://roytuts.com
*/
 
class MongoDbConfig extends BaseConfig {
             
    public $host = 'localhost';
    public $port = 27017;
    public $username = '';
    public $password = '';
    public $authRequired = false;
 
}
