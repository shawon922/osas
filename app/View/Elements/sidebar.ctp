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
              <li><a href="<?php echo $this->webroot; ?>courses"><i class="fa fa-book"></i> Course Management</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
</aside>