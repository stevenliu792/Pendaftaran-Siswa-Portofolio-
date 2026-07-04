<?php
include 'config.php';
if (session_status() === PHP_SESSION_NONE) session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if ($username === '' || $password === '') {
    header('Location: login.php?err=Isi%20username%20dan%20password');
    exit;
}

try {
    $stmt = $pdo->prepare('SELECT id, username, password, role FROM users WHERE username = ? LIMIT 1');
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (password_verify($password, $user['password'])) {
            // login sukses
        } elseif (md5($password) === $user['password']) {
            // kompatibilitas lama
            $newHash = password_hash($password, PASSWORD_DEFAULT);
            $u = $pdo->prepare('UPDATE users SET password = ? WHERE id = ?');
            $u->execute([$newHash, $user['id']]);
        } else {
            header('Location: login.php?err=Username%20atau%20password%20salah');
            exit;
        }

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        header('Location: index.php');
        exit;
    } else {
        header('Location: login.php?err=Username%20atau%20password%20salah');
        exit;
    }
} catch (PDOException $e) {
    header('Location: login.php?err=Error%20Login');
    exit;
}