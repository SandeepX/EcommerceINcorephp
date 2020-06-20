<?php


class Session extends Database{
	public function setSession($key, $value){
		if(!isset($_SESSION)){
			session_start();
		}
		$_SESSION[$key] = $value;
	}

	public function getSession($key){
		if(isset($_SESSION[$key])){
			return $_SESSION[$key];
		} else {
			return false;
		}
	}

	public function destroySession(){
		session_destroy();
	}
}