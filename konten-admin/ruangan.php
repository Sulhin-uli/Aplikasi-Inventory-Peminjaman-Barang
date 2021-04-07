
<?php
if (isset($_GET['hapus'])) {
    $id_ruang = $_GET['id_ruang'];

    mysqli_query($konek,"DELETE FROM ruang WHERE id_ruang=$id_ruang");
    $_SESSION['hapus'] = 'berhasil';
} 
?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Ruangan</h1>


<p class="mb-4">  
    <table>
    <th>
    <td>
  <a href="#" class="btn btn-success btn-icon-split btn-sm" data-toggle="modal" data-target="#tambah">
    <span class="icon text-white-50">
      <i class="fas fa-plus"></i>
    </span>
    <span class="text">Tambah Data</span>
  </a>
  </td>
    <td><form action="konten-admin/report/cetak-ruangan.php" target="_blank" method="post">
        <button type="submit" class="btn btn-success btn-icon-split btn-sm">
        <span class="icon text-white-50">
            <i class="fas fa-print"></i>
        </span>
        <span class="text">Cetak Data Ruangan</span>
        </button>
        </form></td>
    </th>
    </table>
    </p>

 <!-- DataTables  -->
 <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-success">Data Ruangan</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nama</th>
                      <th>Kode</th>
                      <th>Keterangan</th>
                      <th>Opsi</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php 
                      include('koneksi.php');
                      $query = mysqli_query($konek,"SELECT * FROM ruang");
                      $no = 0;
                      while ($row = mysqli_fetch_array($query)) {
                          $no++;
                          ?>
                      <tr>
                          <td><?php print $no ?></td>
                          <td><?php print $row[1] ?></td>
                          <td><?php print $row[2] ?></td>
                          <td><?php print $row[3] ?></td>
                          <td>
                              <a href="#" class="btn btn-primary btn-circle btn-sm" data-toggle="modal" data-target="#ubah<?php print $row[0] ?>">
                                <i class="fas fa-edit"></i>
                              <a href="#" class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-target="#hapus<?php print $row[0]?>">
                                <i class="fas fa-trash"></i>
                          </td>
                      </tr>

                      <!-- Modal Tambah-->
                      <div class="modal fade" id="tambah" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h3 class="modal-tittle">Tambah Data Ruangan</h3>
                                </div>
                                <div class="modal-body">
                                  <form action="konten-admin/tambah-ruangan.php?act=tambah" method="POST" >
                                    <div class="form-group">
                                      <div class="row">
                                        <label class="col-sm-3 control-label text-right">Nama<code>*</code></label>         
                                        <div class="col-sm-8"><input type="text" autocomplete="off" name="nama" class="form-control" placeholder="Masukan Nama Ruangan" required></div>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <div class="row">
                                        <label class="col-sm-3 control-label text-right">Kode<code>*</code></label>         
                                        <div class="col-sm-8"><input type="text" autocomplete="off" name="kode" class="form-control" placeholder="Masukan Kode Ruangan" required></div>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <div class="row">
                                        <label class="col-sm-3 control-label text-right">Keterangan<code>*</code></label>         
                                        <div class="col-sm-8"><textarea name="keterangan" autocomplete="off" class="form-control" cols="30" rows="10" placeholder="keterangan.." required></textarea> </div>
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button id="nosave" type="button" class="btn btn-sm btn-secondary pull-left" data-dismiss="modal">Batal</button>
                                      <button type="submit" name="simpan" class="btn btn-sm btn-success btn-icon-split">
                                      <span class="icon text-white-50">
                                        <i class="fas fa-check"></i>
                                      </span>
                                      <span class="text">Simpan</span>
                                      </button>
                                    </div>
                                  </form>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <!-- Modal Ubah-->
                      <div class="modal fade" id="ubah<?php print $row[0]?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h3 class="modal-tittle">Ubah Data Ruangan</h3>
                                </div>
                                <div class="modal-body">
                                  <form action="konten-admin/ubah-ruangan.php?act=ubah" method="POST" >
                                  <?php
                                      $id_ruang = $row['id_ruang'];
                                      $q = mysqli_query($konek,"SELECT * FROM ruang WHERE id_ruang='$id_ruang'");
                                      $r = mysqli_fetch_array($q);
                                    ?>
                                    <div class="form-group">
                                      <div class="row">
                                        <label class="col-sm-3 control-label text-right">Nama</label>         
                                        <div class="col-sm-8">
                                          <input type="hidden" name="id_ruang" value="<?php print $r[0]?>">
                                          <input type="text" name="nama" autocomplete="off" class="form-control" value="<?php print $r['nama_ruang']?>" placeholder="Nama ruang " required></div>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <div class="row">
                                        <label class="col-sm-3 control-label text-right">Kode</label>         
                                        <div class="col-sm-8"><input autocomplete="off" type="text" name="kode" class="form-control" value="<?php print $r['kode_ruang']?>" placeholder="Kode ruang " required></div>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <div class="row">
                                        <label class="col-sm-3 control-label text-right">Keterangan</label>         
                                        <div class="col-sm-8"><textarea name="keterangan" class="form-control" cols="30" rows="10" placeholder="keterangan.." required><?php print $r['keterangan_ruang']?></textarea> </div>
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button id="nosave" type="button" class="btn btn-sm btn-secondary pull-left" data-dismiss="modal">Batal</button>
                                      <button type="submit" name="simpan" class="btn btn-sm btn-success btn-icon-split">
                                      <span class="icon text-white-50">
                                        <i class="fas fa-check"></i>
                                      </span>
                                      <span class="text">Simpan</span>
                                      </button>
                                    </div>
                                  </form>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <!-- Modal Hapus-->
                      <div class="modal fade" id="hapus<?php print $row[0]?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                              <div class="modal-content">
                                  <div class="modal-body">
                                  Apakah anda yakin menghapus data Ruang <strong><?php print $row[1]?></strong>?
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
                                      <a href="?menu=ruangan&hapus=ya&id_ruang=<?php print $row[0]?>" class="btn btn-danger btn-icon-split btn-sm" name="hapus">
                                      <span class="icon text-white-50">
                                          <i class="fas fa-trash"></i>
                                        </span>
                                        <span class="text">Iya</span>
                                      </a>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

<!-- Modal Tambah-->
<div class="modal fade" id="tambah" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h3 class="modal-tittle">Tambah Data Ruangan</h3>
                                </div>
                                <div class="modal-body">
                                  <form action="konten-admin/tambah-ruangan.php?act=tambah" method="POST" >
                                    <div class="form-group">
                                      <div class="row">
                                        <label class="col-sm-3 control-label text-right">Nama</label>         
                                        <div class="col-sm-8"><input autocomplete="off" type="text" name="nama" class="form-control" placeholder="Masukan Nama Ruangan" required></div>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <div class="row">
                                        <label class="col-sm-3 control-label text-right">Kode</label>         
                                        <div class="col-sm-8"><input autocomplete="off" type="text" name="kode" class="form-control" placeholder="Masukan Kode Ruangan" required></div>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <div class="row">
                                        <label class="col-sm-3 control-label text-right">Keterangan</label>         
                                        <div class="col-sm-8"><textarea name="keterangan" class="form-control" cols="30" rows="10" placeholder="keterangan.." required></textarea> </div>
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button id="nosave" type="button" class="btn btn-sm btn-secondary pull-left" data-dismiss="modal">Batal</button>
                                      <button type="submit" name="simpan" class="btn btn-sm btn-success btn-icon-split">
                                      <span class="icon text-white-50">
                                        <i class="fas fa-check"></i>
                                      </span>
                                      <span class="text">Simpan</span>
                                      </button>
                                    </div>
                                  </form>
                                  </div>
                              </div>
                          </div>
                      </div>