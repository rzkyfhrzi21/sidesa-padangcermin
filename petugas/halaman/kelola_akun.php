<?php
if ($_SESSION['level'] !== 'admin') {
    return;
}
?>

<div class="card">
    <div class="card-header">
        <div class="d-sm-flex justify-content-between align-items-center">
            <h4>Manajemen Akun</h4>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah">
                Tambah Akun
            </button>
        </div>
    </div>

    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead class="bg-info">
                <tr>
                    <th class="text-center">No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Level</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $sql = mysqli_query($koneksi, "SELECT * FROM tb_akun");
                while ($akun = mysqli_fetch_assoc($sql)) :
                ?>
                    <tr>
                        <td class="text-center"><?= $no++; ?></td>
                        <td><?= htmlspecialchars($akun['nama']); ?></td>
                        <td><?= htmlspecialchars($akun['username']); ?></td>
                        <td><?= ucfirst($akun['level']); ?></td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-info dropdown-toggle dropdown-icon"
                                    data-toggle="dropdown">
                                    Aksi
                                </button>
                                <div class="dropdown-menu">
                                    <button class="dropdown-item" data-toggle="modal"
                                        data-target="#modal-ubah<?= $akun['id_akun']; ?>">
                                        Ubah
                                    </button>
                                    <button class="dropdown-item text-danger" data-toggle="modal"
                                        data-target="#modal-hapus<?= $akun['id_akun']; ?>">
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!-- ================= MODAL UBAH ================= -->
                    <div class="modal fade" id="modal-ubah<?= $akun['id_akun']; ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="../config/crud_akun.php" method="post">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Ubah Akun</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <div class="modal-body">
                                        <input type="hidden" name="id_akun" value="<?= $akun['id_akun']; ?>">

                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" name="nama" class="form-control"
                                                value="<?= htmlspecialchars($akun['nama']); ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" name="username" class="form-control"
                                                value="<?= htmlspecialchars($akun['username']); ?>" required>
                                        </div>

                                        <hr>
                                        <small class="text-muted">
                                            Kosongkan password jika tidak ingin mengganti
                                        </small>

                                        <div class="form-group mt-2">
                                            <label>Password Baru</label>
                                            <input type="password" name="password" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Ulangi Password</label>
                                            <input type="password" name="ulangi_password" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Level</label>
                                            <select name="level" class="form-control" required>
                                                <option value="admin" <?= $akun['level'] == 'admin' ? 'selected' : ''; ?>>
                                                    Admin
                                                </option>
                                                <option value="operator" <?= $akun['level'] == 'operator' ? 'selected' : ''; ?>>
                                                    Operator
                                                </option>
                                                <option value="kades" <?= $akun['level'] == 'kades' ? 'selected' : ''; ?>>
                                                    Kepala Desa
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                            Batal
                                        </button>
                                        <button type="submit" name="ubah_akun" class="btn btn-primary">
                                            Simpan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- ================= MODAL HAPUS ================= -->
                    <div class="modal fade" id="modal-hapus<?= $akun['id_akun']; ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="../config/crud_akun.php" method="post">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Hapus Akun</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <p>
                                            Yakin ingin menghapus akun
                                            <b><?= htmlspecialchars($akun['username']); ?></b>?
                                        </p>
                                        <input type="hidden" name="id_akun" value="<?= $akun['id_akun']; ?>">
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                            Batal
                                        </button>
                                        <button type="submit" name="hapus_akun" class="btn btn-danger">
                                            Hapus
                                        </button>
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

<!-- ================= MODAL TAMBAH ================= -->
<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="../config/crud_akun.php" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Akun</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Ulangi Password</label>
                        <input type="password" name="ulangi_password" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Level</label>
                        <select name="level" class="form-control" required>
                            <option value="">-- Pilih Level --</option>
                            <option value="admin">Admin</option>
                            <option value="operator">Operator</option>
                            <option value="kades">Kepala Desa</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" name="tambah_akun" class="btn btn-primary">
                        Tambah
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>