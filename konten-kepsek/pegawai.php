<?php
if (isset($_GET['hapus'])) {
    $id_pegawai = $_GET['id_pegawai'];

    mysqli_query($konek, "DELETE FROM pegawai WHERE id_pegawai=$id_pegawai");
    $_SESSION['hapus'] = 'berhasil';
}
?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Pegawai</h1>
<p class="mb-4">
<table>
    <th>
        <form action="konten-admin/report/cetak-pegawai.php" target="_blank" method="post">
            <button type="submit" class="btn btn-success btn-icon-split btn-sm">
                <span class="icon text-white-50">
                    <i class="fas fa-print"></i>
                </span>
                <span class="text">Cetak Data Pegawai</span>
            </button>
        </form>
        </td>
    <td>
        <!-- Topbar Search -->
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="konten-admin/report/cetak-pegawai-search.php" target="_blank" method="post">
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
        <h6 class="m-0 font-weight-bold text-success">Data Pegawai</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Tgl Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Posisi</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('koneksi.php');
                    $query = mysqli_query($konek, "SELECT * FROM pegawai");
                    $no = 0;
                    while ($row = mysqli_fetch_array($query)) {
                        $no++;
                    ?>
                        <tr>
                            <td><?php print $no ?></td>
                            <td><?php print $row[1] ?></td>
                            <td><?php print $row[2] ?></td>
                            <?php

                            $tanggal = date("d-m-Y", strtotime($row['tgl_lahir']));

                            ?>
                            <td><?php print $tanggal ?></td>
                            <td><?php print $row[4] ?></td>
                            <td><?php print $row[6] ?></td>
                            <td><?php print $row[5] ?></td>
                            <td><?php print $row[3] ?></td>
                        </tr>


                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>