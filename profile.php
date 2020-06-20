<?php
require_once $_SERVER['DOCUMENT_ROOT'].'config/init.php';
require CLASS_PATH.'banner.php'; 
$banner = new Banner(); 
 require 'inc/header.php'; ?>

	<!-- BREADCRUMB -->
	<div id="breadcrumb">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="./">Home</a></li>
				<li class="active">Blank</li>
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
				<?php flash(); ?>
			</div>
			<!-- /row -->
			 <H1 > ........................................WELCOME TO.... DOKAN !!!............</H1>
		</div>
		<!-- /container -->
		<div id="home">
		<!-- container -->
		<div class="container">
			<!-- home wrap -->
			<div class="home-wrap">
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


	</div>
	<!-- /section -->

	<?php require 'inc/footer.php'; ?>