<?php
include 'config.php';
include 'auth.php';
requireAdmin();

// Validasi id ada dan berupa angka
if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
    header('Location: list-siswa.php');
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM calon_siswa WHERE id = ?");
$stmt->execute([$id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

// Kalau id tidak ditemukan di database, jangan lanjut (mencegah error saat akses $data['nama'] dll)
if (!$data) {
    header('Location: list-siswa.php');
    exit;
}

$errEdit = $_GET['err'] ?? '';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Siswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        body { background: linear-gradient(135deg,#f8fafc 0%,#e2eafc 100%);}
        .card { border-radius: 1.3rem; box-shadow: 0 2px 12px rgba(0,0,0,0.08);}
        .form-label { font-weight: 500;}
    </style>
</head>
<body class="min-vh-100 d-flex align-items-center">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="card p-4">
                <div class="card-body">
                    <h3 class="mb-4 text-center"><i class="bi bi-pencil-square text-warning"></i> Edit Siswa</h3>
                    <?php if ($errEdit): ?>
                        <div class="alert alert-danger py-2"><?= htmlspecialchars($errEdit) ?></div>
                    <?php endif; ?>
                    <form action="proses-edit.php" method="POST">
                        <input type="hidden" name="id" value="<?= $data['id'] ?>">
                        <div class="mb-3">
                            <label class="form-label">Nama:</label>
                            <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($data['nama']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat:</label>
                            <textarea name="alamat" class="form-control" required rows="2"><?= htmlspecialchars($data['alamat']) ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin:</label>
                            <select name="jenis_kelamin" class="form-select" required>
                                <option value="Laki-laki" <?= $data['jenis_kelamin']=="Laki-laki"?"selected":"" ?>>Laki-laki</option>
                                <option value="Perempuan" <?= $data['jenis_kelamin']=="Perempuan"?"selected":"" ?>>Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Agama:</label>
                            <select name="agama" class="form-select" required>
                                <option value="Islam" <?= $data['agama']=="Islam"?"selected":"" ?>>Islam</option>
                                <option value="Kristen" <?= $data['agama']=="Kristen"?"selected":"" ?>>Kristen</option>
                                <option value="Katolik" <?= $data['agama']=="Katolik"?"selected":"" ?>>Katolik</option>
                                <option value="Hindu" <?= $data['agama']=="Hindu"?"selected":"" ?>>Hindu</option>
                                <option value="Buddha" <?= $data['agama']=="Buddha"?"selected":"" ?>>Buddha</option>
                                <option value="Konghucu" <?= $data['agama']=="Konghucu"?"selected":"" ?>>Konghucu</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sekolah Asal:</label>
                            <input type="text" name="sekolah_asal" class="form-control" value="<?= htmlspecialchars($data['sekolah_asal']) ?>" required>
                        </div>

                        <hr>
                        <h6 class="text-primary mb-3"><i class="bi bi-person-vcard"></i> Akses Portal Siswa</h6>
                        <div class="alert alert-warning small py-2">
                            <i class="bi bi-info-circle"></i> Siswa hanya bisa login ke portal kalau NIK <strong>dan</strong> password sudah diisi di sini.
                        </div>
                        <div class="mb-3">
                            <label class="form-label">NIK:</label>
                            <input type="text" name="nik" class="form-control" value="<?= htmlspecialchars($data['nik'] ?? '') ?>" maxlength="20" placeholder="Kosongkan jika belum ada NIK">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">
                                Password Portal Siswa:
                                <?= !empty($data['password']) ? '<span class="badge bg-success">Sudah diset</span>' : '<span class="badge bg-secondary">Belum diset</span>' ?>
                            </label>
                            <input type="password" name="password_siswa" class="form-control" placeholder="Kosongkan jika tidak mau ganti password">
                            <div class="form-text">Isi field ini hanya kalau mau membuat/mengganti password siswa. Kosongkan kalau tidak mau mengubah.</div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-warning px-4"><i class="bi bi-save"></i> Update</button>
                            <a href="list-siswa.php" class="btn btn-outline-secondary px-4">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>