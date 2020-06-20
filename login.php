<?php

require $_SERVER['DOCUMENT_ROOT'].'config/init.php';
require CLASS_PATH.'user.php';
require CLASS_PATH.'session.php';

$user = new User();
$session = new Session();

if(isset($_POST) && !empty($_POST)){
	$user_name = filter_var($_POST['username'], FILTER_VALIDATE_EMAIL);
	if(!$user_name){
		redirect('register','error','Invalid username.');
	}	
	
	$password = sha1($_POST['password']);

	$user_info = $user->getUserByUserName($user_name);


	if(!$user_info){
		redirect('register','error', 'Username does not exists.');
	} else {
		if($password == $user_info[0]->password){
			if($user_info[0]->role == "Customer" || "Admin"){
				if($user_info[0]->status == "Active"){
					/*SESSION*/

					$session->setSession('customer_id', $user_info[0]->id);
					$session->setSession('customer_name', $user_info[0]->full_name);
					$session->setSession('email', $user_info[0]->email);

					$token = generateRandomString(100);
					$session->setSession('session_token', $token);

					$data = array('api_token'=>$token);
					$user->updateUser($data, $user_info[0]->id);

					if(isset($_SESSION['return'])){
						$return = $_SESSION['return'];
						unset($_SESSION['return']);
					}  else {
						$return = "profile";
					}
					redirect($return,'success', 'Welcome <em>'.$user_info[0]->full_name.'</em>! To Dokan admin!!');
				} else {
					redirect('register', 'error','Your account is not activated.');
				}
			} else {
				redirect('register', 'error','You do not have previlage to access the system.');
			}
		} else{
			redirect('register', 'error','Password does not match.');
		}
	}
} else {
	redirect('register','error','Unauthorized access');
}