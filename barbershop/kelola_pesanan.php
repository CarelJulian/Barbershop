<?php
include 'koneksi.php';

$query = "SELECT * FROM detail_pesanan ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Pesanan Sekarang</title>
    <link rel="stylesheet" href="css/kelolapesanan.css">
</head>
<body>
    <div class="container">
        <h1>Kelola Pesanan Sekarang</h1>
        <a href="dashboard.php" class="btn kembali">← Kembali ke Dashboard</a>

        <table>
        <thead>
    <tr>
        <th>No</th>
        <th>Nomor Antrian</th>
        <th>Nama</th>
        <th>Telepon</th>
        <th>Layanan</th>
        <th>Total Harga</th>
        <th>Dibuat</th>
        <th>Status</th> <!-- Kolom status -->
        <th>Aksi</th>
    </tr>
</thead>
<tbody>
<?php
if (mysqli_num_rows($result) > 0) {
    $no = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $status = $row['status'];

        // Kelas warna tombol berdasarkan status
        $btn_class = '';
        if ($status == 'Belum') {
            $btn_class = 'Belum';
        } elseif ($status == 'Proses') {
            $btn_class = 'Proses';
        } elseif ($status == 'Selesai') {
            $btn_class = 'Selesai';
        }

        // Tombol status hanya aktif jika belum selesai
        $status_button = ($status != 'Selesai') ? "
            <form method='POST' action='update_status.php'>
                <input type='hidden' name='id' value='{$row['id']}'>
                <input type='hidden' name='current_status' value='{$status}'>
                <button type='submit' class='btn {$btn_class}'>{$status}</button>
            </form>" : "<span class='btn {$btn_class}'>{$status}</span>";

        echo "<tr>
            <td>{$no}</td>
            <td>{$row['nomor_antrian']}</td>
            <td>{$row['nama']}</td>
            <td>{$row['phone']}</td>
            <td>{$row['layanan_terpilih']}</td>
            <td>Rp " . number_format($row['total_harga'], 0, ',', '.') . "</td>
            <td>{$row['created_at']}</td>
            <td>{$status_button}</td>
            <td>
                <a href='edit_sekarang.php?id={$row['id']}' class='btn edit'>Edit</a>
                <a href='hapus_sekarang.php?id={$row['id']}' class='btn hapus' onclick=\"return confirm('Yakin ingin menghapus pesanan ini?')\">Hapus</a>
            </td>
        </tr>";
        $no++;
    }
} else {
    echo "<tr><td colspan='11'>Tidak ada data pesanan.</td></tr>";
}
?>
</tbody>

            </tbody>
        </table>

        <form action="simpan_laporan.php" method="POST" style="text-align: center; margin-top: 20px;">
            <button type="submit" class="btn-laporan">Simpan ke Laporan</button>
        </form>

        <form action="reset_sekarang.php" method="POST" onsubmit="return confirm('Yakin ingin menghapus semua data pesanan hari ini?')" style="text-align: center; margin-top: 10px;">
            <button type="submit" class="btn-reset">Reset Hari Ini</button>
        </form>

    </div>
</body>
</html>
