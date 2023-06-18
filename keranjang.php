<?php
require "./koneksi.php";
require "./utils/functions.php";
require "./functions.php";

// query menampilkan semua data dari tabel keranjang
$queryKeranjang = mysqli_query($conn, "SELECT * FROM keranjang ORDER BY id_keranjang DESC");
$rowQueryKeranjang = mysqli_num_rows($queryKeranjang);

$value = isset($_POST['input-qty']) ? $_POST['input-qty'] : 1;
// if (isset($_POST['increment'])) {
//   $value++;
// }

// if (isset($_POST['decrement'])) {
//   $value--;
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Keranjang | Nishop</title>
  <!-- Bootstrap -->
  <link rel="stylesheet" href="./public/bootstrap-5.3.0/css/bootstrap.min.css">
  <!-- FontAwesome -->
  <link rel="stylesheet" href="./public/fontawesome/css/fontawesome.min.css">
  <link rel="stylesheet" href="./public/css/style.css?v=<?= time(); ?>">
  <link rel="icon" type="image/x-icon" href="./public/image/nishop_logo.png" style="border-radius: 50%;">
  <!-- <script src="./public/js/jquery.js"></script>
  <script src="./public/js/custom.js"></script> -->
  <style>
    .hover-button:hover {
      cursor: pointer;
      background-color: #979998;
    }
  </style>
</head>

<body>
  <?php require "./navbar.php"; ?>

  <!-- List Keranjang -->
  <div class="container-fluid mb-5">
    <div class="container mt-5">
      <?php if (isset($_GET['i'])) {
        // query get produk from detail product
        $queryProduk = mysqli_query($conn, "SELECT id_barang, nama_barang, foto, harga FROM barang WHERE id_barang = $_GET[i]");
        $resultProduk = mysqli_fetch_assoc($queryProduk);
        $namaProduk = $resultProduk['nama_barang'];
        $foto = $resultProduk['foto'];
        $harga = $resultProduk['harga'];

        // query insert produk from product detail to keranjang
        $queryInsert = mysqli_query($conn, "INSERT INTO keranjang VALUES ('', '$namaProduk', $harga, '$foto')");
      ?>

        <div class="row justify-content-center product-data">
          <div class="col-md-10">
            <h5 class="mb-3"><i class="fa-solid fa-cart-shopping"></i> Keranjang Belanja</h5>
            <?php if ($rowQueryKeranjang < 1) : ?>
              <div class="row justify-content-center mt-5">
                <div class="col-md-12">
                  <div class="alert alert-warning text-center" role="alert">
                    Keranjang masih Kosong!
                  </div>
                </div>
              </div>
            <?php endif; ?>
            <ul class="list-group list-group-flush">
              <?php while ($dataKeranjang = mysqli_fetch_assoc($queryKeranjang)) : ?>
                <li class="list-group-item list-group-item-action d-flex justify-content-between">
                  <img src="./public/image/<?= $dataKeranjang['foto'] ?>" class="d-inline-block" alt="image" width="80" height="80">
                  <div class="d-flex justify-content-around align-items-center w-75">
                    <div class="product-name" style="width: 20%;">
                      <p class="d-inline-block text-truncate"><?= $dataKeranjang['nama_produk'] ?></p>
                      <form action="" method="POST">
                        <div class="input-group mb-3 input-product-area w-50">
                          <input type="number" class="form-control text-center" name="input-qty" id="input-qty" value="1" min="1" max="10">
                        </div>
                      </form>
                    </div>
                    <p>Rp. <?= formatRupiah($dataKeranjang['harga']) ?></p>
                  </div>
                  <div class="delete-area d-flex align-items-center">
                    <a href="hapus_keranjang.php?id=<?= $dataKeranjang['id_keranjang'] ?>" class="btn" name="delete" style="border: none;" onclick="return confirm('Yakin ingin menghapus <?= $dataKeranjang['nama_produk'] ?>?')"><i class="fa-solid fa-square-minus" style="color: red;"></i></a>
                  </div>
                </li>
              <?php endwhile; ?>
            </ul>
          </div>
        </div>
      <?php } else { ?>

        <div class="row justify-content-center product-data">
          <div class="col-md-10">
            <h5 class="mb-3"><i class="fa-solid fa-cart-shopping"></i> Keranjang Belanja</h5>
            <?php if ($rowQueryKeranjang < 1) : ?>
              <div class="row justify-content-center mt-5">
                <div class="col-md-12">
                  <div class="alert alert-warning text-center" role="alert">
                    Keranjang masih Kosong!
                  </div>
                </div>
              </div>
            <?php endif; ?>
            <ul class="list-group list-group-flush">
              <?php while ($dataKeranjang = mysqli_fetch_assoc($queryKeranjang)) : ?>
                <li class="list-group-item list-group-item-action d-flex justify-content-between">
                  <img src="./public/image/<?= $dataKeranjang['foto'] ?>" class="d-inline-block" alt="image" width="80" height="80">
                  <div class="d-flex justify-content-around align-items-center w-75">
                    <div class="product-name" style="width: 20%;">
                      <p class="d-inline-block text-truncate"><?= $dataKeranjang['nama_produk'] ?></p>
                      <form action="" method="POST">
                        <div class="input-group mb-3 input-product-area w-50">
                          <input type="number" class="form-control text-center" name="input-qty" id="input-qty" value="1" min="1" max="10">
                        </div>
                      </form>
                    </div>
                    <p>Rp. <?= formatRupiah($dataKeranjang['harga']) ?></p>
                  </div>
                  <div class="delete-area d-flex align-items-center">
                    <a href="hapus_keranjang.php?id=<?= $dataKeranjang['id_keranjang'] ?>" class="btn" name="delete" style="border: none;" onclick="return confirm('Yakin ingin menghapus <?= $dataKeranjang['nama_produk'] ?>?')"><i class="fa-solid fa-square-minus" style="color: red;"></i></a>
                  </div>
                </li>
              <?php endwhile; ?>
            </ul>
          </div>
        </div>

      <?php } ?>

      <div class="row mt-4">
        <div class="col-md-3 d-flex justify-content-center">
          <a href="./payment.php" class="btn btn-warning justify-content-center"><i class="fas fa-money-bill"></i> Bayar Sekarang</a>
        </div>
      </div>
    </div>
  </div>


  <!-- Footer -->
  <?php require "./footer.php"
  ?>

  <script src="./public/bootstrap-5.3.0/js/bootstrap.min.js"></script>
  <script src="./public/fontawesome/js/all.min.js"></script>
</body>

</html>