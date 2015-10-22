<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        
        <?php echo $this->fetch('title'); ?>
    </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <?php
    echo $this->Html->meta('icon');

    echo $this->Html->css(array('bootstrap/bootstrap.min', 'font-awesome-4.4.0/css/font-awesome.min', 'ionicons-2.0.1/css/ionicons.min', '../js/plugins/jvectormap/jquery-jvectormap-1.2.2', 'AdminLTE.min', '../js/plugins/iCheck/square/blue'));

    echo $this->fetch('meta');
    ?>

    

    <?php
    echo $this->fetch('css');
    echo $this->fetch('script');
    ?>
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition login-page">
    <div class="login-box">

        <?php echo $this->Session->flash(); ?>

        <?php echo $this->fetch('content'); ?>

    </div><!-- /.login-box -->


    <?php 
        echo $this->Html->script(array('plugins/jQuery/jQuery-2.1.4.min', 'plugins/bootstrap/bootstrap.min', 'plugins/iCheck/icheck.min')); 
    ?>
   
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>

</body>
</html>