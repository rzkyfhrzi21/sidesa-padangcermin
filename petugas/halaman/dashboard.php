<?php
if (!in_array($_SESSION['level'], ['admin', 'operator', 'kades'])) {
    return;
}

/* =========================
   DATA UNTUK CARD
========================= */
$total_warga = mysqli_fetch_assoc(
    mysqli_query($koneksi, "SELECT COUNT(*) total FROM tb_warga")
)['total'];

$total_kk = mysqli_fetch_assoc(
    mysqli_query($koneksi, "SELECT COUNT(*) total FROM tb_kk")
)['total'];

$total_permohonan = mysqli_fetch_assoc(
    mysqli_query($koneksi, "SELECT COUNT(*) total FROM tb_permohonan")
)['total'];

$total_dokumen = mysqli_fetch_assoc(
    mysqli_query($koneksi, "SELECT COUNT(*) total FROM tb_dokumen WHERE file_pdf IS NOT NULL")
)['total'];

$total_informasi = mysqli_fetch_assoc(
    mysqli_query($koneksi, "SELECT COUNT(*) total FROM tb_informasi_desa")
)['total'];

/* =========================
   DATA GRAFIK
========================= */

/* Permohonan per layanan */
$q_layanan = mysqli_query($koneksi, "
    SELECT l.nama_layanan, COUNT(*) total
    FROM tb_permohonan p
    JOIN tb_layanan l ON p.id_layanan = l.id_layanan
    GROUP BY l.id_layanan
");
$label_layanan = [];
$data_layanan  = [];
while ($r = mysqli_fetch_assoc($q_layanan)) {
    $label_layanan[] = $r['nama_layanan'];
    $data_layanan[]  = $r['total'];
}

/* Warga per jenis kelamin */
$q_jk = mysqli_query($koneksi, "
    SELECT jenis_kelamin, COUNT(*) total
    FROM tb_warga
    GROUP BY jenis_kelamin
");
$label_jk = [];
$data_jk  = [];
while ($r = mysqli_fetch_assoc($q_jk)) {
    $label_jk[] = ($r['jenis_kelamin'] == 'L') ? 'Laki-laki' : 'Perempuan';
    $data_jk[]  = $r['total'];
}

/* Permohonan per bulan */
$q_bulan = mysqli_query($koneksi, "
    SELECT MONTH(tanggal_permohonan) bulan, COUNT(*) total
    FROM tb_permohonan
    GROUP BY bulan
    ORDER BY bulan
");
$label_bulan = [];
$data_bulan  = [];
while ($r = mysqli_fetch_assoc($q_bulan)) {
    $label_bulan[] = date('F', mktime(0, 0, 0, $r['bulan'], 1));
    $data_bulan[]  = $r['total'];
}
?>

<!-- =========================
     CARD STATISTIK
========================= -->
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= $total_warga; ?></h3>
                <p>Total Warga</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3><?= $total_kk; ?></h3>
                <p>Kartu Keluarga</p>
            </div>
            <div class="icon">
                <i class="fas fa-id-card"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?= $total_permohonan; ?></h3>
                <p>Permohonan Layanan</p>
            </div>
            <div class="icon">
                <i class="fas fa-file-signature"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?= $total_dokumen; ?></h3>
                <p>Dokumen Terbit</p>
            </div>
            <div class="icon">
                <i class="fas fa-file-pdf"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= $total_informasi; ?></h3>
                <p>Informasi Desa</p>
            </div>
            <div class="icon">
                <i class="fas fa-bullhorn"></i>
            </div>
        </div>
    </div>
</div>

<!-- =========================
     GRAFIK
========================= -->
<div class="row">

    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-info">
                <h5 class="card-title">Permohonan per Layanan</h5>
            </div>
            <div class="card-body">
                <canvas id="chartLayanan"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-success">
                <h5 class="card-title">Warga Berdasarkan Jenis Kelamin</h5>
            </div>
            <div class="card-body">
                <canvas id="chartJK"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-warning">
                <h5 class="card-title">Permohonan per Bulan</h5>
            </div>
            <div class="card-body">
                <canvas id="chartBulan"></canvas>
            </div>
        </div>
    </div>

</div>

<!-- =========================
     CHART.JS
========================= -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    new Chart(document.getElementById('chartLayanan'), {
        type: 'bar',
        data: {
            labels: <?= json_encode($label_layanan); ?>,
            datasets: [{
                label: 'Jumlah Permohonan',
                data: <?= json_encode($data_layanan); ?>,
                backgroundColor: '#17a2b8'
            }]
        }
    });

    new Chart(document.getElementById('chartJK'), {
        type: 'doughnut',
        data: {
            labels: <?= json_encode($label_jk); ?>,
            datasets: [{
                data: <?= json_encode($data_jk); ?>,
                backgroundColor: ['#007bff', '#e83e8c']
            }]
        }
    });

    new Chart(document.getElementById('chartBulan'), {
        type: 'line',
        data: {
            labels: <?= json_encode($label_bulan); ?>,
            datasets: [{
                label: 'Permohonan',
                data: <?= json_encode($data_bulan); ?>,
                borderColor: '#ffc107',
                fill: false
            }]
        }
    });
</script>