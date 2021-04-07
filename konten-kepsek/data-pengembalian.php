<?php

if (isset($_GET['hapus'])) {
    $id_pengembalian = $_GET['id_pengembalian'];

    mysqli_query($konek,"DELETE FROM pengembalian WHERE id_pengembalian=$id_pengembalian");
    $_SESSION['hapus'] = 'berhasil';
} 
?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Pengembalian</h1>

 <!-- DataTables  -->
 <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-success">Riwayat Pengembalian</h6>
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
                      <th>Waktu Kembali</th>
                      <th>Status</th>
                      <th>Opsi</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php 
                      include('koneksi.php');
                      $query = mysqli_query($konek, "SELECT * FROM pengembalian INNER JOIN 
                                                                            inventaris ON pengembalian.id_inventaris = inventaris.id_inventaris
                                                                            INNER JOIN 
                                                                            pegawai ON pengembalian.id_pegawai = pegawai.id_pegawai ORDER BY id_pengembalian DESC                                                      
                                                                          ");
                    $no = 0;
                    while($row=mysqli_fetch_array($query)) {
                      $no++;
                          ?>
                      <tr>
                      <td><?php print $no?></td>
                      <td><?php print $row['nama_pegawai']?></td>
                      <td><?php print $row['nama_siswa']?></td>
                      <td><?php print $row['nama']?></td>
                      <td><?php print $row['jumlah_pinjam']?></td>
                      <td><?php print $row['keperluan']?></td>
                      <?php 

                        $tanggal1 = date("d-m-Y ", strtotime($row['tanggal_pinjam']));
                        $tanggal2 = date("d-m-Y", strtotime($row['tanggal_kembali']));
                        $jam1 = date("H:i ", strtotime($row['jam_pinjam']));
                        $jam2 = date("H:i ", strtotime($row['jam_kembali']));
                        $kembali = date("H:i  d-m-Y", strtotime($row['waktu_kembali']));

                        ?>
                      
                      <td><?php print $jam1?> <?php print $tanggal1?>s/d<br><?php print $jam2?> <?php print $tanggal2?></td>
                      <td><?php print $kembali?></td>
                      <td><p class="text-success"><i><?php print $row['status_peminjaman']?><i></p></td>
                      <td>
                        <a href="#" class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-target="#hapus<?php print $row[0]?>">
                        <i class="fas fa-trash"></i>
                      </tr>

                      <!-- Modal Hapus-->
                      <div class="modal fade" id="hapus<?php print $row[0]?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                              <div class="modal-content">
                                  <div class="modal-body">
                                  Apakah anda yakin menghapus data ini?
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
                                      <a href="?menu=pengembalian&hapus=ya&id_pengembalian=<?php print $row[0]?>" class="btn btn-danger btn-icon-split btn-sm" name="hapus">
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

