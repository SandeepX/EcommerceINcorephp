	
	<?php 
	if(getCurrentPage() != 'index'){
	?>	
	    <!-- jQuery -->
	    <script src="<?php echo ADMIN_JS_URL; ?>jquery.min.js"></script>
	    <!-- Bootstrap -->
	    <script src="<?php echo ADMIN_JS_URL; ?>bootstrap.min.js"></script>

	    <!-- NProgress -->
	    <script src="<?php echo ADMIN_JS_URL; ?>nprogress.js"></script>
	    
	    <!-- Custom Theme Scripts -->
	    <script src="<?php echo ADMIN_JS_URL; ?>custom.min.js"></script>
	    <script src="<?php echo ADMIN_JS_URL; ?>jquery.dataTables.min.js"></script>
		
		<script>
			$('.table').DataTable();
		</script>
	<?php } ?>

  </body>
</html>
