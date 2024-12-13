<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require 'config.php';

// Pastikan hanya admin yang bisa mengakses halaman ini
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'techuser') {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}


// Handle Create
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author_id = 1; // Untuk contoh, diisi ID admin

    $stmt = $pdo->prepare("INSERT INTO articles (title, content, author_id, created_at) VALUES (?, ?, ?, NOW())");
    $stmt->execute([$title, $content, $author_id]);
    header("Location: articles.php");
    exit();
}

// Handle Update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $pdo->prepare("UPDATE articles SET title = ?, content = ? WHERE id = ?");
    $stmt->execute([$title, $content, $id]);
    header("Location: articles.php");
    exit();
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $stmt = $pdo->prepare("DELETE FROM articles WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: articles.php");
    exit();
}

// Fetch All Articles
$stmt = $pdo->query("SELECT * FROM articles");
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Articles - TechSavvy</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="sidebar">
        <div class="logo-details">
            <i class="bx bx-code-alt"></i>
            <span class="logo_name">TechSavvy</span>
        </div>
        <ul class="nav-links">
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="categories.php">Categories</a></li>
            <li><a href="articles.php" class="active">Articles</a></li>
        </ul>
    </div>

    <div class="home-section">
        <nav>
            <div class="sidebar-button">
            <img src="assets/logo.png" alt="Logo TechSavvy" width="80px" />
                <i class="bx bx-menu"></i>
                <span class="text">Manage Articles</span>
            </div>
            <div class="profile-details">
                <span class="admin_name">Welcome, Admin</span>
            </div>
        </nav>

        <div class="home-content">
            <!-- Form untuk Create Article -->
            <div class="form-article">
                <h3>Create New Article</h3>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" placeholder="Enter article title" required>
                    </div>
                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea name="content" id="content" placeholder="Enter article content" rows="5" required></textarea>
                    </div>
                    <button type="submit" name="create" class="btn">Add Article</button>
                </form>
            </div>

            <!-- Tabel untuk List Articles -->
            <div class="center">
                <h3>Articles List</h3>
                <table class="table-data">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($articles as $article): ?>
                            <tr>
                                <td><?= $article['id'] ?></td>
                                <td><?= htmlspecialchars($article['title']) ?></td>
                                <td><?= htmlspecialchars($article['content']) ?></td>
                                <td>
                                    <!-- Update Form -->
                                    <form method="POST" action="" style="display: inline;">
                                        <input type="hidden" name="id" value="<?= $article['id'] ?>">
                                        <input type="text" name="title" value="<?= htmlspecialchars($article['title']) ?>" required>
                                        <textarea name="content"><?= htmlspecialchars($article['content']) ?></textarea>
                                        <button type="submit" name="update" class="btn btn-edit">Update</button>
                                    </form>
                                    <!-- Delete Action -->
                                    <a href="?delete=<?= $article['id'] ?>" class="btn btn-delete" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
