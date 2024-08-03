<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon">
            <i class="bi bi-file-medical-fill"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Antrian</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0 mb-2">

    <!-- Heading -->
    <div class="sidebar-heading">
        Dashboard
    </div>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '') ?>">
        <a class="nav-link" href="index.php">
            <i class="bi bi-speedometer"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0 mb-2">

    <!-- Heading -->
    <div class="sidebar-heading">
        Manajemen
    </div>

    <!-- Nav Item - Manajemen Antrian -->
    <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'penambahan_antrian.php' ? 'active' : '') ?>">
        <a class="nav-link" href="penambahan_antrian.php">
            <i class="bi bi-file-medical-fill"></i>
            <span>Penambahan Antrian</span></a>
    </li>

    <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'hapus_antrian.php') ? 'active' : ''; ?>">
        <a class="nav-link" href="hapus_antrian.php">
            <i class="bi bi-file-medical-fill"></i>
            <span>Hapus Antrian</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0 mb-2">

    <!-- Heading -->
    <div class="sidebar-heading">
        Pemanggilan
    </div>

    <!-- Nav Item - Pemanggilan Antrian -->
    <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'panggilan_manual.php'
                            || basename($_SERVER['PHP_SELF']) == "panggil_antrian.php" ? 'active' : '') ?>">
        <a class="nav-link" href="panggilan_manual.php">
            <i class="bi bi-megaphone-fill"></i>
            <span>Panggilan Manual</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0 mb-2">

    <!-- Heading -->
    <div class="sidebar-heading">
        Pengaturan
    </div>

    <!-- Nav Item - Reset Password -->
    <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'ganti_password.php' ? 'active' : '') ?>">
        <a class="nav-link" href="ganti_password.php">
            <i class="bi bi-shield-lock-fill"></i>
            <span>Ganti Password</span></a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->