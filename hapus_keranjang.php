<?php
require "./koneksi.php";

$idKeranjang = $_GET['id'];

// query delete data keranjang
$queryDelete = mysqli_query($conn, "DELETE FROM keranjang WHERE id_keranjang = $idKeranjang");

if ($queryDelete) {
  header('Location: ./keranjang.php');
} else {
  mysqli_error($conn);
}
