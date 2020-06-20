<!-- FOOTER -->
	<footer id="footer" class="section section-grey">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- footer widget -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="footer">
						<!-- footer logo -->
						<div class="footer-logo">
							<a class="logo" href="#">
		            <img src="<?php echo FRONT_IMAGES_URL;?>logo.png" alt="">
		          </a>
						</div>
						<!-- /footer logo -->

						<p>In the past few years, the concept of online shopping is getting common. It is evident that customers are building their trust in online shopping and most of the purchases are now made through online stores. Major shopping events like Black Friday have reported heavy traffic towards online shopping stores including the very famous online shopping store in Nepal “Dokan”. Dokan is the ultimate online shopping solution for all the customers. It offers a wide and assorted range of products including clothing, footwear, accessories, electronics, mobile phones, home and living and much more. </p>

						<!-- footer social -->
						<ul class="footer-social">
							<li><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#"><i class="fa fa-instagram"></i></a></li>
							<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							<li><a href="#"><i class="fa fa-pinterest"></i></a></li>
						</ul>
						<!-- /footer social -->
					</div>
				</div>
				<!-- /footer widget -->

				<!-- footer widget -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="footer">
						<h3 class="footer-header">My Account</h3>
						<ul class="list-links">
							<li><a href="register">Checkout</a></li>
							<li><a href="register">Login</a></li>
						</ul>
					</div>
				</div>
				<!-- /footer widget -->

				<div class="clearfix visible-sm visible-xs"></div>

				<!-- footer widget -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="footer">
						<h3 class="footer-header">Customer Service</h3>
						<ul class="list-links">
							<li><a href="#">About Us</a></li>
							<p>  Dokan strives to provide the best online shopping experience without any hassle to its deal customers. The online store is       updated daily as per the trend and new products are everyday to cater all your product needs.

                                For any query related to product or service, call us at UAN 9801292929. Dokan highly values customer feedback and our customer service is available 24/7 to cater your complaints and queries. Dokan Nepal provides best shipping all over Nepal including Dodhara, Dhangadi, mahendranagar with 7 days return policy. So what are you waiting for? Visit Dokan.com.np and experience the best online shopping store in Nepal.

										Dokan Nepal is also available on App Store for your convenience and ease. Now online shopping is just a click away! Don't forget to Download Dokan App for Android and IOS to avail the exclusive discounts.

							</p>
						</ul>
					</div>
				</div>
				<!-- /footer widget -->

				<!-- footer subscribe -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="footer">
						<h3 class="footer-header">Stay Connected</h3>
						<p>In the past few years, the concept of online shopping is getting common. It is evident that customers are building their trust in online shopping and most of the purchases are now made through online stores. Major shopping events like Black Friday have reported heavy traffic towards online shopping stores including the very famous online shopping store in Nepal “Dokan”. Dokan is the ultimate online shopping solution for all the customers. It offers a wide and assorted range of products including clothing, footwear, accessories, electronics, mobile phones, home and living and much more. 
.</p>
						<form>
							<div class="form-group">
								<input class="input" placeholder="Enter Email Address">
							</div>
							<button class="primary-btn">Join Newslatter</button>
						</form>
					</div>
				</div>
				<!-- /footer subscribe -->
			</div>
			<!-- /row -->
			<hr>
			<!-- row -->
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center">
					<!-- footer copyright -->
					<div class="footer-copyright">
						
						Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | THIS website was developed by <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Phenomenal sundeep</a>
						
					</div>
					<!-- /footer copyright -->
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</footer>
	<!-- /FOOTER -->

	<!-- jQuery Plugins -->
	<script src="<?php echo FRONT_JS_URL;?>jquery.min.js"></script>
	<script src="<?php echo FRONT_JS_URL;?>bootstrap.min.js"></script>
	<script src="<?php echo FRONT_JS_URL;?>slick.min.js"></script>
	<script src="<?php echo FRONT_JS_URL;?>nouislider.min.js"></script>
	<script src="<?php echo FRONT_JS_URL;?>jquery.zoom.min.js"></script>
	<script src="<?php echo FRONT_JS_URL;?>main.js"></script>


	<script type="text/javascript">
		function addtocart(prod_id, quantity){
			if(prod_id){
				$.ajax({
					url: 'inc/cart',
					type: 'POST',
					data: {
						product_id: prod_id,
						quantity: quantity,
						act: "<?php echo substr(md5('add-to-cart'), 5,15); ?>"
					},
					success: function(response){
						if(typeof(response) != 'object'){
							response = $.parseJSON(response);
						}

						if(response.meta.message != ""){
							alert(response.meta.message);
						}

						document.location.href = document.location.href;
					}
				});
			}
		}

		function deletefromcart(cart_index){

			$.ajax({
				url: 'inc/cart',
				type: 'POST',
				data: {
					cart_index: cart_index,
					act: "<?php echo substr(md5('delete-from-cart'), 5,15); ?>"
				},
				success: function(response){
					if(typeof(response) != 'object'){
						response = $.parseJSON(response);
					}

					if(response.meta.message != ""){
						alert(response.meta.message);
					}

					document.location.href = document.location.href;
				}
			});
		}
	</script>
</body>

</html>
