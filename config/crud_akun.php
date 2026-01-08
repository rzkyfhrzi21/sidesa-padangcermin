<?php
require_once 'koneksi.php';
session_start();

/* ================= TAMBAH AKUN ================= */
if (isset($_POST['tambah_akun'])) {

	$nama     = mysqli_real_escape_string($koneksi, $_POST['nama']);
	$username = mysqli_real_escape_string($koneksi, $_POST['username']);
	$password = $_POST['password'];
	$ulang    = $_POST['ulangi_password'];
	$level    = mysqli_real_escape_string($koneksi, $_POST['level']);

	// Username unik
	$cek = mysqli_query($koneksi, "SELECT id_akun FROM tb_akun WHERE username='$username'");
	if (mysqli_num_rows($cek) > 0) {
		echo "<script>
            alert('Username sudah digunakan!');
            location.replace('../petugas/admin.php?halaman=akun');
        </script>";
		exit;
	}

	// Password wajib sama
	if ($password !== $ulang) {
		echo "<script>
            alert('Ulangi password tidak sama!');
            location.replace('../petugas/admin.php?halaman=akun');
        </script>";
		exit;
	}

	$password_md5 = md5($password);

	mysqli_query($koneksi, "
        INSERT INTO tb_akun (nama, username, password, level)
        VALUES ('$nama','$username','$password_md5','$level')
    ");

	echo "<script>
        alert('Akun berhasil ditambahkan');
        location.replace('../petugas/admin.php?halaman=akun');
    </script>";
	exit;
}


/* ================= UBAH AKUN ================= */
if (isset($_POST['ubah_akun'])) {

	$id       = (int)$_POST['id_akun'];
	$nama     = mysqli_real_escape_string($koneksi, $_POST['nama']);
	$username = mysqli_real_escape_string($koneksi, $_POST['username']);
	$password = $_POST['password'];
	$ulang    = $_POST['ulangi_password'];
	$level    = mysqli_real_escape_string($koneksi, $_POST['level']);

	// Username unik kecuali dirinya
	$cek = mysqli_query($koneksi, "
        SELECT id_akun FROM tb_akun 
        WHERE username='$username' AND id_akun != $id
    ");
	if (mysqli_num_rows($cek) > 0) {
		echo "<script>
            alert('Username sudah digunakan!');
            location.replace('../petugas/admin.php?halaman=akun');
        </script>";
		exit;
	}

	// Jika password diisi
	if (!empty($password) || !empty($ulang)) {

		if ($password !== $ulang) {
			echo "<script>
                alert('Ulangi password tidak sama!');
                location.replace('../petugas/admin.php?halaman=akun');
            </script>";
			exit;
		}

		$password_md5 = md5($password);

		mysqli_query($koneksi, "
            UPDATE tb_akun SET
            nama='$nama',
            username='$username',
            password='$password_md5',
            level='$level'
            WHERE id_akun=$id
        ");
	} else {

		// Password tidak diubah
		mysqli_query($koneksi, "
            UPDATE tb_akun SET
            nama='$nama',
            username='$username',
            level='$level'
            WHERE id_akun=$id
        ");
	}

	echo "<script>
        alert('Akun berhasil diperbarui');
        location.replace('../petugas/admin.php?halaman=akun');
    </script>";
	exit;
}


/* ================= HAPUS AKUN ================= */
if (isset($_POST['hapus_akun'])) {

	$id = (int)$_POST['id_akun'];

	mysqli_query($koneksi, "DELETE FROM tb_akun WHERE id_akun=$id");

	echo "<script>
        alert('Akun berhasil dihapus');
        location.replace('../petugas/admin.php?halaman=akun');
    </script>";
	exit;
}
