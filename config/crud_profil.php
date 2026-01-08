<?php
require_once 'koneksi.php';
session_start();

if (isset($_POST['simpan_profil'])) {

    $id_akun  = (int)$_POST['id_akun'];
    $nama     = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];
    $ulang    = $_POST['ulangi_password'];

    /* =========================
       VALIDASI USERNAME UNIK
    ========================= */
    $cek = mysqli_query($koneksi, "
        SELECT id_akun FROM tb_akun 
        WHERE username='$username' AND id_akun != $id_akun
    ");

    if (mysqli_num_rows($cek) > 0) {
        echo "<script>
            alert('Username sudah digunakan!');
            location.replace('../petugas/admin.php?halaman=profil');
        </script>";
        exit;
    }

    /* =========================
       JIKA PASSWORD DIISI
    ========================= */
    if (!empty($password) || !empty($ulang)) {

        if ($password !== $ulang) {
            echo "<script>
                alert('Ulangi password tidak sama!');
                location.replace('../petugas/admin.php?halaman=profil');
            </script>";
            exit;
        }

        $password_md5 = md5($password);

        mysqli_query($koneksi, "
            UPDATE tb_akun SET
            nama='$nama',
            username='$username',
            password='$password_md5'
            WHERE id_akun=$id_akun
        ");
    } else {

        // Password kosong → tidak diubah
        mysqli_query($koneksi, "
            UPDATE tb_akun SET
            nama='$nama',
            username='$username'
            WHERE id_akun=$id_akun
        ");
    }

    /* =========================
       UPDATE SESSION JIKA AKUN SENDIRI
    ========================= */
    if ($_SESSION['id'] == $id_akun) {
        $_SESSION['nama']     = $nama;
        $_SESSION['username'] = $username;
    }

    echo "<script>
        alert('Profil berhasil diperbarui');
        location.replace('../petugas/admin.php?halaman=profil');
    </script>";
    exit;
}
