<?php
if (!in_array($_SESSION['level'], ['admin', 'operator'])) {
    return;
}

$id_kk = isset($_GET['id_kk']) ? (int)$_GET['id_kk'] : null;

// Info KK jika filter aktif
if ($id_kk) {
    $qkk = mysqli_query($koneksi, "SELECT * FROM tb_kk WHERE id_kk=$id_kk");
    $kk = mysqli_fetch_assoc($qkk);
}
?>

<div class="card">
    <div class="card-header">
        <div class="d-sm-flex justify-content-between align-items-center">
            <h4>
                <?= $id_kk ? 'Anggota Keluarga - KK ' . $kk['nomor_kk'] : 'Data Warga Desa'; ?>
            </h4>
            <button class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah">
                Tambah Warga
            </button>
        </div>
    </div>

    <div class="card-body">
        <?php if ($id_kk): ?>
            <div class="alert alert-info mb-3">
                <strong>Nomor KK:</strong> <?= $kk['nomor_kk']; ?> <br>
                <strong>Kepala Keluarga:</strong> <?= $kk['kepala_keluarga']; ?> <br>
                <strong>Alamat:</strong> <?= $kk['alamat']; ?> (RT <?= $kk['rt']; ?>/RW <?= $kk['rw']; ?>)
            </div>
        <?php endif; ?>

        <table id="example1" class="table table-bordered table-striped">
            <thead class="bg-info">
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>JK</th>
                    <th>TTL</th>
                    <th>Gol Darah</th>
                    <th>Agama</th>
                    <th>Alamat</th>
                    <th>No KK</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $no = 1;

                $sql = "SELECT w.*, k.nomor_kk FROM tb_warga w JOIN tb_kk k ON w.id_kk=k.id_kk";

                if ($id_kk) {
                    $sql .= " WHERE w.id_kk=$id_kk";
                }

                $q = mysqli_query($koneksi, $sql);

                while ($w = mysqli_fetch_assoc($q)) :
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $w['nik']; ?></td>
                        <td><?= $w['nama_lengkap']; ?></td>
                        <td><?= $w['jenis_kelamin']; ?></td>
                        <td><?= $w['tempat_lahir']; ?>, <?= date('d-m-Y', strtotime($w['tanggal_lahir'])); ?></td>
                        <td><?= $w['gol_darah']; ?></td>
                        <td><?= $w['agama']; ?></td>
                        <td><?= $w['alamat']; ?></td>
                        <td><?= $w['nomor_kk']; ?></td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-info dropdown-toggle" data-toggle="dropdown">Aksi</button>
                                <div class="dropdown-menu">
                                    <button class="dropdown-item" data-toggle="modal"
                                        data-target="#modal-ubah<?= $w['id_warga']; ?>">Ubah</button>
                                    <button class="dropdown-item text-danger" data-toggle="modal"
                                        data-target="#modal-hapus<?= $w['id_warga']; ?>">Hapus</button>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!-- ============ MODAL UBAH ============ -->
                    <div class="modal fade" id="modal-ubah<?= $w['id_warga']; ?>">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form action="../config/crud_warga.php" method="post">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Ubah Data Warga</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <div class="modal-body">
                                        <input type="hidden" name="id_warga" value="<?= $w['id_warga']; ?>">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>NIK</label>
                                                <input type="text" name="nik" class="form-control" value="<?= $w['nik']; ?>" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Nama Lengkap</label>
                                                <input type="text" name="nama_lengkap" class="form-control" value="<?= $w['nama_lengkap']; ?>" required>
                                            </div>
                                        </div>

                                        <div class="row mt-2">
                                            <div class="col-md-4">
                                                <label>Jenis Kelamin</label>
                                                <select name="jenis_kelamin" class="form-control">
                                                    <option value="L" <?= $w['jenis_kelamin'] == 'L' ? 'selected' : ''; ?>>Laki-laki</option>
                                                    <option value="P" <?= $w['jenis_kelamin'] == 'P' ? 'selected' : ''; ?>>Perempuan</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Golongan Darah</label>
                                                <select name="gol_darah" class="form-control">
                                                    <?php foreach (['-', 'A', 'B', 'AB', 'O'] as $g) : ?>
                                                        <option value="<?= $g; ?>" <?= $w['gol_darah'] == $g ? 'selected' : ''; ?>><?= $g; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Agama</label>
                                                <input type="text" name="agama" class="form-control" value="<?= $w['agama']; ?>" required>
                                            </div>
                                        </div>

                                        <div class="row mt-2">
                                            <div class="col-md-6">
                                                <label>Tempat Lahir</label>
                                                <input type="text" name="tempat_lahir" class="form-control" value="<?= $w['tempat_lahir']; ?>" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Tanggal Lahir</label>
                                                <input type="date" name="tanggal_lahir" class="form-control" value="<?= $w['tanggal_lahir']; ?>" required>
                                            </div>
                                        </div>

                                        <div class="form-group mt-2">
                                            <label>Alamat</label>
                                            <textarea name="alamat" class="form-control" required><?= $w['alamat']; ?></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label>No KK</label>
                                            <select name="id_kk" class="form-control" required>
                                                <?php
                                                $kklist = mysqli_query($koneksi, "SELECT * FROM tb_kk");
                                                while ($k = mysqli_fetch_assoc($kklist)) :
                                                ?>
                                                    <option value="<?= $k['id_kk']; ?>" <?= $w['id_kk'] == $k['id_kk'] ? 'selected' : ''; ?>>
                                                        <?= $k['nomor_kk']; ?> - <?= $k['kepala_keluarga']; ?>
                                                    </option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="modal-footer justify-content-between">
                                        <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button class="btn btn-primary" name="ubah_warga">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- ============ MODAL HAPUS ============ -->
                    <div class="modal fade" id="modal-hapus<?= $w['id_warga']; ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="../config/crud_warga.php" method="post">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Hapus Data Warga</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Yakin hapus <b><?= $w['nama_lengkap']; ?></b>?</p>
                                        <input type="hidden" name="id_warga" value="<?= $w['id_warga']; ?>">
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button class="btn btn-danger" name="hapus_warga">Hapus</button>
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

<!-- ============ MODAL TAMBAH ============ -->
<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="../config/crud_warga.php" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Warga</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">
                            <label>NIK</label>
                            <input type="text" name="nik" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control">
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Golongan Darah</label>
                            <select name="gol_darah" class="form-control">
                                <option value="-">-</option>
                                <option>A</option>
                                <option>B</option>
                                <option>AB</option>
                                <option>O</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Agama</label>
                            <input type="text" name="agama" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label>Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group mt-2">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>No KK</label>
                        <select name="id_kk" class="form-control" required>
                            <?php
                            $kklist = mysqli_query($koneksi, "SELECT * FROM tb_kk");
                            while ($k = mysqli_fetch_assoc($kklist)) :
                            ?>
                                <option value="<?= $k['id_kk']; ?>"
                                    <?= $id_kk == $k['id_kk'] ? 'selected' : ''; ?>>
                                    <?= $k['nomor_kk']; ?> - <?= $k['kepala_keluarga']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                </div>

                <div class="modal-footer justify-content-between">
                    <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" name="tambah_warga">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>