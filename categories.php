<?php
session_start();
require 'config.php';

// Create
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $stmt = $pdo->prepare("INSERT INTO categories (name, description, price) VALUES (?, ?, ?)");
    $stmt->execute([$name, $description, $price]);
    header("Location: categories.php");
    exit();
}

// Update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $stmt = $pdo->prepare("UPDATE categories SET name = ?, description = ?, price = ? WHERE id = ?");
    $stmt->execute([$name, $description, $price, $id]);
    header("Location: categories.php");
    exit();
}

// Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM categories WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: categories.php");
    exit();
}

// Fetch data
$stmt = $pdo->query("SELECT * FROM categories");
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories - TechSavvy</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="sidebar">
        <div class="logo-details">
            <i class="bx bx-category"></i>
            <span class="logo_name">TechSavvy</span>
        </div>
        <ul class="nav-links">
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="categories.php" class="active">Categories</a></li>
            <li><a href="articles.php">Articles</a></li>
        </ul>
    </div>

    <div class="home-section">
        <nav>
            <div class="sidebar-button">
            <img src="assets/logo.png" alt="Logo TechSavvy" width="80px" />
                <i class="bx bx-menu"></i>
                <span class="text">Manage Categories</span>
            </div>
            <div class="profile-details">
                <span class="admin_name">Welcome, Admin</span>
            </div>
        </nav>

        <div class="home-content">
            <!-- Form Create -->
            <div class="form-article">
    <h3>Add New Category</h3>
    <form method="POST" action="">
        <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" name="name" id="name" placeholder="Enter category name" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" placeholder="Enter category description" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" id="price" placeholder="Enter category price" required>
        </div>
        <button type="submit" name="create" class="btn">Add Category</button>
    </form>
</div>

<div class="table-section">
    <h3>Categories List</h3>
    <table class="table-data">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category): ?>
                <tr>
                    <td><?= $category['id'] ?></td>
                    <td><?= htmlspecialchars($category['name']) ?></td>
                    <td><?= htmlspecialchars($category['description']) ?></td>
                    <td><?= htmlspecialchars($category['price']) ?></td>
                    <td>
                        <!-- Update Form -->
                        <form method="POST" action="" style="display: inline;">
                            <input type="hidden" name="id" value="<?= $category['id'] ?>">
                            <input type="text" name="name" value="<?= htmlspecialchars($category['name']) ?>" required>
                            <textarea name="description"><?= htmlspecialchars($category['description']) ?></textarea>
                            <input type="number" name="price" value="<?= htmlspecialchars($category['price']) ?>" required>
                            <button type="submit" name="update" class="btn btn-edit">Update</button>
                        </form>
                        <!-- Delete Action -->
                        <a href="?delete=<?= $category['id'] ?>" class="btn btn-delete" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
