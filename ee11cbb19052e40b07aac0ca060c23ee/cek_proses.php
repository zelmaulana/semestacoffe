<?php


include "../functions.php";

$data = getKeranjang($_POST["user"]);
echo "<pre>";
print_r($_POST);
echo "</pre>";



$total = getTotal($_POST["user"]);


echo "<pre>";
print_r($total);
echo "</pre>";


$savekerangjang = simpanPemesanan($_POST["user"]);



print_r($savekerangjang);
