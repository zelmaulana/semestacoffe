
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
              <h3 class="box-title">Data Proses Pengiriman Oleh Kurir</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table table-bordered table-striped" style="font-size:12px">
                <thead>
           		<tr>
                  <th>No</th>
                  <th>Nama Pemesan</th>
                  <th>Total</th>
                  <th>Bukti Pembayaran</th>
                  <th>Nomor Resi</th>
                  <th>Tanggal Pemesanan</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
<?php
	$no = 1;
	$sql = mysqli_query($koneksi, "SELECT * FROM t_pemesanan a
								   LEFT OUTER JOIN m_user c on a.user_id = c.user_id
								   LEFT OUTER JOIN l_resi d on a.pemesanan_id = d.pemesanan_id
								   WHERE a.status_id = '4'");
	while ($hasil = mysqli_fetch_assoc($sql)){
?> 
     
                <tr>
                  <td><?php echo $no ?></td>
                  <td><?php echo $hasil['user_nama']?></td>
                  <td>Rp. <?php echo $hasil['total']?></td>
                  <td><a target="_new" style="margin-left:0cm" style="background:url(../<?php echo md5('admin')?>/dist/img/buktiBayar/<?php echo $hasil['bukti_pembayaran']?>)" title="Display Picture" href="../<?php echo md5('admin')?>/dist/img/buktiBayar/<?php echo $hasil['bukti_pembayaran']?>"><?php echo $hasil['bukti_pembayaran']?></a></td>
                  <td><?php echo $hasil['no_resi']?></td>
                  <td><?php echo date('d-m-Y',strtotime($hasil['tanggal']))?> <?php echo date('G:i:s',strtotime($hasil['tanggal']))?></td>
                  <td><a href="?i=<?php echo md5('dtl-pemesanan')?>&id=<?php echo $hasil['pemesanan_id']?>">
                  <button type="button" class="btn btn-primary fa fa-eye"> Detail Pemesanan</button></a>
                  <a href="?i=<?php echo md5('u_resi')?>&id=<?php echo $hasil['resi_id']?>">
                  <button type="button" class="btn btn-info fa fa-edit"> Ubah No Resi</button></a>
                  <a href="http://www.jet.co.id/track" target="new">
                  <button type="button" class="btn btn-primary fa fa-eye"> Cek Resi</button></a>
                  <a href="?i=<?php echo md5('sampai')?>&id=<?php echo $hasil['pemesanan_id']?>">
                  <button type="button" class="btn btn-success fa fa-check"> Sampai</button></a>
                  </td>
                  </tr> 
 <?php     
 				$no++;
 				}
				$num = mysqli_num_rows($sql);
 ?>
                </tbody>
              </table>
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