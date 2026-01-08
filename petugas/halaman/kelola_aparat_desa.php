<?php
// Hanya admin & kades yang boleh masuk halaman
if (!in_array($_SESSION['level'], ['admin', 'kades'])) {
    return;
}

// Flag role
$isAdmin = ($_SESSION['level'] === 'admin');
?>

<div class="card">
    <div class="card-header">
        <div class="d-sm-flex justify-content-between align-items-center">
            <h4>Aparat Desa</h4>

            <?php if ($isAdmin): ?>
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
                    Tambah Aparat
                </button>
            <?php endif; ?>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped" id="example1">
            <thead class="bg-info">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Periode</th>
                    <?php if ($isAdmin): ?>
                        <th width="15%">Aksi</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>

                <?php
                $no = 1;
                $q = mysqli_query($koneksi, "SELECT * FROM tb_aparat_desa");
                while ($row = mysqli_fetch_assoc($q)) :
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($row['nama_aparat']); ?></td>
                        <td><?= htmlspecialchars($row['jabatan']); ?></td>
                        <td><?= htmlspecialchars($row['periode']); ?></td>

                        <?php if ($isAdmin): ?>
                            <td>
                                <button class="btn btn-warning btn-sm" data-toggle="modal"
                                    data-target="#modalUbah<?= $row['id_aparat']; ?>">Ubah</button>

                                <button class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#modalHapus<?= $row['id_aparat']; ?>">Hapus</button>
                            </td>
                        <?php endif; ?>
                    </tr>

                    <?php if ($isAdmin): ?>
                        <!-- ===== MODAL UBAH ===== -->
                        <div class="modal fade" id="modalUbah<?= $row['id_aparat']; ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="../config/crud_aparat_desa.php" method="post">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Ubah Aparat Desa</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <div class="modal-body">
                                            <input type="hidden" name="id_aparat" value="<?= $row['id_aparat']; ?>">

                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input type="text" name="nama_aparat" class="form-control"
                                                    value="<?= htmlspecialchars($row['nama_aparat']); ?>" required>
                                            </div>

                                            <div class="form-group">
                                                <label>Jabatan</label>
                                                <input type="text" name="jabatan" class="form-control"
                                                    value="<?= htmlspecialchars($row['jabatan']); ?>" required>
                                            </div>

                                            <div class="form-group">
                                                <label>Periode</label>
                                                <input type="text" name="periode" class="form-control"
                                                    value="<?= htmlspecialchars($row['periode']); ?>" required>
                                            </div>
                                        </div>

                                        <div class="modal-footer justify-content-between">
                                            <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <button class="btn btn-primary" name="ubah">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- ===== MODAL HAPUS ===== -->
                        <div class="modal fade" id="modalHapus<?= $row['id_aparat']; ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="../config/crud_aparat_desa.php" method="post">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Hapus Aparat</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <div class="modal-body">
                                            <p>Hapus aparat <b><?= htmlspecialchars($row['nama_aparat']); ?></b>?</p>
                                            <input type="hidden" name="id_aparat" value="<?= $row['id_aparat']; ?>">
                                        </div>

                                        <div class="modal-footer justify-content-between">
                                            <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <button class="btn btn-danger" name="hapus">Hapus</button>
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

<?php if ($isAdmin): ?>
    <!-- ===== MODAL TAMBAH ===== -->
    <div class="modal fade" id="modalTambah">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="../config/crud_aparat_desa.php" method="post">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Aparat Desa</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama_aparat" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Jabatan</label>
                            <input type="text" name="jabatan" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Periode</label>
                            <input type="text" name="periode" class="form-control" required>
                        </div>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button class="btn btn-primary" name="tambah">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>