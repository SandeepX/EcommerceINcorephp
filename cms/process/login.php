<?php


require $_SERVER['DOCUMENT_ROOT'].'config/init.php';
require CLASS_PATH.'user.php';
require CLASS_PATH.'session.php';

$user = new User();
$session = new Session();

if(isset($_POST) && !empty($_POST)){
	$user_name = filter_var($_POST['username'], FILTER_VALIDATE_EMAIL);
	if(!$user_name){
		redirect('../','error','Invalid username.');
	}	

	$password = sha1($_POST['password']);

	$user_info = $user->getUserByUserName($user_name);
	// echo"<pre>";
	// print_r($user_info);
	// die();

	//echo "<pre>"; print_r($user_info); die;
	if(!$user_info){
		redirect('../','error', 'Username does not exists.');
	} else {
		if($password == $user_info[0]->password){
			if($user_info[0]->role =="Admin"){
				if($user_info[0]->status == "Active"){
					/*SESSION*/

					$session->setSession('user_id', $user_info[0]->id);
					$session->setSession('full_name', $user_info[0]->full_name);
					$session->setSession('email', $user_info[0]->email);

					$token = generateRandomString(100);
					$session->setSession('session_token', $token);

					$data = array('api_token'=>$token);
					$user->updateUser($data, $user_info[0]->id);

					redirect('../dashboard','success', 'Welcome <em>'.$user_info[0]->full_name.'</em>! To Dokan admin!!');
				} else {
					redirect('../', 'error','Your account is not activated.');
				}
			} else {
				redirect('../', 'error','You do not have previlage to access the system.');
			}
		} else{
			redirect('../', 'error','Password does not match.');
		}
	}
} else {
	redirect('../','error','Unauthorized access');
}