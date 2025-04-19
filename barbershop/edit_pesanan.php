<?php
include 'koneksi.php';

// Ambil ID pesanan dari URL
if (!isset($_GET['id'])) {
    header("Location: editpesan.php");
    exit();
}
$pesanan_id = $_GET['id'];

// Ambil data pesanan dari database
$query_pesanan = "SELECT * FROM detail_pesanan WHERE id = '$pesanan_id'";
$result_pesanan = mysqli_query($conn, $query_pesanan);
$pesanan = mysqli_fetch_assoc($result_pesanan);

if (!$pesanan) {
    header("Location: editpesan.php?id=$pesanan_id");
    exit();
}

// Ambil layanan yang tersedia
$query_services = "SELECT * FROM services";
$result_services = mysqli_query($conn, $query_services);

// Ambil layanan yang dipilih sebelumnya
$query_selected_services = "SELECT service_id FROM pesanan_services WHERE pesanan_id = '$pesanan_id'";
$result_selected_services = mysqli_query($conn, $query_selected_services);
$selected_services = [];
while ($row = mysqli_fetch_assoc($result_selected_services)) {
    $selected_services[] = $row['service_id'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pesanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="css/editpesanan.css">
</head>
<body class="bg-gray-900 text-white">
<div class="background-slideshow"></div>
<main class="flex justify-center items-center min-h-screen p-4">
    <div class="form-container bg-gray-800 p-6 rounded-lg shadow-lg">
        <h2 class="form-title text-center text-2xl font-bold mb-4">Edit Pesanan</h2>
        <form method="POST" action="proses_edit_pesanan.php">
            <input type="hidden" name="pesanan_id" value="<?php echo htmlspecialchars($pesanan_id); ?>">

            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($pesanan['nama']); ?>" required>
            </div>

            <div class="form-group">
                <label for="phone">Nomor Telepon</label>
                <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($pesanan['phone']); ?>" required>
            </div>

            <div class="form-group">
                <label for="date">Tanggal</label>
                <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($pesanan['tanggal']); ?>" required>
            </div>

            <div class="form-group">
                <label for="time">Waktu</label>
                <input type="time" id="time" name="time" value="<?php echo htmlspecialchars($pesanan['waktu']); ?>" required>
            </div>

            <div class="form-group">
                <label>Layanan</label>
                <div id="service-list">
                    <?php while ($service = mysqli_fetch_assoc($result_services)) : ?>
                        <label class="block">
                            <input type="checkbox" name="services[]" value="<?php echo $service['id']; ?>"
                                   data-price="<?php echo $service['price']; ?>"
                                   <?php echo in_array($service['id'], $selected_services) ? 'checked' : ''; ?>
                                   onclick="hitungTotal()">
                            <?php echo $service['name']; ?> - Rp<?php echo number_format($service['price'], 0, ',', '.'); ?>
                        </label>
                    <?php endwhile; ?>
                </div>
            </div>

            <div class="form-group">
                <label>Total Harga</label>
                <input type="text" id="total_harga" name="total_harga" value="Rp0" readonly>
            </div>

            <div class="text-center mt-4 space-x-2">
                <button type="submit" class="btn-primary bg-blue-500 px-4 py-2 rounded hover:bg-blue-600">Simpan Perubahan</button>
                <button type="button" class="btn cancel" onclick="window.location.href='editpesan.php?id=<?php echo $pesanan_id; ?>'">Batalkan</button>
                
            </div>
        </form>
    </div>
</main>

<script>
    function hitungTotal() {
        let total = 0;
        let checkboxes = document.querySelectorAll("input[name='services[]']:checked");

        checkboxes.forEach((checkbox) => {
            total += parseInt(checkbox.getAttribute("data-price"));
        });

        document.getElementById("total_harga").value = "Rp" + total.toLocaleString("id-ID");
    }

    window.onload = hitungTotal;
</script>
</body>
</html>
