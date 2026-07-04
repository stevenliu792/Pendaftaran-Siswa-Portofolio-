<?php
include 'config.php';
include 'auth.php';
requireAdmin();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $agama = $_POST['agama'];
    $sekolah_asal = $_POST['sekolah_asal'];

    // NIK: kosongkan jadi NULL kalau tidak diisi (bukan string kosong, biar UNIQUE tidak bentrok)
    $nikInput = trim($_POST['nik'] ?? '');
    $nik = $nikInput === '' ? null : $nikInput;

    // Password siswa: HANYA update kalau field diisi. Kalau kosong, password lama tetap dipakai.
    $passwordInput = $_POST['password_siswa'] ?? '';

    try {
        if ($passwordInput !== '') {
            // Admin mau set/ganti password siswa
            $hashedPassword = password_hash($passwordInput, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE calon_siswa SET nama=?, alamat=?, jenis_kelamin=?, agama=?, sekolah_asal=?, nik=?, password=? WHERE id=?");
            $stmt->execute([$nama, $alamat, $jenis_kelamin, $agama, $sekolah_asal, $nik, $hashedPassword, $id]);
        } else {
            // Password tidak disentuh, jangan diubah
            $stmt = $pdo->prepare("UPDATE calon_siswa SET nama=?, alamat=?, jenis_kelamin=?, agama=?, sekolah_asal=?, nik=? WHERE id=?");
            $stmt->execute([$nama, $alamat, $jenis_kelamin, $agama, $sekolah_asal, $nik, $id]);
        }
    } catch (PDOException $e) {
        // Kemungkinan besar NIK sudah dipakai siswa lain (UNIQUE constraint)
        error_log("Edit siswa error: " . $e->getMessage());
        header("Location: form-edit.php?id=" . urlencode($id) . "&err=NIK+sudah+terdaftar+untuk+siswa+lain");
        exit;
    }

    header("Location: list-siswa.php");
    exit;
}
