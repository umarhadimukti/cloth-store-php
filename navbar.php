<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap -->
  <link rel="stylesheet" href="./public/bootstrap-5.3.0/css/bootstrap.min.css">
  <!-- CSS -->
  <link rel="stylesheet" href="./public/css/navbar.css?v=<?= time(); ?>">
</head>

<body>
  <nav class="navbar">
    <div class="brand">
      <img src="./public/image/nishop_logo.png" alt="logo" width="60" height="60" style="box-shadow: 0 0 5px rgba(0,0,0,.4)">
    </div>
    <ul class="nav-list">
      <li>
        <i class="fa-solid fa-house"></i>
        <a href="./index.php">Beranda</a>
      </li>
      <li>
        <i class="fa-solid fa-shirt"></i>
        <a href="./product.php">Produk</a>
      </li>
      <li>
        <i class="fa-solid fa-cart-shopping"></i>
        <a href="./keranjang.php">Keranjang</a>
      </li>
      <li>
        <i class="fa-solid fa-users"></i>
        <a href="./tentang_kami.php">Tentang kami</a>
      </li>
    </ul>
    <div class="menu-toggle">
      <input type="checkbox" id="checkbox">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </nav>

  <script src="./public/js/navbar.js"></script>
</body>

</html>