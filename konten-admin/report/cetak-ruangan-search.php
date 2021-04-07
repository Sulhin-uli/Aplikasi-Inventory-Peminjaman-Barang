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
        <td class="text2"><center><b>Data Ruangan</b></center></td>
    </tr>
</table>
</table>

<table border="1" style="margin-left:auto;margin-right:auto" cellpadding="1" cellspacing="0">
    <tr>
        <th>No.</center></th>
        <th>Nama</th>
        <th>Kode</th>
        <th>Keterangan</th>
    </tr>';

$no = 1;
$sql = mysqli_query($konek, "SELECT * FROM ruang ");
while ($r = mysqli_fetch_array($sql)) {
    $html .= '<tr>
<td>' . $no++ . '</td>
<td>' . $r["nama_ruang"] . '</td>
<td>' . $r["kode_ruang"] . '</td>
<td>' . $r["keterangan_ruang"] . '</td>
</tr>';
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
