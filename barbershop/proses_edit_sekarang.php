<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nomor_antrian = $_POST['nomor_antrian'];
    $nama = $_POST['nama'];
    $phone = $_POST['phone'];
    $tanggal = $_POST['tanggal'];
    $waktu = $_POST['waktu'];
    $layanan_terpilih = $_POST['layanan_terpilih'];
    $total_harga = $_POST['total_harga'];

    $query = "UPDATE detail_pesanan SET 
        nomor_antrian='$nomor_antrian',
        nama='$nama',
        phone='$phone',
        tanggal='$tanggal',
        waktu='$waktu',
        layanan_terpilih='$layanan_terpilih',
        total_harga='$total_harga'
        WHERE id='$id'";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Pesanan berhasil diupdate'); window.location='kelola_pesanan.php';</script>";
    } else {
        echo "<script>alert('Gagal mengupdate pesanan'); window.location='kelola_pesanan.php';</script>";
    }
} else {
    echo "Akses tidak sah.";
}
?>
