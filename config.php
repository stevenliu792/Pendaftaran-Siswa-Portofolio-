<?php
$host = "localhost";
$dbname = "pendaftaran_siswa"; // GANTI sesuai nama database yang benar
$username = "root";
$password = "";

try {
    // Koneksi ke MySQL tanpa memilih database dulu
    $pdo = new PDO("mysql:host=$host;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Buat database jika belum ada
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");

    // Pilih database
    $pdo->exec("USE `$dbname`");

    // Buat tabel users jika belum ada
    $createUserTableSQL = "
        CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            role ENUM('admin','user') NOT NULL DEFAULT 'user',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ";
    $pdo->exec($createUserTableSQL);

    // Jaga-jaga: kalau tabel users sudah ada dari sebelumnya (tanpa kolom role), tambahkan kolomnya
    $checkColumn = $pdo->query("SHOW COLUMNS FROM users LIKE 'role'");
    if ($checkColumn->rowCount() === 0) {
        $pdo->exec("ALTER TABLE users ADD COLUMN role ENUM('admin','user') NOT NULL DEFAULT 'user' AFTER password");
    }

    // Buat tabel calon_siswa jika belum ada
    $createSiswaTableSQL = "
        CREATE TABLE IF NOT EXISTS calon_siswa (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nama VARCHAR(100) NOT NULL,
            alamat TEXT NOT NULL,
            jenis_kelamin ENUM('Laki-laki','Perempuan') NOT NULL,
            agama VARCHAR(50) NOT NULL,
            sekolah_asal VARCHAR(100) NOT NULL,
            nik VARCHAR(20) NULL UNIQUE,
            password VARCHAR(255) NULL,
            tanggal_daftar TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ";
    $pdo->exec($createSiswaTableSQL);

    // Jaga-jaga: kalau tabel calon_siswa sudah ada dari sebelumnya (tanpa kolom nik/password), tambahkan
    $checkNik = $pdo->query("SHOW COLUMNS FROM calon_siswa LIKE 'nik'");
    if ($checkNik->rowCount() === 0) {
        $pdo->exec("ALTER TABLE calon_siswa ADD COLUMN nik VARCHAR(20) NULL UNIQUE AFTER sekolah_asal");
    }
    $checkPass = $pdo->query("SHOW COLUMNS FROM calon_siswa LIKE 'password'");
    if ($checkPass->rowCount() === 0) {
        $pdo->exec("ALTER TABLE calon_siswa ADD COLUMN password VARCHAR(255) NULL AFTER nik");
    }
} catch (PDOException $e) {
    // Jangan tampilkan pesan error asli ke pengunjung (bisa bocorkan info struktur database)
    error_log("Database error: " . $e->getMessage()); // dicatat di log server untuk kamu debug
    die("Terjadi masalah koneksi ke server. Silakan coba lagi nanti atau hubungi admin.");
}
?>