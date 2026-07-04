<?php
include 'config.php';
if (session_status() === PHP_SESSION_NONE) session_start();

// Catatan: pembuatan tabel & kolom role sudah otomatis ditangani oleh config.php

// ganti password jika mau
$username = 'admin';
$password_plain = 'admin'; // ubah setelah login pertama!

$hash = password_hash($password_plain, PASSWORD_DEFAULT);

// masukkan atau update jika sudah ada, dan pastikan role-nya admin
$stmt = $pdo->prepare('INSERT INTO users (username, password, role) VALUES (?, ?, "admin") ON DUPLICATE KEY UPDATE role="admin"');
$stmt->execute([$username, $hash]);

echo "User admin siap. Username: admin, password: admin (ubah segera).";
