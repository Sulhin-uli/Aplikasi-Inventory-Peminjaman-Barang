<?php
session_start();
require 'koneksi.php';
if (isset($_POST["masuk"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];
  $level = $_POST['level'];

  $result = mysqli_query($konek, "SELECT * FROM user WHERE username = '$username' AND id_level = '" . $level . "'");

  //cek username
  if (mysqli_num_rows($result) === 1) {

    //cek password
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row["password"])) {
      $_SESSION['name_user'] = $row['nama_user'];
      $_SESSION['id_user'] = $row['id_user'];


      if ($row['id_level'] == 1) {
        // alihkan ke halaman admin
        header('Location: admin-page.php?menu=home');
        $_SESSION["login_1"] = true;
      } else if ($row['id_level'] == 2) {
        header('Location: kepsek-page.php?menu=home');
        $_SESSION["login_2"] = true;
      } else {
        header('Location: index.php');
      }
      exit;
    }
  }

  $error = true;
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

  <title>APY | Login</title>
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <!-- sewwtalert2 -->
  <script src="vendor/sweetalert2/dist/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="vendor/sweetalert2/dist/sweetalert2.min.css">

</head>

<body class="bg-gradient-success">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <br>
                    <img src="img/smk-yapiimm.png" alt="#" width="95px">
                    <br>
                    <h1 class="h3 text-gray-900 mb-4"><strong>AIPY </strong>App</h1>
                    <h3 class="h6 text-gray-900 mb-4">APLIKASI INVENTORI PEMINJAMAN BARANG <br>SMK YAPIIM INDRAMAYU
                    </h3>
                  </div>
                  <form class="user" action="" method="POST" autocompletes="off">
                    <div class="form-group">
                      <input type="text" name="username" class="form-control bg-light border-0 small" class="form-control " id="exampleInputEmail" aria-describedby="emailHelp" placeholder=" Username" required autocomplete="off">
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control bg-light border-0 small" class="form-control " id="exampleInputPassword" placeholder=" Password" required>
                    </div>
                    <div class="form-group">
                      <select name="level" class="form-control bg-light border-0 small" id="level" class="form-control">
                        <option value="">- Masuk Sebagai -</option>
                        <option value="1">Admin</option>
                        <option value="2">Kepala Sekolah</option>
                      </select>
                    </div>
                    <div class="form-group">
                    </div>
                    <button name="masuk" class="btn btn-success btn-user btn-block">Login</button>
                    <!-- Pesan Kesalahan -->
                    <?php if (isset($error)) : ?>
                      <p style="text-align:center"><i><code><b>username</b> atau <b>pasword</b> tidak valid</code></i></p>
                    <?php endif; ?>
                    <br>
                  </form>
                  <hr>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
<?php
session_destroy();
?>