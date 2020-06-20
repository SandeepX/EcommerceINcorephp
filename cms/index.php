<?php require $_SERVER['DOCUMENT_ROOT'].'config/init.php'; ?>
<?php 
  $page_title = 'Login';
require 'inc/header.php'; ?>

    <div>
      
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <?php flash(); ?>
            <form action="process/login" method="post">
              <h1>Login Form</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" name="username" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" name="password" />
              </div>
              <div>
                <button class="btn btn-success submit">Log in</button>
                
              </div>

              <div class="clearfix"></div>

              
            </form>
          </section>
        </div>

      </div>
    </div>
<?php require 'inc/footer.php'; ?>