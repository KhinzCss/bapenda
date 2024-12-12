<?php
// Masukkan file koneksi
include '../koneksi.php';

$sql = "SELECT id_berita, judul_berita, foto_berita, tanggal_unggah FROM berita ORDER BY tanggal_unggah DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/index.css?v=1.2">
    <link rel="stylesheet" href="../assets/css/header.css?v=1.3">
    <link rel="stylesheet" href="../assets/css/berita.css?v=1.3">
    <title>Document</title>
</head>
<body>
    <?php 
        include "header.php";
    ?>

    <section class="listberita">

        <h1>Daftar Berita</h1>
        <div class="card-container" id="cardContainer">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="card">
                    <img src="<?php echo $row['foto_berita']; ?>" alt="Foto Berita">
                    <div class="card-content">
                        <strong>
                            <a href="berita.php?id=<?php echo $row['id_berita']; ?>"><?php echo $row['judul_berita'] ?? 'kayegori tidal tersedia'; ?></a>
                        </strong>
                        <p><?php echo $row['tanggal_unggah']; ?></p>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
            
    </section>
    <footer>
        <div class="contentfoot">
            <div class="bapemda">
                <h1>Bapenda KBB</h1>
            </div>
            <div class="ppp">
                <div class="profil">
                    <h3>Profil</h3>
                    <ul>
                        <li><a href="">Tentang Bapenda</a></li>
                        <li><a href="">Kepala Bapenda</a></li>
                        <li><a href="">Sekertaris Bapenda</a></li>
                        <li><a href="">Bidang</a></li>
                    </ul>
                </div>
                <div class="informasi">
                    <h3>Informasi</h3>
                </div>
                <div class="kantor">
                    <h3>Kantor</h3>
                    <ul>
                        <li>
                            <p>Jl. Raya Padalarang-Cisarua Km.2 Ngamprah Gedung C Lantai 1 Komplek Perkantoran Pemerintah Kabupaten Bandung Barat.</p>
                        </li>
                        <li><strong>Phone :</strong><p>02282783490</p></li>
                        <li><strong>Email :</strong><p>bapenda@bandungbaratkab.go.id</p></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="copyright">
            <p>© Copyright <strong>Bapenda KBB.</strong></p>
        </div>
    </footer>


 
</body>
</html>