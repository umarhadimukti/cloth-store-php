<?php

function uploadFoto()
{
  //menangkap isi variabel $_FILES
  $namaFile = $_FILES["foto-produk"]["name"];
  $ukuranFile = $_FILES["foto-produk"]["size"];
  $tmpName = $_FILES["foto-produk"]["tmp_name"];
  $error = $_FILES["foto-produk"]["error"];

  //cek apakah gambar ada yang diupload atau tidak
  if ($error == 4) {
    echo "
      <div class='row justify-content-center mt-2'>
        <div class='col-md-6'>
          <div class='alert alert-danger' role='alert'>
            Pilih Foto yang ingin di upload!
          </div>
        </div>
      </div>
      <meta http-equiv='refresh' content='3; url=product.php' />
    ";
    return false;
  }

  $ekstensiValid = ["jpg", "jpeg", "png", "jfif"];
  $ekstensiGambar = explode(".", $namaFile);
  $ekstensiGambar = strtolower(end($ekstensiGambar));
  if (!in_array($ekstensiGambar, $ekstensiValid)) {
    echo "
      <div class='row justify-content-center mt-2'>
        <div class='col-md-6'>
          <div class='alert alert-danger' role='alert'>
            Hanya bisa mengupload Foto!
          </div>
        </div>
      </div>
      <meta http-equiv='refresh' content='3; url=product.php' />
    ";
    return false;
  }

  if ($ukuranFile > 3000000) {
    echo "
      <div class='row justify-content-center mt-2'>
        <div class='col-md-6'>
          <div class='alert alert-danger' role='alert'>
            Ukuran file melebihi 3mb!
          </div>
        </div>
      </div>
      <meta http-equiv='refresh' content='3; url=product.php' />
    ";
    return false;
  }

  $namaFileBaru = uniqid();
  $namaFileBaru .= ".";
  $namaFileBaru .= $ekstensiGambar;

  move_uploaded_file($tmpName, "../public/image/" . $namaFileBaru);
  return $namaFileBaru;
}
