<?php
// Masukkan file koneksi
include '../koneksi.php';

$sql_pajak = "SELECT p.id_pajak, p.nama_pajak, p.informasi_pajak FROM pajak p";
$result_pajak = $conn->query($sql_pajak);
$pajakinfo = $result_pajak->fetch_assoc();

?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<section class="atas">
    <i class="atas1">
        <a href="http://">bapenda@bandungbaratkab.go.id</a>
    </i>
    <i class="atas1">
        <span>02282783490</span>
    </i>
</section>
<header class="header">
    <div class="contenthed">
        <a href="http://" class="logo">
            <img src="https://bapenda.bandungbaratkab.go.id/storage/referensi/pengaturan/logo/1684125212.jpg">
        </a>
        <nav class="navbar">
            <ul>
                <li>
                    <a href="index.php?beranda">Beranda</a>
                </li>
                <li class="dropdown">
                    <a class="dropbtn">Profil 
                        <i class="fas fa-chevron-down"></i>
                    </a>
                    <div class="dropdown-content">
                        <div class="dropdown">
                            <a class="dropbtn" href="#">Tentan Bapenda <i class="fas fa-chevron-down"></i></a>
                            <div class="dropdown-content2">
                                <a href="sejarahbapenda.php">sejarah bapenda</a>
                                <a href="visimisi.php">visi misi</a>
                                <a href="strukturorganisasi.php">struktur organisasi</a>
                                <a href="logobapenda.php">logo bapenda</a>
                                <a href="maskotbapenda.php">maskot bapenda</a>
                                <a href="maklumatbapenda.php">maklumat pelayanan</a>
                            </div>
                        </div>
                        
                        <a href="kepalabapenda.php">Kepala Bapenda</a>
                        <a href="sekertasisbapenda.php">Sekertaris Bapenda</a>
                        <div class="dropdown">
                            <a class="dropbtn" href="#">Bidang <i class="fas fa-chevron-down"></i></a>
                            <div class="dropdown-content2">
                                <a href="bidangpendataan.php">bidang pendataan</a>
                                <a href="bidangpenpel.php">bidang penetapan dan pelayanan</a>
                                <a href="bidangpenagihan.php">bidang penagihan dan pengendalian</a>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="dropdown">
                    <a class="dropbtn">Pajak 
                        <i class="fas fa-chevron-down"></i>
                    </a>
                    <div class="dropdown-content">
                        <div class="dropdown">
                            <a class="dropbtn" href="#">PBB dan bphtb <i class="fas fa-chevron-down"></i></a>
                            <div class="dropdown-content2">
                                <a href="#">pbb</a>
                                <a href="#">bphtb</a>
                            </div>
                        </div>

                        <div class="dropdown">
                            <a class="dropbtn" href="#">NON PBB <i class="fas fa-chevron-down"></i></a>
                            <div class="dropdown-content3">
                                <a href="pajak.php?id=1">Reklame</a>
                                <a href="pajak.php?id=2">Air Tanah</a>
                                <a href="pajak.php?id=3">Hotel</a>
                                <a href="pajak.php?id=4">Restoran</a>
                                <a href="pajak.php?id=5">Parkir</a>
                                <a href="pajak.php?id=6">Hiburan</a>
                                <a href="pajak.php?id=7">Penerangan Jalan</a>
                                <a href="pajak.php?id=8">Mineral Bukan Logam</a>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="dropdown">
                    <a class="dropbtn">produk hukum 
                        <i class="fas fa-chevron-down"></i>
                    </a>
                    <div class="dropdown-content">
                        <a href="#">Peraturan Daerah</a>
                        <div class="dropdown">
                            <a class="dropbtn" href="#">peraturan bupati <i class="fas fa-chevron-down"></i></a>
                            <div class="dropdown-content3">
                                <a href="#">reklame</a>
                                <a href="#">air</a>
                                <a href="#">hotel</a>
                                <a href="#">restoran</a>
                                <a href="#">parkir</a>
                                <a href="#">hiburan</a>
                                <a href="#">penerangan jalan</a>
                                <a href="#">mineral bukan logan dan batuan</a>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <a href="listBerita.php">Berita</a>
                </li>
                <li class="dropdown">
                    <a class="dropbtn" href="#">layanan informasi <i class="fas fa-chevron-down"></i></a>
                        <div class="dropdown-content">
                            <a href="#">alur pembayaran pajak</a>
                        </div>
                </li>
            </ul>
        </nav>
    </div>
</header>