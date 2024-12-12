<?php
session_start();
include 'koneksi.php';

if(isset($_POST['kirim'])){
    $judul_foto = $_POST['berita'];
    $deskripsifoto = $_POST['isi'];
    $tanggalunggah = date('Y-m-d');
    $albumid = $_POST['albumid'];
    $kategoriid = $_POST['kategoriid'];
    $userid = $_SESSION['userid'];
    $foto = $_FILES['lokasifile']['name'];
    $tmp = $_FILES['lokasifile']['tmp_name'];
    $lokasi = 'assets/img/';
    $namafoto = rand().'-'.$foto;
    move_uploaded_file($tmp, $lokasi.$namafoto);

    $sql =mysqli_query($conn, "INSERT INTO foto (deskripsifoto,tanggalunggah,lokasifile,albumid,userid,kategoriid,judulfoto)
     VALUES('$deskripsifoto','$tanggalunggah','$namafoto','$albumid','$userid','$kategoriid','$judul_foto')");

    echo"<script>
       alert('Data Berhasil Disimpan.');
       location.href ='foto.php';
    </script>";
}