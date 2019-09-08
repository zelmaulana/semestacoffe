<?php
session_start();
error_reporting(0);
require_once("koneksi.php");
date_default_timezone_set('Asia/Jakarta');
$rumuscantik = mysqli_query($koneksi, "SELECT * FROM t_pemesanan a
									   LEFT OUTER JOIN t_keranjang b on a.pemesanan_id = b.pemesanan_id WHERE a.status_id = '1'");
while ($executerumus = mysqli_fetch_array($rumuscantik)){
	$date = date('Y-m-d', strtotime( '+1 days', strtotime($executerumus['tanggal'])));
	$valdate = date('Y-m-d');
	if($valdate == $date){
		$tty = date('g');
		$valtime = date('g', strtotime( '+6 hours', strtotime($executerumus['jam'])));
		if($tty > $valtime)
		{
			mysqli_query($koneksi, "UPDATE m_barang SET stok = stok+'$executerumus[jumlah_trx]' WHERE brg_id = '$executerumus[brg_id]'");
			mysqli_query($koneksi, "DELETE FROM t_pemesanan WHERE pemesanan_id = '$executerumus[pemesanan_id]'");
			mysqli_query($koneksi, "DELETE FROM t_keranjang WHERE pemesanan_id = '$executerumus[pemesanan_id]'");
		}
		else{
		}
	}
	else{
		$tty = date('G');
		$valtime = date('G', strtotime( '+6 hours', strtotime($executerumus['jam'])));
		if($tty > $valtime)
		{
			mysqli_query($koneksi, "UPDATE m_barang SET stok = stok+'$executerumus[jumlah_trx]' WHERE brg_id = '$executerumus[brg_id]'");
			mysqli_query($koneksi, "DELETE FROM t_pemesanan WHERE pemesanan_id = '$executerumus[pemesanan_id]'");
			mysqli_query($koneksi, "DELETE FROM t_keranjang WHERE pemesanan_id = '$executerumus[pemesanan_id]'");
		}
		else{
		}
	}
	
}
$a = mysqli_query($koneksi, "SELECT * FROM m_user WHERE user_id = '$_SESSION[id]'");
$b = mysqli_num_rows($a);

if($b == 1){
	$h = mysqli_fetch_array($a);
	header("Location: login_val.php?lv=$h[level_id]");
}
else{
?>
        <!DOCTYPE html>
        <html>
        <head>
          <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="description" content="">
            <meta name="author" content="">
            <title>Semesta "Menyatukan Kita"</title>
            <link rel="icon" type="image/png" href="images/ump.png">
            <link href="css/bootstrap.min.css" rel="stylesheet">
            <link href="css/font-awesome.min.css" rel="stylesheet">
            <link href="css/prettyPhoto.css" rel="stylesheet">
            <link href="css/price-range.css" rel="stylesheet">
            <link href="css/animate.css" rel="stylesheet">
            <link href="css/main.css" rel="stylesheet">
            <link href="css/responsive.css" rel="stylesheet">
    		<script type="text/javascript" src="jquery-1.9.1.min.js"></script>
            <!--[if lt IE 9]>
            <script src="js/html5shiv.js"></script>
            <script src="js/respond.min.js"></script>
            <![endif]-->       
            <link rel="shortcut icon" href="images/ico/favicon.ico">
            <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
            <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
            <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
            <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
        </head>
		<body class="hold-transition login-page" style="background-color:#FFF">
            <?php
            if(isset($_GET['i'])){
				if($_GET['i'] == md5('login') || $_GET['i'] == md5('regis') || $_GET['i'] == md5('verif') || $_GET['i'] == md5('resetpass') || $_GET['i'] == md5('resetpass_verif') || $_GET['i'] == md5('reset')){
				?>
                <center>
            	<br>
                <br>
                <a href="?i="><img class="img img-responsive" src="images/logo_semesta.png" ></a>
            </center>
            <?php
				}
				else{
					?>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> 0856-4298-8418</a></li>
								<!-- <li><a href="#"><i class="fa fa-envelope"></i> semesta.coffe@gmail.com</a></li> -->
								<li><a href="https://www.instagram.com/semesta_coffee/" target="_blank"><i class="fa fa-instagram"></i> semesta_coffee</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="?i="><img class="img img-responsive" src="images/logo_semesta.png" ></a>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
                            <?php
							$sker = mysqli_query($koneksi, "SELECT * FROM t_keranjang WHERE user_id = '$_SESSION[id]' AND pemesanan_id = '0'");
							$nker = mysqli_num_rows($sker);
							?>
								<li><a href="?i=beranda"><i class="fa fa-home"></i> Beranda</a></li>
								<li><a href="?i=<?php echo md5('login')?>"><i class="fa  fa-arrow-circle-right"></i> Login</a></li>
								<li><a href="?i=<?php echo md5('regis')?>"><i class="fa  fa-user"></i> Register</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
					</div>
					<div class="col-sm-3">
					<?php
                    switch ($_GET['i']) {
                        case 'detail-barang':
                        break;
                        default:
						?>
						<div class="search_box pull-right">
                        <form action="" method="post">
							<input type="text" placeholder="Search" name="cari" value="<?php echo $_POST['cari']?>"/>
                            <button type="submit" style="background-color: orange;" class="btn-primary">Cari</button>
                         </form>
						</div>
                        <?php
                    }
                    ?>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
				<?php	
				}
			}
			?>
            <!-- <br> -->
            <?php
			if(!isset($_GET['i'])){
				?>
    <header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> 0856-4298-8418</a></li>
								<!-- <li><a href="#"><i class="fa fa-envelope"></i> semesta.coffe@gmail.com</a></li> -->
								<li><a href="https://www.instagram.com/semesta_coffee/" target="_blank"><i class="fa fa-instagram"></i> semesta_coffee</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="?i="><img class="img img-responsive" src="images/logo_semesta.png" ></a>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
                            <?php
							$sker = mysqli_query($koneksi, "SELECT * FROM t_keranjang WHERE user_id = '$_SESSION[id]' AND pemesanan_id = '0'");
							$nker = mysqli_num_rows($sker);
							?>
								<li><a href="?i=beranda"><i class="fa fa-home"></i> Beranda</a></li>
								<li><a href="?i=<?php echo md5('login')?>"><i class="fa  fa-arrow-circle-right"></i> Login</a></li>
								<li><a href="?i=<?php echo md5('regis')?>"><i class="fa  fa-user"></i> Register</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
					</div>
					<div class="col-sm-3">
					<?php
                    switch ($_GET['i']) {
                        case 'detail-barang':
                        break;
                        default:
						?>
						<div class="search_box pull-right">
                        <form action="" method="post">
							<input type="text" placeholder="Search" name="cari" value="<?php echo $_POST['cari']?>"/>
                            <button type="submit" style="background-color: orange;" class="btn-primary">Cari</button>
                         </form>
						</div>
                        <?php
                    }
                    ?>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
    <?php
			}
			?>
			<?php
			$regis = md5('regis');
			$verif = md5('verif');
			$resetpass = md5('resetpass');
			$resetpass_verif = md5('resetpass_verif');
			$reset = md5('reset');
			if(!isset($_GET['i'])){
				require_once('catalog.php');
			}
			else{
				switch ($_GET['i']) {
				case md5('login'):
					require_once('login.php');
				break;
				case "$regis":
					require_once('register.php');
				break;
				case "$verif":
					require_once('verifity.php');
				break;
				case "$resetpass":
					require_once('resetpass.php');
				break;
				case "$resetpass_verif":
					require_once('resetpass_verif.php');
				break;
				case "$reset":
					require_once('reset.php');
				break;
				case "detail-barang":
					require_once('dtl_barang.php');
				break;
				case md5('beli'):
					?>
                    <script>
						alert("Anda Belum Login, Silahkan Login Terlebih Dahulu.");
						window.location = "?i=<?php echo md5('login')?>";
					</script>
                    <?php
				break;
				default:
					require_once('catalog.php');
				}
			}
			?>
	
	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-3">
						<div class="companyinfo">
							<h2><span>Semesta</span> Coffee</h2>
							<p>"Menyatukan Kita"</p>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="address">
							<img src="images/home/map.png" alt="" />
							<p>Jl. Tegalsari Dukuhwaluh, Kembaran, Belakang Kampus 1 UMP</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2019 Semesta Coffee Inc.</p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->

            <!--/form-->
	<!-- /.login-box -->
    <!-- jQuery 2.2.3 -->
    <script src="js/jquery.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
	</body>
	</html>
<?php
}
?>