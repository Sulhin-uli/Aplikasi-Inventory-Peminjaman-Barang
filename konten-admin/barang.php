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
  <td><a href="#" class="btn btn-success btn-icon-split btn-sm" data-toggle="modal" data-target="#tambah">
      <span class="icon text-white-50">
        <i class="fas fa-plus"></i>
      </span>
      <span class="text">Tambah Data</span>
    </a></td>
  <td>
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
            <th>Opsi</th>
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
              <td>
                <a href="#" class="btn btn-primary btn-circle btn-sm" data-toggle="modal" data-target="#ubah<?php print $row[0] ?>">
                  <i class="fas fa-edit"></i>
                  <a href="#" class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-target="#hapus<?php print $row[0] ?>">
                    <i class="fas fa-trash"></i>
              </td>
            </tr>
            <!-- Modal hapus -->
            <div class="modal fade" id="hapus<?php print $row[0] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-body">
                    Apakah anda yakin menghapus data inventaris <strong><?php print $row[1] ?></strong>?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <a href="?menu=barang&hapus=ya&id_inventaris=<?php print $row[0] ?>" class="btn btn-danger" name="hapus">ya</a>
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal ubah -->
            <div class="modal fade" id="ubah<?php print $row[0] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-body">
                    <form action="konten-admin/ubah-barang.php?act=ubah" method="POST">
                      <?php
                      $id_inventaris = $row['id_inventaris'];
                      $q = mysqli_query($konek, "SELECT * FROM inventaris WHERE id_inventaris='$id_inventaris'");
                      $r = mysqli_fetch_array($q);
                      ?>
                      <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3 control-label text-right">Nama</label>
                          <div class="col-sm-8">
                            <input type="hidden" name="id_inventaris" value="<?php print $r['id_inventaris'] ?>" autocomplete="off">
                            <input type="text" name="nama" class="form-control" value="<?php print $r['nama'] ?>" placeholder="Nama barang" required autocomplete="off">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3 control-label text-right">Kondisi</label>
                          <div class="col-sm-8">
                            <select name="kondisi" id="kondisi" class="form-control">
                              <?php if ($r['kondisi'] == 'Baik') { ?>
                                <option value="Baik">Baik</option>
                                <option value="Rusak">Rusak</option>
                              <?php } else { ?>
                                <option value="Rusak">Rusak</option>
                                <option value="Baik">Baik</option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3 control-label text-right">Keterangan</label>
                          <div class="col-sm-8">
                            <textarea class="form-control" cols="30" rows="10" name="keterangan" required><?php print $r['keterangan'] ?></textarea>

                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3 control-label text-right">Jumlah</label>
                          <div class="col-sm-8">
                            <input type="number" name="jumlah" class="form-control" value="<?php print $r['jumlah'] ?>" placeholder="Jumlah Barang" required autocomplete="off">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3 control-label text-right">jenis</label>
                          <div class="col-sm-8">
                            <select name="jenis" id="jenis" class="form-control">
                              <option value="<?php print $r['jenis'] ?>"><?php print $r['jenis'] ?></option>
                              <option value="Elektronik">Elektronik</option>
                              <option value="Non Elektronik">Non Elektronik</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3 control-label text-right">Ruang</label>
                          <div class="col-sm-8">
                            <select name="ruang" class="form-control">
                              <option value='' size='20' disabled>...</option>
                              <?php
                              $ruang = mysqli_query($konek, "SELECT * FROM ruang ORDER BY nama_ruang");
                              while ($e = mysqli_fetch_array($ruang)) {
                                if ($r['id_ruang'] == $e['id_ruang']) {
                                  $sel = "selected";
                                } else {
                                  $sel = "";
                                } ?> <option value="<?php print $e['id_ruang'] ?>" <?= $sel ?>><?php print $e['nama_ruang'] ?></option>
                              <?php
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3 control-label text-right">Kode</label>
                          <div class="col-sm-8">
                            <input type="text" name="kode" class="form-control" value="<?php print $r['kode_inventaris'] ?>" placeholder="Kode Inventaris" required autocomplete="off">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3 control-label text-right">Tgl Regis</label>
                          <div class="col-sm-8"><input type="date" autocomplete="off" name="tanggal_register" class="form-control" value="<?php print $r['tanggal_register'] ?>" placeholder="Masukan NIP" required></div>
                        </div>
                      </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-3 control-label text-right">Asal Barang</label>
                      <div class="col-sm-8">
                        <select name="asal_barang" id="asal_barang" class="form-control">
                          <?php if ($r['asal_barang'] == 'Hibah') { ?>
                            <option value="Hibah">Hibah</option>
                            <option value="Bukan Hibah">Bukan Hibah</option>
                          <?php } else { ?>
                            <option value="Bukan Hibah">Bukan Hibah</option>
                            <option value="Hibah">Hibah</option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
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
        <form action="konten-admin/tambah-barang.php?act=tambah" method="POST">
          <div class="form-group">
            <div class="row">
              <label class="col-sm-3 control-label text-right">Nama<code>*</code></label>
              <div class="col-sm-8"><input type="text" name="nama" class="form-control" placeholder="Masukan Nama barang" required autocomplete="off">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <label class="col-sm-3 control-label text-right">Kondisi<code>*</code></label>
              <div class="col-sm-8">
                <select name="kondisi" id="kondisi" class="form-control">
                  <option value="">..</option>
                  <option value="Baik">Baik</option>
                  <option value="Rusak">Rusak</option>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <label class="col-sm-3 control-label text-right">Keterangan<code>*</code></label>
              <div class="col-sm-8">
                <textarea name="keterangan" class="form-control" cols="30" rows="10" placeholder="Masukan keterangan.." required></textarea>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <label class="col-sm-3 control-label text-right">Jumlah<code>*</code> </label>
              <div class="col-sm-8">
                <input type="number" name="jumlah" class="form-control" placeholder="Masukan Jumlah Barang" required autocomplete="off">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <label class="col-sm-3 control-label text-right">Jenis Barang<code>*</code></label>
              <div class="col-sm-8">
                <select name="jenis" id="jenis" class="form-control">
                  <option value="">..</option>
                  <option value="Elektronik">Elektronik</option>
                  <option value="Non Elektronik">Non Elektronik</option>
                </select>
              </div>
            </div>
          </div>
      </div>
      <div class="form-group">
        <div class="row">
          <label class="col-sm-3 control-label text-right">Tgl Regis<code>*</code></label>
          <div class="col-sm-8"><input type="date" autocomplete="off" name="tgl_regis" class="form-control" required></div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <label class="col-sm-3 control-label text-right">Ruangan<code>*</code> </label>
          <div class="col-sm-8">
            <select name="id_ruang" class="form-control" required>
              <option value="">..</option>
              <?php
              $query = mysqli_query($konek, "SELECT * FROM ruang");
              while ($row = mysqli_fetch_array($query)) { ?>
                <option value="<?php print $row['id_ruang'] ?>"><?php print $row['nama_ruang'] ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <label class="col-sm-3 control-label text-right">Kode<code>*</code> </label>
          <div class="col-sm-8">
            <input type="text" name="kode" class="form-control" placeholder="Masukan Kode Inventaris" required autocomplete="off">
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <label class="col-sm-3 control-label text-right">Asal Barang<code>*</code></label>
          <div class="col-sm-8">
            <select name="asal_barang" id="asal_barang" class="form-control">
              <option value="">..</option>
              <option value="Hibah">Hibah</option>
              <option value="Bukan Hibah">Bukan Hibah</option>
            </select>
          </div>
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