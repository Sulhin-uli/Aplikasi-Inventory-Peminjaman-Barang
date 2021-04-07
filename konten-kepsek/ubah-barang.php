<?php
session_start();
include('../koneksi.php');
if ($_GET['act']== 'ubah') {
    $nama_ruang = $_POST['nama_ruang'];
    $nama_jenis = $_POST['nama_jenis'];
    $nama = $_POST['nama'];
    $kondisi = $_POST['kondisi'];
    $keterangan = htmlspecialchars($_POST['keterangan']);
    $jumlah = $_POST['jumlah'];
    $jenis = $_POST['jenis'];
    $id_ruang = $_POST['id_ruang'];
    $id_inventaris = $_POST['id_inventaris'];
    $asal_barang = $_POST['asal_barang'];
    $kode = $_POST['kode'];

    $query = mysqli_query($konek,"UPDATE inventaris SET id_inventaris='$id_inventaris',
                                                        nama='$nama', 
                                                        kondisi='$kondisi', 
                                                        keterangan='$keterangan',
                                                        jumlah='$jumlah',
                                                        jenis='$jenis',
                                                        kode_inventaris='$kode',
                                                        asal_barang='$asal_barang'
                                                        WHERE 
                                                        id_inventaris = '$id_inventaris'
                                                        ");
    $query = mysqli_query($konek, "UPDATE ruang SET     nama_ruang='$nama_ruang'
                                                        WHERE 
                                                        id_ruang = '$id_ruang'
                                                        ");

if ($query) {
    header('location: ../admin-page.php?menu=barang');
    $_SESSION['edit'] = 'berhasil';
} else {
    echo"<script>
    alert('Gagal Diubah.')
    </script>";
}
}
?>