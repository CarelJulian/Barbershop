<?php
include 'koneksi.php'; // Pastikan ada file koneksi database

// Tambah Service
if (isset($_POST['tambah'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $query = "INSERT INTO services (name, price) VALUES ('$name', '$price')";
    mysqli_query($conn, $query);
    header("Location: kelola_service.php");
}

// Edit Service
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $query = "UPDATE services SET name='$name', price='$price' WHERE id='$id'";
    mysqli_query($conn, $query);
    header("Location: kelola_service.php");
}

// Hapus Service
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $query = "DELETE FROM services WHERE id='$id'";
    mysqli_query($conn, $query);
    header("Location: kelola_service.php");
}

// Ambil Data Service
$query = "SELECT * FROM services";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Service</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding: 20px;
        }
        table {
            width: 70%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid black;
            background: white;
        }
        th {
            background: yellow;
        }
        .btn {
            padding: 5px 10px;
            margin: 5px;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn-tambah {
            background: green;
            color: white;
        }
        .btn-edit {
            background: blue;
            color: white;
        }
        .btn-hapus {
            background: red;
            color: white;
        }
    </style>
</head>
<body>
    <h2>Kelola Service</h2>

    <!-- Form Tambah Service -->
    <form action="" method="POST">
        <input type="text" name="name" placeholder="Nama Service" required>
        <input type="number" name="price" placeholder="Harga" required>
        <button type="submit" name="tambah" class="btn btn-tambah">Tambah</button>
    </form>

    <table>
        <tr>
            <th>ID</th>
            <th>Nama Service</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= number_format($row['price'], 0, ',', '.') ?></td>
                <td>
                    <a href="edit_service.php?id=<?= $row['id'] ?>" class="btn btn-edit">Edit</a>
                    <a href="?hapus=<?= $row['id'] ?>" class="btn btn-hapus" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <a href="dashboard.php" class="btn btn-dashboard">Kembali ke Dashboard</a>
</body>
</html>
