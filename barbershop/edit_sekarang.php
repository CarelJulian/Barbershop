<?php
include 'koneksi.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID tidak ditemukan.");
}

$id = $_GET['id'];

// Ambil data pesanan
$query = mysqli_query($conn, "SELECT * FROM detail_pesanan WHERE id = '$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    die("Data tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pesanan</title>
    <link rel="stylesheet" href="css/editform.css">
</head>
<body>
    <div class="form-container">
        <h2>Edit Pesanan</h2>
        <form action="proses_edit_sekarang.php" method="POST">
            <input type="hidden" name="id" value="<?= $data['id']; ?>">

            <label>Nomor Antrian:</label>
            <input type="number" name="nomor_antrian" value="<?= $data['nomor_antrian']; ?>" required>

            <label>Nama:</label>
            <input type="text" name="nama" value="<?= $data['nama']; ?>" required>

            <label>Telepon:</label>
            <input type="text" name="phone" value="<?= $data['phone']; ?>" required>

            <label>Tanggal:</label>
            <input type="date" name="tanggal" value="<?= $data['tanggal']; ?>" required>

            <label>Waktu:</label>
            <input type="time" name="waktu" value="<?= $data['waktu']; ?>" required>

            <label>Layanan Terpilih:</label>
            <textarea name="layanan_terpilih" rows="3"><?= $data['layanan_terpilih']; ?></textarea>

            <label>Total Harga:</label>
            <input type="number" name="total_harga" value="<?= $data['total_harga']; ?>" required>

            <div class="btn-group">
                <button type="submit" class="btn-save">Simpan</button>
                <a href="kelola_pesanan.php" class="btn-cancel">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>
