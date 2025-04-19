<?php
include 'koneksi.php';

// Ambil aksi dari URL
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'tambah') {
        $conn->query("UPDATE nomor_antrian SET nomor = nomor + 1");
    } elseif ($_GET['aksi'] == 'kurang') {
        $conn->query("UPDATE nomor_antrian SET nomor = GREATEST(nomor - 1, 1)"); // Agar tidak kurang dari 1
    } elseif ($_GET['aksi'] == 'reset') {
        $conn->query("UPDATE nomor_antrian SET nomor = 1");
    }
}

// Ambil nomor antrian terbaru dan kirim ke JavaScript
$query = $conn->query("SELECT nomor FROM nomor_antrian LIMIT 1");
$row = $query->fetch_assoc();
echo $row['nomor'];
?>
