<?php
include 'koneksi.php';

/* ================= TAMBAH ================= */
if (isset($_POST['tambah_warga'])) {

    $nik           = mysqli_real_escape_string($koneksi, $_POST['nik']);
    $nama_lengkap  = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tempat_lahir  = mysqli_real_escape_string($koneksi, $_POST['tempat_lahir']);
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $gol_darah     = $_POST['gol_darah'];
    $agama         = mysqli_real_escape_string($koneksi, $_POST['agama']);
    $alamat        = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $id_kk         = (int)$_POST['id_kk'];

    $query = mysqli_query($koneksi, "INSERT INTO tb_warga
        (nik, nama_lengkap, jenis_kelamin, tempat_lahir, tanggal_lahir, gol_darah, agama, alamat, id_kk)
        VALUES
        ('$nik','$nama_lengkap','$jenis_kelamin','$tempat_lahir','$tanggal_lahir',
         '$gol_darah','$agama','$alamat',$id_kk)
    ");

    if ($query) {
        echo "<script>
                alert('Berhasil! Data warga berhasil ditambahkan.');
                location.replace('../petugas/admin?halaman=warga&id_kk=$id_kk');
              </script>";
    } else {
        echo "<script>
                alert('Gagal! Data warga tidak berhasil ditambahkan.');
                location.replace('../petugas/admin?halaman=warga&id_kk=$id_kk');
              </script>";
    }
    exit;
}

/* ================= UBAH ================= */
if (isset($_POST['ubah_warga'])) {

    $id_warga      = (int)$_POST['id_warga'];
    $nik           = mysqli_real_escape_string($koneksi, $_POST['nik']);
    $nama_lengkap  = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tempat_lahir  = mysqli_real_escape_string($koneksi, $_POST['tempat_lahir']);
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $gol_darah     = $_POST['gol_darah'];
    $agama         = mysqli_real_escape_string($koneksi, $_POST['agama']);
    $alamat        = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $id_kk         = (int)$_POST['id_kk'];

    $query = mysqli_query($koneksi, "UPDATE tb_warga SET
        nik='$nik',
        nama_lengkap='$nama_lengkap',
        jenis_kelamin='$jenis_kelamin',
        tempat_lahir='$tempat_lahir',
        tanggal_lahir='$tanggal_lahir',
        gol_darah='$gol_darah',
        agama='$agama',
        alamat='$alamat',
        id_kk=$id_kk
        WHERE id_warga=$id_warga
    ");

    if ($query) {
        echo "<script>
                alert('Berhasil! Data warga berhasil diperbarui.');
                location.replace('../petugas/admin?halaman=warga&id_kk=$id_kk');
              </script>";
    } else {
        echo "<script>
                alert('Gagal! Data warga tidak berhasil diperbarui.');
                location.replace('../petugas/admin?halaman=warga&id_kk=$id_kk');
              </script>";
    }
    exit;
}

/* ================= HAPUS ================= */
if (isset($_POST['hapus_warga'])) {

    $id_warga = (int)$_POST['id_warga'];

    // Ambil id_kk untuk redirect
    $qw = mysqli_query($koneksi, "SELECT id_kk FROM tb_warga WHERE id_warga=$id_warga");
    $w = mysqli_fetch_assoc($qw);
    $id_kk = (int)$w['id_kk'];

    // Cek apakah warga masih punya permohonan
    $cek = mysqli_query($koneksi, "
        SELECT COUNT(*) AS total 
        FROM tb_permohonan 
        WHERE id_warga=$id_warga
    ");
    $hasil = mysqli_fetch_assoc($cek);

    if ((int)$hasil['total'] > 0) {
        echo "<script>
                alert('Gagal! Data warga tidak dapat dihapus karena masih memiliki permohonan layanan.');
                location.replace('../petugas/admin?halaman=warga&id_kk=$id_kk');
              </script>";
        exit;
    }

    // Aman untuk dihapus
    $hapus = mysqli_query($koneksi, "DELETE FROM tb_warga WHERE id_warga=$id_warga");

    if ($hapus) {
        echo "<script>
                alert('Berhasil! Data warga berhasil dihapus.');
                location.replace('../petugas/admin?halaman=warga&id_kk=$id_kk');
              </script>";
    } else {
        echo "<script>
                alert('Gagal! Data warga tidak berhasil dihapus.');
                location.replace('../petugas/admin?halaman=warga&id_kk=$id_kk');
              </script>";
    }
    exit;
}
