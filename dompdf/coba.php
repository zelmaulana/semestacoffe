<?php
require_once("dompdf_config.inc.php");
$html =
'<html><body>'.
'<h1>Halo berikut alamat Anda : </h1>'.
'<p>Alamat lengkap Anda adalah : </p>'.
'</body></html>';
$dompdf = new DOMPDF();
$dompdf�>load_html($html);
$dompdf�>render();
$dompdf�>stream('laporan_'.hakim.'.pdf');
?>