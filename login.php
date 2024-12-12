<?php
// Mulai sesi
session_start();

// Masukkan file koneksi
include 'koneksi.php';

// Cek apakah form login telah di-submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $namaadmin = $_POST['namaadmin'];
    $passwordadmin = $_POST['passwordadmin'];

    // Pastikan input tidak kosong
    if (!empty($namaadmin) && !empty($passwordadmin)) {
        // Query untuk mengambil data admin
        $sql = "SELECT * FROM admin WHERE namaadmin = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $namaadmin);
        $stmt->execute();
        $result = $stmt->get_result();

        // Cek apakah admin ditemukan
        if ($result->num_rows > 0) {
            $admin = $result->fetch_assoc();

            // Verifikasi password
            if (password_verify($passwordadmin, $admin['passwordadmin'])) {
                // Simpan informasi admin ke sesi
                $_SESSION['admin_id'] = $admin['admin_id'];
                $_SESSION['namaadmin'] = $admin['namaadmin'];

                // Redirect ke halaman dashboard
                header("Location: admin/dashboardadmin.php");
                exit();
            } else {
                $error = "Password salah!";
            }
        } else {
            $error = "Admin tidak ditemukan!";
        }
    } else {
        $error = "Mohon isi semua field!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .login-container h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }
        .login-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .login-container button {
            width: 100%;
            padding: 10px;
            background: #007BFF;
            border: none;
            color: white;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .login-container button:hover {
            background: #0056b3;
        }
        .error {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Login Admin</h1>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST" action="">
            <input type="text" name="namaadmin" placeholder="Nama Admin" required>
            <input type="password" name="passwordadmin" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
