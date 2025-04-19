<?php
include 'koneksi.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID tidak ditemukan.");
}

$id = $_GET['id'];

// Cek apakah data ada
$cek = mysqli_query($conn, "SELECT * FROM detail_pesanan WHERE id = '$id'");
if (mysqli_num_rows($cek) == 0) {
    die("Data tidak ditemukan.");
}

// Lanjutkan menghapus
$hapus = mysqli_query($conn, "DELETE FROM detail_pesanan WHERE id = '$id'");

if ($hapus) {
    echo "<script>alert('Pesanan berhasil dihapus.'); window.location='kelola_pesanan.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus pesanan.'); window.location='kelola_pesanan.php';</script>";
}
?>
