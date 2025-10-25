<?php
ob_start();
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: auth/login.php");
    exit();
} else {
    session_regenerate_id();

    include "csrf-security/csrf.php";

    function judulDinamis()
    {
        $judul = basename($_SERVER['PHP_SELF']);

        switch ($judul) {
            case "index.php";
                echo "Dashboard";
                break;
            case "penambahan_antrian.php":
                echo "Penambahan Antrian";
                break;
            case "hapus_antrian.php":
                echo "Hapus Antrian";
                break;
            case "update_antrian.php";
                echo "Update Antrian";
                break;
            case "panggilan_manual.php":
                echo "Panggilan Manual";
                break;
            case "panggil_antrian.php":
                echo "Panggil Antrian";
                break;
            case "ganti_password.php":
                echo "Ganti Password";
                break;
            default:
                echo "Error";
                break;
        }
    }

    function layoutApps()
    {
        $layout = basename($_SERVER['PHP_SELF']);

        switch ($layout) {
            case "index.php":
                include "layouts/layout_index.php";
                break;
            case "penambahan_antrian.php":
                include "layouts/layout_penambahan_antrian.php";
                break;
            case "hapus_antrian.php":
                include "layouts/layout_hapus_antrian.php";
                break;
            case "update_antrian.php";
                include "layouts/layout_update_antrian.php";
                break;
            case "panggilan_manual.php":
                include "layouts/layout_panggilan_manual.php";
                break;
            case "panggil_antrian.php":
                include "layouts/layout_panggil_antrian.php";
                break;
            case "ganti_password.php":
                include "layouts/layout_ganti_password.php";
                break;
            default:
                echo "Error";
                break;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php judulDinamis(); ?></title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.jpg">
    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <?php if (
        basename($_SERVER['PHP_SELF']) == 'panggilan_manual.php'
        || 'update_antrian.php' || 'index.php'
    ) { ?>
        <!-- Custom styles for this page -->
        <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <?php } ?>

    <?php if (basename($_SERVER['PHP_SELF']) == 'panggil_antrian.php') { ?>
        <script src="https://code.responsivevoice.org/responsivevoice.js?key=FIRJMxGP"></script>
    <?php } ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php
        include "sidebar.php";
        ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo (isset($_COOKIE['X-APP-USERNAME'])
                                                                                                ? $_COOKIE['X-APP-USERNAME'] : $_SESSION['role']); ?></span>
                                <img class="img-profile rounded-circle" src="assets/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <?php layoutApps(); ?>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Anda yakin untuk keluar?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Pilih "Logout" jika Anda yakin untuk keluar.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-danger" href="auth/logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- End of Page Wrapper -->