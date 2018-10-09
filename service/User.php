<?php
/**
 * 
 */
class User {
	
	function __construct() {
		$this->USERNAME = "aryan";
		$this->PASSWORD = "aryan";
	}

	function login($username, $password) {
		return ($username == $this->USERNAME && $password == $this->PASSWORD);
	}
}
?>