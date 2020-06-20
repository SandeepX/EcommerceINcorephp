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
                <h3>Product Add</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                 
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Product Add</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <form action="process/product" method="post" enctype="multipart/form-data" class="form form-horizontal">
                          <div class="form-group row">
                            <label for="" class="col-sm-3">Title:</label>
                            <div class="col-sm-9">
                              <input type="text" name="title" required id="title" placeholder="Product Title goes here." class="form-control">
                            </div>
                          </div>

                          <div class="form-group row">
                            <label for="" class="col-sm-3">Summary:</label>
                            <div class="col-sm-9">
                              <textarea name="summary" id="summary" rows="6" style="resize: none" required class="form-control"></textarea>
                            </div>
                          </div>

                          <div class="form-group row">
                            <label for="" class="col-sm-3">Description:</label>
                            <div class="col-sm-9">
                              <textarea name="description" id="description" rows="6" style="resize: none" class="form-control"></textarea>
                            </div>
                          </div>


                          <div class="form-group row">
                            <label for="" class="col-sm-3">Price(NPR.):</label>
                            <div class="col-sm-9">
                              <input type="number" min="1" required class="form-control" id="price" name="price">
                            </div>
                          </div>                          

                          <div class="form-group row">
                            <label for="" class="col-sm-3">Discount(%):</label>
                            <div class="col-sm-9">
                              <input type="number" min="0" max="99" class="form-control" id="discount" name="discount">
                            </div>
                          </div>

                          <div class="form-group row">
                            <label for="" class="col-sm-3">Category:</label>
                            <div class="col-sm-9">
                              <select name="cat_id" required id="cat_id" class="form-control">
                                <option value="" selected disabled>--Select Any One--</option>
                                        <?php 
                                            $all_parents = $category->getAllParents();
                                            if($all_parents){
                                                foreach($all_parents as $prent_cat){
                                            ?>
                                                <option value="<?php echo $prent_cat->id; ?>"><?php echo $prent_cat->title; ?></option>
                                            <?php
                                                }
                                            }
                                        ?>
                              </select>
                            </div>
                          </div>   
                          <div class="form-group row hidden" id="child_cat_div">
                              <label for="" class="col-sm-3">Sub-Category:</label>
                              <div class="col-sm-9">
                                  <select name="child_cat_id" id="child_cat_id" class="form-control">
                                      <option value="" selected disabled>--Select Any One--</option>
                                      
                                  </select>
                              </div>
                          </div>


                          <div class="form-group row">
                              <label for="" class="col-sm-3">Brand:</label>
                              <div class="col-sm-9">
                                <input type="text" name="brand" class="form-control" id="brand">
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="" class="col-sm-3">Vendor:</label>
                              <div class="col-sm-9">
                                <input type="text" name="vendor" class="form-control" id="vendor">
                              </div>
                          </div>


                          <div class="form-group row">
                              <label for="" class="col-sm-3">Delivery Cost(NPR.):</label>
                              <div class="col-sm-9">
                                <input type="number" name="delivery_cost" class="form-control" id="delivery_cost" min="0">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label for="" class="col-sm-3">Is Branded:</label>
                              <div class="col-sm-9">
                                <input type="checkbox" name="is_branded" value="1" > Yes
                              </div>
                          </div>
                                                  
                          <div class="form-group row">
                              <label for="" class="col-sm-3">Is Featured:</label>
                              <div class="col-sm-9">
                                <input type="checkbox" name="is_featured" value="1" > Yes
                              </div>
                          </div>

                          <div class="form-group row" >
                              <label for="" class="col-sm-3">Status:</label>
                              <div class="col-sm-9">
                                  <select name="status" id="status" class="form-control">
                                      <option value="Active">Active</option>
                                      <option value="Inactive">Inactive</option>
                                  </select>
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="" class="col-sm-3">Images:</label>
                              <div class="col-sm-9">
                                <input type="file" name="images[]" multiple accept="image/*" >
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="" class="col-sm-3"></label>
                              <div class="col-sm-9">
                                  <button class="btn btn-danger" type="reset">
                                    Cancel
                                  </button>
                                  <button class="btn btn-success" type="submit">
                                    Submit
                                  </button>
                              </div>
                          </div>
                      </form>
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
<?php require 'inc/footer.php';?>
<script type="text/javascript" src="<?php echo ADMIN_ASSETS_URL.'tinymce/tinymce.min.js'; ?>"></script>
<script>
        
    $('#cat_id').change(function(){
        var category_id = $('#cat_id').val();

        /*$.get('inc/api?cat_id='+category_id+'&act=<?php echo substr(md5('get-child-cat-'.$session->getSession('session_token')), 5, 20) ?>', function(response){
            if(typeof(response) != 'object'){
                response = $.parseJSON(response);
            }

            console.log(typeof(response));
        });*/
        
        /*$.post('inc/api', {cat_id: category_id, act: "<?php echo substr(md5('get-child-cat'.$session->getSession('session_token')), 5, 20) ?>"}, function(response){
            if(typeof(response) != 'object'){
                    response = $.parseJSON(response);
                }

                console.log(typeof(response));
        });*/
        
        $.ajax({
            url: 'inc/api',
            type: 'POST',
            data: {
                    cat_id: category_id, 
                    act: "<?php echo substr(md5('get-child-cat'.$session->getSession('session_token')), 5, 20) ?>"
                },
            success: function (response){
                if(typeof(response) != 'object'){
                    response = $.parseJSON(response);
                }

                var html_option = "<option value='' selected disabled>--Select Any one--</option>";

                if(response.meta.status == true){
                    /*Create option */

                    $.each(response.body, function(key, value){
                        html_option += "<option value='"+value.id+"'>"+value.title+"</option>";
                    });

                    $('#child_cat_id').html(html_option);
                    
                    $('#child_cat_div').removeClass('hidden');
                } else {
                    $('#child_cat_id').html(html_option);
                    $('#child_cat_div').addClass('hidden');
                }
            }
        });
    });

    tinymce.init({
      selector: '#description',
      plugins: 'lists table '
    });
</script>