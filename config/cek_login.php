<?php

session_start();

require_once 'koneksi.php';

if (isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = md5($_POST['password']);

	$sql_login = mysqli_query($koneksi, "SELECT * from tb_akun where username = '$username' and password = '$password'");
	$jumlah_petugas = mysqli_num_rows($sql_login);
	$data_petugas	= mysqli_fetch_array($sql_login);

	if ($jumlah_petugas > 0) {
		$_SESSION['id'] 			= $data_petugas['id_akun'];
		$_SESSION['nama'] 			= $data_petugas['nama'];
		$_SESSION['username'] 		= $data_petugas['username'];
		$_SESSION['level'] 			= $data_petugas['level'];

		if ($data_petugas['level'] == 'admin') {
			header('Location: ../petugas/admin');
		} else if ($data_petugas['level'] == 'operator') {
			header('Location: ../petugas/operator');
		} else if ($data_petugas['level'] == 'kades') {
			header('Location: ../petugas/kades');
		} else {
			echo "<script>
				alert('Level user tidak diketahui!');
				location.replace('../login');
			</script>";
		}
	} else {
		echo "<script>
				alert('User tidak ditemukan!');
				location.replace('../login');
			</script>";
	}
}
