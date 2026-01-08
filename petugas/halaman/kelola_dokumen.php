<?php
if (!in_array($_SESSION['level'], ['admin', 'operator', 'kades'])) {
    return;
}

$isKades = $_SESSION['level'] === 'kades';
?>

<div class="card">
    <div class="card-header">
        <div class="d-sm-flex justify-content-between align-items-center">
            <h4>Data Dokumen Layanan</h4>

            <?php if (!$isKades): ?>
                <button class="btn btn-success" data-toggle="modal" data-target="#modal-generate">
                    Buat Dokumen
                </button>
            <?php endif; ?>
        </div>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped" id="example1">
            <thead class="bg-info">
                <tr>
                    <th>#</th>
                    <th>No Dokumen</th>
                    <th>ID</th>
                    <th>Nama Warga</th>
                    <th>Layanan</th>
                    <th>Tanggal Terbit</th>
                    <th>File</th>
                    <?php if (!$isKades): ?>
                        <th width="10%">Aksi</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $q = mysqli_query($koneksi, "
                    SELECT d.*, w.nama_lengkap, l.kode_layanan, l.nama_layanan
                    FROM tb_dokumen d
                    JOIN tb_permohonan p ON d.id_permohonan=p.id_permohonan
                    JOIN tb_warga w ON p.id_warga=w.id_warga
                    JOIN tb_layanan l ON p.id_layanan=l.id_layanan
                    ORDER BY d.id_dokumen DESC
                ");
                while ($row = mysqli_fetch_assoc($q)) :
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['nomor_dokumen']; ?></td>
                        <td><?= $row['id_permohonan']; ?></td>
                        <td><?= htmlspecialchars($row['nama_lengkap']); ?></td>
                        <td><?= $row['kode_layanan']; ?></td>
                        <td><?= $row['tanggal_terbit'] ? date('d-m-Y', strtotime($row['tanggal_terbit'])) : '-'; ?></td>
                        <td>
                            <?php if ($row['file_pdf']): ?>
                                <a href="../assets/hasil_pdf/<?= $row['file_pdf']; ?>" target="_blank"
                                    class="btn btn-danger btn-sm">
                                    <i class="fas fa-file-pdf"></i> Lihat
                                </a>
                            <?php else: ?>
                                <span class="badge badge-warning">Belum Ada PDF</span>
                            <?php endif; ?>
                        </td>

                        <?php if (!$isKades): ?>
                            <td>
                                <?php if ($row['file_pdf']): ?>
                                    <form action="../config/crud_dokumen.php" method="post">
                                        <input type="hidden" name="id_dokumen" value="<?= $row['id_dokumen']; ?>">
                                        <input type="hidden" name="file_pdf" value="<?= $row['file_pdf']; ?>">
                                        <button class="btn btn-danger btn-sm" name="hapus_dokumen">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php if (!$isKades): ?>
    <div class="modal fade" id="modal-generate">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="../config/crud_dokumen.php" method="post">
                    <div class="modal-header">
                        <h4 class="modal-title">Generate Dokumen</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <select name="id_dokumen" class="form-control">
                            <option value="">-- Pilih Dokumen --</option>
                            <?php
                            $qd = mysqli_query($koneksi, "
                            SELECT d.id_dokumen, w.nama_lengkap, l.kode_layanan
                            FROM tb_dokumen d
                            JOIN tb_permohonan p ON d.id_permohonan=p.id_permohonan
                            JOIN tb_warga w ON p.id_warga=w.id_warga
                            JOIN tb_layanan l ON p.id_layanan=l.id_layanan
                            WHERE d.file_pdf IS NULL
                        ");
                            while ($d = mysqli_fetch_assoc($qd)):
                            ?>
                                <option value="<?= $d['id_dokumen']; ?>">
                                    <?= $d['nama_lengkap']; ?> - <?= $d['kode_layanan']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button class="btn btn-primary" name="generate_pdf">Buat PDF</button>
                        <button class="btn btn-success" name="generate_pdf_massal">
                            Buat PDF Massal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>