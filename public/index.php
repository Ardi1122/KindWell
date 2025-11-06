<?php
session_start();
require_once '../app/config/db.php';
require_once '../app/models/User.php';

$userModel = new User($pdo);

// kalau user udah login, redirect ke dashboard sesuai role
if (isset($_SESSION['user'])) {
    $role = $_SESSION['user']['role'];
    if ($role === 'bidan') {
        header('Location: ../app/views/dashboard/admin/index.php');
        exit;
    } else {
        header('Location: ../app/views/dashboard/ibu/index.php');
        exit;
    }
}

// kalau punya cookie remember_token, auto-login
$userModel->checkRememberedUser();
if (isset($_SESSION['user'])) {
    $role = $_SESSION['user']['role'];
    if ($role === 'bidan') {
        header('Location: ../app/views/dashboard/admin/index.php');
        exit;
    } else {
        header('Location: ../app/views/dashboard/ibu/index.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Kesehatan Ibu & Anak</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header class="hero">
        <h1>E-Kesehatan Ibu & Anak</h1>
        <p>Mendukung kesehatan ibu & anak dengan edukasi dan monitoring sederhana</p>
    </header>

    <main class="main-content">
        <section class="intro">
            <h2>Selamat Datang 👩‍🍼</h2>
            <p>Aplikasi ini membantu ibu dan bidan memantau jadwal pemeriksaan, membaca artikel edukatif, dan mencatat kunjungan.</p>
        </section>

        <section class="cta">
            <a href="../app/views/auth/login.php" class="btn btn-primary">Masuk</a>
            <a href="../app/views/auth/register.php" class="btn btn-secondary">Daftar</a>
        </section>
    </main>

    <footer class="footer">
        <p>© <?= date('Y'); ?> E-Kesehatan Ibu & Anak | Dibuat oleh Ardi</p>
    </footer>
</body>
</html>
