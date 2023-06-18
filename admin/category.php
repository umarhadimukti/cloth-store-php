<?php

require "./session.php";
require "../koneksi.php";

$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");
$jmlDataKategori = mysqli_num_rows($queryKategori);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Category | Admin</title>
  <!-- Bootstrap -->
  <link rel="stylesheet" href="../public/bootstrap-5.3.0/css/bootstrap.min.css">
  <!-- FontAwesome -->
  <link rel="stylesheet" href="../public/fontawesome/css/fontawesome.min.css">
  <!-- CSS -->
  <link rel="stylesheet" href="../public/css/category.css?v=<?= time(); ?>">
</head>

<body>
  <?php require "./navbar.php" ?>

  <div class="container">
    <!-- Breadcrumb Area -->
    <div class="container">
      <nav class="area-breadcrumb" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">
            <a href="./index.php" class="no-decoration">
              <i class="fas fa-house me-3"></i>
              Home
            </a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Category</li>
        </ol>
      </nav>
    </div>

    <!-- Insert Kategori Area -->
    <div class="input-kategori-baru row justify-content-center">
      <div class="col-md-5">
        <h5>Tambah Kategori</h5>
        <form method="POST">
          <div class="mb-3">
            <input type="text" class="form-control mt-3" id="kategori-baru" name="kategori-baru" placeholder="Masukkan kategori baru..." required autocomplete="off">
            <button type="submit" class="btn btn-sm btn-primary mt-2" name="tambah-kategori" style="width: 100px;">Tambah</button>
        </form>
      </div>
    </div>

    <?php
    if (isset($_POST['tambah-kategori'])) {
      $namaKategoriBaru = htmlspecialchars($_POST['kategori-baru']);
      $queryExist = mysqli_query($conn, "SELECT nama_kategori FROM kategori WHERE nama_kategori = '$namaKategoriBaru'");
      $rowQueryExist = mysqli_num_rows($queryExist);

      if ($rowQueryExist > 0) {
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
      ?>
        <?php
        $queryInsert = mysqli_query($conn, "INSERT INTO kategori (nama_kategori) VALUES ('$namaKategoriBaru')");
        if ($queryInsert) {
        ?>
          <div class="row justify-content-center">
            <div class="col-md-4">
              <div class="alert alert-success d-flex align-items-center" role="alert">
                <div class="text-center">
                  Kategori berhasil disimpan!
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
    }
    ?>


    <!-- List Area -->
    <div class="table-responsive row justify-content-center mt-4">
      <div class="col-md-6">
        <table class="table table-light">
          <thead>
            <tr>
              <th scope="col">No.</th>
              <th scope="col">Nama Kategori</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($jmlDataKategori < 1) : ?>
              <tr>
                <td colspan="3" class="text-center">Kategori masih kosong!</td>
              </tr>
            <?php endif; ?>
            <?php $jmlNomor = 1; ?>
            <?php while ($dataKategori = mysqli_fetch_assoc($queryKategori)) : ?>
              <tr>
                <td><?= $jmlNomor++; ?></td>
                <td><?= $dataKategori['nama_kategori']; ?></td>
                <td>
                  <a href="kategori_detail.php?p=<?= $dataKategori['id_kategori'] ?>" class="btn btn-info"><i class="fa-solid fa-magnifying-glass"></i> Detail</a>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <footer>
    <?php require "./footer.php"; ?>
  </footer>


  <script src="../public/bootstrap-5.3.0/js/bootstrap.min.js"></script>
  <script src="../public/fontawesome/js/all.min.js"></script>
</body>

</html>