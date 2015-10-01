<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */


?>
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

    echo $this->Html->css(array('bootstrap/bootstrap.min', 'font-awesome-4.4.0/css/font-awesome.min', 'ionicons-2.0.1/css/ionicons.min'));

    echo $this->fetch('meta');
    ?>

    <!-- jvectormap -->
    <link rel="stylesheet" href="js/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="css/skins/_all-skins.min.css">

    <!-- iCheck -->
    <link rel="stylesheet" href="js/plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="js/plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="js/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="js/plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="js/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">


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
<body class="hold-transition skin-blue layout-boxed sidebar-mini">
        <!-- Wrapper Start -->
        <div class="wrapper">

          <?php 

              echo $this->element('header'); 

              echo $this->element('sidebar'); 

          ?>

          <!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">

                <?php echo $this->Session->flash(); ?>

                <?php echo $this->fetch('content'); ?>
          </div>
            <?php echo $this->element('footer'); ?>
          </div><!-- /.content-wrapper -->

            <?php 
              

              echo $this->element('control_sidebar'); 

            ?>
        </div> <!--Wrapper End-->

   <!-- jQuery 2.1.4 -->
    <script src="js/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="js/plugins/jQueryUI/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="js/plugins/bootstrap/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="js/raphael-min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="js/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="js/plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="js/moment.min.js"></script>
    <script src="js/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="js/plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="js/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="js/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="js/AdminLTE/app.min.js"></script>
    
    <script src="js/AdminLTE/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="js/AdminLTE/demo.js"></script>

</body>
</html>