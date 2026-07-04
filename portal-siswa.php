<?php
include 'config.php';
include 'auth.php';
requireSiswaLogin();

$stmt = $pdo->prepare("SELECT * FROM calon_siswa WHERE id = ?");
$stmt->execute([$_SESSION['siswa_id']]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

// Jaga-jaga kalau data ternyata sudah dihapus admin setelah siswa login
if (!$data) {
    session_unset();
    session_destroy();
    header('Location: login-siswa.php?err=Data%20tidak%20ditemukan');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Portal Siswa - Profil Saya</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        body { background: linear-gradient(135deg,#f8fafc 0%,#e2eafc 100%);}
        .card { border-radius: 1.3rem; box-shadow: 0 2px 14px rgba(0,123,255,0.07);}
        .data-row { padding: 0.6rem 0; border-bottom: 1px solid #eee; }
        .data-row:last-child { border-bottom: none; }
        .data-label { color: #6c757d; font-size: 0.85rem; }
        .data-value { font-weight: 600; }
    </style>
</head>
<body class="py-4">
<div class="container" style="max-width:650px">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0"><i class="bi bi-mortarboard text-primary"></i> Portal Siswa</h4>
        <a href="logout.php" class="btn btn-outline-danger btn-sm"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </div>
    <div class="card p-4">
        <div class="card-body">
            <h5 class="mb-4">Halo, <?= htmlspecialchars($data['nama']) ?> 👋</h5>

            <div class="data-row">
                <div class="data-label">Nama Lengkap</div>
                <div class="data-value"><?= htmlspecialchars($data['nama']) ?></div>
            </div>
            <div class="data-row">
                <div class="data-label">NIK</div>
                <div class="data-value"><?= htmlspecialchars($data['nik']) ?></div>
            </div>
            <div class="data-row">
                <div class="data-label">Alamat</div>
                <div class="data-value"><?= htmlspecialchars($data['alamat']) ?></div>
            </div>
            <div class="data-row">
                <div class="data-label">Jenis Kelamin</div>
                <div class="data-value"><?= htmlspecialchars($data['jenis_kelamin']) ?></div>
            </div>
            <div class="data-row">
                <div class="data-label">Agama</div>
                <div class="data-value"><?= htmlspecialchars($data['agama']) ?></div>
            </div>
            <div class="data-row">
                <div class="data-label">Sekolah Asal</div>
                <div class="data-value"><?= htmlspecialchars($data['sekolah_asal']) ?></div>
            </div>
            <div class="data-row">
                <div class="data-label">Tanggal Daftar</div>
                <div class="data-value"><?= htmlspecialchars($data['tanggal_daftar']) ?></div>
            </div>

            <div class="alert alert-info mt-4 mb-0 small">
                <i class="bi bi-info-circle"></i> Data ini hanya bisa dilihat, bukan diubah. Kalau ada data yang salah, silakan hubungi admin sekolah.
            </div>
        </div>
    </div>
</div>
</body>
</html>
