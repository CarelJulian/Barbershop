<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomor_antrian = $_POST['nomor_antrian'];
    $nama = $_POST['name'];
    $phone = $_POST['phone'];
    $tanggal = $_POST['date'];
    $waktu = $_POST['time'];
    $total_harga = 0;

    // Simpan ke tabel detail_pesanan terlebih dahulu tanpa total_harga
    $query_pesanan = "INSERT INTO detail_pesanan (nomor_antrian, nama, phone, tanggal, waktu, total_harga) 
                      VALUES ('$nomor_antrian', '$nama', '$phone', '$tanggal', '$waktu', '$total_harga')";

    if (mysqli_query($conn, $query_pesanan)) {
        $pesanan_id = mysqli_insert_id($conn); // Ambil ID terakhir dari pesanan yang baru disimpan

        // Cek dan proses layanan yang dipilih
        if (isset($_POST['services']) && is_array($_POST['services'])) {
            foreach ($_POST['services'] as $service_id) {
                // Ambil harga layanan
                $query_service = "SELECT price FROM services WHERE id = '$service_id'";
                $result_service = mysqli_query($conn, $query_service);

                if ($service = mysqli_fetch_assoc($result_service)) {
                    $harga_service = $service['price'];
                    $total_harga += $harga_service;

                    // Simpan ke tabel pesanan_services
                    $insert_service = "INSERT INTO pesanan_services (pesanan_id, service_id) VALUES ('$pesanan_id', '$service_id')";
                    mysqli_query($conn, $insert_service);
                }
            }

            // Update total harga di tabel detail_pesanan
            $update_harga = "UPDATE detail_pesanan SET total_harga = '$total_harga' WHERE id = '$pesanan_id'";
            mysqli_query($conn, $update_harga);
        }

        // Arahkan ke halaman editpesan.php dengan ID pesanan
        header("Location: editpesan.php?id=$pesanan_id");
        exit();
    } else {
        die("Gagal menyimpan pesanan: " . mysqli_error($conn));
    }
} else {
    header("Location: pesan.php");
    exit();
}
?>
