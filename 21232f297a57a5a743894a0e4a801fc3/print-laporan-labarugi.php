<?php
session_start();
ob_start();
require_once('../koneksi.php') ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SISTEM INFORMASI PENJUALAN OBAT | APOTEK MUSTIKA HUSADA</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Font Awesome -->
</head>
<body windows="print()">
	<center><br /><h2>LAPORAN LABA RUGI </h2><h4>Periode <?php echo date('d-m-Y', strtotime($_GET['1']))?> s/d <?php echo date('d-m-Y', strtotime($_GET['2']))?> </h4></center><br />
	<table style="font-size:12px;width:100%">
                <thead>
           		<tr bgcolor="#777777">
                  <th>Jumlah Transaksi Penjualan</th>
                  <th>Jumlah Barang Terjual</th>
                  <th>Total Modal</th>
                  <th>Laba/Rugi</th>
                </tr>
                </thead>
                <tbody>
<?php
	$no = 1;
	$sql = mysqli_query($koneksi, "SELECT SUM(b.jumlah_trx) as tot_brg, SUM(b.total) as tot_pen, SUM(d.harga_beli) as tot_hb FROM t_pemesanan a
								   LEFT OUTER JOIN t_keranjang b on a.pemesanan_id = b.pemesanan_id
								   LEFT OUTER JOIN m_user c on b.user_id = c.user_id
								   LEFT OUTER JOIN m_barang d on b.brg_id = d.brg_id
								   WHERE DATE(a.tanggal) BETWEEN '$_GET[1]' AND '$_GET[2]' AND a.status_id = '5' ");
	$hasil = mysqli_fetch_assoc($sql);
	$sql2 = mysqli_query($koneksi, "SELECT * FROM t_pemesanan WHERE DATE(tanggal) BETWEEN '$_GET[1]' AND '$_GET[2]' AND status_id= '5'");
	$num = mysqli_num_rows($sql2);
	$laba = $hasil['tot_pen'] - $hasil['tot_hb'];
?> 
     
                <tr>
                  <td><?php echo $num ?> Kali</td>
                  <td><?php echo $hasil['tot_brg']?> Pcs</td>
                  <td>Rp. <?php echo $hasil['tot_pen']?></td>
                  <td>Rp. <?php echo $laba?></td>
                  </tr> 
                </tbody>
              </table>
 <script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="../plugins/select2/select2.full.min.js"></script>
<!-- InputMask -->
<script src="../plugins/input-mask/jquery.inputmask.js"></script>
<script src="../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="../plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- bootstrap color picker -->
<script src="../plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="../plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- jQuery Knob Chart -->
<script src="../plugins/knob/jquery.knob.js"></script>
<!-- Sparkline -->
<script src="../plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- DataTables -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="../plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
</body>
</html>

<?php
$html = ob_get_clean();
require_once("../dompdf/dompdf_config.inc.php");
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream('CetakLaporanLabaRugi.pdf',array('Attachment' => 0));
?> 