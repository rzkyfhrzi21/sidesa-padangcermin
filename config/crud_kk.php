<?php
require_once 'koneksi.php';

/* =========================
   TAMBAH KK
========================= */
if (isset($_POST['tambah_kk'])) {

    $nomor_kk        = mysqli_real_escape_string($koneksi, $_POST['nomor_kk']);
    $kepala_keluarga = mysqli_real_escape_string($koneksi, $_POST['kepala_keluarga']);
    $alamat          = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $rt              = mysqli_real_escape_string($koneksi, $_POST['rt']);
    $rw              = mysqli_real_escape_string($koneksi, $_POST['rw']);
    $kode_pos        = mysqli_real_escape_string($koneksi, $_POST['kode_pos']);

    $query = mysqli_query($koneksi, "INSERT INTO tb_kk 
        (nomor_kk, kepala_keluarga, alamat, rt, rw, kode_pos)
        VALUES
        ('$nomor_kk','$kepala_keluarga','$alamat','$rt','$rw','$kode_pos')
    ");

    if ($query) {
        echo "<script>
                alert('Berhasil! Data Kartu Keluarga berhasil ditambahkan.');
                location.replace('../petugas/admin?halaman=kk');
              </script>";
    } else {
        echo "<script>
                alert('Gagal! Data Kartu Keluarga tidak berhasil ditambahkan.');
                location.replace('../petugas/admin?halaman=kk');
              </script>";
    }
    exit;
}

/* =========================
   UBAH KK
========================= */
if (isset($_POST['ubah_kk'])) {

    $id_kk           = (int)$_POST['id_kk'];
    $nomor_kk        = mysqli_real_escape_string($koneksi, $_POST['nomor_kk']);
    $kepala_keluarga = mysqli_real_escape_string($koneksi, $_POST['kepala_keluarga']);
    $alamat          = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $rt              = mysqli_real_escape_string($koneksi, $_POST['rt']);
    $rw              = mysqli_real_escape_string($koneksi, $_POST['rw']);
    $kode_pos        = mysqli_real_escape_string($koneksi, $_POST['kode_pos']);

    $query = mysqli_query($koneksi, "UPDATE tb_kk SET
        nomor_kk='$nomor_kk',
        kepala_keluarga='$kepala_keluarga',
        alamat='$alamat',
        rt='$rt',
        rw='$rw',
        kode_pos='$kode_pos'
        WHERE id_kk=$id_kk
    ");

    if ($query) {
        echo "<script>
                alert('Berhasil! Data Kartu Keluarga berhasil diperbarui.');
                location.replace('../petugas/admin?halaman=kk');
              </script>";
    } else {
        echo "<script>
                alert('Gagal! Data Kartu Keluarga tidak berhasil diperbarui.');
                location.replace('../petugas/admin?halaman=kk');
              </script>";
    }
    exit;
}

/* =========================
   HAPUS KK
========================= */
if (isset($_POST['hapus_kk'])) {

    $id_kk = (int)$_POST['id_kk'];

    // Cek apakah KK masih memiliki anggota keluarga
    $cek = mysqli_query($koneksi, "
        SELECT COUNT(*) AS total 
        FROM tb_warga 
        WHERE id_kk=$id_kk
    ");
    $data = mysqli_fetch_assoc($cek);

    if ((int)$data['total'] > 0) {
        echo "<script>
                alert('Gagal! Kartu Keluarga tidak dapat dihapus karena masih memiliki anggota keluarga.');
                location.replace('../petugas/admin?halaman=kk');
              </script>";
        exit;
    }

    $hapus = mysqli_query($koneksi, "DELETE FROM tb_kk WHERE id_kk=$id_kk");

    if ($hapus) {
        echo "<script>
                alert('Berhasil! Data Kartu Keluarga berhasil dihapus.');
                location.replace('../petugas/admin?halaman=kk');
              </script>";
    } else {
        echo "<script>
                alert('Gagal! Data Kartu Keluarga tidak berhasil dihapus.');
                location.replace('../petugas/admin?halaman=kk');
              </script>";
    }
    exit;
}
