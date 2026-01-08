<?php
include 'koneksi.php';

/* ================= TAMBAH ================= */
if (isset($_POST['tambah_layanan'])) {

    $kode = mysqli_real_escape_string($koneksi, $_POST['kode_layanan']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_layanan']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);

    // CEK DUPLIKAT KODE
    $cek = mysqli_query($koneksi, "SELECT id_layanan FROM tb_layanan WHERE kode_layanan='$kode'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>
                alert('Gagal! Kode layanan sudah digunakan. Gunakan kode lain.');
                location.replace('../petugas/admin.php?halaman=layanan');
              </script>";
        exit;
    }

    $query = mysqli_query($koneksi, "INSERT INTO tb_layanan (kode_layanan, nama_layanan, deskripsi)
                                     VALUES ('$kode','$nama','$deskripsi')");

    if ($query) {
        echo "<script>
                alert('Berhasil! Data layanan berhasil ditambahkan.');
                location.replace('../petugas/admin.php?halaman=layanan');
              </script>";
    } else {
        echo "<script>
                alert('Gagal! Data layanan tidak berhasil ditambahkan.');
                location.replace('../petugas/admin.php?halaman=layanan');
              </script>";
    }
    exit;
}

/* ================= UBAH ================= */
if (isset($_POST['ubah_layanan'])) {

    $id   = (int)$_POST['id_layanan'];
    $kode = mysqli_real_escape_string($koneksi, $_POST['kode_layanan']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_layanan']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);

    // CEK DUPLIKAT KODE (KECUALI DIRI SENDIRI)
    $cek = mysqli_query($koneksi, "
        SELECT id_layanan FROM tb_layanan 
        WHERE kode_layanan='$kode' AND id_layanan<>$id
    ");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>
                alert('Gagal! Kode layanan sudah digunakan oleh layanan lain.');
                location.replace('../petugas/admin.php?halaman=layanan');
              </script>";
        exit;
    }

    $query = mysqli_query($koneksi, "UPDATE tb_layanan SET
                                        kode_layanan='$kode',
                                        nama_layanan='$nama',
                                        deskripsi='$deskripsi'
                                     WHERE id_layanan=$id");

    if ($query) {
        echo "<script>
                alert('Berhasil! Data layanan berhasil diperbarui.');
                location.replace('../petugas/admin.php?halaman=layanan');
              </script>";
    } else {
        echo "<script>
                alert('Gagal! Data layanan tidak berhasil diperbarui.');
                location.replace('../petugas/admin.php?halaman=layanan');
              </script>";
    }
    exit;
}

/* ================= HAPUS ================= */
if (isset($_POST['hapus_layanan'])) {

    $id = (int)$_POST['id_layanan'];

    // CEK FK ke permohonan
    $cek = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM tb_permohonan WHERE id_layanan=$id");
    $data = mysqli_fetch_assoc($cek);

    if ((int)$data['total'] > 0) {
        echo "<script>
                alert('Gagal! Layanan tidak dapat dihapus karena sudah digunakan pada permohonan.');
                location.replace('../petugas/admin.php?halaman=layanan');
              </script>";
        exit;
    }

    $hapus = mysqli_query($koneksi, "DELETE FROM tb_layanan WHERE id_layanan=$id");

    if ($hapus) {
        echo "<script>
                alert('Berhasil! Data layanan berhasil dihapus.');
                location.replace('../petugas/admin.php?halaman=layanan');
              </script>";
    } else {
        echo "<script>
                alert('Gagal! Data layanan tidak berhasil dihapus.');
                location.replace('../petugas/admin.php?halaman=layanan');
              </script>";
    }
    exit;
}
