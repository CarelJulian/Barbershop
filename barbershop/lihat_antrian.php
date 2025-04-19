<?php
include 'koneksi.php';

// Ambil nomor antrian terbaru dari database
$query = $conn->query("SELECT nomor FROM nomor_antrian LIMIT 1");
$row = $query->fetch_assoc();
$nomor_antrian = $row['nomor'];

// Ambil tanggal dan waktu sekarang
date_default_timezone_set('Asia/Jakarta');
$tanggal_waktu = date("d F Y - H:i:s");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Nomor Antrian</title>
    <link rel="stylesheet" href="css/lihat_antrian.css">
</head>
<body>
    <div class="antrian-container">
        <h1>ANTRIAN URBAN SHAVE BARBERSHOP</h1>
        <h2><?php echo $tanggal_waktu; ?></h2>
        <div class="nomor-antrian"><?php echo $nomor_antrian; ?></div>
        <a href="dashboarduser.php" class="btn-kembali">Kembali </a>
    </div>
</body>
</html>
