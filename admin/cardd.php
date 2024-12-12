<?php
// Masukkan file koneksi
include '../koneksi.php';

// Ambil data berita dari database
$sql = "SELECT judul_berita, foto_berita, tanggal_unggah FROM berita ORDER BY tanggal_unggah DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Berita</title>
    <style>
        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            overflow: hidden; /* Sembunyikan card yang melebihi tinggi container */
            max-height: 660px; /* 3 baris (3 x tinggi card = 220px per card) */
            transition: max-height 0.3s ease;
        }
        .card-container.expanded {
            max-height: none; /* Hilangkan batas saat tombol "Lihat Lebih Banyak" ditekan */
        }
        .card {
            width: 300px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            background: #fff;
        }
        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .card-content {
            padding: 15px;
        }
        .card-content h3 {
            margin: 0;
            font-size: 20px;
            color: #333;
        }
        .card-content p {
            margin: 10px 0 0;
            color: #666;
        }
        .show-more {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .show-more:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Daftar Berita</h1>
    <div class="card-container" id="cardContainer">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="card">
                <img src="<?php echo $row['foto_berita']; ?>" alt="Foto Berita">
                <div class="card-content">
                    <h3><?php echo $row['judul_berita']; ?></h3>
                    <p><?php echo $row['tanggal_unggah']; ?></p>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    <button class="show-more" id="showMoreBtn">Lihat Lebih Banyak</button>

    <script>
        const cardContainer = document.getElementById('cardContainer');
        const showMoreBtn = document.getElementById('showMoreBtn');

        showMoreBtn.addEventListener('click', () => {
            // Toggle kelas untuk memperluas atau menyembunyikan card tambahan
            if (cardContainer.classList.contains('expanded')) {
                cardContainer.classList.remove('expanded');
                showMoreBtn.textContent = 'Lihat Lebih Banyak';
            } else {
                cardContainer.classList.add('expanded');
                showMoreBtn.textContent = 'Sembunyikan';
            }
        });
    </script>
</body>
</html>
