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
        Laporan Penjualan
        <small>ADMIN</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-male"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Laporan Penjualan</li>
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
                  <th>No</th>
                  <th>Tanggal Transaksi</th>
                  <th>Jenis Barang</th>
                  <th>Judul</th>
                  <th>Jumlah Beli</th>
                  <th>Harga</th>
                  <th>Total</th>
                </tr>
                </thead>
                <tbody>
<?php
	$no = 1;
	$sql = mysqli_query($koneksi, "SELECT a.*, b.tanggal, b.status_id, c.*, d.* FROM t_keranjang a
								   LEFT OUTER JOIN t_pemesanan b on a.pemesanan_id = b.pemesanan_id
								   LEFT OUTER JOIN m_barang c on a.brg_id = c.brg_id
								   LEFT OUTER JOIN l_jenis d on c.jenis_id = d.jenis_id
								   WHERE DATE(b.tanggal) BETWEEN '$_GET[1]' AND '$_GET[2]' AND b.status_id = '5' order by 			a.keranjang_id desc ");
	while ($hasil = mysqli_fetch_assoc($sql)){
		$harga = $hasil['total'] / $hasil['jumlah_trx'];
?> 
     
                <tr>
                  <td><?php echo $no ?></td>
                  <td><?php echo date ('d-m-Y G:i:s', strtotime($hasil['tanggal']))?></td>
                  <td><?php echo $hasil['jenis_name']?></td>
                  <td><?php echo $hasil['judul']?></td>
                  <td><?php echo $hasil['jumlah_trx']?> Pcs</td>
                  <td>Rp. <?php echo $harga?></td>
                  <td>Rp. <?php echo $hasil['total']?></td>
                  </tr> 
 <?php     
 				$no++;
 				}
				$num = mysqli_num_rows($sql);
 ?>
                </tbody>
              </table>
              <br />
              <a href="print-laporan-penjualan.php?1=<?php echo $_GET['1']?>&2=<?php echo $_GET['2']?>" target="new"><button type="button" class="btn btn-primary fa fa-print"> Cetak</button></a>
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