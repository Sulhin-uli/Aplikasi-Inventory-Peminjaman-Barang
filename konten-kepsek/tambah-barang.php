<?php
session_start();
include('../koneksi.php');
if ($_GET['act']== 'tambah') {
    $nama = $_POST['nama'];
    $kondisi = $_POST['kondisi'];
    $keterangan = htmlspecialchars($_POST['keterangan']);
    $jumlah = $_POST['jumlah'];
    $jenis = $_POST['jenis'];
    $id_ruang = $_POST['id_ruang'];
    $kode = $_POST['kode'];
    $asal_barang = $_POST['asal_barang'];
    $id_petugas = $_SESSION['id'];  

    $query = mysqli_query($konek,"INSERT INTO inventaris VALUES ( 
        NULL, 
        '$nama', 
        '$kondisi', 
        '$keterangan',
        '$jumlah',
        '$jenis',
        NOW(),  
        '$id_ruang',
        '$kode',
        '$id_petugas',
        '$asal_barang'
        )");


if ($query) {
    header('location: ../admin-page.php?menu=barang');
    $_SESSION['tambah'] = 'berhasil';
} else {
    echo"<script>
    alert('Gagal Ditambahkan.')
    </script>";
}
}
?>