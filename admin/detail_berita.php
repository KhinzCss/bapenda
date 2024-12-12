<?php
// Masukkan file koneksi
include '../koneksi.php';

// Ambil ID berita dari URL
$id_berita = $_GET['id'];

// Ambil detail berita dari database
$sql = "SELECT b.judul_berita, b.isi_berita, b.foto_berita, b.tanggal_unggah, k.nama_kategori 
        FROM berita b
        JOIN kategori k ON b.kategori_id = k.kategori_id
        WHERE b.id_berita = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_berita);
$stmt->execute();
$result = $stmt->get_result();
$berita = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Berita</title>
    <style>
        .detail-container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 8px;
        }
        .category {
            background-color: red;
            color: white;
            padding: 5px;
            font-size: 14px;
            text-align: center;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .berita-img {
            width: 100%;
            height: auto;
            object-fit: cover;
            margin-bottom: 20px;
        }
        .berita-title {
            font-size: 30px;
            margin-bottom: 10px;
            color: #333;
        }
        .berita-content {
            font-size: 18px;
            color: #666;
        }
        .berita-date {
            font-size: 14px;
            color: #888;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="detail-container">
        <div class="category"><?php echo $berita['nama_kategori']; ?></div>
        <img src="<?php echo $berita['foto_berita']; ?>" alt="Foto Berita" class="berita-img">
        <div class="berita-title"><?php echo $berita['judul_berita']; ?></div>
        <div class="berita-date"><?php echo $berita['tanggal_unggah']; ?></div>
        <div class="berita-content">
            <p><?php echo nl2br($berita['isi_berita']); ?></p>
        </div>
    </div>

</body>
</html>
