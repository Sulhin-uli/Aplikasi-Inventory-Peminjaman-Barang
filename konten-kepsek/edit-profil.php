<?php
include('koneksi.php');

$id_user = $_SESSION["id_user"];
$q = mysqli_query($konek, "SELECT * FROM user WHERE id_user ='$id_user'");
$r = mysqli_fetch_array($q);

function ubah($data)
{
  global $konek;
  global $id_user;

  $username = strtolower(stripslashes($data["username"]));
  $nama = mysqli_real_escape_string($konek, $data["nama"]);
  $password = mysqli_real_escape_string($konek, $data["password"]);
  $password2 = mysqli_real_escape_string($konek, $data["password2"]);

  // cek konfirmasi password
  if ($password !== $password2) {
    $_SESSION['error'] = '<i><code>konfirmasi <b>pasword</b> tidak sesuai</code></i>';
    return false;
  }

  // enkripsi password 
  $password = password_hash($password, PASSWORD_DEFAULT);


  mysqli_query($konek, "UPDATE user SET id_user = '$id_user' , username='$username', password='$password', nama_user='$nama' WHERE id_user = '$id_user'");

  return mysqli_affected_rows($konek);
}
if (isset($_POST["simpan"])) {

  if (ubah($_POST) > 0) {
    $berhasil = true;
  } else {
    echo mysqli_error($konek);
  }
}



?>
<h1 class="h3 mb-2 text-gray-800">Edit Profil</h1>
<div class="card shadow mb-4">
  <div class="card-header py-3">
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <form action="" method="post">
        <div class="form-group">
          <div class="label">
          </div>
        </div>

        <?php if (isset($pts)) : ?>
          <p style="color: red; font-style: italic;"> sdsdsd</p>
        <?php endif; ?>
        <div class="form-group">
          <label for="">Nama</label>
          <input type="text" class="form-control bg-light border-0 small" value="<?php print $r['nama_user'] ?>" placeholder="<?php print $r['nama_user'] ?>" name="nama" required> <br>
          <label for="">Username:</label>
          <input type="text" class="form-control bg-light border-0 small" minlength="8" value="<?php print $r['username'] ?>" name="username" required> <br>
          <label for="">Password</label>
          <input type="password" class="form-control bg-light border-0 small" minlength="6" name="password" required> <br>
          <label for="">Konfirmasi Password:</label>
          <input type="password" class="form-control bg-light border-0 small" minlength="6" name="password2" required> <br>
          <?php
          if (isset($_SESSION['error'])) {

          ?>

            <?= $_SESSION['error']; ?>

          <?php }
          unset($_SESSION['error']) ?>
        </div>
        <button type="submit" name="simpan" class="btn btn-success btn-sm">Simpan</button>
      </form>
    </div>
  </div>
</div>
</div>

<!---Sweetalert Edit---->
<?php

if (isset($berhasil)) {

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
      title: 'Profil berhasil diedit'
    })
  </script>
<?php }
unset($berhasil) ?>