<?php
if(isset($_POST['cari'])){
	?>
    <script>
	window.location="?i=<?php echo $_GET['i']?>&1=<?php echo $_POST['1']?>&2=<?php echo $_POST['2']?>";
	</script>
    <?php
}
?>
<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Laporan Laba Rugi
        <small>ADMIN</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-male"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Laporan Laba Rugi</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
                <br>
                <form action="" method="post">
                <input type="date" value="<?php echo $_GET['1']?>" name="1" class="" style="width:20%;height:0.9cm">
                <input type="date" value="<?php echo $_GET['2']?>" name="2" class="" style="width:20%;height:0.9cm">
                <button type="submit" name="cari" class="btn btn-primary fa fa-search"> Cari</button>
                </form>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table table-bordered table-striped" style="font-size:13px">
                <thead>
           		<tr>
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
              <br />
              <a href="print-laporan-labarugi.php?1=<?php echo $_GET['1']?>&2=<?php echo $_GET['2']?>" target="new"><button type="button" class="btn btn-primary fa fa-print"> Cetak</button></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->