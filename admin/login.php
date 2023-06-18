<?php

session_start();

require "../koneksi.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Nishop</title>
  <!-- Bootstrap -->
  <link rel="stylesheet" href="../public/bootstrap-5.3.0/css/bootstrap.min.css">
  <!-- FontAwesome -->
  <link rel="stylesheet" href="../public/fontawesome/css/fontawesome.min.css">
  <!-- CSS -->
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      background-color: #f0ece2;
    }

    .container {
      /* border: 2px solid black; */
      width: 60%;
      height: 100vh;
      background-color: #dfd3c3;
      display: flex;
      flex-direction: column;
    }

    .box-title {
      /* border: 2px solid black; */
      position: relative;
      top: -50px;
    }

    .box-title img {
      box-shadow: 0 5px 4px 1px rgba(0, 0, 0, .3);
    }

    .box-login {
      background-color: whitesmoke;
      width: 500px;
      height: 280px;
      /* border: 2px solid black; */
      border-radius: 10px;
    }

    .txt-alert {
      width: 500px;
    }
  </style>
</head>

<body>
  <div div class="container d-flex justify-content-center align-items-center">
    <!-- Box Title -->
    <div class="box-title">
      <img src="../public/image/nishop_logo.png" alt="logo" class="rounded-circle" width="180" height="180">
    </div>

    <!-- Box Login -->
    <div class="box-login p-5 shadow">
      <form action="" method="POST">
        <div class="mb-3">
          <i class="fa-solid fa-user" style="position: relative; top: 30px; left: -20px"></i>
          <input type="text" name="username" class="form-control" id="username" placeholder="Masukkan username.." autocomplete="off" autofocus>
        </div>
        <div class="mb-3" style="margin: -20px 0">
          <i class="fa-solid fa-lock" style="position: relative; top: 30px; left: -20px"></i>
          <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan password..">
        </div>
        <div>
          <button type="submit" class="btn btn-success form-control mt-3" name="submit">Login <i class="fa-solid fa-right-to-bracket"></i></button>
        </div>
      </form>
    </div>

    <!-- Box Message -->
    <div>
      <?php
      if (isset($_POST['submit'])) {
        // mengambil data dari input user
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        $query = mysqli_query($conn, "SELECT * FROM pelanggan WHERE username='$username'");

        $countData = mysqli_num_rows($query);
        $dataUser = mysqli_fetch_assoc($query);

        if ($countData > 0) {
          if (password_verify($password, $dataUser['password'])) {
            $_SESSION['username'] = $dataUser['username'];
            $_SESSION['login'] = true;
            header('location: ../admin');
          } else {
      ?>
            <div class="alert alert-danger text-center mt-3 txt-alert" role="alert">
              Password tidak cocok!
            </div>

          <?php
          }
        } else {
          ?>
          <div class="alert alert-warning text-center mt-3 txt-alert" role="alert">
            Username tidak ada!
          </div>

      <?php
        }
      }
      ?>

    </div>
  </div>

  <script src="../public/bootstrap-5.3.0/js/bootstrap.min.js"></script>
  <script src="../public/fontawesome/js/all.min.js"></script>
</body>

</html>