<?php
if (!isset($_SESSION['id'])) {
    return;
}

$id_login = $_SESSION['id'];
$q = mysqli_query($koneksi, "SELECT * FROM tb_akun WHERE id_akun=$id_login");
$data = mysqli_fetch_assoc($q);
?>

<div class="card">
    <div class="card-header">
        <h4>Profil Saya</h4>
    </div>

    <div class="card-body">
        <form action="../config/crud_profil.php" method="post">
            <input type="hidden" name="id_akun" value="<?= $data['id_akun']; ?>">

            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control"
                    value="<?= htmlspecialchars($data['nama']); ?>" required>
            </div>

            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control"
                    value="<?= htmlspecialchars($data['username']); ?>" required>
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

            <button class="btn btn-primary" name="simpan_profil">
                Simpan Perubahan
            </button>
        </form>
    </div>
</div>