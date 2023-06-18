<?php
require "./koneksi.php";
require "./utils/functions.php";

$namaProdukURL = $_GET['d'];

$queryGetDetailProduk = mysqli_query($conn, "SELECT * FROM barang WHERE nama_barang = '$namaProdukURL'");
$dataProduk = mysqli_fetch_assoc($queryGetDetailProduk);

$queryGetSerupa = mysqli_query($conn, "SELECT * FROM barang WHERE kategori_id = '$dataProduk[kategori_id]' AND NOT id_barang = $dataProduk[id_barang] LIMIT 4");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Produk Detail | Nishop</title>
  <!-- Bootstrap -->
  <link rel="stylesheet" href="./public/bootstrap-5.3.0/css/bootstrap.min.css">
  <!-- FontAwesome -->
  <link rel="stylesheet" href="./public/fontawesome/css/fontawesome.min.css">
  <link rel="stylesheet" href="./public/css/style.css?v=<?= time(); ?>">
  <link rel="icon" type="image/x-icon" href="./public/image/nishop_logo.png" style="border-radius: 50%;">
</head>

<body>
  <?php require "./navbar.php"; ?>

  <!-- Detail Produk -->
  <div class="container-fluid" style="height: 70vh;">
    <div class="container my-5">
      <div class="row justify-content-center">
        <div class="col-md-4">
          <img src="./public/image/<?= $dataProduk['foto'] ?>" class="rounded" alt="image" width="350" height="350">
        </div>
        <div class="col-md-5">
          <h4 class="mb-3"><?= $dataProduk['nama_barang'] ?></h4>
          <p><?= $dataProduk['detail'] ?></p>
          <p class="fs-5">Rp. <?= formatRupiah($dataProduk['harga']) ?></p>
          <?php if ($dataProduk['stok'] == 'Tersedia') : ?>
            <a href="keranjang.php?i=<?= $dataProduk['id_barang'] ?>" class="text-dark btn btn-light" style="text-decoration: none">
              <i class="fa-solid fa-cart-shopping"></i> Masukkan Keranjang
            </a>
          <?php endif; ?>
          <?php if ($dataProduk['stok'] == "Tersedia") { ?>
            <span class="badge rounded-pill text-bg-success p-2 d-block mt-3" style="width: 100px"><?= $dataProduk['stok'] ?></span>
          <?php } else { ?>
            <span class="badge rounded-pill text-bg-danger p-2 d-block mt-3" style="width: 100px"><?= $dataProduk['stok'] ?></span>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>

  <!-- Produk serupa -->
  <div class="container-fluid py-5" style="background: linear-gradient(180deg, #f1eeed, white);">
    <div class="container">
      <h4 class="text-center mb-5">Produk Serupa</h4>
      <div class="row">
        <?php while ($dataSerupa = mysqli_fetch_assoc($queryGetSerupa)) : ?>
          <div class="col-md-6 col-lg-3 mb-3">
            <a href="product_detail.php?d=<?= $dataSerupa['nama_barang'] ?>">
              <img src="./public/image/<?= $dataSerupa['foto'] ?>" class="rounded shadow" width="280" height="280" class="produk-serupa img-fluid img-thumbnail" alt="image">
            </a>
          </div>
        <?php endwhile; ?>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <?php require "./footer.php" ?>

  <script src="./public/bootstrap-5.3.0/js/bootstrap.min.js"></script>
  <script src="./public/fontawesome/js/all.min.js"></script>
</body>

</html>