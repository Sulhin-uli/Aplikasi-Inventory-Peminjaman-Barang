<!-- Page Heading -->
<br>

<h1 class="h3 mb-2 text-gray-800">Peminjaman</h1>
<p class="mb-4"><a href="" data-toggle="modal" data-target="#tambah" class="btn btn-success btn-icon-split btn-sm" name="hapus">
    <span class="icon text-white-50">
      <i class="fas fa-dolly"></i>
    </span>
    <span class="text">Mulai Peminjaman</span>
  </a>
</p>
<div class="card shadow mb-2">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-success">Cetak Bukti Peminjaman</h6>
  </div>
  <form action="konten-admin/report/bukti-peminjaman.php" target="_blank" method="post">
    <div class="row">
      <label class="col-sm-3 control-label text-center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama Pegawai : </label>
      <div class="col-sm-8"><select name="nama_pegawai" class="form-control">
          <option value="">..</option>
          <?php
          $query_pegawai = mysqli_query($konek, "select * from pinjam join pegawai on pinjam.id_pegawai = pegawai.id_pegawai");
          while ($row_pegawai = mysqli_fetch_array($query_pegawai)) { ?>
            <option value="<?php print $row_pegawai['nama_pegawai'] ?>"><?php print $row_pegawai['nama_pegawai'] ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-success btn-sm">Cetak</button>

    <br>
  </form>
  <br>
</div>

<br>

<!-- DataTables  -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-success">Data Peminjaman</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Nama Siswa</th>
            <th>Barang</th>
            <th>Jumlah</th>
            <th>Keperluan</th>
            <th>Lama Pinjam</th>
            <th>Status</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          include('koneksi.php');
          $query = mysqli_query($konek, " SELECT * FROM pinjam INNER JOIN 
                                                                            inventaris ON pinjam.id_inventaris = inventaris.id_inventaris
                                                                            INNER JOIN 
                                                                            pegawai ON pinjam.id_pegawai = pegawai.id_pegawai ORDER BY id_pinjam DESC                                                  
                                                                          ");
          $no = 0;
          while ($row = mysqli_fetch_array($query)) {
            $no++;
          ?>
            <tr>
              <td><?php print $no ?></td>
              <td><?php print $row['nama_pegawai'] ?></td>
              <td><?php print $row['nama_siswa'] ?></td>
              <td><?php print $row['nama'] ?></td>
              <td><?php print $row['jumlah_pinjam'] ?></td>
              <td><?php print $row['keperluan'] ?></td>
              <?php

              $tanggal = date("d-m-Y ", strtotime($row['tanggal_pinjam']));
              $jam = date("H:i ", strtotime($row['jam_pinjam']));
              $tanggal2 = date("d-m-Y ", strtotime($row['tanggal_kembali']));
              $jam2 = date("H:i ", strtotime($row['jam_kembali']));

              ?>
              <td><?php print $jam ?> <?php print $tanggal ?>s/d<br><?php print $jam2 ?> <?php print $tanggal2 ?></td>
              <td><i><code><?php print $row['status_peminjaman'] ?></code></i></td>
              <td>
                <a href="#" class="btn btn-warning btn-icon-split btn-sm" data-toggle="modal" data-target="#pengembalian<?php print $row[0] ?>">
                  <span class="icon text-white-50">
                    <i class="fas fa-info-circle"></i>
                  </span>
                  <span class="text">Pengembalian</span>
              </td>
            </tr>

            <!-- Modal Pengembalian-->
            <div class="modal fade" id="pengembalian<?php print $row[0] ?>" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h3 class="modal-tittle">Apakah ingin dikembalikan?</h3>
                  </div>
                  <div class="modal-body">
                    <form action="konten-admin/pengembalian.php?act=ubah" method="POST">
                      <div class="form-group">
                        <input type="hidden" name="tanggal_kembali" value="<?php print $row_p['tanggal_kembali'] ?>">
                        <input type="hidden" name="keperluan" value="<?php print $row['keperluan'] ?>">
                        <p>Nama Peminjaman&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $row['nama_pegawai'] ?></p>
                        <p>Nama Barang&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $row['nama'] ?></p>
                        <p>Jumlah&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $row['jumlah_pinjam'] ?></p>
                        <p>Nama Siswa &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?= $row['nama_siswa'] ?></p>
                        <div class="form-group">
                          <div class="row">
                            <label class="col-sm-3 control-label text-right">Kondisi</label>
                            <div class="col-sm-8">
                              <select name="kondisi" id="kondisi" class="form-control">
                                <?php if ($row['kondisi'] == 'Baik') { ?>
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
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3 control-label text-right">Keterangan</label>
                          <div class="col-sm-8">
                            <textarea class="form-control" autocomplete="off" cols="30" rows="10" name="keterangan" required><?php print $row['keterangan'] ?></textarea>

                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <input type="hidden" name="jumlah_pinjam" class="form-control" value="<?php print $row['jumlah_pinjam'] ?>" required>
                        <input type="hidden" name="id_pinjam" value="<?php print $row['id_pinjam'] ?>">
                        <input type="hidden" name="id_inventaris" value="<?php print $row['id_inventaris'] ?>">
                        <input type="hidden" name="id_pegawai" value="<?php print $row['id_pegawai'] ?>">
                        <input type="hidden" name="nama_siswa" value="<?php print $row['nama_siswa'] ?>">
                        <input type="hidden" name="tanggal_pinjam" value="<?php print $row['tanggal_pinjam'] ?>">
                        <input type="hidden" name="jam_pinjam" value="<?php print $row['jam_pinjam'] ?>">
                        <input type="hidden" name="tanggal_kembali" value="<?php print $row['tanggal_kembali'] ?>">
                        <input type="hidden" name="jam_kembali" value="<?php print $row['jam_kembali'] ?>">
                      </div>
                      <div class="modal-footer">
                        <button id="nosave" type="button" class="btn btn-sm btn-secondary pull-left" data-dismiss="modal">Batal</button>
                        <button type="submit" name="simpan" class="btn btn-sm btn-success btn-icon-split">
                          <span class="icon text-white-50">
                            <i class="fas fa-check"></i>
                          </span>
                          <span class="text">Ya</span>
                        </button>
                      </div>
                    </form>
                  </div>
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
        <h3 class="modal-tittle">Isi Data Peminjaman</h3>
      </div>
      <div class="modal-body">
        <form action="konten-admin/tambah-peminjaman.php?act=tambah" method="POST">
          <div class="form-group">
            <div class="row">
              <label class="col-sm-3 control-label text-right">Nama Pegawai<code>*</code> </label>
              <div class="col-sm-8"><select name="id_pegawai" class="form-control" required>
                  <option value="">..</option>
                  <?php
                  $query3 = mysqli_query($konek, "select * from pegawai");
                  while ($row = mysqli_fetch_array($query3)) { ?>
                    <option value="<?php print $row['id_pegawai'] ?>"><?php print $row['nama_pegawai'] ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <label class="col-sm-3 control-label text-right">Barang<code>*</code> </label>
              <div class="col-sm-8"><select name="id_inventaris" class="form-control" required>
                  <option value="">..</option>
                  <?php
                  $query4 = mysqli_query($konek, "select * from inventaris");
                  while ($row = mysqli_fetch_array($query4)) { ?>
                    <option value="<?php print $row['id_inventaris'] ?>"><?php print $row['nama'] ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <label class="col-sm-3 control-label text-right">Jumlah<code>*</code></label>
              <div class="col-sm-8">
                <input type="number" name="jumlah" class="form-control" placeholder="Jumlah barang" required autocomplete="off">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <label class="col-sm-3 control-label text-right">Waktu Pinjam<code>*</code></label>
              <div class="col-sm-8">
                <input type="time" name="jam_pinjam" id="jam_pinjam" class="form-control">
                <input type="date" name="tanggal_pinjam" class="form-control" placeholder="Jumlah barang" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <label class="col-sm-3 control-label text-right">Waktu Kembali<code>*</code></label>
              <div class="col-sm-8">
                <input type="time" name="jam_kembali" id="jam_kembali" class="form-control">
                <input type="date" name="tanggal_kembali" class="form-control" placeholder="Jumlah barang" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <label class="col-sm-3 control-label text-right">Keperluan<code>*</code></label>
              <div class="col-sm-8">
                <input type="text" name="keperluan" class="form-control" placeholder="Masukan Keperluan" required autocomplete="off">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <label class="col-sm-3 control-label text-right">Nama Siswa</label>
              <div class="col-sm-8">
                <input type="text" name="nama_siswa" class="form-control" placeholder="Masukan Nama Siswa" autocomplete="off">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button id="nosave" type="button" class="btn btn-sm btn-secondary pull-left" data-dismiss="modal">Batal</button>
            <button type="submit" name="tambah" class="btn btn-sm btn-success btn-icon-split">
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

<!---Sweetalert pinjam---->
<?php

if (isset($_SESSION['pinjam'])) {

?>
  <script>
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    })

    Toast.fire({
      icon: 'success',
      title: 'Peminjaman Berhasil'
    })
  </script>
<?php }
unset($_SESSION['pinjam']) ?>

<!---Sweetalert melebihi stok---->
<?php

if (isset($_SESSION['ms'])) {

?>
  <script>
    Swal.fire({
      icon: 'error',
      title: '',
      text: 'Jumlah Pinjam melebihi dari jumlah barang yg ada'
    })
  </script>
<?php }
unset($_SESSION['ms']) ?>

<!---Sweetalert pngm---->
<?php

if (isset($_SESSION['pngb'])) {

?>
  <script>
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    })

    Toast.fire({
      icon: 'success',
      title: 'Pengembalian Berhasil'
    })
  </script>
<?php }
unset($_SESSION['pngb']) ?>