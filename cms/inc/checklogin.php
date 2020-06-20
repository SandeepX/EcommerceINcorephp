<?php


require CLASS_PATH.'session.php';
require CLASS_PATH.'user.php';
$session = new Session();
$user = new User();

if(isset($_SESSION['session_token'])){
	$session_token = $session->getSession('session_token');

	$user_info = $user->getUserBySession($session_token);
	if($user_info){
		if($session->getSession('user_id') != $user_info[0]->id){
			redirect('logout');
		}
	} else {
		redirect('logout','error','User does not exists.');
	}
} else {
	redirect('./','error','Please Login first.');
}