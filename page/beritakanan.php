<?php
// Masukkan file koneksi
include '../koneksi.php';

$sql = "SELECT b.id_berita, b.judul_berita, b.foto_berita, b.tanggal_unggah, k.nama_kategori 
        FROM berita b
        JOIN kategori k ON b.kategori_id = k.kategori_id
        ORDER BY b.tanggal_unggah DESC";
$result = $conn->query($sql);
?>
<?php while ($row = $result->fetch_assoc()): ?>
<div class="bungkus">
    <div class="fotokecil">
        <img src="<?php echo $row['foto_berita']?>" alt="">
    </div>
    <div class="namaberita">
        <a href="berita.php?id=<?php echo $row['id_berita']; ?>"><?php echo $row['judul_berita']?></a>
        <p class="tanggalber"><?php echo $row['tanggal_unggah']?></p>
    </div>
</div>
<?php endwhile?>