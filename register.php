<?php
include 'config.php';
if (session_status() === PHP_SESSION_NONE) session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$err = $_GET['err'] ?? '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Akun Baru - Satu Bangsa Harmoni Batam</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg,#f8fafc 0%,#e2eafc 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .card {
            border-radius: 1.3rem;
            box-shadow: 0 2px 18px rgba(0,123,255,0.11);
        }
        .logo-register {
            max-height: 70px;
            margin-bottom: 1.4rem;
            filter: drop-shadow(0 4px 16px #007bff33);
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card p-4">
                <div class="card-body">
                    <div class="text-center mb-3">
                        <img src="https://harmoni.satubangsa.sch.id/assets/img/satubangsa-logo-vertical.png" class="logo-register" alt="Satu Bangsa Harmoni Batam">
                        <h3 class="mb-1 fw-bold" style="color:#007bff;"><i class="bi bi-person-plus"></i> Daftar Akun Baru</h3>
                        <div class="small text-secondary mb-2">Sistem Pendaftaran Satu Bangsa Harmoni Batam</div>
                    </div>
                    <?php if ($err): ?>
                        <div class="alert alert-danger py-2"><?= htmlspecialchars($err) ?></div>
                    <?php endif; ?>
                    <form action="proses-register.php" method="post" autocomplete="off">
                        <div class="mb-3">
                            <label class="form-label fw-semibold"><i class="bi bi-person"></i> Username</label>
                            <input name="username" class="form-control" required autofocus placeholder="Username">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold"><i class="bi bi-lock"></i> Password</label>
                            <input type="password" name="password" class="form-control" required placeholder="Password">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold"><i class="bi bi-lock-fill"></i> Ulangi Password</label>
                            <input type="password" name="password2" class="form-control" required placeholder="Ulangi Password">
                        </div>
                        <button class="btn btn-primary w-100 py-2 fw-bold" type="submit">
                            <i class="bi bi-person-plus"></i> Daftar
                        </button>
                    </form>
                    <div class="mt-4 text-center small">
                        Sudah punya akun? <a href="login.php" class="text-primary fw-semibold">Login</a>
                    </div>
                    <div class="mt-2 text-center">
                        <a href="index.php" class="btn btn-link text-decoration-none text-secondary small"><i class="bi bi-arrow-left"></i> Kembali ke Beranda</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>