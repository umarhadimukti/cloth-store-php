<?php

require "./session.php";
require "./utils/functions.php";
require "../koneksi.php";

$id = $_GET['p'];

$queryGetProduk = mysqli_query($conn, "SELECT a.*, b.nama_kategori FROM barang a JOIN kategori b ON a.kategori_id = b.id_kategori WHERE id_barang = $id");
$rowQueryProduk = mysqli_num_rows($queryGetProduk);
$resultProduk = mysqli_fetch_assoc($queryGetProduk);

$queryGetKategori = mysqli_query($conn, "SELECT * FROM kategori WHERE id_kategori != '$resultProduk[kategori_id]'");
$rowQueryKategori = mysqli_num_rows($queryGetKategori);

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
  <style>
    .container {
      /* border: 2px solid black; */
      background-color: whitesmoke;
      height: 180vh;
    }

    .area-breadcrumb {
      position: relative;
      top: 30px;
      left: 60px;
    }

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
    <nav class="area-breadcrumb" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">
          <a href="./product.php" class="no-decoration">
            <i class="fa-solid fa-vest"></i>
            Product
          </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Detail Product</li>
      </ol>
    </nav>

    <!-- Alert ketika button hapus di klik -->
    <?php
    if (isset($_POST['hapus'])) {
      $queryHapusProduk = mysqli_query($conn, "DELETE FROM barang WHERE id_barang = $id");
      if ($queryHapusProduk) {
        echo "
            <div class='row justify-content-center mt-5'>
              <div class='col-md-6'>
                <div class='alert alert-primary d-flex align-items-center' role='alert'>
                  <div class='text-center'>
                    Produk berhasil dihapus!
                  </div>
                </div>
              </div>
            </div>
            <meta http-equiv='refresh' content='3; url=product.php' />
          ";
      } else {
        echo mysqli_error($conn);
      }
    }
    ?>

    <!-- Judul List Product -->
    <div class="row justify-content-center mt-5">
      <div class="col-md-6">
        <h5>Detail Data Product</h5>
      </div>
    </div>

    <!-- Tambah Data Product -->
    <div class="row justify-content-center">
      <div class="col-md-6 bg-light rounded p-3">
        <form action="" method="POST" enctype="multipart/form-data">
          <!-- nama -->
          <div class="input-group input-group-sm mb-3">
            <input type="text" class="form-control" id="nama-produk" name="nama-produk" value="<?= $resultProduk['nama_barang']; ?>" placeholder="Ketikkan nama produk.." autocomplete="off" required>
          </div>
          <!-- kategori -->
          <div class="mb-1">
            <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="kategori" required>
              <option value="<?= $resultProduk['kategori_id']; ?>" selected><?= $resultProduk['nama_kategori']; ?></option>
              <?php while ($dataKategori = mysqli_fetch_assoc($queryGetKategori)) : ?>
                <option value="<?= $dataKategori['id_kategori']; ?>"><?= $dataKategori['nama_kategori']; ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <!-- foto -->
          <div class="mb-3">
            <label for="foto" class="form-label">Foto Produk</label>
            <img src="../public/image/<?= $resultProduk['foto']; ?>" class="img-thumbnail m-3" alt="image" width="100" height="100">
            <input class="form-control form-control-sm" id="foto-produk" type="file" name="foto-produk">
          </div>
          <!-- harga -->
          <div class="input-group input-group-sm mb-3">
            <input type="number" id="harga-produk" name="harga-produk" class="form-control" value="<?= $resultProduk['harga'] ?>" placeholder="Ketikkan harga produk.." required>
          </div>
          <!-- detail -->
          <div class="mb-3">
            <div class="form-floating">
              <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" name="detail" style="height: 100px"><?= $resultProduk['detail'] ?></textarea>
              <label for="floatingTextarea2">Detail Produk</label>
            </div>
          </div>
          <!-- stok -->
          <div class="mb-3">
            <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="stok" required>
              <option value="<?= $resultProduk['stok']; ?>" selected><?= $resultProduk['stok'] ?></option>
              <?php if ($resultProduk['stok'] == 'Tersedia') : ?>
                <option value="Habis">Habis</option>
              <?php endif; ?>
              <?php if ($resultProduk['stok'] == 'Habis') : ?>
                <option value="Tersedia">Tersedia</option>
              <?php endif; ?>
            </select>
          </div>
          <div class="d-flex justify-content-between">
            <button type="submit" id="ubah" name="ubah" class="btn btn-warning">Ubah Produk</button>
            <button type="submit" id="hapus" name="hapus" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus <?= $resultProduk['nama_barang']; ?>')">Hapus Produk</button>
          </div>
        </form>
      </div>
    </div>

    <?php
    if (isset($_POST['ubah'])) {
      $namaProduk = htmlspecialchars($_POST['nama-produk']);
      $kategoriProduk = htmlspecialchars($_POST['kategori']);
      $fotoProduk = uploadFoto();
      $hargaProduk = htmlspecialchars($_POST['harga-produk']);
      $detailProduk = htmlspecialchars($_POST['detail']);
      $stokProduk = htmlspecialchars($_POST['stok']);

      if (!$fotoProduk) {
        return false;
      }

      $queryUpdateProduk = mysqli_query($conn, "UPDATE barang SET nama_barang = '$namaProduk', kategori_id = $kategoriProduk, foto = '$fotoProduk', harga = $hargaProduk, detail = '$detailProduk', stok = '$stokProduk' WHERE id_barang = $id");

      if ($queryUpdateProduk) {
    ?>
        <div class="row justify-content-center">
          <div class="col-md-4">
            <div class="alert alert-success d-flex align-items-center" role="alert">
              <div class="text-center">
                Produk berhasil diubah!
              </div>
            </div>
          </div>
        </div>
        <meta http-equiv="refresh" content="3; url=product.php" />
    <?php
      } else {
        echo mysqli_error($conn);
      }
    }
    ?>
  </div>

  <footer>
    <?php require "./footer.php"; ?>
  </footer>


  <script src="../public/bootstrap-5.3.0/js/bootstrap.min.js"></script>
  <script src="../public/fontawesome/js/all.min.js"></script>
</body>

</html>