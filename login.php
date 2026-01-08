<?php
require_once 'config/koneksi.php';

/*
|--------------------------------------------------------------------------
| Redirect jika sudah login
|--------------------------------------------------------------------------
*/
if (@isset($_SESSION['level'])) {
    if ($_SESSION['level'] === 'admin') {
        header('Location: petugas/admin.php');
        exit;
    } elseif ($_SESSION['level'] === 'operator') {
        header('Location: petugas/operator.php');
        exit;
    } elseif ($_SESSION['level'] === 'kades') {
        header('Location: petugas/kades.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <!-- ===== META DASAR ===== -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ===== SEO TITLE ===== -->
    <title>Login Petugas | <?= NAMA_SISTEM ?></title>

    <!-- ===== SEO META DESCRIPTION ===== -->
    <meta name="description" content="Halaman login petugas Sistem Informasi Desa Padang Cermin untuk mengelola data kependudukan dan layanan administrasi desa secara digital.">

    <!-- ===== SEO KEYWORDS ===== -->
    <meta name="keywords" content="login desa padang cermin, sistem informasi desa, sidadesa, layanan desa, website desa">

    <!-- ===== AUTHOR ===== -->
    <meta name="author" content="Mahasiswa KKN IIB Darmajaya">

    <!-- ===== FAVICON ===== -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/logo.png">

    <!-- ===== GOOGLE FONT ===== -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- ===== FONT AWESOME ===== -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">

    <!-- ===== ICHECK ===== -->
    <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <!-- ===== ADMINLTE ===== -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">

    <div class="login-box">

        <!-- ===== LOGO ===== -->
        <div class="login-logo">
            <a href="index.php">
                <b><?= NAMA_SISTEM ?></b>
            </a>
        </div>

        <!-- ===== CARD LOGIN ===== -->
        <div class="card">
            <div class="card-body login-card-body">

                <!-- ===== TEKS PROFESIONAL ===== -->
                <p class="login-box-msg">
                    Silakan masuk untuk mengakses halaman pengelolaan sistem desa
                </p>

                <!-- ===== FORM LOGIN ===== -->
                <form action="config/cek_login.php" method="post" autocomplete="off">

                    <!-- USERNAME -->
                    <div class="input-group mb-3">
                        <input
                            type="text"
                            name="username"
                            class="form-control"
                            placeholder="Username"
                            minlength="5"
                            required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>

                    <!-- PASSWORD -->
                    <div class="input-group mb-3">
                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            placeholder="Password"
                            minlength="5"
                            required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <!-- BUTTON -->
                    <div class="social-auth-links text-center mb-3">
                        <button type="submit" name="login" class="btn btn-primary btn-block">
                            Masuk Sistem
                        </button>
                    </div>

                    <!-- IDENTITAS SISTEM -->
                    <div class="text-center text-muted">
                        <small><?= NAMA_SISTEM ?></small>
                    </div>

                </form>
                <!-- /.form -->

            </div>
            <!-- /.login-card-body -->
        </div>

        <!-- ===== FOOTER MINI ===== -->
        <div class="text-center mt-3 text-muted">
            <small>
                © <?= date('Y') ?> Sistem Informasi Desa Padang Cermin<br>
                Dikembangkan oleh Mahasiswa KKN IIB Darmajaya
            </small>
        </div>

    </div>
    <!-- /.login-box -->

    <!-- ===== SCRIPTS ===== -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/dist/js/adminlte.min.js"></script>

</body>

</html>