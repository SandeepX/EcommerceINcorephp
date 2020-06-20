<?php

function debugger($data, $is_die = false){
	echo "<pre>";
	print_r($data);
	echo "</pre>";
	if($is_die){
		exit;
	}
}

function getCurrentPage(){
	$file = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME); //index, dashboard
	return $file;

}

function redirect($path, $session_key= null, $message = null){
	if(!isset($_SESSION)){
		session_start();
	}
	$_SESSION[$session_key]	= $message;
	@header('location: '.$path);
	exit;
}

function flash(){
	if(isset($_SESSION['success']) && !empty($_SESSION['success'])){
		echo "<p class='alert-success notice'>".$_SESSION['success']."</p>";
		unset($_SESSION['success']);
	}

	if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
		echo "<p class='alert-danger notice'>".$_SESSION['error']."</p>";
		unset($_SESSION['error']);
	}

	if(isset($_SESSION['warning']) && !empty($_SESSION['warning'])){
		echo "<p class='alert-warning notice'>".$_SESSION['warning']."</p>";
		unset($_SESSION['warning']);
	}

	if(isset($_SESSION['info']) && !empty($_SESSION['info'])){
		echo "<p class='alert-info notice'>".$_SESSION['info']."</p>";
		unset($_SESSION['info']);
	}
}

function generateRandomString($length = 100){
	$chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$str_len = strlen($chars);
	
	$random = "";

	for($i = 0; $i<$length; $i++){
		$random .= $chars[rand(0, ($str_len-1))];
	}
	return $random;
}

function sanitize($str){
	$str = strip_tags($str);
	/*$str = stripslashes($str);
	$str = addslashes($str);*/
	$str = htmlentities($str);

	return $str;
}

function uploadSingleFile($files, $folder){
	if($files['error'] == 0){
		$ext = pathinfo($files['name'], PATHINFO_EXTENSION);
		if(in_array(strtolower($ext), ALLOWED_EXTENSION)){
			if($files['size'] <= 5000000){
				$path = UPLOAD_DIR.$folder;

				if(!is_dir($path)){
					mkdir($path, '0777', true);
				}

				$file_name = ucfirst(strtolower($folder))."-".date('Ymdhis').'-'.rand(0,999).".".$ext;

				$success = move_uploaded_file($files['tmp_name'],$path."/".$file_name);
				if($success){
					return $file_name;
				} else {
					return false;
				}
			} else {
				return false;
			}
		} else {
			return false;
		}
	} else {
		return false;
	}
}


function api_response($body = null, $status = false, $response_code = 404, $message = "Failed"){
	$model = new stdClass();

	$model->body = $body;
	$model->meta = array();
	$model->meta['status']	= $status;
	$model->meta['response_code']	= $response_code;
	$model->meta['message']	= $message;

	return $model;
}