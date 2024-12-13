<?php
session_start();
require 'config.php';

// Ambil jumlah data dari tabel
$stmt = $pdo->query("SELECT COUNT(*) AS count FROM users");
$total_users = $stmt->fetch()['count'];

$stmt = $pdo->query("SELECT COUNT(*) AS count FROM articles");
$total_articles = $stmt->fetch()['count'];

$stmt = $pdo->query("SELECT COUNT(*) AS count FROM categories");
$total_categories = $stmt->fetch()['count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - TechSavvy</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
</head>
<body>
    <div class="sidebar">
        <div class="logo-details">
            <i class="bx bx-code-alt"></i>
            <span class="logo_name">TechSavvy</span>
        </div>
        <ul>
            <li><a href="dashboard.php" class="active">Dashboard</a></li>
            <li><a href="categories.php">Categories</a></li>
            <li><a href="articles.php">Articles</a></li>
        </ul>
    </div>

    <div class="home-section">
        <nav>
            <div class="sidebar-button">
                <img src="assets/logo.png" alt="Logo TechSavvy" width="80px" />
                <i class="bx bx-menu"></i>
            </div>
            <span class="profile-details">Welcome, Admin</span>
        </nav>

        <div class="home-content">
            <div class="dashboard-overview">
                <h3>Dashboard Overview</h3>
                <p>Selamat datang di dashboard Anda. Berikut adalah data terbaru yang dapat Anda kelola.</p>
            </div>

            <!-- Widgets -->
            <div class="widgets">
                <div class="widget">
                    <h4>Total Users</h4>
                    <p><?= $total_users ?></p>
                </div>
                <div class="widget">
                    <h4>Total Categories</h4>
                    <p><?= $total_categories ?></p>
                </div>
                <div class="widget">
                    <h4>Total Articles</h4>
                    <p><?= $total_articles ?></p>
                </div>
                <div class="widget">
                    <h4>Generate PDF</h4>
                    <a href="print_articles.php" class="btn" target="_blank">Print Articles</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
