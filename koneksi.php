<?php
$konek = mysqli_connect("localhost", "root", "", "aipy_db");
 /*
function registrasi($data)
{
    global $konek;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($konek, $data["password"]);
    $password2 = mysqli_real_escape_string($konek, $data["password2"]);

    //cek konfirmasi Password
    if ($password !== $password2) {
        echo "<script>
              alert('Konfirmasi Password tidak sesuai')
              </script>";
        return false;
    }
    //encripssi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //tambahkan user baru ke database
    mysqli_query($konek, "INSERT INTO user VALUES ('', '$username', '$password','','')");
    return mysqli_affected_rows($konek);
}
*/
