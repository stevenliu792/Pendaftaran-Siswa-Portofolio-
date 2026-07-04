<?php
include 'config.php';
include 'auth.php';
requireAdmin();

// Pastikan id dikirim dan berupa angka, biar tidak error kalau URL diketik sembarangan
if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
    header("Location: list-siswa.php");
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM calon_siswa WHERE id = ?");
$stmt->execute([$id]);
header("Location: list-siswa.php");
exit;
