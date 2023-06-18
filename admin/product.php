  <?php

require "./session.php";
require "./utils/functions.php";
require "../koneksi.php";

$queryGetProduk = mysqli_query($conn, "SELECT a.*, b.nama_kategori FROM barang a JOIN kategori b ON a.kategori_id = b.id_kategori ORDER BY a.harga ASC");
$rowQueryProduk = mysqli_num_rows($queryGetProduk);

$queryGetKategori = mysqli_query($conn, "SELECT * FROM kategori");
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
  <link rel="stylesheet" href="../public/css/product.css?v=<?= time(); ?>">
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
      bottom: -1500px;
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
          <a href="./index.php" class="no-decoration">
            <i class="fas fa-house me-3"></i>
            Home
          </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Product</li>
      </ol>
    </nav>

    <!-- Judul List Product -->
    <div class="row justify-content-center mt-5">
      <div class="col-md-6">
        <h5>Tambah Data Product</h5>
      </div>
    </div>

    <!-- Tambah Data Product -->
    <div class="row justify-content-center">
      <div class="col-md-6 bg-light rounded p-3">
        <form action="" method="POST" enctype="multipart/form-data">
          <!-- nama -->
          <div class="input-group input-group-sm mb-3">
            <input type="text" class="form-control" id="nama-produk" name="nama-produk" placeholder="Ketikkan nama produk.." autocomplete="off" required>
          </div>
          <!-- kategori -->
          <div class="mb-3">
            <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="kategori" required>
              <option selected>Pilih Kategori</option>
              <?php while ($dataKategori = mysqli_fetch_assoc($queryGetKategori)) : ?>
                <option value="<?= $dataKategori['id_kategori']; ?>"><?= $dataKategori['nama_kategori']; ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <!-- foto -->
          <div class="mb-3">
            <label for="foto" class="form-label">Foto Produk</label>
            <input class="form-control form-control-sm" id="foto-produk" type="file" name="foto-produk" required>
          </div>
          <!-- harga -->
          <div class="input-group input-group-sm mb-3">
            <input type="number" id="harga-produk" name="harga-produk" class="form-control" placeholder="Ketikkan harga produk.." required>
          </div>
          <!-- detail -->
          <div class="mb-3">
            <div class="form-floating">
              <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" name="detail" style="height: 100px"></textarea>
              <label for="floatingTextarea2">Detail Produk</label>
            </div>
          </div>
          <!-- stok -->
          <div class="mb-3">
            <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="stok" required>
              <option selected>Stok Produk</option>
              <option value="Tersedia">Tersedia</option>
              <option value="Habis">Habis</option>
            </select>
          </div>
          <div>
            <button type="submit" id="simpan" name="simpan" class="btn btn-primary">Simpan Produk</button>
          </div>
        </form>
      </div>
    </div>

    <?php
    if (isset($_POST['simpan'])) {
      $namaProduk = htmlspecialchars($_POST['nama-produk']);
      $kategoriProduk = htmlspecialchars($_POST['kategori']);
      $fotoProduk = uploadFoto();
      $hargaProduk = htmlspecialchars($_POST['harga-produk']);
      $detailProduk = htmlspecialchars($_POST['detail']);
      $stokProduk = htmlspecialchars($_POST['stok']);

      if (!$fotoProduk) {
        return false;
      }

      $queryInsertProduk = mysqli_query($conn, "INSERT INTO barang VALUES ('', '$namaProduk', '$fotoProduk', '$detailProduk', $hargaProduk, '$stokProduk', '$kategoriProduk')");

      if ($queryInsertProduk) {
    ?>
        <div class="row justify-content-center">
          <div class="col-md-4">
            <div class="alert alert-success d-flex align-items-center" role="alert">
              <div class="text-center">
                Produk berhasil disimpan!
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

    <!-- Judul List Product -->
    <hr class="mt-5">
    <div class="row justify-content-center mt-5">
      <div class="col-md-10">
        <h5>List Product</h5>
      </div>
    </div>

    <!-- List Area -->
    <div class="table-responsive row justify-content-center">
      <div class="col-md-10">
        <table class="table table-light text-center">
          <thead>
            <tr>
              <th scope="col">No.</th>
              <th scope="col">Nama Produk</th>
              <th scope="col">Kategori</th>
              <th scope="col">Detail</th>
              <th scope="col">Harga</th>
              <th scope="col">Stok</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($rowQueryProduk < 1) : ?>
              <tr>
                <td colspan="7" class="text-center">Produk masih kosong!</td>
              </tr>
            <?php endif; ?>
            <?php $jmlNomor = 1; ?>
            <?php while ($dataProduk = mysqli_fetch_assoc($queryGetProduk)) : ?>
              <tr>
                <td><?= $jmlNomor++; ?></td>
                <td><?= $dataProduk['nama_barang']; ?></td>
                <td><?= $dataProduk['nama_kategori']; ?></td>
                <td><?= $dataProduk['detail']; ?></td>
                <td><?= $dataProduk['harga']; ?></td>
                <td><?= $dataProduk['stok']; ?></td>
                <td>
                  <a href="product_detail.php?p=<?= $dataProduk['id_barang'] ?>" class="btn btn-info btn-sm"><i class="fa-solid fa-magnifying-glass"></i> Detail</a>
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