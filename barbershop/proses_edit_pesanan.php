<?php
include 'koneksi.php';

if (!isset($_POST['pesanan_id']) || empty($_POST['pesanan_id'])) {
    die("❌ Error: ID pesanan tidak dikirim atau kosong!");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pesanan_id = intval($_POST['pesanan_id']); // gunakan intval untuk keamanan ID
    $nama = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $tanggal = mysqli_real_escape_string($conn, $_POST['date']);
    $waktu = mysqli_real_escape_string($conn, $_POST['time']);
    $services = isset($_POST['services']) ? $_POST['services'] : [];
    $total_harga = str_replace(['Rp', '.', ','], '', $_POST['total_harga']);

    // Ambil daftar layanan
    $layanan_terpilih = [];
    foreach ($services as $service_id) {
        $service_id = mysqli_real_escape_string($conn, $service_id);
        $query_service_name = "SELECT name FROM services WHERE id = '$service_id'";
        $result_service_name = mysqli_query($conn, $query_service_name);
        if ($service_data = mysqli_fetch_assoc($result_service_name)) {
            $layanan_terpilih[] = $service_data['name'];
        }
    }
    $layanan_terpilih_str = implode(", ", $layanan_terpilih);

    // Update pesanan
    $query_update = "UPDATE detail_pesanan 
                     SET nama='$nama', phone='$phone', tanggal='$tanggal', waktu='$waktu', 
                         layanan_terpilih='$layanan_terpilih_str', total_harga='$total_harga' 
                     WHERE id='$pesanan_id'";
    if (!mysqli_query($conn, $query_update)) {
        die("Error update pesanan: " . mysqli_error($conn));
    }

    // Hapus & insert ulang layanan
    mysqli_query($conn, "DELETE FROM pesanan_services WHERE pesanan_id = '$pesanan_id'");
    foreach ($services as $service_id) {
        $service_id = mysqli_real_escape_string($conn, $service_id);
        $query_insert = "INSERT INTO pesanan_services (pesanan_id, service_id) VALUES ('$pesanan_id', '$service_id')";
        if (!mysqli_query($conn, $query_insert)) {
            die("Error tambah layanan: " . mysqli_error($conn));
        }
    }

    // Redirect kembali ke halaman edit dengan ID pesanan
    header("Location: editpesan.php?id=" . $pesanan_id);
    exit();
}
?>
