<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Admin
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-male"></i> Home</a></li>
      <li><a href="#">Tables</a></li>
      <li class="active">Data Admin</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">

          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <div class="col-sm-8">
              <!-- <a href="?i=<?php echo md5('i_admin') ?>"><button type="button" class="btn btn-primary fa fa-plus"> Tambah Admin</button></a> -->
              <?php
              $val1 = mysqli_query($koneksi, "SELECT * FROM m_user WHERE level_id = '1'");
              $data = mysqli_fetch_array($val1);
              ?>
              <table id="" class="table" style="font-size:13px;width:100%">
                <thead>
                  <tr>
                    <th width="20%">Nama Lengkap</th>
                    <th>:</th>
                    <th><?php echo $data['user_nama'] ?></th>
                  </tr>
                  <tr>
                    <th>No.HP</th>
                    <th>:</th>
                    <th><?php echo $data['user_nohp'] ?></th>
                  </tr>
                  <tr>
                    <th>Email</th>
                    <th>:</th>
                    <th><?php echo $data['user_email'] ?></th>
                  </tr>
                </thead>
              </table>
              <a href="?i=<?php echo md5('u_admin') ?>&id=<?php echo $data['user_id'] ?>">
                <button type="button" class="btn btn-info fa fa-edit"> Edit</button></a>
            </div>
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