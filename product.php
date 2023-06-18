<?php
require "./koneksi.php";
require "./utils/functions.php";

// query kategori berdasarakan default
$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");

// query barang berdasarkan pencarian keyword dari halaman index.php
if (isset($_GET['p'])) {
  $keyword = $_GET['p'];
  $queryProduk = mysqli_query($conn, "SELECT * FROM barang WHERE nama_barang LIKE '%$keyword%'");
} // query barang berdasarkan list kategori yang ada di halaman produk
else if (isset($_GET['kp'])) {
  $keyList = $_GET['kp'];
  // query untuk mendapatkan id kategori dari list kategori yang di pilih
  $queryGetIdKategori = mysqli_query($conn, "SELECT id_kategori FROM kategori WHERE id_kategori = $keyList");

  $resultID = mysqli_fetch_assoc($queryGetIdKategori);

  // query mendapatkan barang berdasarkan id kategori
  $queryProduk = mysqli_query($conn, "SELECT * FROM barang WHERE kategori_id = $resultID[id_kategori]");
} else {
  // query barang berdasarkan default
  $queryProduk = mysqli_query($conn, "SELECT * FROM barang");
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Produk | Nishop</title>
  <!-- Bootstrap -->
  <link rel="stylesheet" href="./public/bootstrap-5.3.0/css/bootstrap.min.css">
  <!-- FontAwesome -->
  <link rel="stylesheet" href="./public/fontawesome/css/fontawesome.min.css">
  <link rel="stylesheet" href="./public/css/style.css?v=<?= time(); ?>">
  <link rel="icon" type="image/x-icon" href="./public/image/nishop_logo.png" style="border-radius: 50%;">
</head>

<body>
  <?php require "./navbar.php"; ?>

  <!-- List Kategori -->
  <div class="container-fluid">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 p-5">
          <ul class="list-group">
            <?php while ($dataKategori = mysqli_fetch_assoc($queryKategori)) : ?>
              <a href="product.php?kp=<?= $dataKategori['id_kategori'] ?>" class="list-category">
                <li class="list-group-item p-5 list-group-item-action text-center"><?= $dataKategori['nama_kategori']; ?></li>
              </a>
            <?php endwhile; ?>
          </ul>
        </div>
        <div class="col-lg-9 p-5">
          <div class="row">

            <?php while ($dataProduk = mysqli_fetch_assoc($queryProduk)) : ?>
              <!-- List Produk -->
              <div class="col-md-4 mb-4">
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
              <!-- Akhir List Produk -->
            <?php endwhile; ?>

          </div>


        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <?php require "./footer.php" ?>

  <script src="./public/bootstrap-5.3.0/js/bootstrap.min.js"></script>
  <script src="./public/fontawesome/js/all.min.js"></script>
</body>

</html>