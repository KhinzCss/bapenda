<?php
include "../koneksi.php";
$sql = "SELECT b.id_berita, b.judul_berita, b.foto_berita, b.tanggal_unggah, b.isi_berita, k.nama_kategori 
        FROM berita b
        LEFT JOIN kategori k ON b.kategori_id = k.kategori_id
        ORDER BY b.tanggal_unggah DESC";

$result = $conn->query($sql);

$sql_modal = "SELECT p.id_pajak, p.nama_pajak, p.informasi_pajak, p.file_pajak FROM pajak p";
$result_modal = $conn->query($sql_modal);
$modal = $result_modal->fetch_assoc();

if (!$result || !$result_modal) {
    die("Query Error: " . $conn->error); // Tampilkan pesan error jika query gagal
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/index.css?v=1.9">
    <link rel="stylesheet" href="../assets/css/header.css?v=1.5">
    <link rel="stylesheet" href="../assets/css/modal.css?v=1.3">
    
    <title>Document</title>
</head>
<body>
    <?php 
        include "header.php";
    ?>
    
    <section class="awal">
        <div class="branda">
            <img src="https://bapenda.bandungbaratkab.go.id/storage/sliders/1691566449.png" alt="">
        </div>
    </section>

    <section class="pelayanan">
        <h2>Pelayanan Pajak</h2>
        <center>
            <div class="contentpel">
                <div class="tahap1">
                    <div class="card">
                        <div class="cardhead">
                            <button type="submit">PBB</button>
                        </div>
                        <hr>
                        <div class="cardcontent">
                            <img src="https://bapenda.bandungbaratkab.go.id/storage//dokumen_pajak/icon/1691413761.png" alt="">
                        </div>
                    </div>
                    <div class="card">
                        <div class="cardhead">
                            <button type="submit">BPHTB</button>
                        </div>
                        <hr>
                        <div class="cardcontent">
                            <img src="https://bapenda.bandungbaratkab.go.id/storage//dokumen_pajak/icon/1691564980.png" alt="">
                        </div>
                    </div>
                    <div class="card">
                         <div class="cardhead">
                            <button type="button" onclick="openModal(1)">REKLAME</button>
                        </div>
                        <hr>
                        <div class="cardcontent">
                            <img src="https://bapenda.bandungbaratkab.go.id/storage//dokumen_pajak/icon/1691416079.png" alt="">
                        </div>
                    </div>
                    <div class="card">
                        <div class="cardhead">
                            <button type="button" onclick="openModal(2)">AIR</button>
                        </div>
                        <hr>
                        <div class="cardcontent">
                            <img src="https://bapenda.bandungbaratkab.go.id/storage//dokumen_pajak/icon/1691416150.png" alt="">
                        </div>
                    </div>
                    <div class="card">
                        <div class="cardhead">
                            <button type="submit">HOTEL</button>
                        </div>
                        <hr>
                        <div class="cardcontent">
                            <img src="https://bapenda.bandungbaratkab.go.id/storage//dokumen_pajak/icon/1691415876.png" alt="">
                        </div>
                    </div>
                    <div class="card">
                        <div class="cardhead">
                            <button type="submit">RESTO</button>
                        </div>
                        <hr>
                        <div class="cardcontent">
                            <img src="https://bapenda.bandungbaratkab.go.id/storage//dokumen_pajak/icon/1691416180.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="tahap1">
                    <div class="card">
                        <div class="cardhead">
                            <button type="submit">PARKIR</button>
                        </div>
                        <hr>
                        <div class="cardcontent">
                            <img src="https://bapenda.bandungbaratkab.go.id/storage//dokumen_pajak/icon/1691415904.png" alt="">
                        </div>
                    </div>
                    <div class="card">
                        <div class="cardhead">
                            <button type="submit">HIBURAN</button>
                        </div>
                        <hr>
                        <div class="cardcontent">
                            <img src="https://bapenda.bandungbaratkab.go.id/storage//dokumen_pajak/icon/1691416220.png" alt="">
                        </div>
                    </div>
                    <div class="card">
                        <div class="cardhead">
                            <button type="submit">MBLB</button>
                        </div>
                        <hr>
                        <div class="cardcontent">
                            <img src="https://bapenda.bandungbaratkab.go.id/storage//dokumen_pajak/icon/1691416266.png" alt="">
                        </div>
                    </div>
                    <div class="card">
                        <div class="cardhead">
                            <button type="submit">PPJ</button>
                        </div>
                        <hr>
                        <div class="cardcontent">
                            <img src="https://bapenda.bandungbaratkab.go.id/storage//dokumen_pajak/icon/1691416324.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </center>
    </section>
    
    <section class="berita">
        <div class="beritacon">
            <header class="beritahed">
                <h2>Berita Terbaru</h2>
            </header>
            <?php while ($row = $result->fetch_assoc()): ?>
            <div class="beritalagi">
            <!-- <pre></pre> -->

                <div class="fotoberita">
                    <img src="<?php echo $row['foto_berita']; ?>" alt="">
                </div>
                <div class="judulberita">
                    <span><?php echo $row['nama_kategori'] ?? 'Kategori Tidak Tersedia';  ?></span>
                    <h5>
                        <strong>
                            <a href="berita.php?id=<?php echo $row['id_berita']; ?>"><?php echo $row['judul_berita'] ?? 'kayegori tidal tersedia'; ?></a>
                        </strong>
                    </h5>
                    <p class="tanggal"><?php echo $row['tanggal_unggah'] ?? 'tanggal tidak tersedia'; ?></p>
                    <div class="isiberita">
                        <div class="isi"><?php echo nl2br($row['isi_berita'] ?? 'isi tidak ada'); ?></div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        <div class="sidef">
            <div class="fotobupati">
                <header class="bupatihead">
                    <h2>Bupati Kab.Bandung Barat</h2>
                </header>
                <div class="bupati">
                    <img src="https://bapenda.bandungbaratkab.go.id/storage/referensi/pengaturan/logo/1722842637.png" alt="">
                </div>
            </div>
            <div class="pengumuman">
                <header class="penghead">
                    <h2>Pengumuman</h2>
                </header>
                <div class="pengcontent">
                    <div class="tanggaladmin">
                        <p><span>admin  </span>
                        Rabu, 29 November 2023</p>
                    </div>
                    <div class="isipengumuman">
                        <p>Pemberitahuan Penggunaan Sistem Pelaporan Pajak Daerah Lainnya (SIPADA-PJDL)</p>
                    </div>
                    <button class="lihat">Lihat</button>
                    <hr>
                    <div class="tanggaladmin">
                        <p><span>admin  </span>
                        Rabu, 29 November 2023</p>
                    </div>
                    <div class="isipengumuman">
                        <p>Pemberitahuan Penggunaan Sistem Pelaporan Pajak Daerah Lainnya (SIPADA-PJDL)</p>
                    </div>
                    <button class="lihat">Lihat</button>
                    <hr>
                </div>
            </div>
            <div class="pengunjung">
                <header class="pengunjunghead">
                    <h2>Statistik Pengunjung</h2>
                </header>
                <div class="pengunjungcontent">
                    <div class="pengunjunghariini">
                        <span>10</span>
                        <p>Pengunjung Hari ini</p>
                    </div>
                    <hr>
                    <div class="totalpengunjung">
                        <span>5555</span>
                        <p>Total Pengunjung</p>
                    </div>
                </div>
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

    <div class="modal-overlay" id="modalReklame">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modalTitle">Loading...</h5>
                <button class="close-btn" onclick="closeModal()">Tutup</button>
            </div>
            <div class="modal-body">
                <p id="modalDescription">Loading...</p>
                <div class="file-section" id="fileSection"></div>
            </div>
        </div>
    </div>



    <script src="../assets/js/script.js"></script>
    <script>
function openModal(pajakId) {
    console.log('Modal sedang dibuka untuk pajak ID: ' + pajakId); // Debugging
    // Kirim ID pajak ke server menggunakan AJAX untuk mendapatkan data yang relevan
    fetchPajakData(pajakId);
    document.getElementById("modalReklame").style.display = "flex";
}

function fetchPajakData(pajakId) {
    fetch('../database/get_pajak_data.php?id=' + pajakId)
        .then(response => response.json())
        .then(data => {
            // Update modal dengan data yang diterima
            const modalHeader = document.querySelector('.modal-header h5');
            modalHeader.textContent = data.nama_pajak || 'Nama Pajak Tidak Tersedia';

            // Menampilkan hanya file jika ada
            const fileSection = document.querySelector('.modal-body .file-section');
            if (data.file_pajak) {
                fileSection.innerHTML = `<h6>File:</h6>
                                        <div class="file-item">
                                            <p>${data.file_pajak}</p>
                                            <a href="../uploads/${data.file_pajak}" class="download-btn" download>Download</a>
                                        </div>`;
            } else {
                fileSection.innerHTML = '<p>File tidak tersedia.</p>';
            }
        })
        .catch(error => console.log('Error:', error));
}

// Fungsi untuk menutup modal
function closeModal() {
    document.getElementById("modalReklame").style.display = "none";
}

// Menambahkan event listener untuk tombol tutup
document.querySelector('.close-btn').addEventListener('click', closeModal);


    </script>
    

</body>
</html>