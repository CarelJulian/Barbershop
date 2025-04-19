<?php
include 'koneksi.php';

// Hapus semua data dari tabel detail_pesanan
$query = "DELETE FROM detail_pesanan";

if (mysqli_query($conn, $query)) {
    echo "<script>
        alert('Semua data pesanan berhasil direset.');
        window.location.href = 'kelola_pesanan.php';
    </script>";
} else {
    echo "<script>
        alert('Gagal mereset data.');
        window.location.href = 'kelola_pesanan.php';
    </script>";
}
?>
