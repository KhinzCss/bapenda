<?php
session_start();
include "../koneksi.php";

// Cek apakah admin sudah login
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php"); // Arahkan ke halaman login jika admin belum login
    exit();
}

// Cek jika parameter 'edit' ada di URL
if (isset($_GET['edit'])) {
    $id_pajak = $_GET['edit'];
    
    // Ambil data pajak dari database berdasarkan ID
    $sql = "SELECT * FROM pajak WHERE id_pajak = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_pajak);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($data = $result->fetch_assoc()) {
        // Data pajak ditemukan, tampilkan form edit
    } else {
        // Jika data pajak tidak ditemukan, redirect kembali ke dashboard
        header("Location: dashboard.php");
        exit();
    }
} else {
    // Jika tidak ada parameter 'edit', redirect ke dashboard
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pajak</title>
    <link rel="stylesheet" href="../assets/css/admin.css?v=1.4">
</head>
<body>
    <div class="containeradmin">
        <h1>Edit Pajak</h1>
        
        <!-- Form untuk Edit Pajak -->
        <form action="prosestambah.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_pajak" value="<?php echo $data['id_pajak']; ?>">
            <input type="hidden" name="file_pajak_lama" value="<?php echo $data['file_pajak']; ?>">
            
            <label for="nama_pajak">Nama Pajak</label>
            <input type="text" name="nama_pajak" value="<?php echo $data['nama_pajak']; ?>" required>
            
            <label for="informasi_pajak">Informasi Pajak</label>
            <textarea name="informasi_pajak" required><?php echo $data['informasi_pajak']; ?></textarea>
            
            <label for="file_pajak">File Pajak (opsional)</label>
            <input type="file" name="file_pajak">
            
            <button type="submit" name="updatepajak">Update Pajak</button>
        </form>
    </div>
</body>
</html>
