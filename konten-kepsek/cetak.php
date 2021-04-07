<!DOCTYPE html>
<html>
<head>
 <title>AIPY App | Laporan Peminjaman Barang</title>
 <style type="">
 body{
 font-family: sans-serif;
 }
 table{
 margin: 20px auto;
 border-collapse: collapse;
 }
 table th,
 table td{
 border: 1px solid #3c3c3c;
 padding: 3px 8px;

 }
 a{
 background: blue;
 color: #fff;
 padding: 8px 10px;
 text-decoration: none;
 border-radius: 2px;
 }

    .tengah{
        text-align: center;
    }
 </style>
</head>
<body>
 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>NO.</th>
                      <th>NAMA</th>
                      <th>BARANG</th>
                      <th>JUMLAH</th>
                      <th>TGL.PINJAM</th>
                      <th>TGL.KEMBALI</th>
                      <th>STATUS</th>
                      <th>KETERANGAN</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php 
                      include('../koneksi.php');
                      $query = mysqli_query($konek, "
                      select a.*, b.*, c.*, d.id_inventaris, d.nama from peminjaman a
                      inner join pegawai b on a.id_pegawai=b.id_pegawai
                      inner join detil_pinjam c on a.id_peminjaman=c.id_peminjaman
                      inner join inventaris d on c.id_inventaris=d.id_inventaris
                    ");
                    $no = 0;
                    while($row=mysqli_fetch_array($query)) {
                      $no++;
                          ?>
                      <tr>
                      <td><?php print $no?></td>
                      <td><?php print $row['nama_pegawai']?></td>
                      <td><?php print $row['nama']?></td>
                      <td><?php print $row['jumlah']?></td>
                      <td><?php print $row['tanggal_pinjam']?></td>
                </tr>
 <?php 
 }
 ?>
    </tbody>
    </table>
    <script>
 window.print();
 </script>
</body>
</html>