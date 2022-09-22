 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-olive elevation-4">
   <!-- Brand Logo -->
   <a href="<?php echo base_url('dashboard'); ?>" class="brand-link">
     <img src="<?= base_url() ?>/uploads/<?php echo $logo; ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8" width="50" height="50">
     <span class="brand-text font-weight-light">POS-System</span>
   </a>

   <!-- Sidebar -->
   <div class="sidebar">
     <!-- Sidebar user panel (optional) 
     <div class="user-panel mt-3 pb-3 mb-3 d-flex">
       <div class="image">
         <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
       </div>
       <div class="info">
         <a href="#" class="d-block">Alexander Pierce</a>
       </div>
     </div>-->
     <!-- Sidebar Menu -->
     <nav class="mt-2">
       <ul class="nav nav-flat nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

         <li class="nav-header">MAIN MENU</li>
         <?php
          echo $menu1;
          ?>
         <li class="nav-header">REPORT</li>
         <?php
          echo $menu2;
          ?>

         <li class="nav-header">SETTING</li>
         <?php
          echo $menu3;
          ?>

       </ul>
     </nav>
     <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->
 </aside>