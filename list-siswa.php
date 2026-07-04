<?php
include 'config.php';
include 'auth.php';
requireLogin(); // semua yang login boleh lihat, tapi cuma admin yang boleh ubah data

$stmt = $pdo->query("SELECT * FROM calon_siswa ORDER BY id DESC");
$siswa = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Daftar Siswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        body { background: linear-gradient(135deg,#f8fafc 0%,#e2eafc 100%);}
        .table thead { background: #047bfd; color: #fff;}
        .table tbody tr:hover { background: #f1f8ff;}
        .card { border-radius: 1.3rem; box-shadow: 0 2px 14px rgba(0,123,255,0.07);}
        .btn-sm { font-size: 0.93em;}
    </style>
</head>
<body class="py-4">
<div class="container">
    <div class="card p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0"><i class="bi bi-card-list text-primary"></i> Daftar Siswa</h3>
            <div>
                <?php if (isAdmin()): ?>
                    <a href="form-daftar.php" class="btn btn-success btn-sm me-2"><i class="bi bi-plus-circle"></i> Tambah Siswa</a>
                <?php endif; ?>
                <a href="index.php" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left"></i> Kembali</a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table align-middle table-bordered table-striped mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Jenis Kelamin</th>
                        <th>Agama</th>
                        <th>Sekolah Asal</th>
                        <th>Akun Portal</th>
                        <th style="width:100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($siswa)): ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted">Belum ada data siswa.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($siswa as $i => $row): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><?= htmlspecialchars($row['nama']) ?></td>
                                <td><?= htmlspecialchars($row['alamat']) ?></td>
                                <td><?= htmlspecialchars($row['jenis_kelamin']) ?></td>
                                <td><?= htmlspecialchars($row['agama']) ?></td>
                                <td><?= htmlspecialchars($row['sekolah_asal']) ?></td>
                                <td class="text-center">
                                    <?php if (!empty($row['nik']) && !empty($row['password'])): ?>
                                        <span class="badge bg-success">Aktif</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Belum aktif</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isAdmin()): ?>
                                        <a href="form-edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm mb-1"><i class="bi bi-pencil-square"></i></a>
                                        <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Yakin ingin menghapus siswa ini?')"><i class="bi bi-trash"></i></a>
                                    <?php else: ?>
                                        <span class="text-muted small">-</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>