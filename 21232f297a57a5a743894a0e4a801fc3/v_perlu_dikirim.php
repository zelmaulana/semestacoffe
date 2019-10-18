<meta http-equiv="refresh" content="10">
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
            <h2 class="box-title">Data Pesanan Masuk</h2>
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
                  <th>IP Pengguna</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;

                // $sql = mysqli_query($koneksi, "SELECT DISTINCT a.*, b.*, c.* FROM t_pemesanan a
                // 	  LEFT OUTER JOIN t_order b on a.nobill = b.nobill
                // 	  LEFT OUTER JOIN m_user c on b.user_id = c.user_id
                //     WHERE a.status_id = '2'");

                $sql = mysqli_query($koneksi, "SELECT DISTINCT a.pemesanan_id, a.tanggal, a.ip, b.nobill, b.nomeja, b.catatan, c.user_nama FROM t_pemesanan a
                LEFT OUTER JOIN t_order b on a.nobill = b.nobill
                LEFT OUTER JOIN m_user c on a.user_id = c.user_id
                WHERE a.status_id = '2' ORDER BY pemesanan_id DESC");

                while ($hasil = mysqli_fetch_assoc($sql)) {
                  ?>

                  <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $hasil['user_nama'] ?></td>
                    <td>Meja <?php echo $hasil['nomeja'] ?></td>
                    <td><?php echo date('d-m-Y', strtotime($hasil['tanggal'])) ?> / <?php echo date('G:i:s', strtotime($hasil['tanggal'])) ?></td>
                    <td><?php echo $hasil['ip'] ?></td>
                    <td><a href="?i=<?php echo md5('dtl-pemesanan') ?>&id=<?php echo $hasil['pemesanan_id'] ?>">
                        <button type="button" class="btn btn-primary fa fa-eye"> Detail</button></a>
                      <a href="?i=<?php echo md5('verif') ?>&id=<?php echo $hasil['pemesanan_id'] ?>">
                        <button type="button" class="btn btn-info fa fa-check"> Proses</button></a>
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