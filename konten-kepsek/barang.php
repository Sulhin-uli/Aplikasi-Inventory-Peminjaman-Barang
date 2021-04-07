<?php
include('koneksi.php');
?>
<?php

if (isset($_GET['hapus'])) {
  $id_inventaris = $_GET['id_inventaris'];

  mysqli_query($konek, "DELETE FROM inventaris WHERE id_inventaris=$id_inventaris");
  $_SESSION['hapus'] = 'berhasil';
} ?>



<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Barang</h1>
<p class="mb-4">
<table>
  <th>
    <form action="konten-admin/report/cetak-barang.php" target="_blank" method="post">
      <button type="submit" class="btn btn-success btn-icon-split btn-sm">
        <span class="icon text-white-50">
          <i class="fas fa-print"></i>
        </span>
        <span class="text">Cetak Data Barang</span>
      </button>
    </form>
    </td>
  <td>
    <form action="konten-admin/report/cetak-barang-rusak.php" target="_blank" method="post">
      <input type="hidden" name="kondisi" value="Rusak" autocomplete="off">
      <button type="submit" class="btn btn-success btn-icon-split btn-sm">
        <span class="icon text-white-50">
          <i class="fas fa-print"></i>
        </span>
        <span class="text">Cetak Data Barang Rusak</span>
      </button>
    </form>
  </td>
  <td>
    <!-- Topbar Search -->
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="konten-admin/report/cetak-barang-search.php" target="_blank" method="post">
      <div class="input-group">
        <input type="text" autocomplete="off" class="form-control border-0 small" name="cetak" placeholder="Masukan Keyword Cetak" aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-success" type="submit">
            <i class="fas fa-print fa-sm"></i>
          </button>
        </div>
      </div>
    </form>
  </td>
  </th>
</table>
</p>


<!-- DataTables  -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-success">Data Barang</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No.</th>
            <th>Kode</th>
            <th>Nama</th>
            <th>Kondisi</th>
            <th>Keterangan</th>
            <th>Jumlah</th>
            <th>Jenis</th>
            <th>Tgl. Masuk</th>
            <th>Ruang</th>
            <th>Asal</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $query = mysqli_query($konek, "
                      SELECT a.*, c.* FROM inventaris a
                      INNER JOIN ruang c ON a.id_ruang = c.id_ruang
                      ");
          $no = 0;
          while ($row = mysqli_fetch_array($query)) {
            $no++;
          ?>
            <tr>
              <td><?php print $no ?></td>
              <td><?php print $row['kode_inventaris'] ?></td>
              <td><?php print $row['nama'] ?></td>
              <td><?php print $row['kondisi'] ?></td>
              <td><?php print $row['keterangan'] ?></td>
              <td><?php print $row['jumlah'] ?></td>
              <td><?php print $row['jenis'] ?></td>
              <?php

              $tanggal = date("d-m-Y", strtotime($row['tanggal_register']));

              ?>
              <td><?php print $tanggal ?></td>
              <td><?php print $row['nama_ruang'] ?></td>
              <td><?php print $row['asal_barang'] ?></td>
            </tr>

          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
s
</div>