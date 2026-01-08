<?php
include 'koneksi.php';

if (isset($_POST['tambah'])) {

    mysqli_query($koneksi, "
        INSERT INTO tb_aparat_desa (nama_aparat, jabatan, periode)
        VALUES ('{$_POST['nama_aparat']}','{$_POST['jabatan']}','{$_POST['periode']}')
    ");

    echo "<script>
        alert('Aparat desa berhasil ditambahkan');
        location.replace('../petugas/admin.php?halaman=aparat-desa');
    </script>";
}

if (isset($_POST['ubah'])) {

    mysqli_query($koneksi, "
        UPDATE tb_aparat_desa SET
            nama_aparat='{$_POST['nama_aparat']}',
            jabatan='{$_POST['jabatan']}',
            periode='{$_POST['periode']}'
        WHERE id_aparat={$_POST['id_aparat']}
    ");

    echo "<script>
        alert('Aparat desa berhasil diubah');
        location.replace('../petugas/admin.php?halaman=aparat-desa');
    </script>";
}

if (isset($_POST['hapus'])) {

    mysqli_query($koneksi, "
        DELETE FROM tb_aparat_desa
        WHERE id_aparat={$_POST['id_aparat']}
    ");

    echo "<script>
        alert('Aparat desa berhasil dihapus');
        location.replace('../petugas/admin.php?halaman=aparat-desa');
    </script>";
}
