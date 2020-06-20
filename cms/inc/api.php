<?php


require $_SERVER['DOCUMENT_ROOT'].'config/init.php';
require 'checklogin.php';
require CLASS_PATH.'category.php';

$category = new Category();

$act = isset($_REQUEST['act']) ? $_REQUEST['act'] : null;


if($act){

	if($act == substr(md5('get-child-cat'.$session->getSession('session_token')), 5, 20)){
		$cat_id = (int)$_REQUEST['cat_id'];

		$cat_info = $category->getCategoryById($cat_id);
		if($cat_info){
			$child_cats = $category->getChildByCatId($cat_id);
			if($child_cats){
				echo json_encode(api_response($child_cats, true, 200, 'Success'), JSON_HEX_APOS);
				exit;
			} else {
				echo json_encode(api_response(), JSON_HEX_APOS);
				exit;	
			}
		} else {
			echo json_encode(api_response(), JSON_HEX_APOS);
			exit;	
		}
	} else {
		echo json_encode(api_response(), JSON_HEX_APOS);
		exit;
	}
} else {
	echo json_encode(api_response(), JSON_HEX_APOS);
	exit;
}
