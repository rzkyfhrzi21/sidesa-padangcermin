<?php
if (!in_array($_SESSION['level'], ['admin', 'kades'])) {
    return;
}

$isAdmin = $_SESSION['level'] === 'admin';
?>

<div class="card">
    <div class="card-header">
        <div class="d-sm-flex justify-content-between align-items-center">
            <h4>Informasi Desa</h4>

            <?php if ($isAdmin): ?>
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
                    Tambah Informasi
                </button>
            <?php endif; ?>
        </div>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped" id="example1">
            <thead class="bg-info">
                <tr>
                    <th>No</th>
                    <th>Jenis</th>
                    <th>Judul</th>
                    <th>Tanggal</th>
                    <th>Penulis</th>
                    <?php if ($isAdmin): ?>
                        <th width="15%">Aksi</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $q = mysqli_query($koneksi, "SELECT * FROM tb_informasi_desa ORDER BY tanggal DESC");
                while ($row = mysqli_fetch_assoc($q)) :
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['jenis']; ?></td>
                        <td><?= htmlspecialchars($row['judul']); ?></td>
                        <td><?= date('d-m-Y', strtotime($row['tanggal'])); ?></td>
                        <td><?= htmlspecialchars($row['penulis']); ?></td>

                        <?php if ($isAdmin): ?>
                            <td>
                                <button class="btn btn-warning btn-sm" data-toggle="modal"
                                    data-target="#modalUbah<?= $row['id_informasi']; ?>">Ubah</button>

                                <button class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#modalHapus<?= $row['id_informasi']; ?>">Hapus</button>
                            </td>
                        <?php endif; ?>
                    </tr>

                    <?php if ($isAdmin): ?>
                        <!-- MODAL UBAH -->
                        <div class="modal fade" id="modalUbah<?= $row['id_informasi']; ?>">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="../config/crud_informasi_desa.php" method="post">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Ubah Informasi Desa</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <div class="modal-body">
                                            <input type="hidden" name="id_informasi" value="<?= $row['id_informasi']; ?>">

                                            <div class="form-group">
                                                <label>Jenis</label>
                                                <select name="jenis" class="form-control" required>
                                                    <?php foreach (['Berita', 'Pengumuman', 'Agenda'] as $j): ?>
                                                        <option value="<?= $j; ?>" <?= $row['jenis'] == $j ? 'selected' : ''; ?>>
                                                            <?= $j; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Judul</label>
                                                <input type="text" name="judul" class="form-control"
                                                    value="<?= htmlspecialchars($row['judul']); ?>" required>
                                            </div>

                                            <div class="form-group">
                                                <label>Isi</label>
                                                <textarea name="isi" rows="4" class="form-control" required><?= htmlspecialchars($row['isi']); ?></textarea>
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

                        <!-- MODAL HAPUS -->
                        <div class="modal fade" id="modalHapus<?= $row['id_informasi']; ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="../config/crud_informasi_desa.php" method="post">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Hapus Informasi</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <div class="modal-body">
                                            <p>Hapus informasi <b><?= htmlspecialchars($row['judul']); ?></b>?</p>
                                            <input type="hidden" name="id_informasi" value="<?= $row['id_informasi']; ?>">
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
    <!-- MODAL TAMBAH -->
    <div class="modal fade" id="modalTambah">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="../config/crud_informasi_desa.php" method="post">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Informasi Desa</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Jenis</label>
                            <select name="jenis" class="form-control" required>
                                <option value="Berita">Berita</option>
                                <option value="Pengumuman">Pengumuman</option>
                                <option value="Agenda">Agenda</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" name="judul" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Isi</label>
                            <textarea name="isi" rows="4" class="form-control" required></textarea>
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