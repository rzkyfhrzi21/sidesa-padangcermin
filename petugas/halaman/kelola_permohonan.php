<?php
if (!in_array($_SESSION['level'], ['admin', 'operator', 'kades'])) {
    return;
}

$isKades = $_SESSION['level'] === 'kades';
?>

<div class="card">
    <div class="card-header">
        <div class="d-sm-flex justify-content-between align-items-center">
            <h4>Data Permohonan Layanan</h4>

            <?php if (!$isKades): ?>
                <button class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah">
                    Tambah Permohonan
                </button>
            <?php endif; ?>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped" id="example1">
            <thead class="bg-info">
                <tr>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>ID</th>
                    <th>Nama Warga</th>
                    <th>Layanan</th>
                    <th>Keterangan</th>
                    <?php if (!$isKades): ?>
                        <th width="10%">Aksi</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $q = mysqli_query($koneksi, "
                    SELECT p.*, w.nama_lengkap, l.kode_layanan, l.nama_layanan
                    FROM tb_permohonan p
                    JOIN tb_warga w ON p.id_warga=w.id_warga
                    JOIN tb_layanan l ON p.id_layanan=l.id_layanan
                    ORDER BY p.id_permohonan DESC
                ");
                while ($row = mysqli_fetch_assoc($q)) :
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= date('d-m-Y', strtotime($row['tanggal_permohonan'])); ?></td>
                        <td><?= $row['id_permohonan']; ?></td>
                        <td><?= htmlspecialchars($row['nama_lengkap']); ?></td>
                        <td><b><?= $row['kode_layanan']; ?></b><br><?= $row['nama_layanan']; ?></td>
                        <td><?= htmlspecialchars($row['keterangan']); ?></td>

                        <?php if (!$isKades): ?>
                            <td>
                                <button class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#modal-hapus<?= $row['id_permohonan']; ?>">
                                    Hapus
                                </button>
                            </td>
                        <?php endif; ?>
                    </tr>

                    <?php if (!$isKades): ?>
                        <div class="modal fade" id="modal-hapus<?= $row['id_permohonan']; ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="../config/crud_permohonan.php" method="post">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Hapus Permohonan</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <div class="modal-body">
                                            <p>Hapus permohonan ini?</p>
                                            <input type="hidden" name="id_permohonan" value="<?= $row['id_permohonan']; ?>">
                                        </div>

                                        <div class="modal-footer justify-content-between">
                                            <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <button class="btn btn-danger" name="hapus_permohonan">Hapus</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php if (!$isKades): ?>
    <div class="modal fade" id="modal-tambah">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="../config/crud_permohonan.php" method="post">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Permohonan</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                            <label>Warga</label>
                            <select name="id_warga" class="form-control select2" required>
                                <option value="">-- Pilih Warga --</option>
                                <?php
                                $warga = mysqli_query($koneksi, "
                                SELECT id_warga, nik, nama_lengkap
                                FROM tb_warga
                                ORDER BY nama_lengkap
                            ");
                                while ($w = mysqli_fetch_assoc($warga)) :
                                ?>
                                    <option value="<?= $w['id_warga']; ?>">
                                        <?= $w['nik']; ?> - <?= $w['nama_lengkap']; ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Layanan</label>
                            <select name="id_layanan" class="form-control" required>
                                <option value="">-- Pilih Layanan --</option>
                                <?php
                                $layanan = mysqli_query($koneksi, "
                                SELECT id_layanan, kode_layanan, nama_layanan
                                FROM tb_layanan
                                ORDER BY kode_layanan
                            ");
                                while ($l = mysqli_fetch_assoc($layanan)) :
                                ?>
                                    <option value="<?= $l['id_layanan']; ?>">
                                        <?= $l['kode_layanan']; ?> - <?= $l['nama_layanan']; ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea name="keterangan" class="form-control" rows="3" required></textarea>
                        </div>

                    </div>

                    <div class="modal-footer justify-content-between">
                        <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button class="btn btn-primary" name="tambah_permohonan">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>