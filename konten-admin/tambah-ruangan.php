<?php
session_start();
include('../koneksi.php');
if ($_GET['act']== 'tambah') {
    $nama = $_POST['nama'];
    $kode = $_POST['kode'];
    $keterangan = htmlspecialchars($_POST['keterangan']);

    $query = mysqli_query($konek,"INSERT INTO ruang VALUES ( NULL, '$nama', '$kode', '$keterangan')");

if ($query) {
    header('location: ../admin-page.php?menu=ruangan');
    $_SESSION['tambah'] = 'berhasil';
} else {
    echo"<script>
    alert('Gagal Ditambahkan.')
    </script>";
}
}
?>