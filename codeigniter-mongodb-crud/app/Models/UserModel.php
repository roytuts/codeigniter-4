<?php

namespace App\Models;

use App\Libraries\MongoDb;

class UserModel {

	private $database = 'roytuts';
	private $collection = 'user';
	private $conn;

	function __construct() {
		$mongodb = new MongoDb();
		$this->conn = $mongodb->getConn();
	}

	function get_user_list() {
		try {
			$filter = [];
			$query = new \MongoDB\Driver\Query($filter);

			$result = $this->conn->executeQuery($this->database . '.' . $this->collection, $query);
			
			return $result->toArray();
		} catch(\MongoDB\Driver\Exception\RuntimeException $ex) {
			show_error('Error while fetching users: ' . $ex->getMessage(), 500);
		}
	}

	function get_user($_id) {
		try {
			$filter = ['_id' => new \MongoDB\BSON\ObjectId($_id)];
			$query = new \MongoDB\Driver\Query($filter);

			$result = $this->conn->executeQuery($this->database.'.'.$this->collection, $query);

			foreach($result as $user) {
				return $user;
			}

			return null;
		} catch(\MongoDB\Driver\Exception\RuntimeException $ex) {
			show_error('Error while fetching user: ' . $ex->getMessage(), 500);
		}
	}

	function create_user($name, $email) {
		try {
			$user = array(
				'name' => $name,
				'email' => $email
			);

			$query = new \MongoDB\Driver\BulkWrite();
			$query->insert($user);

			$result = $this->conn->executeBulkWrite($this->database.'.'.$this->collection, $query);

			if($result->getInsertedCount() == 1) {
				return true;
			}

			return false;
		} catch(\MongoDB\Driver\Exception\RuntimeException $ex) {
			show_error('Error while saving users: ' . $ex->getMessage(), 500);
		}
	}

	function update_user($_id, $name, $email) {
		try {
			$query = new \MongoDB\Driver\BulkWrite();
			$query->update(['_id' => new \MongoDB\BSON\ObjectId($_id)], ['$set' => array('name' => $name, 'email' => $email)]);

			$result = $this->conn->executeBulkWrite($this->database . '.' . $this->collection, $query);

			if($result->getModifiedCount()) {
				return true;
			}

			return false;
		} catch(\MongoDB\Driver\Exception\RuntimeException $ex) {
			show_error('Error while updating users: ' . $ex->getMessage(), 500);
		}
	}

	function delete_user($_id) {
		try {
			$query = new \MongoDB\Driver\BulkWrite();
			$query->delete(['_id' => new \MongoDB\BSON\ObjectId($_id)]);

			$result = $this->conn->executeBulkWrite($this->database . '.' . $this->collection, $query);

			if($result->getDeletedCount() == 1) {
				return true;
			}

			return false;
		} catch(\MongoDB\Driver\Exception\RuntimeException $ex) {
			show_error('Error while deleting users: ' . $ex->getMessage(), 500);
		}
	}

}