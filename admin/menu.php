<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
  <div class="sidebar-brand-icon rotate-n-15">
    <i class="fas fa-cube"></i>
  </div>
  <div class="sidebar-brand-text mx-3">GANTARI ELEKTRIK</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item">
  <a class="nav-link" href="index.php">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Dashboard</span></a>
</li>

<!-- Divider -->


<!-- Heading -->


      <hr class="sidebar-divider">
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#outgoing" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-truck"></i>
          <span>Transaksi</span>
        </a>
        <div id="outgoing" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="transaksi.php">Data Transaksi</a>
            <a class="collapse-item" href="input-master.php">Input Transaksi Masuk</a>
            <a class="collapse-item" href="input-transaksi-keluar.php">Input Transaksi Keluar</a>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#safetystock" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-truck"></i>
          <span>Safety Stock</span>
        </a>
        <div id="safetystock" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="perhitungan_safety_stock.php">Perhitungan</a>
          </div>
        </div>
      </li>

<!-- Nav Item - Utilities Collapse Menu -->
<?php if($_SESSION['role'] == "admin"){?>
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#user" aria-expanded="true" aria-controls="collapseUtilities">
    <i class="fas fa-users"></i>
    <span>User</span>
  </a>
  <div id="user" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">User</h6>
      <a class="collapse-item" href="user.php">User</a>
      <a class="collapse-item" href="input-user.php">Tambah User</a>
    </div>
  </div>
</li>
<?php } else if($_SESSION['role'] == "karyawan"){ echo "";} ?>
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#report" aria-expanded="true" aria-controls="collapseUtilities">
    <i class="fas fa-list"></i>
    <span>Laporan</span>
  </a>
  <div id="report" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Report</h6>
      <a class="collapse-item" href="laporan-masuk.php">Transaksi Masuk</a>
      <a class="collapse-item" href="laporan-keluar.php">Transaksi Keluar</a>
    </div>
  </div>
</li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

<!-- Divider -->
<hr class="sidebar-divider">
</ul>