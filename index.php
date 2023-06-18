<?php
require "./koneksi.php";
require "./utils/functions.php";

$queryGetProduk = mysqli_query($conn, "SELECT * FROM barang LIMIT 8");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Beranda | Nishop</title>
  <!-- Bootstrap -->
  <link rel="stylesheet" href="./public/bootstrap-5.3.0/css/bootstrap.min.css">
  <!-- FontAwesome -->
  <link rel="stylesheet" href="./public/fontawesome/css/fontawesome.min.css">
  <link rel="stylesheet" href="./public/css/style.css?v=<?= time(); ?>">
</head>

<body>
  <?php require "./navbar.php"; ?>
  <!-- Banner -->
  <div class="banner container-fluid d-flex align-items-center text-light border">
    <div class="container text-center ">
      <h1>Selamat Datang di toko kami</h1>
      <h5>Mau cari pakaian apa?</h5>
      <div class="col-md-4 offset-4">
        <form action="./product.php" method="GET">
          <div class="input-group my-4">
            <input type="text" class="form-control" id="keyword" name="p" placeholder="Ketikkan yang ingin anda cari.." aria-label="Ketikkan yang ingin anda cari.." aria-describedby="button-addon2" autocomplete="off" required>
            <button class="btn btn-light" type="submit" id="cari"><i class="fa-solid fa-magnifying-glass"></i></button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Highlight Category -->
  <div class="container-fluid hg-container">
    <div class="container-fluid text-center">
      <div class="justify-content-center row gap-3">
        <h4 class="mt-5 mb-3">Kategori terlaris</h4>
        <!-- kategori1 -->
        <div class="col-md-3 kategori-dress rounded hover-item">
          <div class="highlighted-category d-flex justify-content-center align-items-center">
            <h3><a href="product.php?kp=471" class="text-white no-decoration">Dress</a></h3>
          </div>
        </div>
        <!-- kategori2 -->
        <div class="col-md-3 kategori-kerudung rounded hover-item">
          <div class="highlighted-category d-flex justify-content-center align-items-center">
            <h3><a href="product.php?kp=469" class="text-white no-decoration">Kerudung</a></h3>
          </div>
        </div>
        <!-- kategori3 -->
        <div class="col-md-3 kategori-kemeja-pria rounded hover-item">
          <div class="highlighted-category d-flex justify-content-center align-items-center">
            <h3><a href="product.php?kp=470" class="text-white no-decoration">Kemeja Pria</a></h3>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Section Tentang Kami -->
  <div class="container-fluid section-us p-5">
    <div class="container d-flex flex-column justify-content-center align-items-center text-center fs-5 pt-3 pb-5">
      <h4 class="mt-3 mb-3">Tentang kami</h4>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat facere assumenda corrupti voluptate ea, ullam atque quas culpa saepe exercitationem repudiandae laudantium fugiat consequatur quis voluptatum soluta dolores tempore sit. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Reprehenderit perferendis perspiciatis laborum! Nobis minus iure ex pariatur delectus possimus itaque.</p>
    </div>
  </div>

  <!-- Section Produk -->
  <div class="container-fluid">
    <div class="container text-center">
      <h4 class="my-5">Produk tersedia</h4>
      <div class="row">
        <?php while ($dataProduk = mysqli_fetch_assoc($queryGetProduk)) : ?>
          <div class="col-md-3 mb-4">
            <div class="card" style="width: 18rem;">
              <img src="./public/image/<?= $dataProduk['foto'] ?>" class="card-img-top" height="280" alt="img">
              <div class="card-body">
                <h5 class="card-title text-truncate"><?= $dataProduk['nama_barang'] ?></h5>
                <p class="card-text text-truncate"><?= $dataProduk['detail'] ?></p>
                <p class="card-text fs-5">Rp. <?= formatRupiah($dataProduk['harga']) ?></p>
                <a href="product_detail.php?d=<?= $dataProduk['nama_barang'] ?>" class="btn" style="width: 150px; background-color: #fbf2d5;">Detail</a>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    </div>
  </div>

  <?php require "./footer.php"; ?>

  <script src="./public/bootstrap-5.3.0/js/bootstrap.min.js"></script>
  <script src="./public/fontawesome/js/all.min.js"></script>
</body>

</html>