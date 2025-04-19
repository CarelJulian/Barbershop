<?php
$host = "localhost";  // Server database (biasanya localhost)
$user = "root";       // Username MySQL (default: root)
$pass = "";           // Password MySQL (default: kosong)
$db   = "barber_db";  // Nama database

// Membuat koneksi ke MySQL
$conn = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
