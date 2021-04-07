<?php
require_once 'koneksi.php';
session_start();
if (!isset($_SESSION["login_2"])) {
  header("Location: index.php");
  exit;
}


?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>AIPY | Kepala Sekolah</title>

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <!-- sewwtalert2 -->
  <script src="vendor/sweetalert2/dist/sweetalert2.min.js"></script>

  <link rel="stylesheet" href="vendor/sweetalert2/dist/sweetalert2.min.css">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="?menu=home">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class=""></i>
        </div>
        <div class="sidebar-brand-text mx-3"><strong>AIPY</strong> App</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="?menu=home">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Interface
      </div>

      <!-- Nav Item - Data Barang -->
      <li class="nav-item">
        <a class="nav-link" href="?menu=barang">
          <i class="fas fa-fw fa-box"></i>
          <span>Barang</span></a>
      </li>

      <!-- Nav Item - Data ruang -->
      <li class="nav-item">
        <a class="nav-link" href="?menu=ruangan">
          <i class="fas fa-fw fa-home"></i>
          <span>Ruangan</span></a>
      </li>

      <!-- Nav Item - Pegawai -->
      <li class="nav-item">
        <a class="nav-link" href="?menu=pegawai">
          <i class="fas fa-fw fa-user"></i>
          <span>Pegawai</span></a>
      </li>

      <!-- Nav Item - Pages Transaksi -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-dolly"></i>
          <span>Transaksi</span>
        </a>
        <div id="collapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="?menu=peminjaman">Peminjaman</a>
            <a class="collapse-item" href="?menu=pengembalian">Pengembalian</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Pages Laporan -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-list"></i>
          <span>Laporan</span>
        </a>
        <div id="collapse2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="?menu=laporan-peminjaman">Peminjaman</a>
            <a class="collapse-item" href="?menu=laporan-pengembalian">Pengembalian</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php print $_SESSION['name_user'] ?></span>
                <i class="fas fa-fw fa-user"></i>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="?menu=edit-profil">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Edit Profil
                </a>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <?php
          if ($_GET['menu'] == 'home') {
            include 'konten-kepsek/konten.php';
          } elseif ($_GET['menu'] == 'logout') {
            session_destroy();
            print "<meta http-equiv='refresh' content='0;URL=index.php'> ";
          } elseif ($_GET['menu'] == 'jenis-barang') {
            include 'konten-kepsek/jenis-barang.php';
          } elseif ($_GET['menu'] == 'ruangan') {
            include 'konten-kepsek/ruangan.php';
          } elseif ($_GET['menu'] == 'pegawai') {
            include 'konten-kepsek/pegawai.php';
          } elseif ($_GET['menu'] == 'barang') {
            include 'konten-kepsek/barang.php';
          } elseif ($_GET['menu'] == 'laporan') {
            include 'konten-kepsek/laporan.php';
          } elseif ($_GET['menu'] == 'peminjaman') {
            include 'konten-kepsek/peminjaman.php';
          } elseif ($_GET['menu'] == 'pengembalian') {
            include 'konten-kepsek/data-pengembalian.php';
          } elseif ($_GET['menu'] == 'edit-profil') {
            include 'konten-kepsek/edit-profil.php';
          } elseif ($_GET['menu'] == 'register') {
            include 'konten-kepsek/register.php';
          } elseif ($_GET['menu'] == 'laporan-peminjaman') {
            include 'konten-kepsek/laporan-peminjaman.php';
          } elseif ($_GET['menu'] == 'laporan-pengembalian') {
            include 'konten-kepsek/laporan-pengembalian.php';
          }
          ?>
        </div>

        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>&copy; SMK YAPIIM INDRAMAYU</span>
            </div>
          </div>
        </footer>
        <!-- End of Footer -->
      </div>
      <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Apakah anda yakin akan Log out?</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
            <a class="btn btn-success" href="?menu=logout">Ya</a>
          </div>
        </div>
      </div>
    </div>

    <!---Sweetalert tambah---->
    <?php

    if (isset($_SESSION['tambah'])) {

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
    unset($_SESSION['tambah']) ?>

    <!---Sweetalert hapus---->
    <?php

    if (isset($_SESSION['hapus'])) {

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
          title: 'Hapus Data Berhasil'
        })
      </script>
    <?php }
    unset($_SESSION['hapus']) ?>

    <!---Sweetalert Edit---->
    <?php

    if (isset($_SESSION['edit'])) {

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
          title: 'Edit Data Berhasil'
        })
      </script>
    <?php }
    unset($_SESSION['edit']) ?>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>





</body>

</html>