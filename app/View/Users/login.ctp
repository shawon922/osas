<div class="login-logo">
  <a href="#"><b>OSAS</b> - Start from here</a>
</div><!-- /.login-logo -->
<div class="login-box-body">
  <p class="login-box-msg">Sign in to start your operation</p>
  <?php echo $this->Form->create('User', array('class' => 'form-horizontal', 'novalidate' => true)); ?>
     
      <?php 
          /*echo $this->Form->input('User.username', array(
                  'type' => 'text',
                  'class' => 'form-control',
                  'placeholder' => 'Username',
                  'required' => true,
                  'div' => array('class' => 'form-group has-feedback'),
                  'after' => '<span class="glyphicon glyphicon-envelope form-control-feedback"></span>'
              )
          );*/
        ?>

      <?php 
          /*echo $this->Form->input('User.password', array(
                  'type' => 'password',
                  'class' => 'form-control',
                  'placeholder' => 'Password',
                  'required' => true,
                  'div' => array('class' => 'form-group has-feedback'),
                  'after' => '<span class="glyphicon glyphicon-lock form-control-feedback"></span>'
              )
          );*/
        ?>

     <div class="form-group has-feedback">
          <label>Username</label>
          <input type="text" name="data[User][username]" class="form-control" placeholder="Username">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <label>Password</label>
          <input type="password" name="data[User][password]" class="form-control" placeholder="Password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

    <div class="row">
      <div class="col-xs-8">
        <div class="checkbox icheck">
          <label>
            <input type="checkbox"> Remember Me
          </label>
        </div>
      </div><!-- /.col -->
      <div class="col-xs-4">
        
        <?php echo $this->Form->button('Log In', array('type' => 'submit', 'class' => 'btn btn-primary btn-block btn-flat')); ?>
      </div><!-- /.col -->
    </div>
  <?php echo $this->Form->end(); ?>

  <div class="social-auth-links text-center">
    <p>- OR -</p>
    <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
    <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
  </div><!-- /.social-auth-links -->

  <a href="#">I forgot my password</a><br>
  <a href="register.html" class="text-center">Register a new membership</a>

</div><!-- /.login-box-body -->