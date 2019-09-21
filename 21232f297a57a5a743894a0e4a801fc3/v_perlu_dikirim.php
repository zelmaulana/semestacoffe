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
            <h3 class="box-title">Data Pesanan Menu</h3>
          </div>
          <br>
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <h3>Belum Diverifikasi</h3>
            <table id="example1" class="table table table-bordered table-striped" style="font-size:13px">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Pemesan</th>
                  <th>No.HP</th>
                  <th>Total</th>
                  <th>No Meja</th>
                  <th>Tanggal Pemesanan</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                $sql = mysqli_query($koneksi, "SELECT DISTINCT b.pemesanan_id, a.*, b.user_id, c.* FROM t_pemesanan a
									LEFT OUTER JOIN t_keranjang b on a.pemesanan_id = b.pemesanan_id
									LEFT OUTER JOIN m_user c on b.user_id = c.user_id
								   WHERE a.status_id = '2'");
                while ($hasil = mysqli_fetch_assoc($sql)) {
                  ?>

                  <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $hasil['user_nama'] ?></td>
                    <td><?php echo $hasil['user_nohp'] ?></td>
                    <td><?php echo $hasil['total'] ?></td>
                    <td><?php echo $hasil['id_meja'] ?></td>
                    <!-- <td><a target="_new" style="margin-left:0cm" style="background:url(../<?php echo md5('admin') ?>/dist/img/buktiBayar/<?php echo $hasil['bukti_pembayaran'] ?>)" title="Display Picture" href="../<?php echo md5('admin') ?>/dist/img/buktiBayar/<?php echo $hasil['bukti_pembayaran'] ?>"><?php echo $hasil['bukti_pembayaran'] ?></a></td> -->
                    <td><?php echo date('d-m-Y', strtotime($hasil['tanggal'])) ?> <?php echo date('G:i:s', strtotime($hasil['tanggal'])) ?></td>
                    <td><a href="?i=<?php echo md5('dtl-pemesanan') ?>&id=<?php echo $hasil['pemesanan_id'] ?>">
                        <button type="button" class="btn btn-primary fa fa-eye"> Detail Pemesanan</button></a>
                      <a href="?i=<?php echo md5('verif') ?>&id=<?php echo $hasil['pemesanan_id'] ?>">
                        <button type="button" class="btn btn-info fa fa-check"> Verifikasi</button></a>
                    </td>
                  </tr>
                  <script type="text/javascript" language="javascript">
                    function konf() {
                      tanya = confirm("Apakah Anda Yakin Tidak Memverivikasi Pemesanan Ini?");
                      if (tanya == true) return true;
                      else return false;
                    }
                  </script>
                <?php
                  $no++;
                }
                $num = mysqli_num_rows($sql);
                ?>
              </tbody>
            </table>
          </div>
          <div class="box-body table-responsive">
            <h3>Sudah Diverifikasi</h3>
            <table id="example2" class="table table table-bordered table-striped" style="font-size:13px">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Pemesan</th>
                  <th>No.HP</th>
                  <th>Total</th>
                  <th>No Meja</th>
                  <th>Tanggal Pemesanan</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                $sql = mysqli_query($koneksi, "SELECT a.*, c.* FROM t_pemesanan a
								   LEFT OUTER JOIN m_user c on a.user_id = c.user_id
								   WHERE a.status_id = '3'");
                while ($hasil = mysqli_fetch_assoc($sql)) {
                  ?>

                  <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $hasil['user_nama'] ?></td>
                    <td><?php echo $hasil['user_nohp'] ?></td>
                    <td><?php echo $hasil['total'] ?></td>
                    <td><?php echo $hasil['id_meja'] ?></td>
                    <!-- <td><a target="_new" style="margin-left:0cm" style="background:url(../<?php echo md5('admin') ?>/dist/img/buktiBayar/<?php echo $hasil['bukti_pembayaran'] ?>)" title="Display Picture" href="../<?php echo md5('admin') ?>/dist/img/buktiBayar/<?php echo $hasil['bukti_pembayaran'] ?>"><?php echo $hasil['bukti_pembayaran'] ?></a></td> -->
                    <td><?php echo date('d-m-Y', strtotime($hasil['tanggal'])) ?> <?php echo date('G:i:s', strtotime($hasil['tanggal'])) ?></td>
                    <td><a href="?i=<?php echo md5('dtl-pemesanan') ?>&id=<?php echo $hasil['pemesanan_id'] ?>">
                        <button type="button" class="btn btn-primary fa fa-eye"> Detail Pemesanan</button></a>
                      <a href="?i=<?php echo md5('btl-verif') ?>&id=<?php echo $hasil['pemesanan_id'] ?>">
                        <button type="button" class="btn btn-danger fa fa-check"> Batal Verifikasi</button></a>
                      <a href="?i=<?php echo md5('resi') ?>&id=<?php echo $hasil['pemesanan_id'] ?>">
                        <button type="button" class="btn btn-info fa fa-check"> Telah Dikirim</button></a>
                    </td>
                  </tr>
                  <script type="text/javascript" language="javascript">
                    function konf() {
                      tanya = confirm("Apakah Anda Yakin Tidak Memverivikasi Pemesanan Ini?");
                      if (tanya == true) return true;
                      else return false;
                    }
                  </script>
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