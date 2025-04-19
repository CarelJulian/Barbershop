<?php
include 'koneksi.php';

date_default_timezone_set('Asia/Jakarta');

// Ambil nomor antrian terbaru berdasarkan tanggal hari ini
$tanggal_sekarang = date('Y-m-d');
$waktu_sekarang = date('H:i');
$query_nomor = "SELECT COUNT(*) as total FROM detail_pesanan WHERE tanggal = '$tanggal_sekarang'";
$result_nomor = mysqli_query($conn, $query_nomor);
$row_nomor = mysqli_fetch_assoc($result_nomor);
$nomor_antrian = $row_nomor['total'] + 1;

// Ambil daftar layanan dari database
$query_services = "SELECT * FROM services";
$result_services = mysqli_query($conn, $query_services);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Sekarang - Urban Shave Barbershop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="css/pesan.css">
</head>
<body class="bg-black text-white relative">
    
    <!-- Tombol Kembali -->
    <a href="dashboarduser.php" class="absolute top-4 left-4 bg-gray-700 hover:bg-gray-600 text-white py-2 px-4 rounded-lg shadow-md">
        ⬅ Kembali
    </a>

    <div class="background-slideshow"></div>

    <main class="flex justify-center items-center min-h-screen p-4">
        <div class="form-container bg-[#1a1a1a] p-8 rounded-2xl shadow-xl max-w-3xl w-full">
            <h2 class="form-title text-center text-3xl text-yellow-400 font-bold mb-6">Pesan Sekarang</h2>
            <form action="proses_pesan.php" method="POST">
                <div class="form-group mb-4">
                    <label class="block mb-2">Nomor Antrian</label>
                    <input type="text" name="nomor_antrian" value="<?php echo $nomor_antrian; ?>" readonly class="w-full px-4 py-2 rounded-lg bg-gray-800 text-white border-none">
                </div>

                <div class="form-group mb-4">
                    <label class="block mb-2">Nama</label>
                    <input type="text" name="name" placeholder="Nama Anda" required class="w-full px-4 py-2 rounded-lg bg-gray-800 text-white border-none">
                </div>

                <div class="form-group mb-4">
                    <label class="block mb-2">Nomor Telepon</label>
                    <input type="tel" name="phone" placeholder="Nomor Telepon Anda" required class="w-full px-4 py-2 rounded-lg bg-gray-800 text-white border-none">
                </div>

                <div class="form-group mb-4">
                    <label class="block mb-2">Tanggal</label>
                    <input type="date" name="date" value="<?php echo $tanggal_sekarang; ?>" readonly class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white cursor-not-allowed">
                </div>

                <div class="form-group mb-4">
                    <label class="block mb-2">Waktu</label>
                    <input type="time" name="time" value="<?php echo $waktu_sekarang; ?>" readonly class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white cursor-not-allowed">
                </div>

                <div class="form-group mb-6">
                    <label class="block text-lg font-semibold mb-2">Pilih Layanan</label>
                    <div class="flex flex-wrap gap-4">
                        <?php while ($service = mysqli_fetch_assoc($result_services)) : ?>
                            <label class="flex items-center bg-gray-800 hover:bg-gray-700 px-4 py-2 rounded-lg cursor-pointer transition duration-200 w-fit">
                                <input type="checkbox" name="services[]" value="<?php echo $service['id']; ?>" 
                                       data-price="<?php echo $service['price']; ?>" 
                                       onclick="hitungTotal()" class="mr-3 w-5 h-5 accent-yellow-500">
                                <span>
                                    <?php echo $service['name']; ?> -
                                    <span class="text-yellow-400">Rp<?php echo number_format($service['price'], 0, ',', '.'); ?></span>
                                </span>
                            </label>
                        <?php endwhile; ?>
                    </div>
                </div>

                <div class="form-group mb-6">
                    <label class="block mb-2">Total Harga</label>
                    <input type="text" id="total_harga" name="total_harga" value="Rp0" readonly class="w-full px-4 py-2 rounded-lg bg-gray-800 text-white border-none">
                </div>

                <div class="text-center">
                    <button type="submit" class="btn-primary bg-yellow-400 text-black px-6 py-3 rounded-xl font-bold hover:bg-yellow-300 transition">
                        Pesan Sekarang
                    </button>
                </div>
            </form>
        </div>
    </main>

    <script>
        function hitungTotal() {
            let total = 0;
            let checkboxes = document.querySelectorAll("input[name='services[]']:checked");

            checkboxes.forEach((checkbox) => {
                total += parseInt(checkbox.getAttribute("data-price"));
            });

            document.getElementById("total_harga").value = "Rp" + total.toLocaleString("id-ID");
        }
    </script>
</body>
</html>
