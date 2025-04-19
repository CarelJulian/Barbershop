<?php
include 'koneksi.php';

// Ambil ID pesanan dari form
$id = $_POST['id'];

// Query untuk mendapatkan status saat ini
$query = "SELECT status FROM detail_pesanan WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$current_status = $row['status'];

// Tentukan status baru berdasarkan status saat ini
if ($current_status == 'Belum') {
    $new_status = 'Proses';
} elseif ($current_status == 'Proses') {
    $new_status = 'Selesai';
} else {
    $new_status = 'Selesai';
}

// Update status pesanan
$update_query = "UPDATE detail_pesanan SET status = '$new_status' WHERE id = '$id'";

// Proses Update
if (mysqli_query($conn, $update_query)) {
    // Redirect kembali ke halaman kelola pesanan setelah status diperbarui
    header('Location: kelola_pesanan.php');
    exit();
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
