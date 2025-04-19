<?php
include 'koneksi.php';

if (!isset($_GET['id'])) {
    echo "ID pesanan tidak ditemukan.";
    exit;
}

$pesanan_id = $_GET['id'];

// Hapus pesanan dari database
mysqli_query($conn, "DELETE FROM pesanan_services WHERE pesanan_id = '$pesanan_id'");
mysqli_query($conn, "DELETE FROM detail_pesanan WHERE id = '$pesanan_id'");

// Redirect ke halaman utama dengan pesan sukses
header("Location: pesan.php?canceled=1");
exit();
?>
