<?php
session_start();
include '../koneksi.php';

// Cek apakah admin sudah login
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php"); // Arahkan ke halaman login jika admin belum login
    exit();
}

// Menangani proses tambah pajak
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_pajak = $_POST['nama_pajak'];
    $informasi_pajak = $_POST['informasi_pajak'];
    $admin_id = $_SESSION['admin_id'];

    // Direktori untuk menyimpan file
    $target_dir = "../assets/files/";
    $uploaded_files = [];
    $uploadOk = 1;

    // Memproses upload file
    foreach ($_FILES['file_pajak']['name'] as $key => $file_name) {
        $file_tmp_name = $_FILES['file_pajak']['tmp_name'][$key];
        $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $target_file = $target_dir . uniqid() . '-' . basename($file_name);

        // Cek apakah format file valid
        $allowed_file_types = ['pdf', 'docx', 'xlsx'];
        if (!in_array($file_type, $allowed_file_types)) {
            $error = "Hanya file PDF, DOCX, dan Excel yang diperbolehkan!";
            $uploadOk = 0;
            break;
        }

        // Cek apakah file berhasil diupload
        if (move_uploaded_file($file_tmp_name, $target_file)) {
            $uploaded_files[] = $target_file; // Menyimpan path file yang berhasil diupload
        } else {
            $error = "Gagal mengupload file: $file_name!";
            $uploadOk = 0;
            break;
        }
    }

    // Jika semua file berhasil diupload
    if ($uploadOk && !empty($uploaded_files)) {
        // Gabungkan semua file menjadi string (misal menggunakan koma sebagai pemisah)
        $file_paths = implode(',', $uploaded_files);

        // Menyimpan data pajak ke dalam database
        $sql = "INSERT INTO pajak (nama_pajak, informasi_pajak, file_pajak, admin_id) 
                VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $nama_pajak, $informasi_pajak, $file_paths, $admin_id);

        if ($stmt->execute()) {
            $success = "Pajak berhasil ditambahkan!";
            header("Location: dashboardadmin.php"); // Redirect setelah sukses
            exit();
        } else {
            $error = "Gagal menambahkan pajak!";
        }
    } else {
        $error = "Terjadi kesalahan saat mengupload file!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pajak</title>
    <link rel="stylesheet" href="../assets/css/admin.css?v=1.4">
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
</head>
<body>

    <div class="containeradmin">
        <h1>Tambah Pajak</h1>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error; ?></div>
        <?php endif; ?>
        <?php if (isset($success)): ?>
            <div class="alert alert-success"><?= $success; ?></div>
        <?php endif; ?>

        <form action="tambahpajak.php" method="POST" enctype="multipart/form-data">
            
                <label for="nama_pajak">Nama Pajak</label>
                <input type="text" name="nama_pajak" id="nama_pajak" required>

                <label for="informasi_pajak">isi Pajak:</label><br>
                <div id="editor-container" style="height: 200px;"></div>
                <input type="hidden" id="informasi_pajak" name="informasi_pajak">

                <label for="file_pajak">File Pajak (PDF, DOCX, Excel)</label>
                <input type="file" name="file_pajak[]" id="file_pajak" multiple required>


            <button type="submit">Tambah Pajak</button>
        </form>
    </div>

    <script>
            var quillInformasi = new Quill('#editor-container', {
            theme: 'snow',
            placeholder: 'Tulis informasi pajak di sini...',
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

        // Sinkronkan isi Quill dengan input hidden saat form disubmit
        document.querySelector('form').onsubmit = function() {
            document.querySelector('#informasi_pajak').value = quillInformasi.root.innerHTML;
        };

    </script>

</body>
</html>
