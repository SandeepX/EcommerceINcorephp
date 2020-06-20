<?php


require $_SERVER['DOCUMENT_ROOT'].'config/init.php';
require '../inc/checklogin.php';

require CLASS_PATH.'category.php';
$category = new Category();

if(isset($_POST) && !empty($_POST)){
	/*debugger($_POST);
	debugger($_FILES, true);*/




	$data = array(
		'title'		=> sanitize($_POST['title']),
		'summary'		=> sanitize($_POST['summary']),
		'is_parent'	=> (isset($_POST['is_parent']) && $_POST['is_parent'] == 1) ? 1 : 0,
		'parent_id'	=> (isset($_POST['parent_id']) && !empty($_POST['parent_id'])) ? (int)$_POST['parent_id'] : 0,
		'show_in_menu'	=> (isset($_POST['show_in_menu']) && $_POST['show_in_menu'] == 1) ? 1 : 0,
		'status'	=> sanitize($_POST['status']),
		'added_by'	=>	$session->getSession('user_id')
	);


	if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
		$file_name = uploadSingleFile($_FILES['image'], 'category');
		if($file_name){
			$data['image']	= $file_name;
		} else {
			$session->setSession('warning', 'Image could not be uploaded at this moment.');
		}
	}


	$category_id = (isset($_POST['category_id']) && !empty($_POST['category_id']) ) ? (int)$_POST['category_id'] : null;

	if($category_id){
		$act = "Updat";
		$category_id = $category->updateCategory($data, $category_id);
	} else {
		$act = "Add";
		$category_id = $category->addCategory($data);
	}




	if($category_id){
		redirect('../category', 'success', 'Category '.$act.'ed successfully.');
	} else {
		redirect('../category', 'error', 'Sorry! There was problem while '.$act.'ing category.');
	}

} if(isset($_GET['id'], $_GET['act']) && !empty($_GET['id']) && !empty($_GET['act'])){

	$cat_id = (int)$_GET['id'];

	if($_GET['act'] == substr(md5('del-cat-'.$cat_id.'-'.$session->getSession('session_token')), 5,15)){
		$cat_info = $category->getCategoryById($cat_id);
		if($cat_info){
			$del = $category->deleteCategory($cat_id);

			if($del){
				if($cat_info[0]->image != "" && file_exists(UPLOAD_DIR.'category/'.$cat_info[0]->image)){
					unlink(UPLOAD_DIR.'category/'.$cat_info[0]->image);
				}

				redirect('../category','success', 'Category deleted successfully.');
			} else {
				redirect('../category','error', 'Sorry! There was problem while deleting category.');
			}

		} else {
			redirect('../category', 'error', 'Category data not found or has been already deleted.');		
		}

	} else {
		redirect('../category', 'error', 'Invalid Token.');		
	}
}
else {
	redirect('../category', 'error', 'Unauthorized access.');
}