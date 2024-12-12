<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/index.css?v=1.3">
    <link rel="stylesheet" href="../assets/css/header.css?=1.3">
    <title>Document</title>
</head>
<body>
    <?php 
        include "header.php";
    ?>

    <section class="pagesejarah">
        <div class="sejarahcont">
            <p class="judul">Maskot Bapenda</p>
            <center>
            <div class="maskotbapenda">
                <img src="https://bapenda.bandungbaratkab.go.id/storage/uploads/1691569358Snapinsta.app_239474715_262643755440517_7579362467952925098_n_1080.jpg" alt="">
                <img src="https://bapenda.bandungbaratkab.go.id/storage/uploads/1691569313Snapinsta.app_240183006_820835711922466_1098676542241954281_n_1080.jpg" alt="">
                <img src="https://bapenda.bandungbaratkab.go.id/storage/uploads/1691569276Snapinsta.app_239334220_887531352178817_7392994548708509302_n_1080.jpg" alt="">
            </div>
            </center>
            
            
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