<!-- Page Heading -->
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
  </div>

  <!-- Content Row -->
  <div class="row">

    <?php
    // menghubungkan dengan koneksi database
    include 'koneksi.php';

    // mengambil data barang
    $data_barang = mysqli_query($konek, "SELECT * FROM inventaris");

    // menghitung data barang
    $jumlah_barang = mysqli_num_rows($data_barang);
    ?>
    <!-- Jumlah Barang -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Barang</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $jumlah_barang; ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-box fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php
    // mengambil data pegawai
    $data_pegawai = mysqli_query($konek, "SELECT * FROM pegawai");

    // menghitung data pegawai
    $jumlah_pegawai = mysqli_num_rows($data_pegawai);
    ?>
    <!-- Jumlah Pegawai -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Pegawai</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $jumlah_pegawai; ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-user fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php

    // mengambil data pegawai
    $data_ruangan = mysqli_query($konek, "SELECT * FROM ruang");

    // menghitung data ruangan
    $jumlah_ruangan = mysqli_num_rows($data_ruangan);
    ?>
    <!-- Jumlah ruangan -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah ruangan</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $jumlah_ruangan; ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-home fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php

    // mengambil data peminjaman
    $data_peminjaman = mysqli_query($konek, "SELECT * FROM pinjam");

    // menghitung data peminjaman
    $jumlah_peminjaman = mysqli_num_rows($data_peminjaman);
    ?>
    <!-- Jumlah peminjaman -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah peminjaman</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $jumlah_peminjaman; ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->


  </div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<!-- End of Main Content -->
<!-- /.container-fluid -->