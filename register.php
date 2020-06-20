<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'config/init.php';
// $meta_keywords = "Home page";

require 'inc/header.php'; ?>
	<!-- BREADCRUMB -->
	<div id="breadcrumb">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="./">Home</a></li>
				<li class="active">Register/Login</li>
			</ul>
		</div>
	</div>
	<!-- /BREADCRUMB -->

	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<?php flash(); ?>
			<div class="row">
				<div class="col-md-6" style="border-right: 1px solid #000;">
					<!--<form id="register-form" class="clearfix" method="post" action="register-process">
						<div class="billing-details">
							<p>Already a customer ? <a href="#">Login</a></p>
							<div class="section-title">
								<h3 class="title">Billing Details</h3>
							</div>
							<div class="form-group">
								<input class="input" type="text" name="full_name" placeholder="Full Name" required>
							</div>
							<div class="form-group">
								<input class="input" type="email" name="email" placeholder="Email" required>
							</div>

							<div class="form-group">
								<textarea class="input form-control" style="resize:  none;" rows="5" name="billing_address" placeholder="Billing Address"></textarea>
							</div>
							<div class="form-group">
								<input class="input" type="tel" name="tel" placeholder="Telephone" requried>
							</div>
							<div class="form-group">				
								<input class="input" type="password" name="password" placeholder="Enter Your Password">
							</div>
							<div class="form-group">
								<button href="index.php" class="primary-btn" type="submit">Register</button>
							</div>
						</div>
					</form> -->
				</div>
				<div class="col-md-6">
					<form id="login-form" class="clearfix" action="login" method="post">
						<div class="section-title">
							<h3 class="title">Login</h3>
						</div>
						<div class="form-group">
							<input class="input" type="email" name="username" placeholder="User Name">
						</div>
						<div class="form-group">				
							<input class="input" type="password" name="password" placeholder="Enter Your Password">
						</div>
						<div class="form-group">
							<button href="profile.php" class="primary-btn">Login</button>
						</div>
					</form>
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

<?php require 'inc/footer.php' ?>