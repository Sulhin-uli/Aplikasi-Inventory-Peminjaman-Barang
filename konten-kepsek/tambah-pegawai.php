<?php
session_start();
include('../koneksi.php');
if ($_GET['act']== 'tambah') {
    $nama = $_POST['nama'];
    $nik = $_POST['nik'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $posisi = $_POST['posisi'];
    $telepon = $_POST['telepon'];
    $tgl_lahir = $_POST['tgl_lahir'];

    $query = mysqli_query($konek,"INSERT INTO pegawai VALUES ( NULL, '$nama', '$nik', '$alamat', '$jenis_kelamin', '$telepon',  '$posisi',  '$tgl_lahir')");

if ($query) {
    header('location: ../admin-page.php?menu=pegawai');
    $_SESSION['tambah'] = 'berhasil';
} else {
    echo"<script>
    alert('Gagal Ditambahkan.')
    </script>";
}
}
?>
