<?php

namespace App\Libraries;

/**
 * Description of JWT Library
 *
 * @author https://roytuts.com
 */
class JwtLibrary {
	
	private $request;
	
	public function __construct() {
		$this->request = \Config\Services::request();
	}
	
	function generate_jwt($headers, $payload, $secret = 'secret') {
		$headers_encoded = $this->base64url_encode(json_encode($headers));
		
		$payload_encoded = $this->base64url_encode(json_encode($payload));
		
		$signature = hash_hmac('SHA256', "$headers_encoded.$payload_encoded", $secret, true);
		$signature_encoded = $this->base64url_encode($signature);
		
		$jwt = "$headers_encoded.$payload_encoded.$signature_encoded";
		
		return $jwt;
	}

	function is_jwt_valid($jwt, $secret = 'secret') {
		if(empty($jwt)) {
			return false;
		}
			
		// split the jwt
		$tokenParts = explode('.', $jwt);
		$header = base64_decode($tokenParts[0]);
		$payload = base64_decode($tokenParts[1]);
		$signature_provided = $tokenParts[2];

		// check the expiration time - note this will cause an error if there is no 'exp' claim in the jwt
		$expiration = json_decode($payload)->exp;
		$is_token_expired = ($expiration - time()) < 0;

		// build a signature based on the header and payload using the secret
		$base64_url_header = $this->base64url_encode($header);
		$base64_url_payload = $this->base64url_encode($payload);
		$signature = hash_hmac('SHA256', $base64_url_header . "." . $base64_url_payload, $secret, true);
		$base64_url_signature = $this->base64url_encode($signature);

		// verify it matches the signature provided in the jwt
		$is_signature_valid = ($base64_url_signature === $signature_provided);
		
		if ($is_token_expired || !$is_signature_valid) {
			return false;
		} else {
			return true;
		}
	}

	function base64url_encode($data) {
		return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
	}

	function get_authorization_header(){
		$headers = null;
		
		if ($this->request->getServer('Authorization')) {
			$headers = $this->request->getServer('Authorization');
		} else if ($this->request->getServer('HTTP_AUTHORIZATION')) { //Nginx or fast CGI
			$headers = $this->request->getServer('HTTP_AUTHORIZATION');
		} else if (function_exists('apache_request_headers')) {
			$requestHeaders = apache_request_headers();
			// Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
			$requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
			//print_r($requestHeaders);
			if (isset($requestHeaders['Authorization'])) {
				$headers = trim($requestHeaders['Authorization']);
			}
		}
		
		return $headers;
	}

	function get_bearer_token() {
		$headers = $this->get_authorization_header();
		
		// HEADER: Get the access token from the header
		if (!empty($headers)) {
			if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
				return $matches[1];
			}
		}
		return null;
	}
	
}
