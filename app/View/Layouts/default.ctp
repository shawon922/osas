<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        
        <?php echo $this->fetch('title').' - OSAS'; ?>
    </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <?php
    echo $this->Html->meta('icon');

    echo $this->Html->css(array('bootstrap/bootstrap.min', 'font-awesome-4.4.0/css/font-awesome.min', 'ionicons-2.0.1/css/ionicons.min', '../js/plugins/jvectormap/jquery-jvectormap-1.2.2', 'AdminLTE.min', 'skins/_all-skins.min', '../js/plugins/iCheck/flat/blue', '../js/plugins/morris/morris', '../js/plugins/datepicker/datepicker3', '../js/plugins/daterangepicker/daterangepicker-bs3', '../js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min', 'style'));

    echo $this->fetch('meta');
    ?>

    <?php 
        echo $this->Html->script(array('plugins/jQuery/jQuery-2.1.4.min', 'plugins/jQueryUI/jquery-ui.min'));
    ?>
<SCRIPT type="text/javascript">
    window.history.forward();
    function noBack() { window.history.forward(); }
</SCRIPT>
       

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
<body onload="noBack();" onpageshow="if (event.persisted) noBack();" onunload="" class="hold-transition skin-blue layout-boxed sidebar-mini">
        <!-- Wrapper Start -->
        <div class="wrapper">

          <?php 

              echo $this->element('header'); 

              echo $this->element('sidebar'); 

          ?>

          <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <section class="content-header">
                    <h1>
                      Dashboard
                      <small><?php echo $title_for_layout; ?></small>
                    </h1>
                </section>

                <section class="content">

                    <?php echo $this->Session->flash(); ?>

                    <?php echo $this->fetch('content'); ?>

                </section>
            </div>
            <?php echo $this->element('footer'); ?>
          

            <?php               

              echo $this->element('control_sidebar'); 

            ?>
        </div> <!--Wrapper End-->

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>

    <?php 
        echo $this->Html->script(array('plugins/bootstrap/bootstrap.min', 'raphael-min', 'plugins/sparkline/jquery.sparkline.min', 'plugins/sparkline/jquery.sparkline.min', 'plugins/jvectormap/jquery-jvectormap-1.2.2.min', 'plugins/jvectormap/jquery-jvectormap-world-mill-en', 'plugins/knob/jquery.knob', 'moment.min', 'plugins/daterangepicker/daterangepicker', 'plugins/datepicker/bootstrap-datepicker', 'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min', 'plugins/slimScroll/jquery.slimscroll.min', 'plugins/fastclick/fastclick.min', 'AdminLTE/app.min', 'AdminLTE/demo'));
    ?>
    
    
</body>
</html>