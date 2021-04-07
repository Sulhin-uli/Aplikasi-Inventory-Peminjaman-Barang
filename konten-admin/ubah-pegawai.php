<?php
session_start();
include('../koneksi.php');
if ($_GET['act'] == 'ubah') {
    $nama_pegawai = $_POST['nama_pegawai'];
    $nik = $_POST['nik'];
    $alamat = htmlspecialchars($_POST['alamat']);
    $id_pegawai = $_POST['id_pegawai'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $posisi = $_POST['posisi'];
    $telepon = $_POST['telepon'];
    $tgl_lahir = $_POST['tgl_lahir'];

    $query = mysqli_query($konek, "UPDATE pegawai SET id_pegawai ='$id_pegawai', nama_pegawai='$nama_pegawai', nik='$nik', alamat='$alamat', jenis_kelamin='$jenis_kelamin', posisi='$posisi', telepon='$telepon', tgl_lahir='$tgl_lahir' WHERE id_pegawai = '$id_pegawai'");

    if ($query) {
        header('location: ../admin-page.php?menu=pegawai');
        $_SESSION['edit'] = 'berhasil';
    } else {
        echo "<script>
    alert('Gagal Diubah.')
    </script>";
    }
}
