<?php
session_start();
error_reporting();
date_default_timezone_set('Asia/Jakarta');
if (empty($_SESSION['id'])) {
  ?>
  <script>
    window.location = "../";
    alert("Silahkan Login Terlebih Dahulu!!!");
  </script>
<?php
} else {
  require_once("../koneksi.php");
  $s1 = mysqli_query($koneksi, "SELECT * FROM t_pemesanan WHERE status_id = '2' OR status_id = '3'");
  $h1 = mysqli_num_rows($s1);
  $s2 = mysqli_query($koneksi, "SELECT * FROM t_pemesanan WHERE status_id = '4'");
  $h2 = mysqli_num_rows($s2);
  $a = mysqli_query($koneksi, "SELECT * FROM m_user WHERE user_id = '$_SESSION[id]'");
  $h = mysqli_fetch_array($a);
  if ($h['level_id'] != 1) {
    header("Location: ../login_val.php?lv=$h[level_id]");
  } else { }
  $sql = mysqli_query($koneksi, "SELECT * FROM m_user WHERE user_id = '$_SESSION[id]'");
  $row = mysqli_fetch_assoc($sql);
  ?>
  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Semesta "Manyatukan Kita"</title>
    <link rel="icon" type="image/png" href="../images/logo_fav.png">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="plugins/iCheck/all.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="plugins/colorpicker/bootstrap-colorpicker.min.css">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/select2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <script type="text/javascript" src="jquery-1.9.1.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  </head>

  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      <header class="main-header">
        <!-- Logo -->
        <a href="?i=" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>ADM</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>ADMIN</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="../images/logo_fav.png" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $row['user_nama']; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">

                    <img src="../images/logo_fav.png" class="img-circle" alt="User Image" width="50px">

                    <p>
                      <?php echo $row['user_nama']; ?>
                      <small>Semesta Coffee</small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                    </div>
                    <div class="pull-right">
                      <a href="../logout.php" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
          <h4 style="color:#FFF;margin-top:0.5cm">
            <center</center> </h4> </nav> </header> <!-- Left side column. contains the logo and sidebar -->
              <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                  <!-- Sidebar user panel -->
                  <div class="user-panel">
                    <div class="pull-left image">
                      <img src="../images/logo_fav.png" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                      <p><?php echo $row['user_nama']; ?></p>
                      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                  </div>
                  <!-- sidebar menu: : style can be found in sidebar.less -->
                  <ul class="sidebar-menu">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="treeview">
                      <a href="?page=">
                        <i class="fa fa-home"></i> <span>Home</span>
                        <!-- <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span> -->
                      </a>
                    </li>
                    <li class="treeview">
                      <a href="#">
                        <i class="fa fa-users"></i> <span>Data Pengguna</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        <ul class="treeview-menu">
                          <li><a href="?i=<?php echo md5('v_admin') ?>"><i class="fa fa-user"></i>Admin</a></li>
                          <li><a href="?i=<?php echo md5('v_user') ?>"><i class="fa fa-user"></i>User</a></li>
                        </ul>
                      </a>
                    </li>
                    <li class="treeview">
                      <a href="#">
                        <i class="fa fa-sitemap"></i> <span>Data Lookup</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        <ul class="treeview-menu">
                          <!-- <li><a href="?i=<?php echo md5('v_penerbit') ?>"><i class="fa fa-book"></i>Data Penerbit</a></li>
            <li><a href="?i=<?php echo md5('v_penulis') ?>"><i class="fa fa-book"></i>Data Penulis</a></li> -->
                          <li><a href="?i=<?php echo md5('l_kategori') ?>"><i class="fa fa-book"></i>Lookup Kategori Menu</a></li>
                          <!-- <li><a href="?i=<?php echo md5('l_kategori_acc') ?>"><i class="fa fa-book"></i>Lookup Kategori Acc</a></li> -->
                        </ul>
                      </a>
                    </li>
                    <li class="treeview">
                      <a href="#">
                        <i class="fa fa-folder"></i> <span>Data Master</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        <ul class="treeview-menu">
                          <li><a href="?i=<?php echo md5('v_buku') ?>"><i class="fa fa-book"></i>Data Menu</a></li>
                          <!-- <li><a href="?i=<?php echo md5('v_jurnal') ?>"><i class="fa fa-book"></i>Data Jurnal</a></li>
            <li><a href="?i=<?php echo md5('v_acc') ?>"><i class="fa fa-image"></i>Aksesories</a></li> -->
                        </ul>
                      </a>
                    </li>
                    <li class="treeview">
                      <a href="#">
                        <i class="fa fa-bar-chart"></i> <span>Data Transaksi</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-double-down"></i>
                        </span>
                    <li><a href="?i=<?php echo md5('perlu-dikirim') ?>"><i class="fa fa-bell"></i>Pesanan Masuk <sup style="color:#FF3"><i class="fa fa-bell"></i><?php echo $h1 ?></sup></a></li>
                    <li><a href="?i=<?php echo md5('dikirim') ?>"><i class="fa fa-bell"></i>Proses <sup style="color:#FF3"><i class="fa fa-bell"></i><?php echo $h2 ?></sup></a></li>
                    <li><a href="?i=<?php echo md5('selesai') ?>"><i class="fa fa-bell"></i>Selesai</a></li>
                    </a>
                    </li>
                    <li class="treeview">
                      <a href="#">
                        <i class="fa fa-area-chart"></i> <span>Laporan</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        <ul class="treeview-menu">
                          <li><a href="?i=<?php echo md5('lap_penjualan') ?>&1=<?php echo date('Y-m-d') ?>&2=<?php echo date('Y-m-d') ?>"><i class="fa fa-area-chart"></i>Laporan Penjualan</a></li>
                          <li><a href="?i=<?php echo md5('lap_labarugi') ?>&1=<?php echo date('Y-m-d') ?>&2=<?php echo date('Y-m-d') ?>"><i class="fa fa-area-chart"></i>Laporan Laba Rugi</a></li>
                        </ul>
                      </a>
                    </li>
                  </ul>
                </section>
              </aside>
              <?php
                switch ($_GET['i']) {
                  case md5('v_admin'):
                    require_once('v_admin.php');
                    break;
                  case md5('i_admin'):
                    require_once('i_admin.php');
                    break;
                  case md5('u_admin'):
                    require_once('u_admin.php');
                    break;
                  case md5('d_admin'):
                    mysqli_query($koneksi, "DELETE FROM m_user WHERE user_id = '$_GET[id]'");
                    ?>
                  <script>
                    window.location = "?i=<?php echo md5('v_admin') ?>";
                  </script>
                <?php
                    break;
                  case md5('v_user'):
                    require_once('v_user.php');
                    break;
                  case md5('d_user'):
                    mysqli_query($koneksi, "DELETE FROM m_user WHERE user_id = '$_GET[id]'");
                    ?>
                  <script>
                    window.location = "?i=<?php echo md5('v_user') ?>";
                  </script>
                <?php
                    break;
                  case md5('v_penerbit'):
                    require_once('v_penerbit.php');
                    break;
                  case md5('d_penerbit'):
                    mysqli_query($koneksi, "DELETE FROM l_penerbit WHERE penerbit_id = '$_GET[id]'");
                    ?>
                  <script>
                    window.location = "?i=<?php echo md5('v_penerbit') ?>";
                  </script>
                <?php
                    break;
                  case md5('l_kategori'):
                    require_once('l_kategori.php');
                    break;
                  case md5('d_kategori'):
                    mysqli_query($koneksi, "DELETE FROM l_kategori WHERE kategori_id = '$_GET[id]'");
                    ?>
                  <script>
                    window.location = "?i=<?php echo md5('l_kategori') ?>";
                  </script>
                <?php
                    break;
                  case md5('l_kategori_acc'):
                    require_once('l_kategoriacc.php');
                    break;
                  case md5('d_kategoriacc'):
                    mysqli_query($koneksi, "DELETE FROM l_kategori_acc WHERE kategoriacc_id = '$_GET[id]'");
                    ?>
                  <script>
                    window.location = "?i=<?php echo md5('l_kategori_acc') ?>";
                  </script>
                <?php
                    break;
                  case md5('v_penulis'):
                    require_once('v_penulis.php');
                    break;
                  case md5('d_penulis'):
                    mysqli_query($koneksi, "DELETE FROM l_penulis WHERE penulis_id = '$_GET[id]'");
                    ?>
                  <script>
                    window.location = "?i=<?php echo md5('v_penulis') ?>";
                  </script>
                <?php
                    break;
                  case md5('v_buku'):
                    require_once('v_buku.php');
                    break;
                  case md5('i_buku'):
                    require_once('i_buku.php');
                    break;
                  case md5('u_buku'):
                    require_once('u_buku.php');
                    break;
                  case md5('d_buku'):
                    mysqli_query($koneksi, "DELETE FROM m_barang WHERE brg_id = '$_GET[id]'");
                    ?>
                  <script>
                    window.location = "?i=<?php echo md5('v_buku') ?>";
                  </script>
                <?php
                    break;
                  case md5('v_jurnal'):
                    require_once('v_jurnal.php');
                    break;
                  case md5('i_jurnal'):
                    require_once('i_jurnal.php');
                    break;
                  case md5('u_jurnal'):
                    require_once('u_jurnal.php');
                    break;
                  case md5('d_jurnal'):
                    mysqli_query($koneksi, "DELETE FROM m_barang WHERE brg_id = '$_GET[id]'");
                    ?>
                  <script>
                    window.location = "?i=<?php echo md5('v_jurnal') ?>";
                  </script>
                <?php
                    break;
                  case md5('v_acc'):
                    require_once('v_acc.php');
                    break;
                  case md5('i_acc'):
                    require_once('i_acc.php');
                    break;
                  case md5('u_acc'):
                    require_once('u_acc.php');
                    break;
                  case md5('d_acc'):
                    mysqli_query($koneksi, "DELETE FROM m_barang WHERE brg_id = '$_GET[id]'");
                    ?>
                  <script>
                    window.location = "?i=<?php echo md5('v_acc') ?>";
                  </script>
                <?php
                    break;
                  case md5('perlu-dikirim'):
                    require_once('v_perlu_dikirim.php');
                    break;
                  case md5('dtl-pemesanan'):
                    require_once('dtl_pemesanan.php');
                    break;
                  case md5('verif'):
                    mysqli_query($koneksi, "UPDATE t_pemesanan SET status_id = '3' WHERE pemesanan_id = '$_GET[id]'");
                    ?>
                  <script>
                    window.location = "?i=<?php echo md5('perlu-dikirim') ?>";
                  </script>
                <?php
                    break;
                  case md5('btl-verif'):
                    mysqli_query($koneksi, "UPDATE t_pemesanan SET status_id = '2' WHERE pemesanan_id = '$_GET[id]'");
                    ?>
                  <script>
                    window.location = "?i=<?php echo md5('perlu-dikirim') ?>";
                  </script>
                <?php
                    break;
                  case md5('resi'):
                    require_once('resi.php');
                    break;
                  case md5('dikirim'):
                    require_once('v_dikirim.php');
                    break;
                  case md5('u_resi'):
                    require_once('u_resi.php');
                    break;
                  case md5('sampai'):
                    $sdata = mysqli_query($koneksi, "SELECT * FROM t_keranjang a
											 LEFT OUTER JOIN m_barang b on a.brg_id = b.brg_id
											 WHERE pemesanan_id = '$_GET[id]'");
                    while ($data = mysqli_fetch_array($sdata)) {
                      mysqli_query($koneksi, "UPDATE m_barang SET jml_terjual = jml_terjual+'$data[jumlah_trx]' WHERE brg_id = '$data[brg_id]'");
                    }
                    mysqli_query($koneksi, "UPDATE t_pemesanan SET status_id = '5' WHERE pemesanan_id = '$_GET[id]'");
                    ?>
                  <script>
                    alert("Pesanan Telah Selesai");
                    window.location = "?i=<?php echo md5('dikirim') ?>";
                  </script>
                <?php
                    break;
                  case md5('selesai'):
                    require_once('v_selesai.php');
                    break;
                  case md5('btl-selesai'):
                    $sdata = mysqli_query($koneksi, "SELECT * FROM t_keranjang a
											 LEFT OUTER JOIN m_barang b on a.brg_id = b.brg_id
											 WHERE pemesanan_id = '$_GET[id]'");
                    while ($data = mysqli_fetch_array($sdata)) {
                      mysqli_query($koneksi, "UPDATE m_barang SET jml_terjual = jml_terjual-'$data[jumlah_trx]' WHERE brg_id = '$data[brg_id]'");
                    }
                    mysqli_query($koneksi, "UPDATE t_pemesanan SET status_id = '4' WHERE pemesanan_id = '$_GET[id]'");
                    ?>
                  <script>
                    alert("Status Berhasil Ubah");
                    window.location = "?i=<?php echo md5('selesai') ?>";
                  </script>
                <?php
                    break;
                  case md5('lap_penjualan'):
                    require_once('v_laporan_penjualan.php');
                    break;
                  case md5('lap_labarugi'):
                    require_once('v_laporan_labarugi.php');
                    break;
                  default:
                    require_once('home.php');
                }
                ?>
                <footer class="main-footer">
                  <div class="pull-right hidden-xs">
                    <b>Version</b> 1.0.0
                  </div>
                  <strong>Copyright &copy; 2019 <span> Semesta Coffee Inc.</span></strong>
                </footer>
                <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery 2.2.3 -->
    <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Select2 -->
    <script src="plugins/select2/select2.full.min.js"></script>
    <!-- InputMask -->
    <script src="plugins/input-mask/jquery.inputmask.js"></script>
    <script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <!-- date-range-picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap datepicker -->
    <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- bootstrap color picker -->
    <script src="plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
    <!-- bootstrap time picker -->
    <script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/knob/jquery.knob.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- page script -->
    <script type="text/javascript">
      function previewImage(input) {
        if (input.files && input.files[0]) {
          var fileReader = new FileReader();
          var imageFile = input.files[0];


          if (imageFile.type == "image/png" || imageFile.type == "image/jpeg") {
            fileReader.readAsDataURL(imageFile);

            fileReader.onload = function(e) {
              $('#preview-image').attr('src', e.target.result);
            }
          } else {
            alert("Masukan File Gambar");
          }
        }
      }

      $("[name='file']").change(function() {
        previewImage(this);
      });
    </script>
    <script>
      $(function() {
        $("#example1").DataTable();
        $("#example2").DataTable();
        $("#example5").DataTable();
        $('#example3').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": false,
          "info": true,
          "autoWidth": true
        });
        $('#example4').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "responsived": false,
          "autoWidth": true
        });
        $(".select2").select2();

        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {
          "placeholder": "dd/mm/yyyy"
        });
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("mm/dd/yyyy", {
          "placeholder": "mm/dd/yyyy"
        });
        //Money Euro
        $("[data-mask]").inputmask();

        //Date range picker
        $('#reservation').daterangepicker();
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({
          timePicker: true,
          timePickerIncrement: 30,
          format: 'MM/DD/YYYY h:mm A'
        });
        //Date range as a button
        $('#daterange-btn').daterangepicker({
            ranges: {
              'Today': [moment(), moment()],
              'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
              'Last 7 Days': [moment().subtract(6, 'days'), moment()],
              'Last 30 Days': [moment().subtract(29, 'days'), moment()],
              'This Month': [moment().startOf('month'), moment().endOf('month')],
              'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            startDate: moment().subtract(29, 'days'),
            endDate: moment()
          },
          function(start, end) {
            $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
          }
        );

        //Date picker
        $('#datepicker').datepicker({
          autoclose: true
        });

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });

        //Colorpicker
        $(".my-colorpicker1").colorpicker();
        //color picker with addon
        $(".my-colorpicker2").colorpicker();

        //Timepicker
        $(".timepicker").timepicker({
          showInputs: false
        });
      });
    </script>
  </body>

  </html>
<?php
}
?>