<?php

function formatRupiah($angka)
{
  $result = number_format($angka, '0', '', '.');
  return $result;
}
