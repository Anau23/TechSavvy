<?php
session_start();

// Redirect ke login jika pengguna belum login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Simpan waktu kunjungan terakhir ke cookie
if (isset($_COOKIE['last_visit'])) {
    $last_visit = $_COOKIE['last_visit']; // Ambil waktu kunjungan terakhir dari cookie
} else {
    $last_visit = "Belum pernah mengunjungi."; // Default jika cookie tidak ada
}
setcookie("last_visit", date("Y-m-d H:i:s"), time() + (86400 * 30), "/"); // Perbarui cookie dengan waktu saat ini
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Welcome to TechSavvy</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
    <div class="container">
        <header>
            <nav>
                <div class="logo">
                    <img src="assets/logo.png" alt="Logo TechSavvy" width="80px" />
                </div>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="login.php?logout=true" class="btn_login">Logout</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <div class="jumbotron">
				<div class="jumbotron-text">
					<h1>Temukan Informasi Teknologi Terbaru di TechSavvy</h1>
					<p> TechSavvy adalah portal terbaik untuk belajar dan mendapatkan berita terkini seputar teknologi.</p>
				</div>
				<div class="jumbotron-img">
					<img src="assets/jumbotron.png" alt="Jumbotron Image" alt="" width="200px"/>
				</div>
			</div>
            <div class="center">
                <h3>Selamat Datang, <?= htmlspecialchars($_SESSION['username']); ?>!</h3>
                <p>Ini adalah halaman utama setelah login.</p>
                <p>Waktu kunjungan terakhir Anda: <?= htmlspecialchars($last_visit); ?></p>
            </div>
        </main>
        <footer>
            <h4>&copy; TechSavvy 2024. All rights reserved.</h4>
        </footer>
    </div>
</body>
</html>
