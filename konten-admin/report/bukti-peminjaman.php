<?php

session_start();
require_once "../../vendor/autoload.php";
include "../../koneksi.php";

$mpdf = new \Mpdf\Mpdf();
$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<center>
<table>
    <tr>
        <td><img src="../report/smk-yapiim.png" width="90" height="90"></td>
        <td>
        <center>
            <font size="4">YAYASAN PENDIDIKAN ISLAM I`ANATUL MUBTADIIN</font><br>
            <font size="5"><b>SMK YAPIIM INDRAMAYU</font><br>
            <font size="2">NSS : 32.2.02.18.150.10   NPSN : 69754418</font><br>
            <font size="2"><i>Alamat : Jl. Kapuan Jaya No. 175 Desa Dukuh kec./kab. Indramayu Propinsi Jawa Barat Kode Post. 45216</i></font><br>
            <font size="2"><i>Telp. (0234) 71200583   E-mail : kampusasri.yapiim@yahoo.co.id   webs : smkyapiim.sch.id</i></font>
        </center>
        </td>
    </tr>
    <tr>
        <td colspan="2"><hr></td>
    </tr>
<table width="625">
    <tr>
        <td class="text2"><center><b>Bukti Peminjaman Barang</b></center></td>
    </tr>
</table>
</table>

<table border="1" style="margin-left:auto;margin-right:auto" style="border-collapse:collapse;" cellpadding="7" cellspacing="0">
    <tr>
        <th>No.</center></th>
        <th>Nama Peminjam</th>
        <th>Nama Siswa</th>
        <th>Nama Barang</th>
        <th>Jumlah</th>
        <th>Keperluan</th>
        <th>Lama Pinjam</th>
        <th>Status Pinjam</th>
    </tr>';
$no = 1;
$nama_pegawai = $_POST['nama_pegawai'];
$sql = mysqli_query($konek, "SELECT * FROM pinjam INNER JOIN inventaris ON pinjam.id_inventaris = inventaris.id_inventaris
                                                INNER JOIN pegawai ON pinjam.id_pegawai = pegawai.id_pegawai where nama_pegawai = '$nama_pegawai' ");
$count = mysqli_num_rows($sql);
if ($count > 0) {
    while ($r = mysqli_fetch_array($sql)) {
        $tanggal = date("d-m-Y ", strtotime($r['tanggal_pinjam']));
        $jam = date("H:i ", strtotime($r['jam_pinjam']));
        $tanggal2 = date("d-m-Y", strtotime($r['tanggal_kembali']));
        $jam2 = date(" H:i ", strtotime($r['jam_kembali']));
        $html .= '<tr>
<td>' . $no++ . '</td>
<td>' . $r["nama_pegawai"] . '</td>
<td>' . $r["nama_siswa"] . '</td>
<td>' . $r["nama"] . '</td>
<td>' . $r["jumlah_pinjam"] . '</td>
<td>' . $r["keperluan"] . '</td>
<td>' . $jam . '' . $tanggal . 's/d' . $jam2 . '' . $tanggal2 . '</td>
<td>' . $r["status_peminjaman"] . '</td>
</tr>';
    }
} else {
    $html .= '<tr><td  colspan="10"><p><i>Tidak ada catatan Peminjaman.</p></i></td></tr>';
}

$bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
$waktu[1] = date("d", time());
$waktu[2] = date("m", time());
$waktu[3] = date("Y", time());
$tanggalini = "$waktu[1] " . $bulan[$waktu[2] - 1] . " $waktu[3]";

$html .= '</table>
<br>
    <table width="625">
        <tr>
            <td width="430"><br><br><br><br></td>
            <td class="text" align="center">Indramayu,' . $tanggalini . '<br>Admin,<br><br><br><br><u>' . $_SESSION['name_user'] . '</u></td>
        </tr>
    </table>
</body>
</html>';
$mpdf->WriteHTML($html);
$mpdf->Output();
