<?php
 
namespace App\Libraries;

//use MongoDB\Driver\Manager;

/**
* Author: https://roytuts.com
*/
 
class MongoDB {
             
	private $conn;

	function __construct() {
		$config = new \Config\MongoDbConfig();

		$host = $config->host;
		$port = $config->port;
		$username = $config->username;
		$password = $config->password;
		$authRequired = $config->authRequired;

		try {
			if($authRequired === true) {
				$this->conn = new \MongoDB\Driver\Manager('mongodb://' . $username . ':' . $password . '@' . $host. ':' . $port);
			} else {
				$this->conn = new \MongoDB\Driver\Manager('mongodb://' . $host. ':' . $port);
			}
		} catch(MongoDB\Driver\Exception\MongoConnectionException $ex) {
			show_error('Couldn\'t connect to mongodb: ' . $ex->getMessage(), 500);
		}
	}

	function getConn() {
		return $this->conn;
	}
             
}