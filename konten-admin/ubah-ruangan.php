<?php
session_start();
include('../koneksi.php');
if ($_GET['act']== 'ubah') {
    $nama = $_POST['nama'];
    $kode = $_POST['kode'];
    $keterangan = htmlspecialchars($_POST['keterangan']);
    $id_ruang = $_POST['id_ruang'];

    $query = mysqli_query($konek, "UPDATE ruang SET id_ruang ='$id_ruang', nama_ruang='$nama', kode_ruang='$kode', keterangan_ruang='$keterangan' WHERE id_ruang = '$id_ruang'");

if ($query) {
    header('location: ../admin-page.php?menu=ruangan');
    $_SESSION['edit'] = 'berhasil';
} else {
    echo"<script>
    alert('Gagal Diubah.')
    </script>";
}
}
?>