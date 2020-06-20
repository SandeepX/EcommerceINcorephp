<?php require $_SERVER['DOCUMENT_ROOT'].'config/init.php'; ?>
<?php 
  require 'inc/checklogin.php';
  $page_title = "Dashboard";
  require CLASS_PATH.'category.php';
  $category = new Category();


require 'inc/header.php'; ?>

    <div class="container body">
      <div class="main_container">
        <?php require 'inc/menu.php' ?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <?php flash(); ?>
            
            <div class="page-title">
              <div class="title_left">
                <h3>Category Page</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                	<a href="javascript:;" id="add-category" class="btn btn-success pull-right">
                		<i class="fa fa-plus"></i> Add Category
                	</a>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Category Page</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  		<table class="table table-bordered jambo_table">
                  			<thead>
                  				<th>S.N</th>
                  				<th>Title</th>
                  				<th>Summary</th>
                  				<th>Is parent</th>
                  				<th>In menu</th>
                  				<th>Thumbnail</th>
                  				<th>Status</th>
                  				<th>Action</th>
                  			</thead>
                  			<tbody>
                  				<?php 
                  					$all_categories = $category->getAllCategories();
                  					if($all_categories){
                  						foreach($all_categories as $key => $cat_info){
                  					?>
                  							<tr>
                  								<td><?php echo ($key+1); ?></td>
                  								<td><?php echo $cat_info->title; ?></td>
                  								<td><?php echo $cat_info->summary; ?></td>
                  								<td><?php echo ($cat_info->is_parent == 1) ? 'Yes' : 'No' ; ?></td>
                  								<td><?php echo ($cat_info->show_in_menu == 1) ? 'Yes' : 'No'; ?></td>
                  								<td>
                  									<?php 
                  										if(!empty($cat_info->image) && file_exists(UPLOAD_DIR.'category/'.$cat_info->image)){
                  									?>
                  											<img style="max-width: 150px;" src="<?php echo UPLOAD_URL.'category/'.$cat_info->image;?>" alt="" class="img img-responsive img-thumbnail">
                  									<?php
                  										} 
                  									?>
                  								</td>
                  								<td><?php echo $cat_info->STATUS; ?></td>
                  								<td>
                                                    <a href="javascript:;" data-edit='<?php echo json_encode($cat_info, JSON_HEX_APOS); ?>' onclick="editCategory(this)" class="btn-link">
                                                        Edit
                                                    </a> 
                                  					/
                                                    <?php 
                                                      $token = substr(md5("del-cat-".$cat_info->id."-".$session->getSession('session_token')), 5, 15);
                                                    ?>
                                                    <a href="process/category?id=<?php echo $cat_info->id; ?>&amp;act=<?php echo $token; ?>" class="btn-link" onclick="return confirm('Are you sure you want to delete this category?');">
                                                        Delete         
                                                    </a>
                  								</td>
                  							</tr>
                  					<?php
                  						}
                  					}
                  				?>
                  			</tbody>
                  		</table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

       <?php include 'inc/copy.php'; ?>
      </div>
    </div>

