<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'config/init.php'; ?>
<?php 
require 'inc/header.php'; 
require CLASS_PATH.'banner.php'; 
$banner = new Banner(); 
  require CLASS_PATH.'product.php';

  $product = new Product();

//require CLASS_PATH.'product_image.php';
//echo "<pre>"; print_r($banner); die;
?>
	<!-- HOME -->
	<div id="home">
		<!-- container -->
		<div class="container">
			<!-- home wrap -->
			<div class="home">
				<!-- home slick -->
				<div id="home-slick">
					<?php 
                      			$all_banners = $banner->getAllBanner();
                      			if($all_banners){
                      				foreach($all_banners as $key=>$banner_data){
                      			?>
					<!-- banner -->
					
					<div class="banner banner-1">
						<img src="<?php echo UPLOAD_URL.'banner/'.$banner_data->image; ?>" alt="">
						<div class="banner-caption text-center">
							<h1><?= $banner_data->title ?></h1>
							<h3 class="white-color font-weak">Up to 50% Discount</h3>
							<button class="primary-btn">Shop Now</button>
						</div>
					</div>
				<?php }} ?>
				</div>
				<!-- /home slick -->
			</div>
			<!-- /home wrap -->
		</div>
		<!-- /container -->
	</div>
	<!-- /HOME -->

<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			

			<!-- row -->
			<div class="row">
				<!-- section title -->
				<div class="col-md-12">
					<div class="section-title">
						<h2 class="title">FEATURED PRODUCT</h2>
					</div>
				</div>


				<!-- section title -->
					<?php 
          			$all_product = $product->getAllfeatured();
          			//debugger($all_product, $is_die = false);
          			  if($all_product){
          				    foreach($all_product as $key=>$product_info){
          					$today = strtotime(date('Y-m-d h:i:s A'));
							$added_date = strtotime($product_info->added_date);

							$latest = false;
							if(($today-$added_date) <= (15*86400)){
							$latest = true;
										}
							$discount = $product_info->discount;
										
							$rate = 0;
							if($product_info->total_reviewer > 0){
								$rate = ceil($product_info->total_rate/$product_info->total_reviewer);
									}

									if($rate > 5){
										$rate = 5;
									}							
      				?>

				<!-- Product Single -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="product product-single">
						<div class="product-thumb">
							<div class="product-label">
								<?php 
									if($latest){ ?>
									   <span>New</span>
									<?php  } 
										if($discount > 0){
									?>
										 <span class="sale">-<?php echo $discount; ?>%</span>
									<?php } ?>
							</div>	
							
							<img src="<?php echo UPLOAD_URL.'Product/'.$product_info->image_name;?>" alt="">
						</div>
						<div class="product-body">
													<?php 
														$price = $product_info->price;

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
							<h2 class="product-name"><a href="#"><?= $product_info->title ?></a></h2>
							<div class="product-btns">
								
								
								<button class="primary-btn add-to-cart" onclick="addtocart(<?php echo $product_info->id; ?>, 1)">
															<i class="fa fa-shopping-cart"></i> Add to Cart
							</div>
						</div>
					</div>
				</div>
			<?php }}?>	
				<!-- /Product Single -->
			</div>
			<!-- /row -->	
				
				

				
			

			<div class="row">
				<!-- section title -->
				<div class="col-md-12">
					<div class="section-title">
						<h2 class="title">Picked For You</h2>
					</div>
				</div>


				<!-- section title -->
					<?php 
          			$all_product = $product->getAllbranded();
          			//debugger($all_product, $is_die = false);
          			  if($all_product){
          				    foreach($all_product as $key=>$product_info){
          					$today = strtotime(date('Y-m-d h:i:s A'));
							$added_date = strtotime($product_info->added_date);

							$latest = false;
							if(($today-$added_date) <= (15*86400)){
							$latest = true;
										}
							$discount = $product_info->discount;
										
							$rate = 0;
							if($product_info->total_reviewer > 0){
								$rate = ceil($product_info->total_rate/$product_info->total_reviewer);
									}

									if($rate > 5){
										$rate = 5;
									}							
      				?>

				<!-- Product Single -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="product product-single">
						<div class="product-thumb">
							<div class="product-label">
								<?php 
									if($latest){ ?>
									   <span>New</span>
									<?php  } 
										if($discount > 0){
									?>
										 <span class="sale">-<?php echo $discount; ?>%</span>
									<?php } ?>
							</div>	
							
							<img src="<?php echo UPLOAD_URL.'Product/'.$product_info->image_name;?>" alt="">
						</div>
						<div class="product-body">
													<?php 
														$price = $product_info->price;

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
							<h2 class="product-name"><a href="#"><?= $product_info->title ?></a></h2>
							<div class="product-btns">
								
								
								<button class="primary-btn add-to-cart" onclick="addtocart(<?php echo $product_info->id; ?>, 1)">
															<i class="fa fa-shopping-cart"></i> Add to Cart
							</div>
						</div>
					</div>
				</div>
			<?php }}?>	
				<!-- /Product Single -->
			</div>
			<!-- /row -->

				<!-- row -->
			<div class="row">
				<!-- section title -->
				<div class="col-md-12">
					<div class="section-title">
						<h2 class="title">HOT DEAL</h2>
					</div>
				</div>
				<!-- section title -->

				<!-- Product Single -->

				<?php 
          			$all_product = $product->getAllProduct();
          			if($all_product){
          				foreach($all_product as $key=>$product_info){
      			?>

				<div class="col-md-3 col-sm-6 col-xs-6">
					
					<div class="product product-single">
						<div class="product-thumb">
							
							<img src="<?php echo UPLOAD_URL.'Product/'.$product_info->image_name;?>" alt="">
						</div>
						<div class="product-body">
							<h3 class="product-price">Rs.<?= $product_info->price ?></h3>
							
							<h2 class="product-name"><?= $product_info->title ?></a></h2>
							<div class="product-btns">
								
								
								<button class="primary-btn add-to-cart" onclick="addtocart(<?php echo $product_info->id; ?>, 1)">
															<i class="fa fa-shopping-cart"></i> Add to Cart
							</div>
						</div> 
					</div>
				</div>
				<?php }}?>
				<!-- /Product Single -->

		


		</div>
		<!-- /container -->
						<div class="aside">
							
							<a href="search" button class="primary-btn " ;>
									 View All </a>
						</div>
	</div>
	<!-- /section -->


	
<?php require 'inc/footer.php' ?>