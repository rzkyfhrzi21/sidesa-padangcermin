<?php
include 'koneksi.php';

if (isset($_POST['tambah'])) {

    mysqli_query($koneksi, "
        INSERT INTO tb_informasi_desa
        (jenis, judul, isi, tanggal, penulis)
        VALUES (
            '{$_POST['jenis']}',
            '{$_POST['judul']}',
            '{$_POST['isi']}',
            CURDATE(),
            '{$_SESSION['nama']}'
        )
    ");

    echo "<script>
        alert('Informasi berhasil ditambahkan');
        location.replace('../petugas/admin.php?halaman=informasi-desa');
    </script>";
}

if (isset($_POST['ubah'])) {

    mysqli_query($koneksi, "
        UPDATE tb_informasi_desa SET
            jenis='{$_POST['jenis']}',
            judul='{$_POST['judul']}',
            isi='{$_POST['isi']}'
        WHERE id_informasi={$_POST['id_informasi']}
    ");

    echo "<script>
        alert('Informasi berhasil diubah');
        location.replace('../petugas/admin.php?halaman=informasi-desa');
    </script>";
}

if (isset($_POST['hapus'])) {

    mysqli_query($koneksi, "
        DELETE FROM tb_informasi_desa
        WHERE id_informasi={$_POST['id_informasi']}
    ");

    echo "<script>
        alert('Informasi berhasil dihapus');
        location.replace('../petugas/admin.php?halaman=informasi-desa');
    </script>";
}
