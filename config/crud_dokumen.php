<?php
include 'koneksi.php';
require_once __DIR__ . '/../assets/vendor/tcpdf/tcpdf.php';

/* ======================================================
   GENERATE PDF DOKUMEN
====================================================== */
if (isset($_POST['generate_pdf'])) {

    $id_dokumen = (int)$_POST['id_dokumen'];

    /* ===== Ambil Data Lengkap ===== */
    $q = mysqli_query($koneksi, "
        SELECT d.id_dokumen, d.nomor_dokumen,
               w.nama_lengkap, w.nik, w.tempat_lahir, w.tanggal_lahir,
               w.jenis_kelamin, w.alamat,
               k.kepala_keluarga,
               l.kode_layanan
        FROM tb_dokumen d
        JOIN tb_permohonan p ON d.id_permohonan = p.id_permohonan
        JOIN tb_warga w ON p.id_warga = w.id_warga
        JOIN tb_kk k ON w.id_kk = k.id_kk
        JOIN tb_layanan l ON p.id_layanan = l.id_layanan
        WHERE d.id_dokumen = $id_dokumen
    ");
    $data = mysqli_fetch_assoc($q);

    if (!$data) {
        echo "<script>
            alert('Data dokumen tidak ditemukan.');
            location.replace('../petugas/admin.php?halaman=dokumen');
        </script>";
        exit;
    }

    /* ===== Tentukan Template ===== */
    switch ($data['kode_layanan']) {
        case 'SKTM':
            $template = __DIR__ . '/../assets/template_pdf/sktm.php';
            break;
        case 'SKD':
            $template = __DIR__ . '/../assets/template_pdf/domisili.php';
            break;
        case 'SKU':
            $template = __DIR__ . '/../assets/template_pdf/usaha.php';
            break;
        case 'SKL':
            $template = __DIR__ . '/../assets/template_pdf/kelahiran.php';
            break;
        case 'SKK':
            $template = __DIR__ . '/../assets/template_pdf/kematian.php';
            break;
        default:
            echo "<script>
                alert('Template surat belum tersedia.');
                location.replace('../petugas/admin.php?halaman=dokumen');
            </script>";
            exit;
    }

    /* ===== Inisialisasi TCPDF ===== */
    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
    $pdf->SetMargins(20, 20, 20);
    $pdf->SetAutoPageBreak(true, 20);
    $pdf->AddPage();

    /* ===== Render Template ===== */
    ob_start();
    include $template; // template memakai variabel $data
    $html = ob_get_clean();

    $pdf->writeHTML($html, true, false, true, false, '');

    /* ===== PATH ABSOLUT (FIX ERROR TCPDF) ===== */
    $folder = realpath(__DIR__ . '/../assets/hasil_pdf');
    if (!$folder) {
        echo "<script>
            alert('Folder hasil_pdf tidak ditemukan.');
            location.replace('../petugas/admin.php?halaman=dokumen');
        </script>";
        exit;
    }

    $filename = $data['nomor_dokumen'] . '.pdf';
    $path = $folder . DIRECTORY_SEPARATOR . $filename;

    /* ===== Simpan PDF ===== */
    $pdf->Output($path, 'F');

    /* ===== Update Database ===== */
    mysqli_query($koneksi, "
        UPDATE tb_dokumen SET
            file_pdf = '$filename',
            tanggal_terbit = CURDATE()
        WHERE id_dokumen = $id_dokumen
    ");

    echo "<script>
        alert('Dokumen berhasil dibuat dan disimpan.');
        location.replace('../petugas/admin.php?halaman=dokumen');
    </script>";
    exit;
}

/* ======================================================
   GENERATE PDF MASSAL
====================================================== */
if (isset($_POST['generate_pdf_massal'])) {

    $q = mysqli_query($koneksi, "
        SELECT d.id_dokumen
        FROM tb_dokumen d
        WHERE d.file_pdf IS NULL
    ");

    if (mysqli_num_rows($q) == 0) {
        echo "<script>
            alert('Tidak ada dokumen yang perlu dibuat.');
            location.replace('../petugas/admin.php?halaman=dokumen');
        </script>";
        exit;
    }

    while ($row = mysqli_fetch_assoc($q)) {
        $_POST['id_dokumen'] = $row['id_dokumen'];
        $_POST['generate_pdf'] = true;
        include __FILE__; // panggil ulang logic generate satuan
        exit;
    }
}


/* ======================================================
   HAPUS PDF (BUKAN HAPUS DATA)
====================================================== */
if (isset($_POST['hapus_dokumen'])) {

    $id_dokumen = (int)$_POST['id_dokumen'];
    $file_pdf   = $_POST['file_pdf'];

    $folder = realpath(__DIR__ . '/../assets/hasil_pdf');
    if ($file_pdf && $folder && file_exists($folder . DIRECTORY_SEPARATOR . $file_pdf)) {
        unlink($folder . DIRECTORY_SEPARATOR . $file_pdf);
    }

    mysqli_query($koneksi, "
        UPDATE tb_dokumen SET
            file_pdf = NULL,
            tanggal_terbit = NULL
        WHERE id_dokumen = $id_dokumen
    ");

    echo "<script>
        alert('File dokumen berhasil dihapus.');
        location.replace('../petugas/admin.php?halaman=dokumen');
    </script>";
    exit;
}
