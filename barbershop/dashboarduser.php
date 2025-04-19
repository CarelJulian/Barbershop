<?php
session_start();
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Pesanan Anda</title>
    <link rel="stylesheet" href="css/dashboarduser.css?v=<?php echo time(); ?>">
</head>

<body>

    <!-- Navbar -->
    <div class="navbar">
        <a href="dashboarduser.php" class="logo">Slamat Datang di Urban Save Barbershop</a>
        <div class="menu">
            <a href="logout.php" class="logout-btn">Keluar</a>
        </div>
    </div>

    <div class="background-slideshow"></div>

    <!-- Dashboard Container -->
    <div class="dashboard-container">

        <div class="menu-container">
            <a href="pesan.php" class="menu-card">Buat Pesanan</a>
            <a href="lihat_antrian.php" class="menu-card">Lihat Nomer Antrian </a>
            <a href="scan_qris.php" class="menu-card">Qris Tampil Urban Save</a>
        </div>
    </div>

   

</body>
</html>
