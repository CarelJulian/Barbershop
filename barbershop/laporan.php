<?php
include 'koneksi.php';

$filter_bulan = $_GET['bulan'] ?? date('m');
$filter_tahun = $_GET['tahun'] ?? date('Y');

$query = "SELECT * FROM laporan_pesanan 
          WHERE MONTH(tanggal) = '$filter_bulan' 
          AND YEAR(tanggal) = '$filter_tahun' 
          ORDER BY tanggal DESC";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pesanan</title>
    <link rel="stylesheet" href="css/laporan.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
</head>
<body>
<div class="container">

    <h1>Laporan Pesanan Bulanan</h1>

    <form method="GET" class="filter-form">
        <label for="bulan">Bulan:</label>
        <select name="bulan" id="bulan">
            <?php
            for ($i = 1; $i <= 12; $i++) {
                $bulan_val = str_pad($i, 2, '0', STR_PAD_LEFT);
                $selected = ($filter_bulan == $bulan_val) ? 'selected' : '';
                echo "<option value='$bulan_val' $selected>$bulan_val</option>";
            }
            ?>
        </select>

        <label for="tahun">Tahun:</label>
        <select name="tahun" id="tahun">
            <?php
            $tahun_sekarang = date('Y');
            for ($y = $tahun_sekarang; $y >= $tahun_sekarang - 5; $y--) {
                $selected = ($filter_tahun == $y) ? 'selected' : '';
                echo "<option value='$y' $selected>$y</option>";
            }
            ?>
        </select>

        <button type="submit">Filter</button>
    </form>

    <table id="laporanTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Telepon</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Layanan</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $total_semua = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$no}</td>
                        <td>{$row['nama']}</td>
                        <td>{$row['phone']}</td>
                        <td>{$row['tanggal']}</td>
                        <td>{$row['waktu']}</td>
                        <td>{$row['layanan_terpilih']}</td>
                        <td>Rp " . number_format($row['total_harga'], 0, ',', '.') . "</td>
                    </tr>";
                $total_semua += $row['total_harga'];
                $no++;
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6"><strong>Total Pendapatan</strong></td>
                <td><strong>Rp <?= number_format($total_semua, 0, ',', '.'); ?></strong></td>
            </tr>
        </tfoot>
    </table>
    <div class="btn-wrapper">
        <a href="dashboard.php" class="btn-kembali">← Kembali ke Dashboard</a>
        <button onclick="cetakPDF()" class="btn-cetak">Cetak Laporan (PDF)</button>
    </div>
</div>

<script>
function cetakPDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
    doc.text("Laporan Pesanan Bulanan ", 14, 16);
    doc.autoTable({ html: '#laporanTable', startY: 20 });
    doc.save("laporan_pesanan.pdf");
}
</script>
</body>
</html>
