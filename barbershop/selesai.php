<?php
include 'koneksi.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID pesanan tidak ditemukan.");
}

$pesanan_id = $_GET['id'];

$query_pesanan = "SELECT * FROM detail_pesanan WHERE id = '$pesanan_id'";
$result_pesanan = mysqli_query($conn, $query_pesanan);

if (!$result_pesanan) {
    die("Query gagal: " . mysqli_error($conn));
}

$pesanan = mysqli_fetch_assoc($result_pesanan);

if (!$pesanan) {
    die("Pesanan dengan ID tersebut tidak ditemukan.");
}

$query_services = "SELECT s.name, s.price FROM pesanan_services ps 
                   JOIN services s ON ps.service_id = s.id 
                   WHERE ps.pesanan_id = '$pesanan_id'";
$result_services = mysqli_query($conn, $query_services);

$services = [];
$total_harga = 0;

if ($result_services) {
    while ($row = mysqli_fetch_assoc($result_services)) {
        $services[] = $row;
        $total_harga += $row['price'];
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pesanan Selesai</title>
    <link rel="stylesheet" href="css/selesai.css">
</head>
<body>
    <div class="background-slideshow"></div>
    <div class="struk-container" id="struk">
        <h2>Struk Pesanan Urban Save Barbershop</h2>
        <p><strong>Nomor Antrian:</strong> <?php echo htmlspecialchars($pesanan['nomor_antrian']); ?></p>
        <p><strong>Nama:</strong> <?php echo htmlspecialchars($pesanan['nama']); ?></p>
        <p><strong>Telepon:</strong> <?php echo htmlspecialchars($pesanan['phone']); ?></p>
        <p><strong>Tanggal:</strong> <?php echo htmlspecialchars($pesanan['tanggal']); ?></p>
        <p><strong>Waktu:</strong> <?php echo htmlspecialchars($pesanan['waktu']); ?></p>

        <h3>Layanan:</h3>
        <ul>
            <?php foreach ($services as $service): ?>
                <li><?php echo $service['name']; ?> - Rp<?php echo number_format($service['price'], 0, ',', '.'); ?></li>
            <?php endforeach; ?>
        </ul>

        <h3>Total: Rp<?php echo number_format($total_harga, 0, ',', '.'); ?></h3>

        <div class="button-group">
            <button onclick="window.print()" class="btn">Cetak Struk (PDF)</button>
            <a href="home.php" class="btn kembali">Kembali ke Beranda</a>
        </div>
    </div>
</body>
</html>
