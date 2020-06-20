<?php
require_once $_SERVER['DOCUMENT_ROOT'].'config/init.php';
require CLASS_PATH.'product.php';

$product = new Product();

	$search_param = array();
	if(isset($_GET['keyword']) && !empty($_GET['keyword'])){
		$search_param['keyword'] = sanitize($_GET['keyword']);
	}

	if(isset($_GET['cat']) && !empty($_GET['cat'])){
		$search_param['cat_id'] = (int)$_GET['cat'];
	}

	if(isset($_GET['brand']) && !empty($_GET['brand'])){
		$search_param['brand'] = sanitize($_GET['brand']);
	}

	if(isset($_GET['price']) && !empty($_GET['price'])){
		list($min_price, $max_price) = explode("-",$_GET['price']);
		//echo $max_price;

		if($min_price > 0){
			$search_param['min_price'] =  $max_price;
			$search_param['max_price'] =  0;
		} else {
			$search_param['min_price'] =  0;
			$search_param['max_price']	= $max_price;
		}
	}

	if(isset($_GET['order_by']) && !empty($_GET['order_by'])){
		$search_param['order_by'] = "products.".$_GET['order_by'];
	}

	$serach_products = $product->getSearchResult($search_param);
	require 'inc/header.php'; ?>

	<!-- BREADCRUMB -->
	<div id="breadcrumb">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="./">Home</a></li>
				<li class="active">Products</li>
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
				<!-- ASIDE -->
				<div id="aside" class="col-md-3">
					
					<form method="get" action="search">
						<div class="aside">
							<input type="text" name="keyword" class="form-control" placeholder="Enter Keyword" value="<?php echo @$_GET['keyword']; ?>">
						</div>

						<!-- aside widget -->
						<div class="aside">
							<h3 class="aside-title">Filter by Price</h3>
							<input type="radio" value="0-1000" name="price" <?php echo (isset($_GET['price']) && $_GET['price'] == '0-1000') ? 'checked' : '' ?>> NPR. < 1,000 <br>
							<input type="radio" <?php echo (isset($_GET['price']) && $_GET['price'] == '0-10000') ? 'checked' : '' ?> value="0-10000" name="price"> NPR. < 10,000 <br>
							<input type="radio" <?php echo (isset($_GET['price']) && $_GET['price'] == '0-100000') ? 'checked' : '' ?> value="0-100000" name="price"> NPR. < 100,000 <br>
							<input type="radio" <?php echo (isset($_GET['price']) && $_GET['price'] == '100000-0') ? 'checked' : '' ?> value="100000-0" name="price"> NPR. > 1,00,000  <br>
						</div>
						<!-- aside widget -->


						<!-- aside widget -->
						<div class="aside">
							<h3 class="aside-title">Filter by Brand</h3>
							<ul class="list-links">
								<?php 
									$all_brands = $product->getAllBrands();
									if($all_brands){
										foreach($all_brands as $brand_data){
									?>
										<li>
											<input type="radio" name="brand" value="<?php echo $brand_data->brand; ?>" <?php echo (isset($_GET['brand'] ) && $_GET['brand'] == $brand_data->brand) ? 'checked' : '' ?>>
											<?php echo $brand_data->brand; ?>
										</li>
									<?php
										}
									}
								?>
							</ul>
						</div>
						<!-- /aside widget -->

						<!-- aside widget -->
						<div class="aside">
							<h3 class="aside-title">Filter by Category</h3>
							<ul class="list-links">
								<?php 
									if($all_categories){
										foreach($all_categories as $parent){
									?>
										<li value="<?php echo $parent->id; ?>">
											<input type="radio" name="cat" value="<?php echo $parent->id; ?>" <?php echo (isset($_GET['cat'] ) && $_GET['cat'] == $parent->id) ? 'checked' : '' ?>>
												<?php echo $parent->title; ?>
										</li>
									<?php
										}
									}
								?>
							</ul>
						</div>

						<div class="aside">
							<select class="form-control" name="order_by">
								<option value="price DESC">High to Low Price</option>
								<option value="price ASC">Low to High Price</option>
							</select>
						</div>
						<!-- /aside widget -->
						<div class="aside">
							<button type="submit" class="primary-btn">
								Filter
							</button>
							<button type="reset" id="reset" class="primary-btn">
								Clear Filter
							</button>
						</div>
					</form>
					<!-- aside widget -->
					<div class="aside">
						<h3 class="aside-title">Top Rated Product</h3>
						<!-- widget product -->
						<div class="product product-widget">
							<div class="product-thumb">
								<img src="<?php echo FRONT_IMAGES_URL;?>thumb-product01.jpg" alt="">
							</div>
							<div class="product-body">
								<h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
								<h3 class="product-price">$32.50 <del class="product-old-price">$45.00</del></h3>
								<div class="product-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o empty"></i>
								</div>
							</div>
						</div>
						<!-- /widget product -->

						<!-- widget product -->
						<div class="product product-widget">
							<div class="product-thumb">
								<img src="<?php echo FRONT_IMAGES_URL;?>thumb-product01.jpg" alt="">
							</div>
							<div class="product-body">
								<h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
								<h3 class="product-price">$32.50</h3>
								<div class="product-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o empty"></i>
								</div>
							</div>
						</div>
						<!-- /widget product -->
					</div>
					<!-- /aside widget -->
				</div>
				<!-- /ASIDE -->

				<!-- MAIN -->
				<div id="main" class="col-md-9">
					<!-- STORE -->
					<div id="store">
						<!-- row -->
						<div class="row">
							<?php 
								if($serach_products){
									foreach($serach_products as $key=> $product_items){
										$today = strtotime(date('Y-m-d h:i:s A'));
										$added_date = strtotime($product_items->added_date);

										$latest = false;
										if(($today-$added_date) <= (15*86400)){
											$latest = true;
										}
										$discount = $product_items->discount;
										
										$rate = 0;
										if($product_items->total_reviewer > 0){
											$rate = ceil($product_items->total_rate/$product_items->total_reviewer);
										}

										if($rate > 5){
											$rate = 5;
										}

									?>
										<!-- Product Single -->
										<div class="col-md-4 col-sm-6 col-xs-6">
											<div class="product product-single">
												<div class="product-thumb">
													<div class="product-label">
														<?php if($latest){ ?>
															<span>New</span>
														<?php  } 
														if($discount > 0){
														?>
															<span class="sale">-<?php echo $discount; ?>%</span>
														<?php } ?>
													</div>
													<?php 
														//debugger($product_items);
		 												if(!empty($product_items->image_name) && file_exists(UPLOAD_DIR.'product/'.$product_items->image_name)){
															$thumb = UPLOAD_URL.'product/'.$product_items->image_name;
														} else {
															$thumb = FRONT_IMAGES_URL.'no-image.jpg';
														}
													?>
													<img src="<?php echo $thumb;?>" alt="<?php echo $product_items->title; ?>" title="<?php echo $product_items->title; ?>">
												</div>
												<div class="product-body">
													<?php 
														$price = $product_items->price;

														if($discount > 0){
															$org_price = $price;
															$price = $price-(($price*$discount)/100);
														}
													?>
													<h3 class="product-price">NPR. <?php echo number_format($price); ?> 
														<?php if($discount>0){ ?>
														<del class="product-old-price">NPR. <?php echo number_format($org_price); ?></del>
													<?php } ?>
													</h3>

													<div class="product-rating">
														<?php 
															for($i = 1; $i<=5; $i++){
																if($i<= $rate){
																	$class = "fa-star";
																} else {
																	$class = "fa-star-o empty";
																}
															?>
																<i class="fa <?php echo $class; ?>"></i>
															<?php
															}
														?>
													</div>
													
													<h2 class="product-name">
														<a href="<?php echo SITE_URL.'product-page?id='.$product_items->id; ?>">
															<?php echo $product_items->title; ?>
														</a>
													</h2>
													<div class="product-btns">

														<button class="primary-btn add-to-cart" onclick="addtocart(<?php echo $product_items->id; ?>, 1)">
															<i class="fa fa-shopping-cart"></i> Add to Cart
														</button>
													</div>
												</div>
											</div>
										</div>
										<!-- /Product Single -->
									<?php
									if(($key+1)%3 == 0){
										echo '<div class="clearfix"></div>';
									}
									} 
								}	else {
									echo "<p class='alert-danger'> No product found in the search option.</p>";
								}
							?>
						</div>
						<!-- /row -->
					</div>
					<!-- /STORE -->
				</div>
				<!-- /MAIN -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->
<?php require 'inc/footer.php' ?>
<script type="text/javascript">
	$('#reset').click(function(){
		document.location.href = "<?php echo SITE_URL.'search'; ?>";
	})
</script>