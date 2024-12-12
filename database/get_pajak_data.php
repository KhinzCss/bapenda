<?php
include "../koneksi.php";

if (isset($_GET['id'])) {
    $id_pajak = $_GET['id'];

    // Ambil data pajak berdasarkan ID
    $sql = "SELECT nama_pajak, informasi_pajak, file_pajak FROM pajak WHERE id_pajak = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_pajak);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $pajak = $result->fetch_assoc();
        echo json_encode($pajak);
    } else {
        echo json_encode(['error' => 'Data pajak tidak ditemukan']);
    }
} else {
    echo json_encode(['error' => 'ID pajak tidak diberikan']);
}
?>
