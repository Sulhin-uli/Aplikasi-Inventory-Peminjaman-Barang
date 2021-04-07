<?php
session_start();
include('../koneksi.php');
if ($_GET['act'] == 'ubah') {
    $nama = $_POST['nama'];
    $kondisi = $_POST['kondisi'];
    $keterangan = htmlspecialchars($_POST['keterangan']);
    $jumlah = $_POST['jumlah'];
    $jenis = $_POST['jenis'];
    $id_ruang = $_POST['ruang'];
    $id_inventaris = $_POST['id_inventaris'];
    $asal_barang = $_POST['asal_barang'];
    $kode = $_POST['kode'];
    $tanggal_register = $_POST['tanggal_register'];


    $query = mysqli_query($konek, "UPDATE inventaris SET id_inventaris='$id_inventaris',
                                                        nama='$nama', 
                                                        kondisi='$kondisi', 
                                                        keterangan='$keterangan',
                                                        jumlah='$jumlah',
                                                        jenis='$jenis',
                                                        tanggal_register='$tanggal_register',
                                                        id_ruang='$id_ruang',
                                                        kode_inventaris='$kode',
                                                        asal_barang='$asal_barang'
                                                        WHERE 
                                                        id_inventaris = '$id_inventaris'
                                                        ");

    if ($query) {
        header('location: ../admin-page.php?menu=barang');
        $_SESSION['edit'] = 'berhasil';
    } else {
        echo "<script>
    alert('Gagal Diubah.')
    </script>";
    }
}
