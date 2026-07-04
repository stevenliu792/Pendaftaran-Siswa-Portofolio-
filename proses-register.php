<?php
include 'config.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: register.php');
    exit;
}
$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';
$password2 = $_POST['password2'] ?? '';

if ($username === '' || $password === '' || $password2 === '') {
    header('Location: register.php?err=Isi+semua+field');
    exit;
}
if ($password !== $password2) {
    header('Location: register.php?err=Password+tidak+sama');
    exit;
}

// Cek username unik
$stmt = $pdo->prepare('SELECT id FROM users WHERE username = ? LIMIT 1');
$stmt->execute([$username]);
if ($stmt->fetch()) {
    header('Location: register.php?err=Username+sudah+terdaftar');
    exit;
}

// Hash password dan simpan (role otomatis 'user', bukan admin)
$hash = password_hash($password, PASSWORD_DEFAULT);
$stmt = $pdo->prepare('INSERT INTO users (username, password, role) VALUES (?, ?, "user")');
$stmt->execute([$username, $hash]);

// Login otomatis setelah register
session_start();
$_SESSION['user_id'] = $pdo->lastInsertId();
$_SESSION['username'] = $username;
$_SESSION['role'] = 'user';

header('Location: index.php');
exit;