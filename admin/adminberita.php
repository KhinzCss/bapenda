<?php
// Mulai sesi
session_start();

// Cek apakah admin sudah login
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit();
}

// Masukkan file koneksi
include '../koneksi.php';

// Ambil data kategori dari tabel kategori
$sql_kategori = "SELECT kategori_id, nama_kategori FROM kategori";
$result_kategori = $conn->query($sql_kategori);

// Ambil semua data berita untuk ditampilkan di tabel
$sql_berita = "SELECT b.id_berita, b.judul_berita, b.tanggal_unggah, k.nama_kategori
               FROM berita b
               JOIN kategori k ON b.kategori_id = k.kategori_id
               ORDER BY b.tanggal_unggah DESC";
$result_berita = $conn->query($sql_berita);


?>

<!DOCTYPE html>
<html lang="id">
<head>
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/admin.css?v=1.4">
    <title>Admin - Tambah Berita</title>
</head>
<body>
    <div class="containeradmin">
    <h1>Tambah Berita</h1>
    <?php if (isset($success)) echo "<p style='color: green;'>$success</p>"; ?>
    <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>

    <form method="POST" action="prosestambah.php" enctype="multipart/form-data">
        <label for="judul_berita">Judul Berita:</label><br>
        <input type="text" id="judul_berita" name="judul_berita" required><br><br>

        <label for="isi_berita">Isi Berita:</label><br>
        <div id="editor-container" style="height: 200px;"></div>
        <input type="hidden" id="isi_berita" name="isi_berita">


        <label for="foto_berita">Foto Berita:</label><br>
        <input type="file" id="foto_berita" name="foto_berita" accept="image/*" required><br><br>

        <label for="kategori_id">Kategori Berita:</label><br>
        <select id="kategori_id" name="kategori_id" required>
            <option value="">Pilih Kategori</option>
            <?php while ($row = $result_kategori->fetch_assoc()): ?>
                <option value="<?php echo $row['kategori_id']; ?>"><?php echo $row['nama_kategori']; ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <button type="submit" name="tambah">Simpan</button>
    </form>

    <h2>Daftar Berita</h2>
    <table border="1" cellpadding="10">
        <tr>
            <th>Judul Berita</th>
            <th>Kategori</th>
            <th>Tanggal Unggah</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = $result_berita->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['judul_berita']; ?></td>
                <td><?php echo $row['nama_kategori']; ?></td>
                <td><?php echo $row['tanggal_unggah']; ?></td>
                <td>
                    <form action="prosesupdate.php" method="POST" style="display:inline;">
                        <input type="hidden" name="berita_id" value="<?php echo $row['id_berita']; ?>">
                        <button type="submit" name="edit">Edit</button>
                    </form>
                    <form action="prosestambah.php" method="POST" style="display:inline;">
                        <input type="hidden" name="berita_id" value="<?php echo $row['id_berita']; ?>">
                        <button type="submit" name="hapus">Hapus</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    <?php 
    include "adminkategori.php";
    ?>
    </div>

    <script>
        
    var quill = new Quill('#editor-container', {
        theme: 'snow',
        placeholder: 'Tulis berita di sini...',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'align': [] }],
                ['link', 'image']
            ]
        }
    });

    // Sinkronkan isi editor ke input hidden saat form disubmit
    document.querySelector('form').onsubmit = function() {
        document.querySelector('#isi_berita').value = quill.root.innerHTML;
    };
    </script>
    
</body>
</html>
