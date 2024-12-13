<?php
$host = 'localhost'; // Server database
$db = 'techsavvy';   // Nama database
$user = 'root';      // Username MySQL
$pass = '';          // Password MySQL (kosong jika default)

try {
    // Membuat koneksi menggunakan PDO
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Mode debug error
} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}
?>
