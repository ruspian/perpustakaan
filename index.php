<?php
session_start();
include './db/db.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan UNIPO</title>
    <link rel="stylesheet" href="./style/style.css">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">
          <img src="./img/unipo.png"  alt="">
          <!-- <a href="#" class="logo">UNIPO Library</a> -->
        </div>
        <div class="menu-toggle" id="mobile-menu">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
        <ul class="nav-links">
            <li><a href="./page/bukuPage.php">BACA BUKU</a></li>
            <li><a href="./page/daftarBukuPage.php">DAFTAR BUKU</a></li>
            
        </ul>
        <div class="auth">
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="./logic/logout.php" class="btn">Keluar</a>
            <?php else: ?>
                <a href="./page/loginPage.php" class="btn">Masuk</a>
            <?php endif; ?>
        </div>
    </nav>

    <div class="container">
        <!-- Hero Section -->
        <header class="hero">
            <h1>Selamat Datang di Perpustakaan UNIPO</h1>
            <p>Temukan buku favoritmu dan tingkatkan wawasan bersama kami!</p>
            <form class="search-form" id="search-form" action="./page/daftarBukuPage.php" method="POST">
                <input type="text" name="q" placeholder="Cari buku..." required>
                <button type="button" id="search-button">Cari</button> <!-- Ikon kaca pembesar -->
            </form>
        </header>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2025 UNIPO. All Rights Reserved.</p>
    </footer>

    <script src="./script/indexPage.js"></script>

</body>
</html>
