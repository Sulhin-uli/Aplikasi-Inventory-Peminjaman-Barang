<?php
session_start();
include('../koneksi.php');
if ($_GET['act']== 'ubah') {
  $id_inventaris = $_POST['id_inventaris'];
  $jumlah = $_POST['jumlah_pinjam'];
  $id_pinjam = $_POST['id_pinjam'];
  $id_pegawai = $_POST['id_pegawai'];
  $nama_siswa = $_POST['nama_siswa'];
  $tanggal_pinjam = $_POST['tanggal_pinjam'];
  $jam_pinjam = $_POST['jam_pinjam'];
  $tanggal_kembali = $_POST['tanggal_kembali'];
  $jam_kembali = $_POST['jam_kembali'];
  $kondisi = $_POST['kondisi'];
  $keperluan = $_POST['keperluan'];
  $keterangan = htmlspecialchars($_POST['keterangan']);

                                                            
  $selSto = mysqli_query($konek, "SELECT * FROM inventaris WHERE id_inventaris='$id_inventaris'");
  $sto    = mysqli_fetch_array($selSto);
  $stok   = $sto['jumlah'];
  //menambah sisa stok
  $sisa    =$stok + $jumlah;

    mysqli_query($konek, "UPDATE inventaris SET jumlah = '$sisa', kondisi='$kondisi', keterangan='$keterangan' WHERE id_inventaris='$id_inventaris'");
    mysqli_query($konek,"DELETE FROM pinjam WHERE id_pinjam=$id_pinjam");
    $insert = mysqli_query($konek, "INSERT INTO pengembalian (id_pengembalian, id_pegawai, nama_siswa, id_inventaris, jumlah_pinjam, tanggal_pinjam, tanggal_kembali, jam_pinjam, jam_kembali, waktu_kembali, keperluan, status_peminjaman) VALUES (NULL, '$id_pegawai', '$nama_siswa','$id_inventaris', '$jumlah', '$tanggal_pinjam', '$tanggal_kembali', '$jam_pinjam', '$jam_kembali', NOW(), '$keperluan', 'Dikembalikan')");
    if($insert){
      header('location: ../admin-page.php?menu=peminjaman');
      $_SESSION['pngb'] = 'pngb';
    }
    else {
        echo "<div><b>Oops!</b> 404 Error Server.</div>";
    }


  }
?>