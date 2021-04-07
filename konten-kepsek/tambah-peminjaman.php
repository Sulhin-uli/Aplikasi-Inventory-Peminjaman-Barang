<?php
session_start();
include('../koneksi.php');
if ($_GET['act']== 'tambah') {
    $id_pegawai = $_POST['id_pegawai'];
    $id_inventaris = $_POST['id_inventaris'];
    $jumlah = $_POST['jumlah'];
    $jam_pinjam = $_POST['jam_pinjam'];
    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $jam_kembali = $_POST['jam_kembali'];
    $tanggal_kembali = $_POST['tanggal_kembali'];
    $nama_siswa = $_POST['nama_siswa'];
    $keperluan = $_POST['keperluan'];

    $selSto = mysqli_query($konek, "SELECT * FROM inventaris WHERE id_inventaris='$id_inventaris'");
    $sto    = mysqli_fetch_array($selSto);
    $stok   = $sto['jumlah'];
    //menghitung sisa stok
    $sisa    =$stok-$jumlah;
    
    if ($stok < $jumlah) {
        header('location: ../admin-page.php?menu=peminjaman');
        $_SESSION['ms'] = 'ms';
    }
    //proses    
    else{
        $insert = mysqli_query($konek, "INSERT INTO pinjam (id_pinjam, id_pegawai, nama_siswa, id_inventaris, jumlah_pinjam, tanggal_pinjam, jam_pinjam, tanggal_kembali, jam_kembali, keperluan, status_peminjaman) VALUES (NULL, '$id_pegawai', '$nama_siswa','$id_inventaris', '$jumlah', '$tanggal_pinjam', '$jam_pinjam', '$tanggal_kembali', '$jam_kembali', '$keperluan', 'Sedang dipinjam')");
            if($insert){
                //update stok
                $upstok= mysqli_query($konek, "UPDATE inventaris SET jumlah = '$sisa' WHERE id_inventaris='$id_inventaris'");
                header('location: ../admin-page.php?menu=peminjaman');
                $_SESSION['pinjam'] = 'berhasil';
            }
            else {
                echo "<div><b>Oops!</b> 404 Error Server.</div>";
            }
    }
    }
?>