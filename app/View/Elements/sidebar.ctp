<style type="text/css">
    .menu-open li.current-li {
        background-color: #225922;
    }

    .sidebar-menu li a, .sidebar-menu .treeview-menu > li > a {
        font-size: 16px;
    }


</style>


<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $this->webroot.'img/user2-160x160.jpg'; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>
              <?php 
                  if (!empty($userInfo['first_name']) && !empty($userInfo['first_name'])) {
                      echo $userInfo['first_name'].' '.$userInfo['last_name'];
                  } elseif (!empty($userInfo['first_name'])) {
                      echo $userInfo['first_name'];
                  }
              ?>
          </p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
          </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview">
          <a href="<?php echo $this->webroot.'dashboards'; ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        
        <li class="treeview">
          <a href="#">
            <i class="glyphicon glyphicon-book"></i>
            <span>Course Management</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
              <li><a href="<?php echo $this->webroot.'offer_courses'; ?>">
            <i class="fa fa-book"></i> <span>Offer Course</span> </a></li>              
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="glyphicon glyphicon-book"></i>
            <span>Course Enrollment</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
              <li><a href="<?php echo $this->webroot.'course_enrollments'; ?>">
            <i class="fa fa-book"></i> <span>Course Enrollment</span> </a></li>              
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>User Management</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
              <li><a href="<?php echo $this->webroot.'modules'; ?>"><i class="fa fa-book"></i> Module Management</a></li>

              <li><a href="<?php echo $this->webroot.'roles'; ?>"><i class="fa fa-book"></i> Role Management</a></li>

              <li><a href="<?php echo $this->webroot.'users'; ?>"><i class="fa fa-book"></i> User List</a></li>
          </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-database"></i>
                <span>System Data</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo $this->webroot.'employees'; ?>"><i class="fa fa-book"></i> Employee </a></li>

                <li><a href="<?php echo $this->webroot.'designations'; ?>"><i class="fa fa-book"></i> Designation </a></li>

                <li><a href="<?php echo $this->webroot.'departments'; ?>"><i class="fa fa-book"></i> Department </a></li>
            
                <li><a href="<?php echo $this->webroot.'courses'; ?>"><i class="fa fa-book"></i> Course </a></li>
            </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
</aside>


<script type="text/javascript">
    $(document).ready(function () {
        var i=0;
        $(document).find("ul.unique-left-menu > li").each(function(){
            i++;
            if ( i<3 ) return;
            var cnt = $(this).find("ul").children().length;
            if (cnt <= 0) {
                $(this).remove();
            }
        });

        var webroot = "<?php echo $this->webroot; ?>";
        var controller = "<?php echo $this->params['controller']; ?>";
        var action = "<?php echo $this->params['action']; ?>";

        if (action == "changePass") {
            url = webroot+controller+"/"+action;
        } else {
            url = webroot+controller;
        }


        /*console.log(url);
        console.log(controller);
        console.log(action);*/

        $("ul.sidebar-menu li ul li a").each(function() {
            if ($(this).attr("href") == url || $(this).attr("href") == '' ) { 
                console.log($(this).parent("ul"));
                $(this).parent().parent().parent().addClass("active");
                $(this).parent().addClass("current-li");
                $(this).parent().parent().addClass("menu-open");
                $(this).parent().parent().css({'display': 'block'});
            }

        })
    });
</script>