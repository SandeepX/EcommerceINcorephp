<?php
	require $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	require CLASS_PATH.'product.php';

	$product = new Product();
	$act = isset($_REQUEST['act']) ? sanitize($_REQUEST['act']) : null;

	if($act){
		if($act == substr(md5('add-to-cart'), 5, 15)){
			/*Create Cart*/
			$product_id = (int)$_POST['product_id'];
			$quantity = (int)$_POST['quantity'];

			$product_info = $product->getProductById($product_id);
			if($product_info){
				$current_item = array();
				$price = $product_info[0]->price;
				$discount = $product_info[0]->discount;
				$actual_price = ($price-(($price*$discount)/100));

				$current_item['id'] = $product_info[0]->id;
				$current_item['title'] = $product_info[0]->title;
				$current_item['discount'] = $discount;
				$current_item['original_price'] = $price;
				$current_item['actual_price'] = $actual_price;
				$current_item['image_name'] = $product_info[0]->image_name;
				$current_item['delivery_cost']	= $product_info[0]->delivery_cost;


				if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
					$cart = $_SESSION['cart'];
				} else {
					$cart = array();
				}


				if(!empty($cart)){
					$index = null;
					// debugger($cart);
					foreach($cart as $key => $items){
						if($items['id'] == $product_id){
							$index = $key;
							break;
						}
					}

					if($index !== null){
						$cart[$index]['total_quantity'] = $cart[$index]['total_quantity']+$quantity;
						$cart[$index]['total_amount'] = $cart[$index]['total_amount']+($quantity*$actual_price);

					} else {
						$current_item['total_quantity'] = $quantity;
						$current_item['total_amount']	= $actual_price*$quantity;
						$cart[] = $current_item;					
					}
				} else {
					$current_item['total_quantity'] = $quantity;
					$current_item['total_amount']	= $actual_price*$quantity;

					$cart[] = $current_item;					
				}

				$_SESSION['cart'] = $cart;

				echo json_encode(api_response(null, true, 200, 'Cart updated successfully.'));
				exit;	
			} else {
				echo json_encode(api_response(null, false, 404, 'Product does not exists.'));
				exit;	
			}
		} else if($act == substr(md5('delete-from-cart'), 5,15)){
			$cart_index = (int)$_POST['cart_index'];
			if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
				
				$cart = $_SESSION['cart'];
				
				unset($cart[$cart_index]);
				
				$_SESSION['cart'] = $cart;

				echo json_encode(api_response(null, true, 200, 'Cart updated successfully.'));
				exit;
			} else {
				echo json_encode(api_response(null, false, 404, 'Cart not set.'));
				exit;	
			}
		}
		else {
			echo json_encode(api_response(null, false, 404, 'Token mismatch.'));
			exit;	
		}
	} else {
		echo json_encode(api_response());
		exit;
	}