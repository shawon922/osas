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

    echo $this->Html->css(array('bootstrap/bootstrap.min'));

    echo $this->fetch('meta');
    ?>

    <?php 
        echo $this->Html->script(array('plugins/jQuery/jQuery-2.1.4.min'));
    ?>
<script type="text/javascript">
    //window.history.forward();
    
    function noBack() { 
        //window.history.forward(); 
    }
</script>
       

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
<body onload="noBack();" onpageshow="if (event.persisted) noBack();" onunload="" class="">
        <!-- Wrapper Start -->
        
        <div class="container">
            <div class="row">
                <nav class="navbar navbar-default navbar-fixed-top top-menu">
                    <div class="container">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="<?php echo $this->webroot; ?>">OSAS</a>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="navbar-collapse-1">
                            <ul class="nav navbar-nav navbar-right">
                                
                                <li><a href="<?php echo $this->webroot.'register'; ?>">Register</a></li>
                                <li><a href="<?php echo $this->webroot.'login'; ?>">Log In</a></li>
                                
                            </ul>
                        </div><!-- /.navbar-collapse -->

                    </div><!-- /.container-fluid -->
                </nav>
            </div>

            <div class="row jumbotron"></div>

            <?php echo $this->Session->flash(); ?>

            <?php echo $this->fetch('content'); ?>


        </div> <!--Wrapper End-->



    <?php 
        echo $this->Html->script(array('plugins/bootstrap/bootstrap.min'));
    ?>
    
    
</body>
</html>