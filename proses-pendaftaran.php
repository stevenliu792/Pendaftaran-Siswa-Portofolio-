<?php
include 'config.php';
include 'auth.php';
requireAdmin();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $agama = $_POST['agama'];
    $sekolah_asal = $_POST['sekolah_asal'];

    $stmt = $pdo->prepare("INSERT INTO calon_siswa (nama, alamat, jenis_kelamin, agama, sekolah_asal) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$nama, $alamat, $jenis_kelamin, $agama, $sekolah_asal]);

    header("Location: list-siswa.php");
    exit;
}
