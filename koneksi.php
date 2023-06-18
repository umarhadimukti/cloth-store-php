<?php

$conn = mysqli_connect("localhost", "root", "", "toko_baju");

if (!$conn) {
  die("Failed connection to DB! " . mysqli_connect_error());
}