<div class="modal" tabindex="-1" role="dialog" id="add-category-modal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title">Category Add</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    
	    <form action="process/category" method="post" enctype="multipart/form-data" class="form form-horizontal">
			<div class="modal-body">
				<div class="form-group row">
					<label for="" class="col-sm-3">Title:</label>
					<div class="col-sm-9">
						<input type="text" name="title" required placeholder="Enter Category Title" class="form-control" id="title">
					</div>
				</div>

				<div class="form-group row">
					<label for="" class="col-sm-3">Summary:</label>
					<div class="col-sm-9">
						<textarea name="summary" id="summary"  rows="5" class="form-control" style="resize: none;"></textarea>
					</div>
				</div>

				<div class="form-group row">
					<label for="" class="col-sm-3">Is parent:</label>
					<div class="col-sm-9">
						<input type="checkbox" name="is_parent" id="is_parent" value="1" checked> Yes
					</div>
				</div>

				<div class="form-group row hidden" id="parent_cat_div">
					<label for="" class="col-sm-3">Parent Category:</label>
					<div class="col-sm-9">
						<select name="parent_id" id="parent_id" class="form-control">
							<option value="" disabled selected>
								--Select Any one--
							</option>
							<?php 
								$all_parents = $category->getAllParents();
								if($all_parents){
									foreach($all_parents as $parent_cats){
								?>
								<option value="<?php echo $parent_cats->id; ?>">
									<?php echo $parent_cats->title; ?>
								</option>
								<?php
									}
								}
							?>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label for="" class="col-sm-3">Show in Menu:</label>
					<div class="col-sm-9">
						<input type="checkbox" name="show_in_menu" id="show_in_menu" value="1" checked> Yes
					</div>
				</div>

				<div class="form-group row">
					<label for="" class="col-sm-3">Status:</label>
					<div class="col-sm-9">
						<select name="status" required id="status" class="form-control">
							<option value="Active">Active</option>
							<option value="Inactive">Inactive</option>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="" class="col-sm-3">Image:</label>
					<div class="col-sm-4">
						<input type="file" name="image" required id="image" accept="image/*">
					</div>
                      <div class="col-sm-4">
                        <img src="<?php echo ADMIN_IMAGES_URL.'no-image.jpg'; ?>" id="thumbnail" alt="" class="img img-responsive img-thumbnail">
                      </div>
				</div>


			</div>
			<div class="modal-footer">
                <input type="hidden" name="category_id" id="category_id" value="">
				<button type="submit" class="btn btn-success">
					<i class="fa fa-send"></i>
					Save changes
				</button>
				<button type="reset" class="btn btn-danger" data-dismiss="modal">
					<i class="fa fa-trash"></i>
					Close
				</button>
			</div>
		</form>

    </div>
  </div>
</div>

<?php require 'inc/footer.php';?>

<script>
	
	function showPopUP(){
		$('#add-category-modal').modal('show');
	}

	$('#add-category').click(function(){

        $('.modal-title').html('Category Add');
        $('#title').val('');
        $('#summary').val('');
        $('#status').val('Active');

        $('#is_parent').prop('checked', true);
        $('#parent_cat_div').addClass('hidden');
        $('#parent_id').val('');
        $('#show_in_menu').prop('checked', true);
        $('#thumbnail').attr('src', "<?php echo ADMIN_IMAGES_URL.'no-image.jpg'; ?>");
        $('#category_id').val('');
        $('#image').attr('required');
		showPopUP();
	});

	$('#is_parent').change(function(){
		var is_checked = $('#is_parent').prop('checked');	// true or flase

		if(is_checked == true){
			$('#parent_cat_div').addClass('hidden');
		} else {
			$('#parent_cat_div').removeClass('hidden');
		}
	});

    function editCategory(elem){
        var cat_data = $(elem).data('edit');
        if(cat_data){

            $('.modal-title').html('Category Update');
            $('#title').val(cat_data.title);
            $('#summary').val(cat_data.summary);
            $('#status').val(cat_data.status);

            if(cat_data.is_parent == 1){
                $('#is_parent').prop('checked', true);
                $('#parent_cat_div').addClass('hidden');
                $('#parent_id').val('');
            } else {
                $('#is_parent').prop('checked', false);
                $('#parent_cat_div').removeClass('hidden');
                $('#parent_id').val(cat_data.parent_id);
            }

            if(cat_data.show_in_menu == 1){
                $('#show_in_menu').prop('checked', true);
            } else {
                $('#show_in_menu').prop('checked', false);
            }

            if(cat_data.image != ""){
                $('#thumbnail').attr('src', "<?php echo UPLOAD_URL.'category/'; ?>"+cat_data.image);
            } else {
                $('#thumbnail').attr('src', "<?php echo ADMIN_IMAGES_URL.'no-image.jpg'; ?>");
            }
            $('#category_id').val(cat_data.id);
            $('#image').removeAttr('required');
            showPopUP();
        }
    }
</script>