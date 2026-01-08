<?php
if (!in_array($_SESSION['level'], ['admin', 'operator'])) {
    return;
}
?>

<div class="card">
    <div class="card-header">
        <div class="d-sm-flex justify-content-between align-items-center">
            <h4>Data Layanan</h4>
            <button class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah">
                Tambah Layanan
            </button>
        </div>
    </div>

    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead class="bg-info">
                <tr>
                    <th width="5%">No</th>
                    <th>Kode Layanan</th>
                    <th>Nama Layanan</th>
                    <th>Deskripsi</th>
                    <th width="10%" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $no = 1;
                $layanan = mysqli_query($koneksi, "SELECT * FROM tb_layanan ORDER BY id_layanan DESC");
                while ($row = mysqli_fetch_assoc($layanan)) :
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><strong><?= htmlspecialchars($row['kode_layanan']); ?></strong></td>
                        <td><?= htmlspecialchars($row['nama_layanan']); ?></td>
                        <td><?= htmlspecialchars($row['deskripsi']); ?></td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                    Aksi
                                </button>
                                <div class="dropdown-menu">
                                    <button class="dropdown-item" data-toggle="modal"
                                        data-target="#modal-ubah<?= $row['id_layanan']; ?>">Ubah</button>
                                    <button class="dropdown-item text-danger" data-toggle="modal"
                                        data-target="#modal-hapus<?= $row['id_layanan']; ?>">Hapus</button>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!-- ===== MODAL UBAH ===== -->
                    <div class="modal fade" id="modal-ubah<?= $row['id_layanan']; ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="../config/crud_layanan.php" method="post">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Ubah Layanan</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <div class="modal-body">
                                        <input type="hidden" name="id_layanan" value="<?= $row['id_layanan']; ?>">

                                        <div class="form-group">
                                            <label>Kode Layanan</label>
                                            <input type="text" name="kode_layanan" class="form-control"
                                                value="<?= htmlspecialchars($row['kode_layanan']); ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Nama Layanan</label>
                                            <input type="text" name="nama_layanan" class="form-control"
                                                value="<?= htmlspecialchars($row['nama_layanan']); ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Deskripsi</label>
                                            <textarea name="deskripsi" class="form-control" rows="3" required>
<?= htmlspecialchars($row['deskripsi']); ?></textarea>
                                        </div>
                                    </div>

                                    <div class="modal-footer justify-content-between">
                                        <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button class="btn btn-primary" name="ubah_layanan">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- ===== MODAL HAPUS ===== -->
                    <div class="modal fade" id="modal-hapus<?= $row['id_layanan']; ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="../config/crud_layanan.php" method="post">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Hapus Layanan</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <div class="modal-body">
                                        <p>
                                            Yakin hapus layanan
                                            <strong><?= htmlspecialchars($row['kode_layanan']); ?></strong>?
                                        </p>
                                        <input type="hidden" name="id_layanan" value="<?= $row['id_layanan']; ?>">
                                    </div>

                                    <div class="modal-footer justify-content-between">
                                        <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button class="btn btn-danger" name="hapus_layanan">Hapus</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                <?php endwhile; ?>

            </tbody>
        </table>
    </div>
</div>

<!-- ===== MODAL TAMBAH ===== -->
<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="../config/crud_layanan.php" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Layanan</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>Kode Layanan</label>
                        <input type="text" name="kode_layanan" class="form-control"
                            placeholder="Contoh: LYN-001" required>
                    </div>

                    <div class="form-group">
                        <label>Nama Layanan</label>
                        <input type="text" name="nama_layanan" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" name="tambah_layanan">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>