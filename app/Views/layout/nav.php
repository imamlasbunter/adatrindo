<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-olive navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <!--
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
        -->
  </ul>

  <!-- SEARCH FORM 
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>
    -->


  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <?php echo session()->get('name');
        ?>
        <i class="fas fa-angle-down right"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <div class="dropdown-divider"></div>
        <a href="<?= base_url('user-profile'); ?>" class="dropdown-item">
          <i class="fas fa-user mr-2"></i> Profile
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="<?= base_url('logout') ?>">
          <i class="fas fa-sign-out-alt"></i> Log Out
        </a>
      </div>
    </li>

  </ul>

</nav>
<!-- /.navbar -->