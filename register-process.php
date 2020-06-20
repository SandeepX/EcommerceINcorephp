<?php 

require $_SERVER['DOCUMENT_ROOT'].'config/init.php';
require CLASS_PATH.'user.php';
require CLASS_PATH.'session.php';
$user = new User();
$session = new Session();

if(isset($_POST) && !empty($_POST)){
	/*debugger($_POST);
	debugger($_SESSION, true);*/
	$array = array(
		'full_name' => sanitize($_POST['full_name']),
		'email'		=> sanitize($_POST['email']),
		'password'	=> sha1($_POST['password']),
		'billing_address'	=> sanitize($_POST['billing_address']),
		'phone'		=> sanitize($_POST['tel']),
		'role'		=> 'Customer' ||'Admin',
		'status'	=> 'Active'
	);
	$user_id = $user->addUser($array);
	if($user_id){
		if(isset($_SESSION['return'])){
			$return = $_SESSION['return'];
			unset($_SESSION['return']);
		}  else {
			$return = "profile";
		}
		$session->setSession('customer_id', $user_id);
		$session->setSession('customer_name', $array['full_name']);
		$session->setSession('email', $array['email']);
		redirect($return, 'success', 'You have been registered successfully.');
	} else {
		redirect('register', 'error', 'Sorry! There was problem while registering you. Please contact our admin.');
	}
} else {
	redirect('register', 'error', 'Please login or register to continue.');
}