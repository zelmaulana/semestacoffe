<?php


include "../functions.php";

//$data = getKeranjang($_POST["user"]);
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";


//$newNoBill();
//$total = getTotal($_POST["user"]);


// echo "<pre>";
// print_r($total);
// echo "</pre>";
// date_default_timezone_set('Asia/Jakarta');
// $tgl = date('d-m-Y G:i:s');

$savekerangjang = simpanOrder($_POST["user"]);



print_r($savekerangjang);
