<?php 
session_start();
include '../koneksi.php';
//upload poto proses

if (isset($_POST['tambah'])) {
    $judul_berita = $_POST['judul_berita'];
    $isi_berita = $_POST['isi_berita'];
    $tanggal_unggah = date("Y-m-d");
    $admin_id = $_SESSION['admin_id'];
    $kategori_id = $_POST['kategori_id'];

    // Upload foto
    $foto_berita = $_FILES['foto_berita'];
    $lokasi = "../assets/upload/";
    $nama_file = uniqid().'-' . basename($foto_berita["name"]);
    $namadanlokasi = $lokasi . $nama_file;
    $uploadOk = 1;
    $imageType = strtolower(pathinfo($namadanlokasi, PATHINFO_EXTENSION));

    if (isset($_POST["submit"])) {
        $check = getimagesize($foto_berita["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $error = "File bukan gambar!";
            $uploadOk = 0;
        }
    }

    if ($uploadOk && move_uploaded_file($foto_berita["tmp_name"], $namadanlokasi)) {
        $sql = "INSERT INTO berita (judul_berita, isi_berita, foto_berita, tanggal_unggah, admin_id, kategori_id) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssii", $judul_berita, $isi_berita, $namadanlokasi, $tanggal_unggah, $admin_id, $kategori_id);

        if ($stmt->execute()) {
            $success = "Berita berhasil ditambahkan!";
            echo"<script>
                alert('$success');
                location.href = 'dashboardadmin.php';
            </script>";

            // header("Location:dashboardadmin.php");
            // exit();
        } else {
            $error = "Gagal menyimpan berita!";
        }
    } else {
        $error = "Gagal mengupload gambar!";
    }
}

// tambah kategori
if(isset($_POST['tambahkategori'])){
    $kategori = $_POST['kategoriname'];
    $admin_id = $_SESSION['admin_id'];

    $sql = mysqli_query($conn, "INSERT INTO kategori (nama_kategori,admin_id) VALUES ('$kategori','$admin_id')");

    echo"<script>
       alert('Data Berhasil Disimpan.');
       location.href ='adminkategori.php';
    </script>";

}



if (isset($_POST['hapus'])) {
    $berita_id = $_POST['berita_id'];

    // Cek apakah berita ID valid
    if (!empty($berita_id)) {
        // Ambil informasi foto
        $query = mysqli_query($conn, "SELECT foto_berita FROM berita WHERE id_berita = '$berita_id'");
        $data = mysqli_fetch_assoc($query);

        // Hapus file foto jika ada
        if (!empty($data['foto_berita']) && is_file("../" . $data['foto_berita'])) {
            unlink("../" . $data['foto_berita']);
        }

        // Hapus berita dari database
        $sql = mysqli_query($conn, "DELETE FROM berita WHERE id_berita = '$berita_id'");
        if ($sql) {
            echo"<script>
                alert('Data Berhasil dihapus.');
                location.href ='dashboardadmin.php';
            </script>";
        } else {
            echo "<script>alert('Gagal menghapus berita.');</script>";
        }
    } else {
        echo "<script>alert('ID berita tidak ditemukan.');</script>";
    }
}



// proses pajak

// Cek apakah admin sudah login
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php"); // Arahkan ke halaman login jika admin belum login
    exit();
}

// Proses Edit Pajak
// Cek jika tombol 'updatepajak' diklik
if (isset($_POST['updatepajak'])) {
    $id_pajak = $_POST['id_pajak'];
    $nama_pajak = $_POST['nama_pajak'];
    $informasi_pajak = $_POST['informasi_pajak'];
    $file_pajak_lama = $_POST['file_pajak_lama'];
    
    // Cek apakah ada file baru yang diupload
    if ($_FILES['file_pajak']['name']) {
        // File baru diupload, proses upload file
        $file_pajak = $_FILES['file_pajak']['name'];
        $tmp_name = $_FILES['file_pajak']['tmp_name'];
        $upload_dir = "../uploads/";
        $upload_file = $upload_dir . basename($file_pajak);
        
        if (move_uploaded_file($tmp_name, $upload_file)) {
            // Jika upload berhasil, hapus file lama jika ada
            if ($file_pajak_lama) {
                unlink($upload_dir . $file_pajak_lama);
            }
        }
    } else {
        // Jika tidak ada file baru, gunakan file lama
        $file_pajak = $file_pajak_lama;
    }

    // Query untuk update data pajak
    $sql_update = "UPDATE pajak SET nama_pajak = ?, informasi_pajak = ?, file_pajak = ? WHERE id_pajak = ?";
    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param("sssi", $nama_pajak, $informasi_pajak, $file_pajak, $id_pajak);
    $stmt->execute();
    
    // Redirect ke halaman daftar pajak setelah update
    header("Location: dashboardadmin.php");
    exit();
}

// Proses Hapus Pajak
if (isset($_POST['hapuspajak'])) {
    $id_pajak = $_POST['pajakdi'];
    
    // Ambil file pajak untuk dihapus
    $sql = "SELECT file_pajak FROM pajak WHERE id_pajak = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_pajak);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    
    // Hapus file jika ada
    if (file_exists("../" . $data['file_pajak'])) {
        unlink("../" . $data['file_pajak']);
    }

    // Hapus data pajak
    $sql_delete = "DELETE FROM pajak WHERE id_pajak = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $id_pajak);
    $stmt_delete->execute();

    header("Location: dashboardadmin.php"); // Kembali ke dashboard
    exit();
}
?>
