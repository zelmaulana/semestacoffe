<?php
session_start();
error_reporting(0);
require_once("koneksi.php");
date_default_timezone_set('Asia/Jakarta');
$rumuscantik = mysqli_query($koneksi, "SELECT * FROM t_pemesanan a
									   LEFT OUTER JOIN t_keranjang b on a.pemesanan_id = b.pemesanan_id WHERE a.status_id = '1'");
while ($executerumus = mysqli_fetch_array($rumuscantik)) {
	$date = date('Y-m-d', strtotime('+1 days', strtotime($executerumus['tanggal'])));
	$valdate = date('Y-m-d');
	if ($valdate == $date) {
		$tty = date('g');
		$valtime = date('g', strtotime('+6 hours', strtotime($executerumus['jam'])));
		if ($tty > $valtime) {
			mysqli_query($koneksi, "UPDATE m_barang SET stok = stok+'$executerumus[jumlah_trx]' WHERE brg_id = '$executerumus[brg_id]'");
			mysqli_query($koneksi, "DELETE FROM t_pemesanan WHERE pemesanan_id = '$executerumus[pemesanan_id]'");
			mysqli_query($koneksi, "DELETE FROM t_keranjang WHERE pemesanan_id = '$executerumus[pemesanan_id]'");
		} else { }
	} else {
		$tty = date('G');
		$valtime = date('G', strtotime('+6 hours', strtotime($executerumus['jam'])));
		if ($tty > $valtime) {
			mysqli_query($koneksi, "UPDATE m_barang SET stok = stok+'$executerumus[jumlah_trx]' WHERE brg_id = '$executerumus[brg_id]'");
			mysqli_query($koneksi, "DELETE FROM t_pemesanan WHERE pemesanan_id = '$executerumus[pemesanan_id]'");
			mysqli_query($koneksi, "DELETE FROM t_keranjang WHERE pemesanan_id = '$executerumus[pemesanan_id]'");
		} else { }
	}
}
$a = mysqli_query($koneksi, "SELECT * FROM m_user WHERE user_id = '$_SESSION[id]'");
$b = mysqli_num_rows($a);

if ($b == 1) {
	$h = mysqli_fetch_array($a);
	header("Location: login_val.php?lv=$h[level_id]");
} else {
	?>
	<!DOCTYPE html>
	<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Semesta "Menyatukan Kita"</title>
		<link rel="icon" type="image/png" href="images/logo_fav.png">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/font-awesome.min.css" rel="stylesheet">
		<link href="css/prettyPhoto.css" rel="stylesheet">
		<link href="css/price-range.css" rel="stylesheet">
		<link href="css/animate.css" rel="stylesheet">
		<link href="css/main.css" rel="stylesheet">
		<link href="css/responsive.css" rel="stylesheet">
		<!-- <script type="text/javascript" src="jquery-1.9.1.min.js"></script> -->
		<!--[if lt IE 9]>
            <script src="js/html5shiv.js"></script>
            <script src="js/respond.min.js"></script>
            <![endif]-->
		<link rel="shortcut icon" href="images/ico/favicon.ico">
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
		<link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
		<script src="assets/sweetalert2/sweetalert2.all.min.js"></script>
	</head>

	<body class="hold-transition login-page" style="background-color:#FFF">

		<!-- Modal Pop Up Otomatis -->
		<!-- <div id="myModal" class="modal fade" role="dialog">
			<div class="modal-dialog">

				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Welcome</h4>
					</div>
					<div class="modal-body">
						<p><img class="img img-responsive" src="images/logo_header.png" width="390" height="95"></p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
					</div>
				</div>

			</div>
		</div> -->
		<!-- End Modal Pop Up Otomatis -->


		<?php
			if (isset($_GET['i'])) {
				if ($_GET['i'] == md5('login') || $_GET['i'] == md5('regis') || $_GET['i'] == md5('verif') || $_GET['i'] == md5('resetpass') || $_GET['i'] == md5('resetpass_verif') || $_GET['i'] == md5('reset')) {
					?>
				<center>
					<br>
					<br>
					<a href="?i="><img class="img img-responsive" src="images/logo_header.png" width="390" height="95"></a>
				</center>
			<?php
					} else {
						?>
				<header id="header">
					<!--header-->
					<div class="header_top">
						<!--header_top-->
						<div class="container">
							<div class="row">
								<div class="col-sm-6">
									<div class="contactinfo">
										<ul class="nav nav-pills">
											<li><a href="#"><i class="fa fa-phone"></i> 0811 2600 106</a></li>
											<!-- <li><a href="#"><i class="fa fa-envelope"></i> semesta.coffe@gmail.com</a></li> -->
											<li><a href="https://www.instagram.com/semesta_coffee/" target="_blank"><i class="fa fa-instagram"></i> semesta_coffee</a></li>
										</ul>
									</div>
								</div>
								<div class="col-sm-6">
								</div>
							</div>
						</div>
					</div>
					<!--/header_top-->

					<div class="header-middle">
						<!--header-middle-->
						<div class="container">
							<div class="row">
								<div class="col-sm-4">
									<div class="logo pull-left">
										<a href="?i="><img class="img img-responsive" src="images/logo_header.png" width="390" height="95"></a>
									</div>
								</div>
								<div class="col-sm-8">
									<div class="shop-menu pull-right">
										<ul class="nav navbar-nav">
											<?php
														$sker = mysqli_query($koneksi, "SELECT * FROM t_keranjang WHERE user_id = '$_SESSION[id]' AND pemesanan_id = '0'");
														$nker = mysqli_num_rows($sker);
														?>
											<li><a href="?i=beranda" class="active"><i class="fa fa-home"></i> Beranda</a></li>
											<li><a href="?i=<?php echo md5('login') ?>"><i class="fa  fa-lock"></i> Masuk</a></li>
											<li><a href="?i=<?php echo md5('regis') ?>"><i class="fa  fa-user"></i> Daftar</a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--/header-middle-->

					<div class="header-bottom">
						<!--header-bottom-->
						<div class="container">
							<div class="row">
								<div class="col-sm-9">
									<div class="navbar-header">
										<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
											<span class="sr-only">Toggle navigation</span>
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
										</button>
									</div>
									<div class="mainmenu pull-left">
										<ul class="nav navbar-nav collapse navbar-collapse">
											<li><a href="?i=beranda" class="active">Beranda</a></li>
											<!-- <li class="dropdown"><a href="#">Souvenir<i class="fa fa-angle-down"></i></a>
												<ul role="menu" class="sub-menu">
													<li><a href="">Kaos</a></li>
													<li><a href="">Kaos</a></li>
													<li><a href="">Kaos</a></li>
												</ul>
											</li>
											<li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
												<ul role="menu" class="sub-menu">
													<li><a href="">Berita</a></li>
													<li><a href="">Video</a></li>
												</ul>
											</li> -->
											<li><a href="?i=contact">Kontak</a></li>
										</ul>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="search_box pull-right">
										<form action="" method="post">
											<input type="text" placeholder="Search" name="cari" value="<?php echo $_POST['cari'] ?>" />
											<button type="submit" class="btn btn-warning">Cari</button>
										</form>
									</div>
									<?php
												switch ($_GET['i']) {
													case 'detail-barang':
														break;
													default:
														?>

										<?php
												}
												?>
								</div>
							</div>
						</div>
					</div>
					<!--/header-bottom-->
				</header>
				<!--/header-->
		<?php
				}
			}
			?>
		<!-- <br> -->
		<?php
			if (!isset($_GET['i'])) {
				?>
			<header id="header">
				<!--header-->
				<div class="header_top">
					<!--header_top-->
					<div class="container">
						<div class="row">
							<div class="col-sm-6">
								<div class="contactinfo">
									<ul class="nav nav-pills">
										<li><a href="#"><i class="fa fa-phone"></i> 0811 2600 106</a></li>
										<!-- <li><a href="#"><i class="fa fa-envelope"></i> semesta.coffe@gmail.com</a></li> -->
										<li><a href="https://www.instagram.com/semesta_coffee/" target="_blank"><i class="fa fa-instagram"></i> semesta_coffee</a></li>
									</ul>
								</div>
							</div>
							<div class="col-sm-6">
							</div>
						</div>
					</div>
				</div>
				<!--/header_top-->

				<div class="header-middle">
					<!--header-middle-->
					<div class="container">
						<div class="row">
							<div class="col-sm-4">
								<div class="logo pull-left">
									<a href="?i="><img class="img img-responsive" src="images/logo_header.png" width="390" height="95"></a>
								</div>
							</div>
							<div class="col-sm-8">
								<div class="shop-menu pull-right">
									<ul class="nav navbar-nav">
										<?php
												$sker = mysqli_query($koneksi, "SELECT * FROM t_keranjang WHERE user_id = '$_SESSION[id]' AND pemesanan_id = '0'");
												$nker = mysqli_num_rows($sker);
												?>
										<li><a href="?i=beranda" class="active"><i class="fa fa-home"></i> Beranda</a></li>
										<li><a href="?i=<?php echo md5('login') ?>"><i class="fa  fa-lock"></i> Masuk</a></li>
										<li><a href="?i=<?php echo md5('regis') ?>"><i class="fa  fa-user"></i> Daftar</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--/header-middle-->

				<div class="header-bottom">
					<!--header-bottom-->
					<div class="container">
						<div class="row">
							<div class="col-sm-9">
								<div class="navbar-header">
									<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
										<span class="sr-only">Toggle navigation</span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</button>
								</div>
								<div class="mainmenu pull-left">
									<ul class="nav navbar-nav collapse navbar-collapse">
										<li><a href="?i=beranda" class="active">Beranda</a></li>
										<!-- <li class="dropdown"><a href="#">Souvenir<i class="fa fa-angle-down"></i></a>
											<ul role="menu" class="sub-menu">
												<li><a href="">Kaos</a></li>
												<li><a href="">Kaos</a></li>
												<li><a href="">Kaos</a></li>
											</ul>
										</li>
										<li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
											<ul role="menu" class="sub-menu">
												<li><a href="">Berita</a></li>
												<li><a href="">Video</a></li>
											</ul>
										</li> -->
										<li><a href="?i=contact">Kontak</a></li>
									</ul>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="search_box pull-right">
									<form action="" method="post">
										<input type="text" placeholder="Search" name="cari" value="<?php echo $_POST['cari'] ?>" />
										<button type="submit" class="btn btn-warning">Cari</button>
									</form>
								</div>
								<?php
										switch ($_GET['i']) {
											case 'detail-barang':
												break;
											default:
												?>
									<?php
										}
										?>
							</div>
						</div>
					</div>
				</div>
				<!--/header-bottom-->
			</header>
			<!--/header-->
		<?php
			}
			?>
		<?php
			$regis = md5('regis');
			$verif = md5('verif');
			$resetpass = md5('resetpass');
			$resetpass_verif = md5('resetpass_verif');
			$reset = md5('reset');
			if (!isset($_GET['i'])) {
				require_once('catalog.php');
			} else {
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
					case "contact":
						require_once('contact.php');
						break;
					case md5('beli'):
						?>
					<script>
						Swal.fire({
							title: 'Mau pesan mudah?',
							imageUrl: 'https://semestaku.com/wp-content/uploads/2019/10/cropped-logo-13x5-coklat.png',
							imageWidth: 120,
							imageHeight: 35,
							imageAlt: 'Custom image',
							animation: false,
							customClass: {
								popup: 'animated tada'
							},
							text: "Masuk aja dulu",
							type: 'success',
							showCancelButton: false,
							confirmButtonColor: '#FFA500',
							confirmButtonText: 'Oke'
						}).then((result) => {
							if (result.value) {
								window.location = "?i=<?php echo md5('login') ?>";
							}
						})
					</script>
			<?php
						break;
					default:
						require_once('catalog.php');
				}
			}
			?>




			<footer id="footer">
				<!--Footer-->
				<div class="footer-top">
					<div class="container">
						<div class="row">
							<div class="col-sm-3">
								<div class="companyinfo">
									<h2><span>Semesta</span> Coffee</h2>
									<p style="color: orange;">"menyatukan kita"</p>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="companyinfo">
									<h2><span>Jam</span> Operasional</h2>
									<ul class="nav nav-pills nav-stacked">
										<li>Setiap Hari</li>
										<li>09.00 - 24.00 WIB</li>
									</ul>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="companyinfo">
									<h2><span>Kontak</span> Kami</h2>
									<ul class="nav nav-pills nav-stacked">
										<li>Whatsapp: 0811 2600 106</li>
										<li>Email: coffeesemesta@gmail.com</li>
									</ul>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="address">
									<img src="images/home/map.png" alt="" />
									<p style="color: black;">Jl. Tegalsari Dukuhwaluh, Kembaran, Belakang Kampus 1 UMP, Purwokerto, Jawa Tengah</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="footer-bottom">
					<div class="container">
						<div class="row">
							<p class="pull-left">Copyright © 2019 Semesta Coffee Inc. All rights reserved.</p>
						</div>
					</div>
				</div>

			</footer>
			<!--/Footer-->

			<!--/form-->
			<!-- /.login-box -->
			<!-- jQuery 2.2.3 -->
			<script src="js/jquery.js"></script>
			<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
			<script type="text/javascript" src="js/gmaps.js"></script>
			<script src="js/price-range.js"></script>
			<script src="js/jquery.scrollUp.min.js"></script>
			<script src="js/bootstrap.min.js"></script>
			<script src="js/jquery.prettyPhoto.js"></script>
			<script src="js/main.js"></script>
			<script>
				$('#myModal').modal('show');
			</script>
	</body>

	</html>
<?php
}
?>