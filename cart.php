<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'config/init.php';
// $meta_keywords = "Home page";

require 'inc/header.php'; ?>
	<!-- BREADCRUMB -->
	<div id="breadcrumb">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="./">Home</a></li>
				<li class="active">Cart</li>
			</ul>
		</div>
	</div>
	<!-- /BREADCRUMB -->

	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<div class="col-md-12">
					<div class="order-summary clearfix">
						<div class="section-title">
							<h3 class="title">Order Review</h3>
						</div>
						<table class="shopping-cart-table table">
							<thead>
								<tr>
									<th>Product</th>
									<th></th>
									<th class="text-center">Price</th>
									<th class="text-center">Quantity</th>
									<th class="text-center">Total</th>
									<th class="text-right"></th>
								</tr>
							</thead>
						<?php 
							if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
						
						?>
							<tbody>
								<?php 
									$total_amount = 0;

									foreach($_SESSION['cart'] as $key=>$cart_items){
										$thumb = FRONT_IMAGES_URL.'no-image.jpg';
										if(!empty($cart_items['image_name']) && file_exists(UPLOAD_DIR.'product/'.$cart_items['image_name'])){
											$thumb = UPLOAD_URL.'product/'.$cart_items['image_name'];
										}
										// debugger($cart_items);
								?>
								<tr>
									<td class="thumb">
										<img src="<?php echo $thumb; ?>" alt="">
									</td>
									<td class="details">
										<a href="product?id=<?php echo $cart_items['id'] ?>"><?php echo $cart_items['title']; ?></a>
									</td>
									<td class="price text-center">
										<strong>NPR. <?php echo number_format($cart_items['actual_price']); ?></strong>
										<?php 
										if($cart_items['discount'] > 0){
										?>
										<br>
										<del class="font-weak">
											<small>NPR. <?php echo number_format($cart_items['original_price']); ?></small>
										</del>
									<?php } ?>
									</td>
									
									<td class="qty text-center"><?php echo $cart_items['total_quantity'] ?></td>
									<td class="total text-center">
										<strong class="primary-color">NPR. <?php echo number_format($cart_items['total_amount']) ?></strong>
									</td>
									<td class="text-right">
										<button class="main-btn icon-btn" onclick="addtocart(<?php echo $cart_items['id']; ?>, 1)">
											<i class="fa fa-plus"></i>
										</button>
										
										<button class="main-btn icon-btn"  onclick="deletefromcart(<?php echo $key; ?>)">
											<i class="fa fa-close"></i>
										</button>
									</td>
								</tr>
								<?php 
								$total_amount += $cart_items['total_amount'];
							} ?>
							</tbody>
							<tfoot>
								<!-- <tr>
									<th class="empty" colspan="3"></th>
									<th>Delivery Cost: </th>
									<th colspan="2" class="total">NPR. 100
									</th>
								</tr> -->
								<tr>
									<th class="empty" colspan="3"></th>
									<th>TOTAL</th>
									<th colspan="2" class="total">NPR. <?php echo number_format($total_amount); ?></th>
								</tr>
							</tfoot>
						<?php } else {
							echo "	<tbody>
										<tr>
											<td colspan='6'>No items in the cart.</td>
										</tr>
									</tbody>";
						} ?>
						</table>
						<div class="pull-left">
							<em>* Delivery charge may vary from place to deliver. See <a href="delivery-charge">Deliver Rate </a> Page for the rate. </em>
						</div>
						<div class="pull-right">
							
							<?php /* ?>
							<form action="https://sandbox.paypal.com/cgi-bin/webscr" method="post">
								  <!-- Saved buttons use the "secure click" command -->
								  <input type="hidden" name="cmd" value="_s-xclick">
								  <input type="hidden" name="business" name="sandesh.bhattarai79@gmail.com">
								  <!-- Saved buttons are identified by their button IDs -->
								  <input type="hidden" name="hosted_button_id" value="221">
								  <!-- Saved buttons display an appropriate button image. -->
								  <input type="image" name="submit"
								    src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
								    alt="PayPal - The safer, easier way to pay online">
								  <img alt="" width="1" height="1"
								    src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >
							</form>
							<?php */ ?>
							<!-- FORM FOR ESEWA -->
								<!-- <form method="get" action="https://esewa.com.np/">
									<input type="hidden" name="merchant_id" value="">
									<input type="hidden" name="product_name" value="Total Online Purchase">
									<input type="hidden" name="total_amount" value="<?php echo $total_amount; ?>">
									<input type="hidden" name="return" value="<?php echo SITE_URL.'success'; ?>">
									<input type="hidden" name="cancel" value="">
									<button type="submit" name="">
										Esewa
									</button>
								</form> -->
							<!-- FORM FOR ESEWA -->
							<a href="checkout" class="primary-btn">
								Place Order
							</a>
						</div>
					</div>

				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->
<?php require 'inc/footer.php'; ?>