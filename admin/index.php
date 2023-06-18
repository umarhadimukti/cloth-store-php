<?php

require "./session.php";
require "../koneksi.php";

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
    footer {
      position: absolute;
      bottom: -700px;
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
    <div class="row justify-content-center">
      <div class="col-md-11">
        <nav class="area-breadcrumb" aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
              <i class="fas fa-house me-3"></i>Home
            </li>
          </ol>
        </nav>
      </div>
    </div>

    <!-- Carousel -->
    <div class="row justify-content-center my-5">
      <div class="col-md-10">
        <div id="carouselExampleIndicators" class="carousel slide">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="../public/image/carousel/image1.jpg" class="d-block w-100 rounded" alt="image1" width="800" height="500">
            </div>
            <div class="carousel-item">
              <img src="../public/image/carousel/image2.jpg" class="d-block w-100 rounded" alt="image2" width="800" height="500">
            </div>
            <div class="carousel-item">
              <img src="../public/image/carousel/image3.jpg" class="d-block w-100 rounded" alt="image3" width="800" height="500">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bg-secondary rounded" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon bg-secondary rounded" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
    </div>
    <!-- Akhir Carousel -->

    <footer>
      <?php require "./footer.php"; ?>
    </footer>


    <script src="../public/bootstrap-5.3.0/js/bootstrap.min.js"></script>
    <script src="../public/fontawesome/js/all.min.js"></script>
</body>

</html>