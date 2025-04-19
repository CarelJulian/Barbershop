<?php
session_start();
include 'koneksi.php';

// Pastikan admin sudah login
if (!isset($_SESSION['admin'])) {
    header("Location: admin.php");
    exit();
}

// Ambil nomor antrian terbaru dari database
$query = $conn->query("SELECT nomor FROM nomor_antrian LIMIT 1");
$row = $query->fetch_assoc();
$nomor_antrian = $row['nomor'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="css/dashboard.css?v=<?php echo time(); ?>">
</head>

<body>

    <!-- Navbar -->
    <div class="navbar">
        <a href="dashboard.php" class="logo">Admin Panel</a>
        <div class="menu">
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
    </div>

    <!-- Dashboard Container -->
    <div class="dashboard-container">
        <h1>Dashboard Admin</h1>
        <div class="menu-container">
            <a href="kelola_service.php" class="menu-card">Kelola Service</a>
            <a href="kelola_pesanan.php" class="menu-card">Kelola Pesanan Sekarang</a>
            <a href="laporan.php" class="menu-card">Laporan Bulanan</a>
        </div>
    </div>

    <!-- Nomor Antrian -->
    <div class="antrian-container">
        <h2>Update Nomor Antrian</h2>
        <div class="antrian-number" id="nomorAntrian"><?php echo $nomor_antrian; ?></div>
        <div class="antrian-buttons">
            <button onclick="updateAntrian('kurang')">-</button>
            <button onclick="updateAntrian('tambah')">+</button>
            <button onclick="updateAntrian('reset')">Reset</button>
        </div>
    </div>

    <!-- JavaScript untuk Update Antrian -->
    <script>
        function updateAntrian(aksi) {
            fetch('update_antrian.php?aksi=' + aksi)
                .then(response => response.text())
                .then(data => {
                    document.getElementById("nomorAntrian").innerText = data;
                })
                .catch(error => console.error('Error:', error));
        }
    </script>

</body>
</html>
