<?php 
session_start();
include "../koneksi.php";

// Cek apakah ID berita valid
if (!isset($_POST['berita_id'])) {
    echo "<script>alert('ID berita tidak ditemukan.'); location.href='adminberita.php';</script>";
    exit();
}

$berita_id = $_POST['berita_id'];

// Ambil data berita berdasarkan ID
$query = mysqli_query($conn, "SELECT * FROM berita WHERE id_berita = '$berita_id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "<script>alert('Berita tidak ditemukan.'); location.href='adminberita.php';</script>";
    exit();
}

// Proses update
if (isset($_POST['update'])) {
    $judul_berita = $_POST['judul_berita'];
    $isi_berita = $_POST['isi_berita'];
    $tanggal_unggah = date("Y-m-d");

    // Jika ada file foto baru
    if (!empty($_FILES['foto_berita']['name'])) {
        $foto_berita = $_FILES['foto_berita'];
        $lokasi = "../assets/upload/"; // Folder tujuan
        $nama_file = uniqid() . '-' . basename($foto_berita["name"]); // Nama file unik
        $path_relatif = "assets/upload/" . $nama_file; // Path relatif untuk disimpan di database
        $path_lengkap = $lokasi . $nama_file; // Path lengkap di server

        // Hapus file lama jika ada
        if (!empty($data['foto_berita']) && is_file("../" . $data['foto_berita'])) {
            unlink("../" . $data['foto_berita']);
        }

        // Pindahkan file baru
        if (move_uploaded_file($foto_berita["tmp_name"], $path_lengkap)) {
            $sql = "UPDATE berita SET judul_berita = ?, isi_berita = ?, foto_berita = ?, tanggal_unggah = ? WHERE id_berita = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssi", $judul_berita, $isi_berita, $path_lengkap, $tanggal_unggah, $berita_id);
        }
    } else {
        // Jika tidak ada file baru
        $sql = "UPDATE berita SET judul_berita = ?, isi_berita = ?, tanggal_unggah = ? WHERE id_berita = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $judul_berita, $isi_berita, $tanggal_unggah, $berita_id);
    }

    // Eksekusi query
    if ($stmt->execute()) {
        echo "<script>
            alert('Berita berhasil diperbarui.');
            location.href = 'adminberita.php';
        </script>";
    } else {
        echo "<script>alert('Gagal memperbarui berita.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/admin.css?v=1.4">
    <title>Edit Berita</title>
</head>
<body>
    <div class="containeradmin">
        <form action="prosesupdate.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="berita_id" value="<?php echo $berita_id; ?>">
            <label>Judul Berita:</label>
            <input type="text" name="judul_berita" value="<?php echo htmlspecialchars($data['judul_berita']); ?>" required>
            
            <label>Isi Berita:</label>
            <textarea name="isi_berita" required><?php echo htmlspecialchars($data['isi_berita']); ?></textarea>
            
            <label>Foto Berita (Opsional):</label>
            <input type="file" name="foto_berita">
            
            <button type="submit" name="update">Update</button>
        </form>
    </div>
</body>
</html>
