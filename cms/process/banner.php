<?php


require $_SERVER['DOCUMENT_ROOT'].'config/init.php';
require '../inc/checklogin.php';
require CLASS_PATH.'banner.php';
$banner = new Banner();

if(isset($_POST) && !empty($_POST)){
	/*debugger($_POST);
	debugger($_FILES, true);*/
	$data = array(
		'title'		=> sanitize($_POST['title']),
		'link'		=> sanitize($_POST['link']),
		'status'	=> sanitize($_POST['status']),
		'added_by'	=>	$session->getSession('user_id')
	);


	if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
		$file_name = uploadSingleFile($_FILES['image'], 'banner');
		if($file_name){
			$data['image']	= $file_name;
		} else {
			$session->setSession('warning', 'Image could not be uploaded at this moment.');
		}
	}


	$banner_id = (isset($_POST['banner_id']) && !empty($_POST['banner_id']) ) ? (int)$_POST['banner_id'] : null;

	if($banner_id){
		$act = "Updat";
		$banner_id = $banner->updateBanner($data, $banner_id);
	} else {
		$act = "Add";
		$banner_id = $banner->addBanner($data);
	}




	if($banner_id){
		redirect('../banner', 'success', 'Banner '.$act.'ed successfully.');
	} else {
		redirect('../banner', 'error', 'Sorry! There was problem while '.$act.'ing banner.');
	}

} elseif(isset($_GET['id'], $_GET['act']) && !empty($_GET['id']) && !empty($_GET['act'])){
	$id = (int)$_GET['id'];
	$act = $_GET['act'];

	$session_token = $session->getSession('session_token');

	if($act == substr(md5("del-banner-".$id."-".$session_token), 3, 15)){
		$banner_info = $banner->getBannerById($id);
		if($banner_info){
			/*Delete banner*/
			$del = $banner->deleteBanner($id);
			if($del){
				if(!empty($banner_info[0]->image) && file_exists(UPLOAD_DIR.'banner/'.$banner_info[0]->image)){
					unlink(UPLOAD_DIR.'banner/'.$banner_info[0]->image);
				}

				redirect('../banner', 'success', 'Banner deleted successfully.');
			} else {
				redirect('../banner', 'error', 'Sorry! There was problem while deleting the banner.');
			}
		} else {
			redirect('../banner', 'error', 'Banner does not exists or has been already deleted.');
		}
	} else {
		redirect('../banner', 'error', 'Invalid Token.');
	}
}
else {
	redirect('../banner', 'error', 'Unauthorized access.');
}