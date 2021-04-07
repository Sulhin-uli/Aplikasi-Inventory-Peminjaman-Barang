<?php
include("../koneksi.php");
  $tgl_awal = $_POST['tgl_awal'];
  $tgl_akhir = $_POST['tgl_akhir'];

  $q = mysqli_query($konek,"SELECT * FROM pinjam INNER JOIN 
                    inventaris ON pinjam.id_inventaris = inventaris.id_inventaris
                    INNER JOIN 
                    pegawai ON pinjam.id_pegawai = pegawai.id_pegawai         
                    where DATE(tanggal_pinjam) between '$tgl_awal' and '$tgl_akhir'");
  $count = mysqli_num_rows($q);
  $no = 0;
  $no++;
  ?>

  <table border = "1" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th>No.</th>
        <th>Nama Barang</th>
        <th>Nama Peminjam</th>
        <th>Nama Siswa</th>
        <th>Jumlah Pinjam</th>
        <th>Tgl. Pinjam</th>
        <th>Status Peminjaman</th>
      </tr>
    </thead>
    <tbody>
    <?php
    if ($count > 0) {
      while($r = mysqli_fetch_array($q)) {
        $tanggal_pinjam = date('d F Y', strtotime($r['tanggal_pinjam']));
        
        ?>
        <tr>
          <td><?php print $no?></td>
          <td><?=$r['nama']?></td>
          <td><?=$r['nama_pegawai']?></td>
          <td><?=$r['nama_siswa']?></td>
          <td><?=$r['jumlah_pinjam']?></td>
          <td><?=$tanggal_pinjam?></td>
          <td><?=$r['status_peminjaman']?></td>
        </tr>
      <?php }
    } else { ?>
      <tr>
        <td colspan="7"><em>Tidak ada catatan peminjaman dari tanggal tersebut. :(</em></td>
      </tr>
    <?php } ?>
    </tbody>
  </table>

  <script>
 window.print();
 </script>