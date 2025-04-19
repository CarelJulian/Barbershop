<?php
session_start();
include 'koneksi.php'; // Pastikan koneksi.php sudah benar

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim(mysqli_real_escape_string($conn, $_POST['username']));
    $password = trim(mysqli_real_escape_string($conn, $_POST['password'])); // Simpan tanpa hash

    if (!empty($username) && !empty($password)) {
        // Cek username dan password di database
        $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['admin'] = $row['username'];
            header("Location: dashboard.php"); // Redirect ke halaman dashboard
            exit();
        } else {
            $error = "Username atau password salah!";
        }
    } else {
        $error = "Harap isi username dan password!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body class="bg-gray-900 flex items-center justify-center h-screen">

    <div class="bg-gray-800 p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold text-white text-center">Login Admin</h2>
        
        <?php if (isset($error)): ?>
            <p class="text-red-500 text-sm text-center mt-2"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="POST" class="mt-4">
            <div class="mb-4">
                <label class="block text-gray-300 text-sm font-bold mb-2">Username</label>
                <input type="text" name="username" class="w-full p-2 text-black rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-300 text-sm font-bold mb-2">Password</label>
                <input type="password" name="password" class="w-full p-2 text-black rounded" required>
            </div>

            <button type="submit" class="w-full bg-yellow-500 text-black font-bold py-2 px-4 rounded-full hover:bg-yellow-400 transition">Login</button>
        </form>
    </div>

</body>
</html>
