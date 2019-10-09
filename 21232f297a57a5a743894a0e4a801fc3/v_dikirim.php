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
            <h2 class="box-title">Data Proses Pesanan</h2>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <table id="example1" class="table table table-bordered table-striped" style="font-size:13px">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Pemesan</th>
                  <th>Nomor Meja</th>
                  <th>Tanggal Pemesanan</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                $sql = mysqli_query($koneksi, "SELECT * FROM t_pemesanan a
								   LEFT OUTER JOIN m_user c on a.user_id = c.user_id
								   WHERE a.status_id = '4'");
                while ($hasil = mysqli_fetch_assoc($sql)) {
                  ?>

                  <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $hasil['user_nama'] ?></td>
                    <td><?php echo $hasil['id_meja'] ?></td>
                    <td><?php echo date('d-m-Y', strtotime($hasil['tanggal'])) ?> / <?php echo date('G:i:s', strtotime($hasil['tanggal'])) ?></td>
                    <td><a href="?i=<?php echo md5('dtl-pemesanan') ?>&id=<?php echo $hasil['pemesanan_id'] ?>">
                        <button type="button" class="btn btn-primary fa fa-eye"> Detail</button></a>
                      <!-- <a href="?i=<?php echo md5('u_resi') ?>&id=<?php echo $hasil['resi_id'] ?>">
                        <button type="button" class="btn btn-info fa fa-edit"> Ubah No Meja</button></a>
                      <a href="http://www.jet.co.id/track" target="new">
                        <button type="button" class="btn btn-primary fa fa-eye"> Cek Resi</button></a> -->
                      <a href="?i=<?php echo md5('sampai') ?>&id=<?php echo $hasil['pemesanan_id'] ?>">
                        <button type="button" class="btn btn-success fa fa-check"> Selesai</button></a>
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