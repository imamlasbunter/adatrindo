 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-olive elevation-4">
   <!-- Brand Logo -->
   <a href="index3.html" class="brand-link">
     <img src="<?= base_url() ?>/assets/dist/img/AdminLTELogo.png" alt="Adatrindo Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
     <span class="brand-text font-weight-light">POS-System</span>
   </a>

   <!-- Sidebar -->
   <div class="sidebar">
     <!-- Sidebar Menu -->
     <nav class="mt-2">
       <ul class="nav nav-flat nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         <li class="nav-header">MAIN MENU</li>
         <li class="nav-item">
           <a href="<?= base_url('dashboard'); ?>" class="nav-link <?= ($title == "Dashboard") ? "active" : ""; ?>">
             <i class="nav-icon fas fa-tachometer-alt"></i>
             <p>
               Dashboard
             </p>
           </a>
         </li>
         <li class="nav-item has-treeview">
           <a href="#" class="nav-link">
             <i class="nav-icon fas fa-shopping-cart"></i>
             <p>
               Transaction
               <i class="fas fa-angle-left right"></i>
             </p>
           </a>
           <ul class="nav nav-treeview">
             <li class="nav-item">
               <a href="pages/tables/simple.html" class="nav-link">
                 <i class="nav-icon fas fa-cart-plus"></i>
                 <p>Sales</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="pages/tables/data.html" class="nav-link">
                 <i class=" nav-icon fas fa-cart-arrow-down"></i>
                 <p>Stock IN</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="pages/tables/jsgrid.html" class="nav-link">
                 <i class="nav-icon fas fa-outdent"></i>
                 <p>Stock Out</p>
               </a>
             </li>
           </ul>
         </li>
         <li class="nav-header">REPORT</li>
         <li class="nav-item">
           <a href="#" class="nav-link">
             <i class="nav-icon fas fa-chart-line"></i>
             <p>Sales</p>
           </a>
         </li>
         <li class="nav-item">
           <a href="#" class="nav-link">
             <i class="nav-icon fas fa-list"></i>
             <p>Stock In/Out</p>
           </a>
         </li>
         <li class="nav-item">
           <a href="#" class="nav-link">
             <i class="fas fa-table nav-icon"></i>
             <p>Log</p>
           </a>
         </li>

         <li class="nav-header">SETTING</li>
         <li class="nav-item">
           <a href="<?= base_url('suppliers'); ?>" class="nav-link  <?= ($title == "Suppliers" || $title == "Add|Suppliers" || $title == "Edit|Suppliers") ? "active" : ""; ?>">
             <i class="nav-icon fas fa-truck"></i>
             <p>Suppliers</p>
           </a>
         </li>
         <li class="nav-item">
           <a href="<?= base_url('customers'); ?>" class="nav-link <?= ($title == "Customers" || $title == "Add|Customers" || $title == "Edit|Customers") ? "active" : ""; ?>">
             <i class="nav-icon fas fa-users"></i>
             <p>Customers</p>
           </a>
         </li>
         <li class="nav-item has-treeview <?= ($title == "Product Categories" || $title == "Add|Product Categories" || $title == "Edit|Product Categories" || $title == "Product Units" || $title == "Add|Product Units" || $title == "Edit|Product Units" || $title == "Product Items" || $title == "Add|Product Items" || $title == "Edit|Product Items") ? "menu-open" : ""; ?>">
           <a href="#" class="nav-link">
             <i class="nav-icon fas fa-box"></i>
             <p>
               Product
               <i class="right fas fa-angle-left"></i>
             </p>
           </a>
           <ul class="nav nav-treeview">
             <li class="nav-item">
               <a href="<?= base_url('category') ?>" class="nav-link <?= ($title == "Product Categories" || $title == "Add|Product Categories" || $title == "Edit|Product Categories") ? "active" : ""; ?>">
                 <i class="fas fa-list-ul nav-icon"></i>
                 <p>Categories</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="<?= base_url('units') ?>" class="nav-link <?= ($title == "Product Units" || $title == "Add|Product Units" || $title == "Edit|Product Units") ? "active" : ""; ?>">
                 <i class="fas fa-list-ul nav-icon"></i>
                 <p>Units</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="<?= base_url('/items'); ?>" class="nav-link <?= ($title == "Product Items" || $title == "Add|Product Items" || $title == "Edit|Product Items") ? "active" : ""; ?>">
                 <i class="fas fa-list-ul nav-icon"></i>
                 <p>Items</p>
               </a>
             </li>
           </ul>
         </li>
         <li class="nav-item">
           <a href="<?= base_url('users') ?>" class="nav-link <?= ($title == "Users" || $title == "Add|Users" || $title == "Edit|Users") ? "active" : ""; ?>">
             <i class="fas fa-user nav-icon"></i>
             <p>Users</p>
           </a>
         </li>


       </ul>
     </nav>
     <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->
 </aside>
 <script>
   //  const currentLocation = location.href;
   //  const menuITem = document.querySelectorAll('a');
   //  const menuLength = menuITem.length
   //  for (let i = 0; i < menuLength; i++) {
   //    if (menuITem[i].href === currentLocation) {
   //      menuITem[i].className = "active"
   //    }
   //  }
 </script>