
<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Transaksi
        <small>ADMIN</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-male"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data Transaksi</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Detail Pemesanan Yang Perlu Dikirim</h3>
            </div>
            <br>
            <!-- /.box-header -->
            <?php
			$val1 = mysqli_query($koneksi, "SELECT * FROM t_pemesanan WHERE pemesanan_id = '$_GET[id]'");
			$hval1 = mysqli_fetch_array($val1);
			if($hval1['jenis_pemesanan_id'] == '1'){
            	$sql = mysqli_query($koneksi, "SELECT a.*, b.user_id, c.*, d.*, e.*, f.*, g.*, h.* FROM t_pemesanan a
								   LEFT OUTER JOIN t_keranjang b on a.pemesanan_id = b.pemesanan_id
								   LEFT OUTER JOIN m_user c on b.user_id = c.user_id
								   LEFT OUTER JOIN m_alamat d on b.user_id = d.user_id
								   LEFT OUTER JOIN l_propinsi e on d.propinsi_id = e.propinsi_id
								   LEFT OUTER JOIN l_kabupaten f on d.kabupaten_id = f.kabupaten_id
								   LEFT OUTER JOIN l_kecamatan g on d.kecamatan_id = g.kecamatan_id
								   LEFT OUTER JOIN l_desa h on d.desa_id = h.desa_id
								   WHERE a.pemesanan_id = '$_GET[id]'");
			}
			else if($hval1['jenis_pemesanan_id'] == '2'){
            	$sql = mysqli_query($koneksi, "SELECT a.*, b.user_id, c.*, d.*, e.*, f.*, g.*, h.* FROM t_pemesanan a
								   LEFT OUTER JOIN t_keranjang b on a.pemesanan_id = b.pemesanan_id
								   LEFT OUTER JOIN m_user c on b.user_id = c.user_id
								   LEFT OUTER JOIN m_dropshiper d on b.pemesanan_id = d.pemesanan_id
								   LEFT OUTER JOIN l_propinsi e on d.propinsi_id = e.propinsi_id
								   LEFT OUTER JOIN l_kabupaten f on d.kabupaten_id = f.kabupaten_id
								   LEFT OUTER JOIN l_kecamatan g on d.kecamatan_id = g.kecamatan_id
								   LEFT OUTER JOIN l_desa h on d.desa_id = h.desa_id
								   WHERE a.pemesanan_id = '$_GET[id]'");
			}
			$hasil = mysqli_fetch_assoc($sql);
			?>
            <div class="box-body table-responsive">
            <div class="col-sm-8">
              <table id="" class="table" style="font-size:13px;width:100%">
                <thead>
           		<tr>
                  <th width="20%">Nama Pemesan</th>
                  <th>:</th>
                  <td><?php echo $hasil['user_nama']?></td>
                </tr>
                <tr>
                  <th>No.HP</th>
                  <th>:</th>
                  <td><?php echo $hasil['user_nohp']?></td>
                </tr>
                <tr>
                  <th>Ongkos Kirim</th>
                  <th>:</th>
                  <td>Rp. <?php echo $hasil['ongkos_kirim']?></td>
                </tr>
                <tr>
                  <th>Total</th>
                  <th>:</th>
                  <td>Rp. <?php echo $hasil['total']?></td>
                </tr>
                <tr>
                  <th>Tanggal Pemesanan</th>
                  <th>:</th>
                  <td><?php echo date('d-m-Y',strtotime($hasil['tanggal']))?> <?php echo date('G:i:s',strtotime($hasil['tanggal']))?></td>
                </tr>
                <tr>
                  <th>Alamat Tujuan</th>
                  <th>:</th>
                  <td><?php echo $hasil['alamat_spesifik']?>, Desa/Kelurahan <?php echo $hasil['desa_name']?>, RT <?php echo $hasil['rt']?> RW <?php echo $hasil['rw']?>, Kec. <?php echo $hasil['kecamatan_name']?>, Kab. <?php echo $hasil['kabupaten_name']?>, <?php echo $hasil['propinsi_name']?></td>
                </tr>
                </thead>
              </table>
            </div>
            <div class="col-sm-4">
              <table>
                <tr>
                  <th>Bukti Pembayaran</th>
                </tr>
                <tr>
                  <td><img src="dist/img/buktiBayar/<?php echo $hasil['bukti_pembayaran']?>" style="width:150px"></td>
                </tr>
              </table>
            </div>
            </div>
            <div class="box-body table-responsive">
            <h3>Detail Barang</h3>
              <table id="example2" class="table table table-bordered table-striped" style="font-size:13px">
                <thead>
           		<tr>
                  <th>No</th>
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
	$sql = mysqli_query($koneksi, "SELECT * FROM t_keranjang a
								   LEFT OUTER JOIN m_barang c on a.brg_id = c.brg_id
								   LEFT OUTER JOIN l_jenis d on c.jenis_id = d.jenis_id
								   WHERE a.pemesanan_id = '$_GET[id]'");
	while ($hasil = mysqli_fetch_assoc($sql)){
		$harga = $hasil['total'] / $hasil['jumlah_trx'];
?> 
     
                <tr>
                  <td><?php echo $no ?></td>
                  <td><?php echo $hasil['jenis_name']?></td>
                  <td><?php echo $hasil['judul']?></td>
                  <td><?php echo $hasil['jumlah_trx']?></td>
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
              <br>
              <br>
              <a href="?i=<?php echo md5('perlu-dikirim')?>"><button type="button" class="btn btn-danger fa fa-close"> Kembali</button></a>
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