<?php

require 'koneksi.php';

if (isset($_POST["register"])) {
    if (registrasi($_POST) > 0) {
        echo "<script> 
        alert('User baru ditambahkan');
        </script>";
    } else {
        echo mysqli_error($konek);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        label {
            display: block;
        }
    </style>
</head>

<body>
    <form action="" method="POST">

        <ul>
            <li>
                <label for="">Username</label>
                <input type="text" class="form-control bg-light border-0 small" name="username"> &nbsp;
            </li>
            <li>
                <label for="">Password</label>
                <input type="password" class="form-control bg-light border-0 small" name="password"> &nbsp;
            </li>
            <li>
                <label for="">Konfirmasi Password</label>
                <input type="password" class="form-control bg-light border-0 small" name="password2"> &nbsp;
            </li>
            <li>
                <button type="submit" name="register">Regsitarsi</button>
            </li>
        </ul>
    </form>
</body>

</html>