<?php
  include("../koneksi.php");
  $s1 = mysqli_query($koneksi, "SELECT * FROM t_pemesanan WHERE status_id = '2' OR status_id = '3'");
  $h1 = mysqli_num_rows($s1); 
  $s2 = mysqli_query($koneksi, "SELECT * FROM t_pemesanan WHERE status_id = '4'");
  $h2 = mysqli_num_rows($s2); 
  $a = mysqli_query($koneksi, "SELECT * FROM m_user WHERE user_id = '$_SESSION[id]'");
  $h = mysqli_fetch_array($a);
  $user = mysqli_query($koneksi, "SELECT * FROM m_user WHERE level_id != '1'");
  $u = mysqli_num_rows($user);
  $terkirim = mysqli_query($koneksi, "SELECT * FROM t_pemesanan a
                   LEFT OUTER JOIN m_user c on a.user_id = c.user_id
                   LEFT OUTER JOIN l_resi d on a.pemesanan_id = d.pemesanan_id
                   WHERE a.status_id = '5'");
  $t = mysqli_num_rows($terkirim);
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Home
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active">Home</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box" style="background-color:#FFF">
            <div class="box-header">
            <!-- <center><img src="../images/logo.png" style="width:1000px" /></center> -->

            <center><h3>Status Pesanan Menu</h3></center><br>
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-red">
                    <div class="inner">
                      <h3><?php echo $h1 ?></h3>

                      <h4>Pesanan Masuk</h4>
                    </div>
                    <div class="icon">
                      <i class="fa fa-check-square-o"></i>
                    </div>
                    <a href="?i=<?php echo md5('perlu-dikirim')?>" class="small-box-footer">Lebih Detail <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-yellow">
                    <div class="inner">
                      <h3><?php echo $h2 ?></h3>

                      <h4>Proses</h4>
                    </div>
                    <div class="icon">
                      <i class="fa fa-send-o"></i>
                    </div>
                    <a href="?i=<?php echo md5('dikirim')?>" class="small-box-footer">Lebih Detail <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-aqua">
                    <div class="inner">
                      <h3><?php echo $t; ?></h3>

                      <h4>Selesai</h4>
                    </div>
                    <div class="icon">
                      <i class="fa fa-shopping-bag"></i>
                    </div>
                    <a href="?i=<?php echo md5('selesai')?>" class="small-box-footer">Lebih Detail <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                  <div class="small-box bg-green">
                    <div class="inner">
                      <h3><?php echo $u; ?></h3>

                      <h4>User Pelanggan</h4>
                    </div>
                    <div class="icon">
                      <i class="fa fa-users"></i>
                    </div>
                    <a href="?i=<?php echo md5('v_user')?>" class="small-box-footer">Lebih Detail <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
              </div>

            </div>
            <!-- /.box-header -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>