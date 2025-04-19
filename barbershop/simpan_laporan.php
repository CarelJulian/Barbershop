<?php
include 'koneksi.php';

// Ambil semua data dari detail_pesanan
$query = "SELECT * FROM detail_pesanan";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}

// Simpan tiap data ke laporan_pesanan
while ($row = mysqli_fetch_assoc($result)) {
    $nama = $row['nama'];
    $phone = $row['phone'];
    $tanggal = $row['tanggal'];
    $waktu = $row['waktu'];
    $layanan = $row['layanan_terpilih'];
    $harga = $row['total_harga'];
    $created = date('Y-m-d H:i:s');

    // Cek apakah data ini sudah ada di laporan untuk menghindari duplikat
    $cek = mysqli_query($conn, "SELECT * FROM laporan_pesanan WHERE nama='$nama' AND phone='$phone' AND tanggal='$tanggal' AND waktu='$waktu'");
    if (mysqli_num_rows($cek) == 0) {
        $insert = "INSERT INTO laporan_pesanan (nama, phone, tanggal, waktu, layanan_terpilih, total_harga, created_at) 
                   VALUES ('$nama', '$phone', '$tanggal', '$waktu', '$layanan', '$harga', '$created')";
        mysqli_query($conn, $insert);
    }
}

echo "<script>alert('Data berhasil disimpan ke laporan.'); window.location.href='kelola_pesanan.php';</script>";
?>
