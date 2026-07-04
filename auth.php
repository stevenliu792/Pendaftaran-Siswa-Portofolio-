<?php
// File ini berisi fungsi bantuan untuk cek login & role.
// Panggil include 'auth.php'; setelah include 'config.php'; di file yang butuh proteksi.

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Pastikan user sudah login. Kalau belum, redirect ke login.php.
 */
function requireLogin() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }
}

/**
 * Pastikan user sudah login DAN role-nya admin. Kalau tidak, redirect.
 */
function requireAdmin() {
    requireLogin();
    if (($_SESSION['role'] ?? '') !== 'admin') {
        header('Location: index.php?err=Akses+ditolak,+halaman+ini+khusus+admin');
        exit;
    }
}

/**
 * Cek apakah user yang sedang login adalah admin (tanpa redirect).
 * Berguna untuk sembunyikan/tampilkan tombol tertentu di HTML.
 */
function isAdmin() {
    return ($_SESSION['role'] ?? '') === 'admin';
}

/**
 * Pastikan SISWA (bukan admin/staff) sudah login lewat NIK. Kalau belum, redirect ke login-siswa.php.
 */
function requireSiswaLogin() {
    if (!isset($_SESSION['siswa_id'])) {
        header('Location: login-siswa.php');
        exit;
    }
}

/**
 * Cek apakah yang sedang login adalah siswa (bukan admin/staff).
 */
function isSiswaLoggedIn() {
    return isset($_SESSION['siswa_id']);
}
