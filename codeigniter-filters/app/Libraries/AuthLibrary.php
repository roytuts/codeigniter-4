<?php

namespace App\Libraries;

use App\Models\AuthModel;

/**
 * Description of Auth Library
 *
 * @author https://roytuts.com
 */
class AuthLibrary {
	
	private $db;
	private $msg;
	private $request;
	
	public function __construct() {
		$this->db = \Config\Database::connect();
		$this->request = \Config\Services::request();
	}
	
	private function set_msg($msg) {
        $this->msg .= $msg . nl2br("\n");
    }
	
	function get_msg() {
        return $this->msg;
    }
	
	function login($username, $password) {
        if ((strlen($username) > 0) AND (strlen($password) > 0)) {
			$model = new AuthModel();
			$login = $model->get_login_details($username, $password);
			
            if ($login !== NULL) {
				$session = session();
				
				$session->set(array(
					'user_name' => $login->username,
					'last_login' => $login->last_login
				));
				
                return TRUE;
            } else { // fail - wrong creadentials
                $this->set_msg(lang('Message.incorrect_credentials'));
            }
        }
		
        return FALSE;
    }
	
	function logout() {
		$session = session();
		
        $session->set(array('user_name' => '', 'last_login' => ''));
        $session->destroy();
    }
	
	function is_logged_in() {
		$session = session();
		
        return $session->has('user_name');
    }
	
}