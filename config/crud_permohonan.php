<?php
include 'koneksi.php';

/* ================= TAMBAH ================= */
if (isset($_POST['tambah_permohonan'])) {

    $id_warga   = (int)$_POST['id_warga'];
    $id_layanan = (int)$_POST['id_layanan'];
    $ket        = mysqli_real_escape_string($koneksi, $_POST['keterangan']);

    /* ================= VALIDASI DUPLIKAT =================
       Jika warga sudah pernah mengajukan layanan yang sama -> blok
    ====================================================== */
    $cekDup = mysqli_query($koneksi, "
        SELECT COUNT(*) AS total
        FROM tb_permohonan
        WHERE id_warga = $id_warga
          AND id_layanan = $id_layanan
    ");
    $dup = mysqli_fetch_assoc($cekDup);

    if ((int)$dup['total'] > 0) {
        echo "<script>
                alert('Gagal! Warga tersebut sudah pernah mengajukan permohonan untuk layanan yang sama.');
                location.replace('../petugas/admin.php?halaman=permohonan');
              </script>";
        exit;
    }

    /* ================= INSERT PERMOHONAN ================= */
    $ins = mysqli_query($koneksi, "
        INSERT INTO tb_permohonan
        (id_warga, id_layanan, tanggal_permohonan, keterangan)
        VALUES
        ($id_warga, $id_layanan, CURDATE(), '$ket')
    ");

    if (!$ins) {
        echo "<script>
                alert('Gagal! Permohonan tidak berhasil dibuat.');
                location.replace('../petugas/admin.php?halaman=permohonan');
              </script>";
        exit;
    }

    $id_permohonan = mysqli_insert_id($koneksi);

    /* ================= AMBIL KODE LAYANAN ================= */
    $qL = mysqli_query($koneksi, "SELECT kode_layanan FROM tb_layanan WHERE id_layanan=$id_layanan");
    $l  = mysqli_fetch_assoc($qL);
    $kode_layanan = strtoupper($l['kode_layanan']);

    /* ================= AMBIL NAMA WARGA ================= */
    $qW = mysqli_query($koneksi, "SELECT nama_lengkap FROM tb_warga WHERE id_warga=$id_warga");
    $w  = mysqli_fetch_assoc($qW);
    $nama_warga = strtoupper(str_replace(' ', '-', $w['nama_lengkap']));

    /* ================= HITUNG URUTAN PER LAYANAN =================
       total permohonan untuk layanan tsb (sudah termasuk yg baru)
    ============================================================= */
    $qC = mysqli_query($koneksi, "
        SELECT COUNT(*) AS total
        FROM tb_permohonan
        WHERE id_layanan=$id_layanan
    ");
    $c = mysqli_fetch_assoc($qC);
    $urutan = (int)$c['total'];

    /* ================= NOMOR DOKUMEN OTOMATIS ================= */
    $nomor_dokumen = "{$kode_layanan}-{$urutan}_{$nama_warga}_PADANGCERMIN";

    /* ================= INSERT DOKUMEN (AUTO) ================= */
    $dok = mysqli_query($koneksi, "
        INSERT INTO tb_dokumen
        (id_permohonan, nomor_dokumen, file_pdf, tanggal_terbit)
        VALUES
        ($id_permohonan, '$nomor_dokumen', NULL, NULL)
    ");

    if (!$dok) {
        echo "<script>
                alert('Gagal! Permohonan dibuat, tetapi dokumen gagal digenerate. Silakan cek data dokumen.');
                location.replace('../petugas/admin.php?halaman=permohonan');
              </script>";
        exit;
    }

    echo "<script>
            alert('Berhasil! Permohonan dibuat dan nomor dokumen otomatis digenerate.');
            location.replace('../petugas/admin.php?halaman=permohonan');
          </script>";
    exit;
}

/* ================= HAPUS ================= */
if (isset($_POST['hapus_permohonan'])) {

    $id = (int)$_POST['id_permohonan'];

    // 1. Cek apakah sudah ada dokumen PDF terbit
    $cek_pdf = mysqli_query($koneksi, "
        SELECT COUNT(*) AS total
        FROM tb_dokumen
        WHERE id_permohonan = $id
          AND file_pdf IS NOT NULL
    ");
    $pdf = mysqli_fetch_assoc($cek_pdf);

    if ((int)$pdf['total'] > 0) {
        echo "<script>
                alert('Gagal! Permohonan tidak dapat dihapus karena dokumen PDF sudah diterbitkan.');
                location.replace('../petugas/admin.php?halaman=permohonan');
              </script>";
        exit;
    }

    // 2. Jika belum ada PDF → hapus dulu data dokumen (file_pdf masih NULL)
    mysqli_query($koneksi, "
        DELETE FROM tb_dokumen
        WHERE id_permohonan = $id
    ");

    // 3. Baru hapus permohonan
    $hapus = mysqli_query($koneksi, "
        DELETE FROM tb_permohonan
        WHERE id_permohonan = $id
    ");

    if ($hapus) {
        echo "<script>
                alert('Berhasil! Permohonan berhasil dihapus.');
                location.replace('../petugas/admin.php?halaman=permohonan');
              </script>";
    } else {
        echo "<script>
                alert('Gagal! Permohonan tidak berhasil dihapus.');
                location.replace('../petugas/admin.php?halaman=permohonan');
              </script>";
    }
    exit;
}
