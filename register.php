<?php
require 'config.php'; // Menghubungkan ke konfigurasi database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Enkripsi password

    try {
        // Menyimpan data pengguna ke database
        $stmt = $pdo->prepare("INSERT INTO users (email, username, password) VALUES (?, ?, ?)");
        $stmt->execute([$email, $username, $password]);
        header("Location: login.php"); // Redirect ke halaman login
        exit();
    } catch (PDOException $e) {
        $error = "Registrasi gagal: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Register - TechSavvy</title>
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>
  <div class="container">
    <header>
      <nav>
        <div class="logo">
          <img src="assets/logo.png" alt="Logo TechSavvy" width="80px"/>
        </div>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="login.php" class="btn_login">Login</a></li>
        </ul>
      </nav>
    </header>
    <main>
      <div class="center">
        <div class="form-login">
          <h3>Daftar Akun TechSavvy</h3>
          <?php if (isset($error)) : ?>
              <p style="color: red;"><?= htmlspecialchars($error); ?></p>
          <?php endif; ?>
          <form method="POST" action="">
            <input type="email" name="email" placeholder="Email" required />
            <input type="text" name="username" placeholder="Username" required />
            <input type="password" name="password" placeholder="Password" required />
            <button type="submit" class="btn_login">Daftar</button>
          </form>
        </div>
      </div>
    </main>
    <footer>
      <h4>&copy; TechSavvy 2024. All rights reserved.</h4>
    </footer>
  </div>
</body>
</html>
