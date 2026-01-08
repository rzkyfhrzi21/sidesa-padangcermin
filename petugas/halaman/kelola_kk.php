<?php
// Hak akses: admin & operator
if (!in_array($_SESSION['level'], ['admin', 'operator'])) {
    return;
}
?>

<div class="card">
    <div class="card-header">
        <div class="d-sm-flex justify-content-between align-items-center">
            <h4>Data Kartu Keluarga</h4>
            <button class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah-kk">
                Tambah KK
            </button>
        </div>
    </div>

    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead class="bg-info">
                <tr>
                    <th class="text-center">No</th>
                    <th>No KK</th>
                    <th>Kepala Keluarga</th>
                    <th>Alamat</th>
                    <th>RT/RW</th>
                    <th>Kode Pos</th>
                    <th class="text-center">Anggota</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $no = 1;
                $kk = mysqli_query($koneksi, "
                    SELECT k.*, 
                        (SELECT COUNT(*) FROM tb_warga w WHERE w.id_kk = k.id_kk) AS jumlah_anggota
                    FROM tb_kk k
                    ORDER BY k.id_kk DESC
                ");

                while ($row = mysqli_fetch_assoc($kk)) :
                ?>
                    <tr>
                        <td class="text-center"><?= $no++; ?></td>
                        <td><?= htmlspecialchars($row['nomor_kk']); ?></td>
                        <td><?= htmlspecialchars($row['kepala_keluarga']); ?></td>
                        <td><?= htmlspecialchars($row['alamat']); ?></td>
                        <td><?= $row['rt']; ?>/<?= $row['rw']; ?></td>
                        <td><?= $row['kode_pos']; ?></td>
                        <td class="text-center">
                            <span class="badge badge-info"><?= $row['jumlah_anggota']; ?> Orang</span>
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                    Aksi
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="?halaman=warga&id_kk=<?= $row['id_kk']; ?>">
                                        Lihat Anggota
                                    </a>
                                    <button class="dropdown-item" data-toggle="modal"
                                        data-target="#modal-ubah-kk<?= $row['id_kk']; ?>">
                                        Ubah
                                    </button>
                                    <button class="dropdown-item text-danger" data-toggle="modal"
                                        data-target="#modal-hapus-kk<?= $row['id_kk']; ?>">
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!-- ================= MODAL UBAH KK ================= -->
                    <div class="modal fade" id="modal-ubah-kk<?= $row['id_kk']; ?>">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form action="../config/crud_kk.php" method="post">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Ubah Data Kartu Keluarga</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">

                                        <input type="hidden" name="id_kk" value="<?= $row['id_kk']; ?>">

                                        <div class="form-group">
                                            <label>Nomor KK</label>
                                            <input type="text" name="nomor_kk" class="form-control"
                                                value="<?= htmlspecialchars($row['nomor_kk']); ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Kepala Keluarga</label>
                                            <select name="kepala_keluarga" class="form-control" required>
                                                <option value="">-- Pilih Kepala Keluarga --</option>
                                                <?php
                                                $warga_kk = mysqli_query($koneksi, "
                                                    SELECT nama_lengkap 
                                                    FROM tb_warga 
                                                    WHERE id_kk = '{$row['id_kk']}'
                                                ");
                                                while ($w = mysqli_fetch_assoc($warga_kk)) :
                                                ?>
                                                    <option value="<?= $w['nama_lengkap']; ?>"
                                                        <?= ($w['nama_lengkap'] == $row['kepala_keluarga']) ? 'selected' : ''; ?>>
                                                        <?= $w['nama_lengkap']; ?>
                                                    </option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea name="alamat" class="form-control" rows="2" required><?= htmlspecialchars($row['alamat']); ?></textarea>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>RT</label>
                                                <input type="text" name="rt" class="form-control" value="<?= $row['rt']; ?>" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label>RW</label>
                                                <input type="text" name="rw" class="form-control" value="<?= $row['rw']; ?>" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Kode Pos</label>
                                                <input type="text" name="kode_pos" class="form-control" value="<?= $row['kode_pos']; ?>" required>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="submit" name="ubah_kk" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- ================= MODAL HAPUS KK ================= -->
                    <div class="modal fade" id="modal-hapus-kk<?= $row['id_kk']; ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="../config/crud_kk.php" method="post">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Hapus Kartu Keluarga</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <p>
                                            Hapus KK <strong><?= $row['nomor_kk']; ?></strong>?
                                            <br><small class="text-danger">
                                                Pastikan seluruh anggota keluarga telah dipindahkan atau dihapus.
                                            </small>
                                        </p>
                                        <input type="hidden" name="id_kk" value="<?= $row['id_kk']; ?>">
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="submit" name="hapus_kk" class="btn btn-danger">Hapus</button>
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

<!-- ================= MODAL TAMBAH KK ================= -->
<div class="modal fade" id="modal-tambah-kk">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="../config/crud_kk.php" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Kartu Keluarga</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Nomor KK</label>
                        <input type="text" name="nomor_kk" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Kepala Keluarga</label>
                        <select name="kepala_keluarga" class="form-control select2" required>
                            <option value="">-- Pilih Kepala Keluarga --</option>
                            <?php
                            $warga_belum_kk = mysqli_query($koneksi, "
                                SELECT nama_lengkap 
                                FROM tb_warga 
                                WHERE id_kk IS NULL
                            ");
                            while ($w = mysqli_fetch_assoc($warga_belum_kk)) :
                            ?>
                                <option value="<?= $w['nama_lengkap']; ?>">
                                    <?= $w['nama_lengkap']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" rows="2" required></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <label>RT</label>
                            <input type="text" name="rt" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label>RW</label>
                            <input type="text" name="rw" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label>Kode Pos</label>
                            <input type="text" name="kode_pos" class="form-control" required>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" name="tambah_kk" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>