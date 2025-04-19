<?php
include 'koneksi.php'; // Pastikan file koneksi sudah ada

// Ambil data berdasarkan ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM services WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    $service = mysqli_fetch_assoc($result);
}

// Update data service
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $query = "UPDATE services SET name='$name', price='$price' WHERE id='$id'";
    mysqli_query($conn, $query);
    header("Location: kelola_service.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Service</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding: 20px;
        }
        form {
            background: white;
            padding: 20px;
            width: 300px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 0 10px gray;
        }
        input {
            width: 90%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid gray;
            border-radius: 5px;
        }
        button {
            padding: 10px;
            width: 100%;
            background: blue;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        a {
            display: block;
            margin-top: 10px;
            text-decoration: none;
            color: red;
        }
    </style>
</head>
<body>
    <h2>Edit Service</h2>
    <form action="" method="POST">
        <input type="hidden" name="id" value="<?= $service['id'] ?>">
        <input type="text" name="name" value="<?= $service['name'] ?>" required>
        <input type="number" name="price" value="<?= $service['price'] ?>" required>
        <button type="submit" name="update">Update</button>
        <a href="kelola_service.php">Batal</a>
    </form>

    <a href="kelola_service.php" class="btn">Kembali Menu Service</a>
</body>
</html>
