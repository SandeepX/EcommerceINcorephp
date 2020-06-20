<?php


require $_SERVER['DOCUMENT_ROOT'].'config/init.php';
require CLASS_PATH.'user.php';
require CLASS_PATH.'session.php';

$user = new User();
$session = new Session();

$user_id = $session->getSession('user_id');
$session->destroySession();

$data = array(
		'api_token' => ''
);

$user->updateUser($data, $user_id);
redirect('./', 'success','Thank you for using dokan.');