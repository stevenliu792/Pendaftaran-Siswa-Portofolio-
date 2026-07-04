<?php
include 'config.php';
if (session_status() === PHP_SESSION_NONE) session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login-siswa.php');
    exit;
}

$nik = trim($_POST['nik'] ?? '');
$password = $_POST['password'] ?? '';

if ($nik === '' || $password === '') {
    header('Location: login-siswa.php?err=Isi%20NIK%20dan%20password');
    exit;
}

$stmt = $pdo->prepare('SELECT id, nama, nik, password FROM calon_siswa WHERE nik = ? LIMIT 1');
$stmt->execute([$nik]);
$siswa = $stmt->fetch(PDO::FETCH_ASSOC);

// Kalau NIK tidak ditemukan, ATAU ditemukan tapi belum punya password (admin belum aktifkan akunnya)
if (!$siswa || empty($siswa['password'])) {
    header('Location: login-siswa.php?err=NIK%20belum%20terdaftar%20atau%20akun%20belum%20diaktifkan%20admin');
    exit;
}

if (!password_verify($password, $siswa['password'])) {
    header('Location: login-siswa.php?err=NIK%20atau%20password%20salah');
    exit;
}

// Login berhasil
$_SESSION['siswa_id'] = $siswa['id'];
$_SESSION['siswa_nama'] = $siswa['nama'];
header('Location: portal-siswa.php');
exit;
