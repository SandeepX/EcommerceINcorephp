<?php 
	require $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	require CLASS_PATH.'session.php';
	require CLASS_PATH.'order.php';
	$session = new Session();
	$order = new Order();

	if(isset($_SESSION['customer_id']) && !empty($_SESSION['customer_id'])){
	
		debugger($_SESSION);
		$cart = $_SESSION['cart'];

		if(!empty($cart)){
			$cart_id = generateRandomString(15);
			$customer_id = $_SESSION['customer_id'];
			$order_counter = 0;

			$tr_body = '';
			$total_amount = 0;
			foreach($cart as $cart_items){
				$temp_cart = array(
					'order_id' => $cart_id,
					'customer_id'	=> $customer_id,
					'product_id'	=> $cart_items['id'],
					'quantity'	=> $cart_items['total_quantity'],
					'unit_price'	=> $cart_items['actual_price'],
					'delivery_charge'	=> 150,
					'total_amount'	=> $cart_items['total_amount'],
					'order_status'	=> 'New',
				);

				$order_id = $order->addOrder($temp_cart);
				if($order_id){
					$order_counter++;
					$tr_body .=' <tr>
									<td style="max-width: 100px;">
										<img style="max-width: 100px;" src="'.UPLOAD_URL.'product/'.$cart_items['image_name'].'" alt="">
									</td>
									<td class="details">'.$cart_items['title'].'</td>
									<td class="price text-center">
										<strong>NPR. '.number_format($cart_items['actual_price']).'</strong></td>
									<td class="qty text-center">'.$cart_items['total_quantity'].'</td>
									<td class="total text-center">
										<strong class="primary-color">NPR. '.number_format($cart_items['total_amount']).'</strong>
									</td>
								</tr>';
					$total_amount += $cart_items['total_amount'];
				}
			}

			if($order_counter > 0){
				unset($_SESSION['cart']);
				/*Bill creation for email*/
				$bill_message = "Dear ".$session->getSession('customer_name')."!<br>";
				$bill_message .= "Thank you for using dokan.com. Your order has been placed successfully. Here is your order detail: <br>";

				$bill_message	.= '
							<table style="">
							<thead>
								<tr>
									<th>Product</th>
									<th></th>
									<th class="text-center">Price</th>
									<th class="text-center">Quantity</th>
									<th class="text-center">Total</th>
								</tr>
							</thead>';
				$bill_message .= '<tbody>';
				
				$bill_message .= $tr_body;

				$bill_message .= '</tbody>
							<tfoot>
								<tr>
									<th class="empty" colspan="3"></th>
									<th>TOTAL</th>
									<th colspan="2" class="total">NPR. '.number_format($total_amount).'</th>
								</tr>
							</tfoot>
												</table>';
				
				$headers = "MIME-Verison: 1.0"."\r\n";
				$headers .= "Content-type: text/html; charset=utf-8"."\r\n";
				$headers .= "From: no-reply@dokan.com";

				mail($session->getSession('email'), 'New Order palced.', $bill_message, $headers);
				
				redirect('profile', 'success', 'Thank you for the purchase. Your order has been successfully placed.');


			}
		}
	} else {
		$session->setSession('return','checkout');
		redirect('register', 'warning', 'Please login or register to continue.');
	}