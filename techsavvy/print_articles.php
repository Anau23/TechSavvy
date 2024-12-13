<<<<<<< HEAD
<?php
require('fpdf/fpdf.php');
require 'config.php'; // Memuat konfigurasi database

// Fetch data dari database
$stmt = $pdo->query("SELECT * FROM articles");
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Membuat objek PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Header PDF
$pdf->Cell(190, 10, 'Articles Report', 1, 1, 'C');
$pdf->Ln(10); // Spasi setelah header

// Header tabel
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(10, 10, 'ID', 1);
$pdf->Cell(80, 10, 'Title', 1);
$pdf->Cell(100, 10, 'Content (Preview)', 1);
$pdf->Ln(); // Pindah ke baris berikutnya

// Isi tabel
$pdf->SetFont('Arial', '', 12);
foreach ($articles as $article) {
    $pdf->Cell(10, 10, $article['id'], 1);
    $pdf->Cell(80, 10, $article['title'], 1);
    $pdf->Cell(100, 10, substr($article['content'], 0, 50) . '...', 1); // Ambil 50 karakter pertama
    $pdf->Ln();
}

// Output PDF
$pdf->Output();
?>
=======
<?php
require('fpdf/fpdf.php');
require 'config.php'; // Memuat konfigurasi database

// Fetch data dari database
$stmt = $pdo->query("SELECT * FROM articles");
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Membuat objek PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Header PDF
$pdf->Cell(190, 10, 'Articles Report', 1, 1, 'C');
$pdf->Ln(10); // Spasi setelah header

// Header tabel
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(10, 10, 'ID', 1);
$pdf->Cell(80, 10, 'Title', 1);
$pdf->Cell(100, 10, 'Content (Preview)', 1);
$pdf->Ln(); // Pindah ke baris berikutnya

// Isi tabel
$pdf->SetFont('Arial', '', 12);
foreach ($articles as $article) {
    $pdf->Cell(10, 10, $article['id'], 1);
    $pdf->Cell(80, 10, $article['title'], 1);
    $pdf->Cell(100, 10, substr($article['content'], 0, 50) . '...', 1); // Ambil 50 karakter pertama
    $pdf->Ln();
}

// Output PDF
$pdf->Output();
?>
>>>>>>> a18602e7cc27f78d152e016db3becaadab4b395f
