<?php
require_once '../config/koneksi.php';
date_default_timezone_set('Asia/Jakarta');

$sesi_id        = $_SESSION['id'];
$sesi_nama      = $_SESSION['nama'];
$sesi_username  = $_SESSION['username'];
$sesi_level     = $_SESSION['level'];

if ($_SESSION['level'] !== 'kades') {
    header('location: ../login');
}

if (isset($_GET['halaman'])) {
    $halaman   = $_GET['halaman'];
} else {
    $halaman   = 'dashboard';
}

$usernameDaftar = @$_GET['username'];
$namaDaftar     = @$_GET['nama'];

$pukul  = date('h:i A');

// var_dump($_SESSION);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= ucfirst($sesi_level); ?> | <?= NAMA_SISTEM; ?></title>

    <?php require_once '../assets/css.php'; ?>
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?= $sesi_level; ?>" class="nav-link">Dashboard</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="?page=profil" class="nav-link">Profil</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="../config/logout.php" class="nav-link">Logout</a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link">
                        <h5>Pukul <?= $pukul; ?></h5>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="../index.php" class="brand-link">
                <img src="../assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light"><?= ucfirst($sesi_level); ?></span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?= ucfirst($sesi_nama); ?></a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Cari" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="?halaman=dashboard" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="?halaman=aparat-desa" class="nav-link">
                                <i class="nav-icon fas fa-user-tie"></i>
                                <p>Aparat Desa</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="?halaman=permohonan" class="nav-link">
                                <i class="nav-icon fas fa-file-signature"></i>
                                <p>Permohonan Layanan</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="?halaman=dokumen" class="nav-link">
                                <i class="nav-icon fas fa-file-pdf"></i>
                                <p>Dokumen (PDF)</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="?halaman=informasi-desa" class="nav-link">
                                <i class="nav-icon fas fa-bullhorn"></i>
                                <p>Informasi Desa</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="?halaman=profil" class="nav-link">
                                <i class="nav-icon fas fa-user-circle"></i>
                                <p>Profil Saya</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="../config/logout.php" class="nav-link">
                                <i class="nav-icon fas fa-power-off"></i>
                                <p>
                                    Logout
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains halaman content -->
        <div class="content-wrapper">
            <!-- Content Header (Halaman header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1><?= ucfirst($sesi_level) . " " . NAMA_SISTEM ?> </h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <p class="text-primary">Admin</p>
                                </li>
                                <li class="breadcrumb-item active" style="text-transform: capitalize;"><?= $halaman; ?></li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <?php
                if (@$_GET['halaman']) {
                    switch (@$_GET['halaman']) {

                        // ===== SIDESA ADMIN PAGES =====
                        case 'dashboard':
                            include 'halaman/dashboard.php';
                            break;

                        case 'permohonan':
                            include 'halaman/kelola_permohonan.php';
                            break;

                        case 'dokumen':
                            include 'halaman/kelola_dokumen.php';
                            break;

                        case 'informasi-desa':
                            include 'halaman/kelola_informasi_desa.php';
                            break;

                        case 'aparat-desa':
                            include 'halaman/kelola_aparat_desa.php';
                            break;

                        case 'profil':
                            include 'halaman/kelola_profil.php';
                            break;

                        // ===== DEFAULT / NOT FOUND =====
                        default:
                            include 'halaman/dashboard.php'; // atau halaman/404.php kalau kamu punya
                            break;
                    }
                } else {
                    include 'halaman/dashboard.php';
                }
                ?>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b><?= NAMA_SISTEM ?> 5TI2</b>
            </div>

            <strong>
                © 2026 <a href="<?= URL_IG ?>" target="_blank" rel="noopener"><?= NAMA_LENGKAP ?></a>
            </strong>
            <span class="text-muted"> <?= htmlspecialchars(NPM ?? '', ENT_QUOTES, 'UTF-8'); ?></span>
        </footer>

    </div>
    <!-- ./wrapper -->

    <?php require_once '../assets/js.php'; ?>
</body>

</html>