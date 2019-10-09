<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Pelanggan
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-male"></i> Home</a></li>
      <li><a href="#">Tables</a></li>
      <li class="active">Data Pelanggan</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">

          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <table id="example1" class="table table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Pengguna</th>
                  <th>E-Mail</th>
                  <th>No.HP</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                $sql = mysqli_query($koneksi, "SELECT * FROM m_user WHERE level_id = '2'");
                while ($hasil = mysqli_fetch_assoc($sql)) {
                  ?>

                  <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $hasil['user_nama'] ?></td>
                    <td><?php echo $hasil['user_email'] ?></td>
                    <td><?php echo $hasil['user_nohp'] ?></td>
                    <td>
                      <a href="?i=<?php echo md5('dtl_user') ?>&id=<?php echo $hasil['user_id'] ?>"><button type="button" class="btn btn-primary fa fa-eye"> Show Detail</button></a>

                      <!-- <a class="btn btn-primary fa fa-eye" data-toggle="modal" data-target="#modalShow" data-id=".$hasil['user_id']."> Show Detail</a> -->



                      <!-- <a href="?i=<?php echo md5('d_user') ?>&id=<?php echo $hasil['user_id'] ?>">
                        <button type="button" onclick="return konf()" class="btn btn-danger fa fa-trash"> Hapus</button></a>-->
                    </td>
                  </tr>
                  <script type="text/javascript" language="javascript">
                    function konf() {
                      tanya = confirm("Apakah Anda Yakin Akan Menghapus Data Ini?");
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

<!-- Modal -->
<div class="modal fade" id="modalShow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Detail Pelanggan</h4>
      </div>
      <div class="modal-body">
        <!-- start form for validation -->
        <form action="" enctype="multipart/form-data" method="POST">
          <?php
          $id = $_GET['user_id'];
          $val1 = mysqli_query($koneksi, "SELECT a.*, b.* FROM m_user a LEFT OUTER JOIN m_alamat b ON a.user_id = b.user_id WHERE a.user_id = '$id'");
          $data = mysqli_fetch_array($val1);
          ?>
          <table id="" class="table" style="font-size:13px;width:100%">
            <thead>
              <tr>
                <th width="20%">Nama Lengkap</th>
                <th>:</th>
                <td><?php echo $data['user_nama'] ?></td>
              </tr>
              <tr>
                <th>No.HP</th>
                <th>:</th>
                <td><?php echo $data['user_nohp'] ?></td>
              </tr>
              <tr>
                <th>Email</th>
                <th>:</th>
                <td><?php echo $data['user_email'] ?></td>
              </tr>
              <tr>
                <th>Tanggal Lahir</th>
                <th>:</th>
                <td><?php echo date('d-m-Y', strtotime($data['user_ttl'])) ?></td>
              </tr>
              <tr>
                <th>Alamat</th>
                <th>:</th>
                <td><?php echo $data['alamat_spesifik'] ?></td>
              </tr>
            </thead>
          </table>
      </div>
      </form>
    </div>
  </div>
</div>