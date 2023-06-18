<?php

require "./session.php";
require "../koneksi.php";

$id = $_GET['p'];
$queryGetCategory = mysqli_query($conn, "SELECT * FROM kategori WHERE id_kategori = $id");
$result = mysqli_fetch_assoc($queryGetCategory);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home | Admin</title>
  <!-- Bootstrap -->
  <link rel="stylesheet" href="../public/bootstrap-5.3.0/css/bootstrap.min.css">
  <!-- FontAwesome -->
  <link rel="stylesheet" href="../public/fontawesome/css/fontawesome.min.css">
  <link rel="stylesheet" href="../public/css/home.css?v=<?= time(); ?>">
  <style>
    .no-decoration {
      text-decoration: none;
      color: black;
    }

    .no-decoration:hover {
      color: rgb(110, 110, 110);
      cursor: pointer;
    }

    footer {
      position: absolute;
      bottom: -300px;
      left: 0;
      right: 0;
      background: #596e79;
      height: auto;
      width: 100%;
      padding-top: 40px;
      color: #fff;
    }
  </style>
</head>

<body>
  <?php require "./navbar.php" ?>

  <div class="container">
    <!-- Breadcrumb -->
    <nav class="area-breadcrumb mb-5" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">
          <a href="./category.php" class="no-decoration">
            <i class="fas fa-list me-3"></i>
            Category
          </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Detail Category</li>
      </ol>
    </nav>

    <!-- Judul Detail Category -->
    <div class="row justify-content-center">
      <div class="col-md-4">
        <h5>Detail Category</h5>
      </div>
    </div>

    <!-- Input Area Detail Category -->
    <div class="row justify-content-center mt-3">
      <div class="col-md-4">
        <form method="POST">
          <div class="mb-3">
            <input type="text" class="form-control" id="nama-kategori" name="nama-kategori" value="<?= $result['nama_kategori'] ?>" placeholder="Edit Kategori..">
            <div class="mt-2 d-flex justify-content-between">
              <button type="submit" class="btn btn-sm btn-warning mt-2" name="edit-kategori" style="width: 100px">Edit</button>
              <button type="submit" class="btn btn-sm btn-danger mt-2" name="delete-kategori" style="width: 100px" onclick="return confirm(`Yakin ingin menghapus <?= $result['nama_kategori']; ?>`);">Delete</button>
            </div>
        </form>
      </div>
    </div>
  </div>

  <?php
  if (isset($_POST['edit-kategori'])) {
    $namaKategori = htmlspecialchars($_POST['nama-kategori']);
    if ($result['nama_kategori'] == $namaKategori) {
  ?>
      <meta http-equiv='refresh' content='0; url=category.php' />
      <?php
    } else {
      $query = mysqli_query($conn, "SELECT * FROM kategori WHERE nama_kategori = '$namaKategori'");
      $rowQuery = mysqli_num_rows($query);
      if ($rowQuery > 0) {
      ?>
        <div class="row justify-content-center">
          <div class="col-md-4">
            <div class="alert alert-warning d-flex align-items-center" role="alert">
              <div class="text-center">
                Kategori sudah ada!
              </div>
            </div>
          </div>
        </div>
        <?php
      } else {
        $queryInsert = mysqli_query($conn, "UPDATE kategori SET nama_kategori = '$namaKategori' WHERE id_kategori = $id");
        if ($queryInsert) {
        ?>
          <div class="row justify-content-center">
            <div class="col-md-4">
              <div class="alert alert-success d-flex align-items-center" role="alert">
                <div class="text-center">
                  Kategori berhasil diubah!
                </div>
              </div>
            </div>
          </div>
          <meta http-equiv="refresh" content="1; url=category.php" />
  <?php
        } else {
          echo mysqli_error($conn);
        }
      }
    }
  }
  ?>

  <?php
  if (isset($_POST['delete-kategori'])) {
    $queryCheck = mysqli_query($conn, "SELECT * FROM barang WHERE kategori_id = $id");
    $rowQueryCheck = mysqli_num_rows($queryCheck);
    if ($rowQueryCheck > 0) {
      echo "
        <div class='row justify-content-center'>
          <div class='col-md-4'>
            <div class='alert alert-warning d-flex align-items-center' role='alert'>
              <div class='text-center'>
                Kategori tidak bisa dihapus karena sudah ada di produk!
              </div>
            </div>
          </div>
        </div>
      ";
      die();
    }

    $queryDelete = mysqli_query($conn, "DELETE FROM kategori WHERE id_kategori = $id");
    if ($queryDelete) {
  ?>
      <div class="row justify-content-center">
        <div class="col-md-4">
          <div class="alert alert-primary d-flex align-items-center" role="alert">
            <div class="text-center">
              Kategori berhasil dihapus!
            </div>
          </div>
        </div>
      </div>
      <meta http-equiv="refresh" content="2; url=category.php" />
  <?php
    } else {
      echo mysqli_error($conn);
    }
  }
  ?>


  <footer>
    <?php require "./footer.php"; ?>
  </footer>


  <script src="../public/bootstrap-5.3.0/js/bootstrap.min.js"></script>
  <script src="../public/fontawesome/js/all.min.js"></script>
</body>

</html>