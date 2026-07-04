<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$logged_in = isset($_SESSION['user_id']);
$username = $_SESSION['username'] ?? '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Pendaftaran Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
body {
    background:
        linear-gradient(135deg, rgba(248,250,252,0.85) 0%, rgba(226,234,252,0.85) 100%),
        url('https://harmoni.satubangsa.sch.id/assets/img/Harmoni_new_background.jpg') center center fixed no-repeat;
    background-size: cover;
    position: relative;
}
.bg-blur {
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    z-index: 0;
    backdrop-filter: blur(4px);
    -webkit-backdrop-filter: blur(4px);
    background: rgba(255,255,255,0.1);
    pointer-events: none;
}
main, nav, footer, .card, .menu-card, .hero {
    position: relative;
    z-index: 1;
}
/* Menambahkan background solid pada hero section agar logo lebih jelas */
.hero {
    background: rgba(255, 255, 255, 0.9); /* Warna putih semi-transparan */
    border-radius: 12px; /* Menambahkan sedikit border-radius agar serasi */
}
footer {
    background: rgba(255,255,255,0.7);
    backdrop-filter: blur(6px);
    -webkit-backdrop-filter: blur(6px);
    border-radius: 12px;
    padding: 6px 16px;
    margin-bottom: 18px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.07);
    display: inline-block;
}
.user-info {
    background-color: rgba(255, 255, 255, 0.8); /* Latar belakang putih semi-transparan */
    border-radius: 8px; /* Sudut melengkung */
    padding: 8px 12px; /* Padding untuk ruang di dalam */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Bayangan halus */
}
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#"><i class="bi bi-journal-richtext"></i> Pendaftaran Siswa</a>
        <div class="ms-auto d-flex align-items-center gap-3">
            <?php if ($logged_in): ?>
                <div class="userbox">
                    <div class="user-info d-flex align-items-center">
                        <i class="bi bi-person-circle fs-4 text-primary"></i>
                        <span class="fw-semibold ms-2"><?= htmlspecialchars($username) ?></span>
                        <a href="logout.php" class="btn btn-danger btn-sm ms-2">Logout</a>
                    </div>
                </div>
            <?php else: ?>
                <a href="login-siswa.php" class="btn btn-outline-light btn-lg px-4 me-2"><i class="bi bi-mortarboard"></i> Portal Siswa</a>
                <a href="login.php" class="btn btn-warning btn-lg px-4 me-2"><i class="bi bi-box-arrow-in-right"></i> Login</a>
                <a href="register.php" class="btn btn-primary btn-lg px-4"><i class="bi bi-person-plus"></i> Register</a>

            <?php endif; ?>
        </div>
    </div>
</nav>

<main class="container mt-5 mb-5">
    <?php if (!$logged_in): ?> <!-- Tambahkan kondisi untuk menampilkan carousel hanya jika belum login -->
        <div id="carouselSatuBangsa" class="carousel slide mb-5 shadow" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://harmoni.satubangsa.sch.id/assets/img/aboutus/SMP.jpeg" class="d-block w-100" alt="Foto 1" style="height: 300px; object-fit: cover;">
                </div>
                <div class="carousel-item">
                    <img src="https://asset.terdepan.co.id/wp-content/uploads/2024/01/IMG-20240111-WA0013.jpg" class="d-block w-100" alt="Foto 2" style="height: 300px; object-fit: cover;">
                </div>
                <div class="carousel-item">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/3/37/Sekolah_Dasar_Satu_Bangsa_Harmoni_Batam.jpg" class="d-block w-100" alt="Foto 3" style="height: 300px; object-fit: cover;">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselSatuBangsa" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                <span class="visually-hidden">Sebelumnya</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselSatuBangsa" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
                <span class="visually-hidden">Berikutnya</span>
            </button>
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselSatuBangsa" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselSatuBangsa" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselSatuBangsa" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
        </div>
    <?php endif; ?>
    <section class="hero p-5 mb-4 shadow-lg">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-5 fw-bold mb-3">Selamat Datang di Sistem Pendaftaran Siswa</h1>
            <p class="lead mb-4">
                <?php if (!$logged_in): ?>
                    Silahkan login untuk melakukan pendaftaran siswa baru, melihat data siswa, atau mengelola profil Anda.
                <?php else: ?>
                    Silakan lakukan pendaftaran siswa baru, lihat data siswa, atau kelola profil Anda dengan mudah dan cepat melalui dashboard ini.
                <?php endif; ?>
            </p>
                <?php if (!$logged_in): ?>
                        <a href="login.php" class="btn btn-primary btn-lg px-4 me-2"><i class="bi bi-box-arrow-in-right"></i> Login</a>
                        <a href="register.php" class="btn btn-success btn-lg px-4"><i class="bi bi-person-plus"></i> Register</a>
                <?php else: ?>
                <?php endif; ?>
            </div>
            <div class="col-lg-4 d-none d-lg-block text-center">
                <img src="https://harmoni.satubangsa.sch.id/assets/img/satubangsa-logo-vertical.png"
                    alt="Satu Bangsa Harmoni Batam"
                    class="img-fluid rounded shadow"
                    style="max-height:260px;">
                <!-- <div class="small mt-2 fst-italic text-">Satu Bangsa Harmoni Batam</div> -->
            </div>
        </div>
    </section>

    <?php if ($logged_in): ?>
        <div class="row gy-4">
            <div class="col-md-4">
                <a href="form-daftar.php" class="text-decoration-none text-dark">
                    <div class="menu-card card p-4 text-center h-100">
                        <i class="bi bi-file-earmark-plus fs-1 text-success mb-3"></i>
                        <h5 class="fw-bold">Daftar Siswa Baru</h5>
                        <div class="text-secondary">Tambah data siswa baru dengan mudah.</div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="list-siswa.php" class="text-decoration-none text-dark">
                    <div class="menu-card card p-4 text-center h-100">
                        <i class="bi bi-card-list fs-1 text-primary mb-3"></i>
                        <h5 class="fw-bold">Lihat Data Siswa</h5>
                        <div class="text-secondary">Tampilkan & kelola semua data siswa.</div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="profil.php" class="text-decoration-none text-dark">
                    <div class="menu-card card p-4 text-center h-100">
                        <i class="bi bi-person fs-1 text-warning mb-3"></i>
                        <h5 class="fw-bold">Profil Sekolah</h5>
                        <div class="text-secondary">Lihat profil  tentang sekolah.</div>
                    </div>
                </a>
            </div>
        </div>
    <?php endif; ?>
</main>

<div class="d-flex justify-content-center">
    <footer class="text-center text-secondary mt-5 mb-3 small">
        &copy; <?= date('Y') ?> Sistem Pendaftaran Siswa.
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
