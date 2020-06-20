<?php 

require $_SERVER['DOCUMENT_ROOT'].'config/init.php';

require '../inc/checklogin.php';
require CLASS_PATH.'product.php';
require CLASS_PATH.'product_image.php';

$product = new Product();
$images = new ProductImages();
// debugger($_FILES);
// debugger($_POST, true);

if(isset($_POST) && !empty($_POST)){
	$data = array(
		'title'	=> sanitize($_POST['title']),
		'cat_id'	=> (int)$_POST['cat_id'],
		'child_cat_id'	=> (isset($_POST['child_cat_id']) && !empty($_POST['child_cat_id'])) ? (int)$_POST['child_cat_id'] : '',
		'summary'	=> sanitize($_POST['summary']),
		'description'	=> htmlentities($_POST['description']),
		'price'	=> (float)$_POST['price'],
		'discount'	=> (float)$_POST['discount'],
		'brand'	=> sanitize($_POST['brand']),
		'vendor'	=> sanitize($_POST['vendor']),
		'delivery_cost'	=> (float)$_POST['delivery_cost'],
		'is_branded'	=> (isset($_POST['is_branded']) && $_POST['is_branded'] == 1) ? 1 : 0,
		'is_featured'	=> (isset($_POST['is_featured']) && $_POST['is_featured'] == 1) ? 1 : 0,
		'status'	=> sanitize($_POST['status']),
		'added_by'	=> $session->getSession('user_id'),
	);

	$product_id = $product->addProduct($data);
	if($product_id){
		// debugger($_FILES, true);

		if(isset($_FILES['images']) && !empty($_FILES['images'])){
			$files = $_FILES['images'];
			$count = count($files['name']);

			for($i=0; $i<$count; $i++){
				if($files['error'][$i] == 0){
					$temp = array(
						'name'	=> $files['name'][$i],
						'type'	=> $files['type'][$i],
						'tmp_name'	=> $files['tmp_name'][$i],
						'error'	=> $files['error'][$i],
						'size'	=> $files['size'][$i]
					);

					$single_image = uploadSingleFile($temp, 'product');
					if($single_image){
						$product_image = array(
							'product_id' => $product_id,
							'image_name'	=> $single_image
						);

						$images->addImage($product_image);
					}
				}
			}
		}

		redirect('../product', 'success', 'Product added successfully.');
	} else {
		redirect('../product', 'error', 'Sorry! There was problem while adding product.');
	}
} else {
	redirect('../product', 'error', 'Unauthorized access.');
}