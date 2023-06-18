<?php
require "./koneksi.php";
require "./utils/functions.php";
require "./functions.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Metode Pembayaran | Nishop</title>
  <!-- Bootstrap -->
  <link rel="stylesheet" href="./public/bootstrap-5.3.0/css/bootstrap.min.css">
  <!-- FontAwesome -->
  <link rel="stylesheet" href="./public/fontawesome/css/fontawesome.min.css">
  <link rel="stylesheet" href="./public/css/style.css?v=<?= time(); ?>">
  <link rel="icon" type="image/x-icon" href="./public/image/nishop_logo.png" style="border-radius: 50%;">
  <!-- <script src="./public/js/jquery.js"></script>
  <script src="./public/js/custom.js"></script> -->
  <style>
    .whatsapp-area:hover {
      cursor: pointer;
      background-color: #d4d4d4;
    }
  </style>
</head>

<body>
  <?php require "./navbar.php"; ?>

  <!-- List Keranjang -->
  <div class="container-fluid mb-5">
    <div class="container mt-5">
      <h4 class="mb-4"><i class="fas fa-money-bill"></i> Metode Pembayaran</h4>
      <!-- Whatsapp -->
      <!-- Button trigger modal -->
      <div class="row mt-3 border rounded">
        <div class="col-md-12 d-flex flex-rows justify-content-evenly align-items-center py-3 hover whatsapp-area">
          <img src="./public/image/wa.png" width="60" height="60" alt="whatsapp-img">
          <h5>Whatsapp</h5>
          <p>(+62) 822 6081 7677</p>
        </div>
      </div>
      <!-- Akhir Whatsapp -->

      <!-- BCA -->
      <!-- Button trigger modal -->
      <div data-bs-toggle="modal" data-bs-target="#exampleModal">
        <div class="row mt-3 border rounded">
          <div class="col-md-12 d-flex flex-rows justify-content-evenly align-items-center py-3 hover whatsapp-area">
            <img src="./public/image/bca.png" width="180" height="60" alt="whatsapp-img">
            <h5>Bank Central Asia</h5>
            <p>821077603020 A/n Kelompok 5</p>
          </div>
        </div>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">
                <img src="./public/image/bca.png" width="60" height="20" alt="">
              </h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">Silahkan transfer ke rekening berikut :
                  <h6>821077603020 A/n Kelompok 5</h6>
                </li>
                </li>
              </ul>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Akhir BCA -->

      <!-- Dana -->
      <div class="row mt-3 border rounded">
        <div class="col-md-12 d-flex flex-rows justify-content-evenly align-items-center py-3 hover whatsapp-area">
          <img src="./public/image/dana.png" width="60" height="60" alt="whatsapp-img">
          <h5>Dana</h5>
          <p>(+62) 822 6081 7677</p>
        </div>
      </div>
      <!-- Akhir Dana -->

      <!-- Shopee Pay -->
      <div class="row mt-3 border rounded">
        <div class="col-md-12 d-flex flex-rows justify-content-evenly align-items-center py-3 hover whatsapp-area">
          <img src="./public/image/shopeepay.png" width="120" height="60" alt="whatsapp-img">
          <h5>Shopee Pay</h5>
          <p>(+62) 822 6081 7677</p>
        </div>
      </div>
      <!-- Akhir ShopeePay -->
    </div>
  </div>


  <!-- Footer -->
  <?php require "./footer.php"
  ?>

  <script src="./public/bootstrap-5.3.0/js/bootstrap.min.js"></script>
  <script src="./public/fontawesome/js/all.min.js"></script>
</body>

</html>