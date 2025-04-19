<?php
include 'koneksi.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID pesanan tidak ditemukan.");
}

$pesanan_id = $_GET['id'];

// Ambil data pesanan dari database
$query_pesanan = "SELECT * FROM detail_pesanan WHERE id = '$pesanan_id'";
$result_pesanan = mysqli_query($conn, $query_pesanan);

if (!$result_pesanan) {
    die("Query gagal: " . mysqli_error($conn));
}

$pesanan = mysqli_fetch_assoc($result_pesanan);
if (!$pesanan) {
    die("Pesanan dengan ID tersebut tidak ditemukan.");
}

// Ambil layanan yang dipilih
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan</title>
    <link rel="stylesheet" href="css/editpesan.css">
</head>

<body>
    <div class="background-slideshow"></div>

    <div class="receipt-container">
        <h2>Detail Pesanan</h2>
        <p><strong>Nomor Antrian:</strong> <?php echo htmlspecialchars($pesanan['nomor_antrian']); ?></p>
        <p><strong>Nama:</strong> <?php echo htmlspecialchars($pesanan['nama']); ?></p>
        <p><strong>Telepon:</strong> <?php echo htmlspecialchars($pesanan['phone']); ?></p>
        <p><strong>Tanggal:</strong> <?php echo htmlspecialchars($pesanan['tanggal']); ?></p>
        <p><strong>Waktu:</strong> <?php echo htmlspecialchars($pesanan['waktu']); ?></p>
        
        <h3>Layanan:</h3>
        <ul>
            <?php if (count($services) > 0): ?>
                <?php foreach ($services as $service): ?>
                    <li><?= htmlspecialchars($service['name']) ?> - Rp<?= number_format($service['price'], 0, ',', '.') ?></li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>Tidak ada layanan yang dipilih.</li>
            <?php endif; ?>
        </ul>

        <h3>Total Harga: Rp<?= number_format($total_harga, 0, ',', '.') ?></h3>
        
        <div class="info-box">
            <span class="icon-warning">⚠</span> 
            Pastikan pesanan anda benar. Jika salah, silakan edit atau batalkan pesanan.
        </div>

        <div class="button-group">
            <a href="edit_pesanan.php?id=<?= $pesanan_id ?>" class="btn btn-edit">Edit</a>
            <a href="batalkan_pesanan.php?id=<?= $pesanan_id ?>" class="btn btn-cancel">Batalkan</a>
            <a href="selesai.php?id=<?= $pesanan_id ?>" class="btn btn-continue">Lanjut</a>
        </div>
    </div>
</body>
</html>
