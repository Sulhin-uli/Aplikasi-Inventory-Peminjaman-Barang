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
    <td><a href="#" class="btn btn-success btn-icon-split btn-sm" data-toggle="modal" data-target="#tambah">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Tambah Data</span>
        </a></td>
    <td>
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
                        <th>Opsi</th>
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
                            <td>
                                <a href="#" class="btn btn-primary btn-circle btn-sm" data-toggle="modal" data-target="#ubah<?php print $row[0] ?>">
                                    <i class="fas fa-edit"></i>
                                    <a href="#" class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-target="#hapus<?php print $row[0] ?>">
                                        <i class="fas fa-trash"></i>
                            </td>
                        </tr>



                        <!-- Modal Ubah-->
                        <div class="modal fade" id="ubah<?php print $row[0] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-tittle">Ubah Data Pegawai</h3>
                                    </div>
                                    <div class="modal-body">
                                        <form action="konten-admin/ubah-pegawai.php?act=ubah" method="POST">
                                            <?php
                                            $id_pegawai = $row['id_pegawai'];
                                            $q = mysqli_query($konek, "SELECT * FROM pegawai WHERE id_pegawai='$id_pegawai'");
                                            $r = mysqli_fetch_array($q);
                                            ?>
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-sm-3 control-label text-right">Nama</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" autocomplete="off" name="nama_pegawai" class="form-control" value="<?php print $r['nama_pegawai'] ?>" placeholder="Masukkan Nama Pegawai" required>
                                                        <input type="hidden" autocomplete="off" name="id_pegawai" value="<?php print $r['id_pegawai'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-sm-3 control-label text-right">NIK</label>
                                                    <div class="col-sm-8"><input type="number" autocomplete="off" name="nik" class="form-control" value="<?php print $r['nik'] ?>" placeholder="Masukan NIP" required></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-sm-3 control-label text-right">Tgl Lahir</label>
                                                    <div class="col-sm-8"><input type="date" autocomplete="off" name="tgl_lahir" class="form-control" value="<?php print $r['tgl_lahir'] ?>" placeholder="Masukan NIP" required></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-sm-3 control-label text-right">Alamat</label>
                                                    <div class="col-sm-8"><textarea name="alamat" class="form-control" cols="30" rows="10" placeholder="Alamat.." required><?php print $r['alamat'] ?></textarea> </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-sm-3 control-label text-right">Jenis Kelamin</label>
                                                    <div class="col-sm-8">
                                                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                                            <?php if ($r['jenis_kelamin'] == 'Laki-laki') { ?>
                                                                <option value="Laki-laki">Laki-laki</option>
                                                                <option value="Perempuan">Perempuan</option>
                                                            <?php } else { ?>
                                                                <option value="Perempuan">Perempuan</option>
                                                                <option value="Laki-laki">Laki-laki</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-sm-3 control-label text-right">Posisi</label>
                                                    <div class="col-sm-8"><input type="text" name="posisi" class="form-control" value="<?php print $r['posisi'] ?>" placeholder="Masukan Posisi" required></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-sm-3 control-label text-right">Telepon</label>
                                                    <div class="col-sm-8"><input type="number" autocomplete="off" name="telepon" class="form-control" value="<?php print $r['telepon'] ?>" placeholder="Masukan telepon" required></div>
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
                        <div class="modal fade" id="hapus<?php print $row[0] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        Apakah anda yakin menghapus data Pegawai <strong><?php print $row[1] ?></strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
                                        <a href="?menu=pegawai&hapus=ya&id_pegawai=<?php print $row[0] ?>" class="btn btn-danger btn-icon-split btn-sm" name="hapus">
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
                <h3 class="modal-tittle">Tambah Data Pegawai</h3>
            </div>
            <div class="modal-body">
                <form action="konten-admin/tambah-pegawai.php?act=tambah" method="POST">
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right">Nama<code>*</code></label>
                            <div class="col-sm-8"><input type="text" name="nama" class="form-control" placeholder="Masukan Nama Pegawai" required></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right">NIK<code>*</code></label>
                            <div class="col-sm-8"><input type="number" autocomplete="off" name="nik" class="form-control" placeholder="Masukan NIK" required></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right">Tgl Lahir<code>*</code></label>
                            <div class="col-sm-8"><input type="date" autocomplete="off" name="tgl_lahir" class="form-control" required></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right">Alamat<code>*</code></label>
                            <div class="col-sm-8"><textarea name="alamat" class="form-control" cols="30" rows="10" placeholder="Masukan Alamat.." required></textarea></textarea> </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right">Jenis Kelamin<code>*</code></label>
                            <div class="col-sm-8">
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                                    <option value="">- Jenis Kelamin -</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right">Posisi<code>*</code></label>
                            <div class="col-sm-8"><input type="text" autocomplete="off" name="posisi" class="form-control" placeholder="Masukan Posisi" required></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right">Telepon<code>*</code></label>
                            <div class="col-sm-8"><input type="number" autocomplete="off" name="telepon" class="form-control" placeholder="Masukan telepon" required></div>
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