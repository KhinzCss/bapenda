<?php
// Masukkan file koneksi
include '../koneksi.php';

$is_pajak = $_GET['id'];

if (isset($is_pajak) && is_numeric($is_pajak)) {
    $sql = "SELECT p.nama_pajak, p.informasi_pajak
            FROM pajak p
            WHERE p.id_pajak = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $is_pajak); 
    $stmt->execute();
    $result = $stmt->get_result();
    $pajak = $result->fetch_assoc();
    
    if ($pajak) {
        $nama_pajak = $pajak['nama_pajak'];
        $informasi_pajak = $pajak['informasi_pajak'];
    } else {
        $error_message = "Pajak tidak ditemukan!";
    }
} else {
    $error_message = "ID pajak tidak valid!";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/index.css?v=1.2">
    <link rel="stylesheet" href="../assets/css/header.css?v=1.3">
    <title>Detail Pajak</title>
</head>
<body>
    <?php 
        include "header.php";
    ?>

    <section class="pagesejarah">
        <div class="sejarahcont">
            <div class="judul">
                <?php echo isset($nama_pajak) ? $nama_pajak : "Pajak tidak ditemukan"; ?>
            </div>
            <div class="isiberitalengkap">
                <p><?php echo isset($informasi_pajak) ? nl2br($informasi_pajak) : (isset($error_message) ? $error_message : "Data tidak tersedia"); ?></p>
            </div>
        </div>
        <div class="beritakanan">
            <div class="beritakecil">
                <header>
                    <strong>Berita</strong>
                </header>
                <hr>
                <?php include "beritakanan.php"?>
            </div>
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
