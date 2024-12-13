<<<<<<< HEAD
<?php
session_start();
require 'config.php'; // Menghubungkan ke database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? null;
    $password = $_POST['password'] ?? null;

    if ($username && $password) {
        // Ambil data pengguna dari database
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC); // Ambil data sebagai array asosiatif

        if ($user && password_verify($password, $user['password'])) {
            // Login berhasil, simpan ke session
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'] ?? 'user'; // Role default adalah 'user'

            // Simpan cookie jika "Remember Me" dicentang
            if (isset($_POST['remember'])) {
                setcookie("username", $username, time() + (86400 * 7), "/"); // Simpan selama 7 hari
            }

            header("Location: index.php");
            exit();
        } else {
            // Login gagal
            $error = "Username atau password salah.";
        }
    } else {
        $error = "Username atau Password tidak boleh kosong.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login - TechSavvy</title>
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
          <li><a href="register.php" class="btn_login">Register</a></li>
        </ul>
      </nav>
    </header>
    <main>
      <div class="center">
        <div class="form-login">
          <h3>Login ke TechSavvy</h3>
          <?php if (isset($error)) : ?>
              <p style="color: red;"><?= htmlspecialchars($error); ?></p>
          <?php endif; ?>
          <form method="POST" action="">
          <input type="text" name="username" placeholder="Username" value="<?= htmlspecialchars($_COOKIE['username'] ?? '') ?>" required />
          <input type="password" name="password" placeholder="Password" required />
          <label>
              <input type="checkbox" name="remember" /> Remember Me
          </label>
          <button type="submit" class="btn_login">Login</button>
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
=======
<?php
session_start();
require 'config.php'; // Menghubungkan ke database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? null;
    $password = $_POST['password'] ?? null;

    if ($username && $password) {
        // Ambil data pengguna dari database
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC); // Ambil data sebagai array asosiatif

        if ($user && password_verify($password, $user['password'])) {
            // Login berhasil, simpan ke session
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'] ?? 'user'; // Role default adalah 'user'

            // Simpan cookie jika "Remember Me" dicentang
            if (isset($_POST['remember'])) {
                setcookie("username", $username, time() + (86400 * 7), "/"); // Simpan selama 7 hari
            }

            header("Location: index.php");
            exit();
        } else {
            // Login gagal
            $error = "Username atau password salah.";
        }
    } else {
        $error = "Username atau Password tidak boleh kosong.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login - TechSavvy</title>
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
          <li><a href="register.php" class="btn_login">Register</a></li>
        </ul>
      </nav>
    </header>
    <main>
      <div class="center">
        <div class="form-login">
          <h3>Login ke TechSavvy</h3>
          <?php if (isset($error)) : ?>
              <p style="color: red;"><?= htmlspecialchars($error); ?></p>
          <?php endif; ?>
          <form method="POST" action="">
          <input type="text" name="username" placeholder="Username" value="<?= htmlspecialchars($_COOKIE['username'] ?? '') ?>" required />
          <input type="password" name="password" placeholder="Password" required />
          <label>
              <input type="checkbox" name="remember" /> Remember Me
          </label>
          <button type="submit" class="btn_login">Login</button>
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
>>>>>>> a18602e7cc27f78d152e016db3becaadab4b395f
