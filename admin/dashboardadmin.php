<?php
session_start();
include "../koneksi.php";

// Cek apakah admin sudah login
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php"); // Arahkan ke halaman login jika admin belum login
    exit();
}

$sql_berita = "SELECT b.id_berita, b.judul_berita, b.tanggal_unggah, k.nama_kategori
               FROM berita b
               JOIN kategori k ON b.kategori_id = k.kategori_id
               ORDER BY b.tanggal_unggah DESC";
$result_berita = $conn->query($sql_berita);


$sql_pajak = "SELECT p.id_pajak, p.nama_pajak, p.informasi_pajak, p.file_pajak FROM pajak p";
$result_pajak = $conn->query($sql_pajak);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="../assets/css/admin.css?v=1.4">
    
</head>
<body>

    <div class="containeradmin">
        <h1>Dashboard Admin</h1>
        
        <div class="button-container">
            <a href="adminberita.php" class="btn"><button>tambah berita</button></a>
            <a href="tambahpajak.php" class="btn"><button>Tambah Pajak</button></a>
            <button type="button"><a href="../logout.php">logout</a></button>
        </div>

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
        <h2>Daftar Pajak</h2>   
    <table border="1" cellpadding="10">
        <tr>
            <th>Nama Pajak</th>
            <th>Infrmasi Pajak</th>
            <th>Tanggal Unggah</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = $result_pajak->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['nama_pajak']; ?></td>
                <td><?php echo $row['informasi_pajak']; ?></td>
                <td><?php echo $row['file_pajak']; ?></td>
                <td>

                    <!-- Link untuk Edit Pajak -->
                    <a href="edit_pajak.php?edit=<?php echo $row['id_pajak']; ?>"><button>Edit</button></a>
                    
                    <!-- Form Hapus Pajak -->
                    <form action="prosestambah.php" method="POST" style="display:inline;">
                        <input type="hidden" name="pajakdi" value="<?php echo $row['id_pajak']; ?>">
                        <button type="submit" name="hapuspajak">Hapus</button>
                    </form>

                </td>
            </tr>
        <?php endwhile; ?>
        
    </table>
    </div>

</body>
</html>
