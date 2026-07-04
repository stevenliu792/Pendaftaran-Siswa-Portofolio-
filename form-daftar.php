<?php
include 'config.php';
include 'auth.php';
requireAdmin();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Form Pendaftaran Siswa</title>
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
                    <h3 class="mb-4 text-center"><i class="bi bi-pencil-square text-primary"></i> Form Pendaftaran Siswa</h3>
                    <form action="proses-pendaftaran.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Nama:</label>
                            <input type="text" name="nama" class="form-control" required autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat:</label>
                            <textarea name="alamat" class="form-control" required rows="2"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin:</label>
                            <select name="jenis_kelamin" class="form-select" required>
                                <option value="">-- Pilih --</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Agama:</label>
                            <select name="agama" class="form-select" required>
                                <option value="">-- Pilih Agama --</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Katolik">Katolik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Konghucu">Konghucu</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sekolah Asal:</label>
                            <input type="text" name="sekolah_asal" class="form-control" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save"></i> Simpan</button>
                            <a href="index.php" class="btn btn-outline-secondary px-4">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>