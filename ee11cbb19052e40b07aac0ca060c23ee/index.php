<?php
session_start();
error_reporting(0);
require_once("../koneksi.php");
date_default_timezone_set('Asia/Jakarta');
$rumuscantik = mysqli_query($koneksi, "SELECT * FROM t_pemesanan a
									   LEFT OUTER JOIN t_keranjang b on a.pemesanan_id = b.pemesanan_id WHERE status_id = '1'");
while ($executerumus = mysqli_fetch_array($rumuscantik)){
	$jam = date('G');
	$time = date('G:i:s Y-m-d');
	$valtime = date('G:i:s Y-m-d', strtotime( '+6 hours', strtotime($executerumus['tanggal'])));
	if($jam < 10){
		if('0'.$time >= $valtime)
		{
			mysqli_query($koneksi, "UPDATE m_barang SET stok = stok+'$executerumus[jumlah_trx]' WHERE brg_id = '$executerumus[brg_id]'");
			mysqli_query($koneksi, "DELETE FROM t_pemesanan WHERE pemesanan_id = '$executerumus[pemesanan_id]'");
			mysqli_query($koneksi, "DELETE FROM t_keranjang WHERE pemesanan_id = '$executerumus[pemesanan_id]'");
		}
		else{
		}
	}
	else{
		if($time >= $valtime)
		{
			mysqli_query($koneksi, "UPDATE m_barang SET stok = stok+'$executerumus[jumlah_trx]' WHERE brg_id = '$executerumus[brg_id]'");
			mysqli_query($koneksi, "DELETE FROM t_pemesanan WHERE pemesanan_id = '$executerumus[pemesanan_id]'");
			mysqli_query($koneksi, "DELETE FROM t_keranjang WHERE pemesanan_id = '$executerumus[pemesanan_id]'");
		}
		else{
		}
	}
}
$ab = mysqli_query($koneksi, "SELECT * FROM t_keranjang a
							  LEFT OUTER JOIN m_barang b on a.brg_id = b.brg_id
							  WHERE a.user_id = '$_SESSION[id]' AND pemesanan_id = '0'");
while ($ac = mysqli_fetch_array($ab)){
	if ($ac['stok'] < $ac['jumlah_trx']){
		mysqli_query($koneksi, "UPDATE t_keranjang SET jumlah_trx='$ac[stok]' WHERE user_id = '$_SESSION[id]' AND pemesanan_id = '0' AND brg_id = '$ac[brg_id]'"); 
	}
}

if (empty($_SESSION['id'])){
	?>
        <script>
			window.location = "../";
			alert("Silahkan Login Terlebih Dahulu!!!");
		</script>
        <?php
}
else {
	$a = mysqli_query($koneksi, "SELECT * FROM m_user WHERE user_id = '$_SESSION[id]'");
	$h = mysqli_fetch_array($a);
	if($h['level_id'] != 2){
		header("Location: ../login_val.php?lv=$h[level_id]");
	}
	else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Semesta "Menyatukan Kita"</title>
    <link rel="icon" type="image/png" href="../images/ump.png">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/prettyPhoto.css" rel="stylesheet">
    <link href="../css/price-range.css" rel="stylesheet">
    <link href="../css/animate.css" rel="stylesheet">
	<link href="../css/main.css" rel="stylesheet">
	<link href="../css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
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
							<a href="?i="><img class="img img-responsive" src="../images/logo_semesta.png" ></a>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
                            <?php
							$sker = mysqli_query($koneksi, "SELECT * FROM t_keranjang WHERE user_id = '$_SESSION[id]' AND pemesanan_id = '0'");
							$nker = mysqli_num_rows($sker);
							$sker1 = mysqli_query($koneksi, "SELECT * FROM t_pemesanan a 
															 WHERE a.status_id < '5' AND a.user_id = '$_SESSION[id]'");
							$nker1 = mysqli_num_rows($sker1);
							?>
								<li><a href="?i=beranda"><i class="fa fa-home"></i> Beranda</a></li>
								<li><a href="?i=list_pemesanan"><i class="fa fa-book"></i> List Pemesanan
                                <span class="label label-warning"><?php echo $nker1?></span></a></li>
								<li><a href="?i=keranjang"><i class="fa fa-shopping-cart"></i> Keranjang
              						<span class="label label-warning"><?php echo $nker?></span></a></li>
								<li><a href="?i=saya"><i class="fa fa-user"></i> Saya</a></li>
								<li><a href="../logout.php"><i class="fa  fa-arrow-circle-right"></i> Logout</a></li>
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
                        case 'keranjang':
                        break;
                        case 'saya':
                        break;
                        case 'chekout':
                        break;
                        case 'bayar':
                        break;
                        case 'list_pemesanan':
                        break;
                        case 'dropshiper':
                        break;
                        case 'detail-pemesanan':
                        break;
                        case 'detail-pemesanan1':
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
	switch ($_GET['i']) {
		case 'detail-barang':
			require_once('dtl_barang.php');
		break;
		case md5('beli'):
			$sker = mysqli_query($koneksi, "SELECT * FROM t_keranjang WHERE user_id = '$_SESSION[id]' AND brg_id = '$_GET[idbrg]' AND pemesanan_id='0'");
			$nker = mysqli_num_rows($sker);
			$hker = mysqli_fetch_array($sker);
			if($nker == 0){
				mysqli_query($koneksi, "INSERT INTO t_keranjang VALUES('','','$_SESSION[id]', '$_GET[idbrg]', '1','')");
			}
			else{
				mysqli_query($koneksi, "UPDATE t_keranjang SET jumlah_trx=$hker[jumlah_trx]+1 WHERE user_id = '$_SESSION[id]' AND brg_id = '$_GET[idbrg]' ");
			}
			?>
            <script>
				alert("Dimasukkan Ke Keranjang");
				window.location = "?i=keranjang";
			</script>
            <?php
		break;
		case 'keranjang':
			require_once('keranjang.php');
		break;
		case md5('min_jumlah'):
			$sker = mysqli_query($koneksi, "SELECT * FROM t_keranjang WHERE keranjang_id = '$_GET[id]'");
			$hker = mysqli_fetch_array($sker);
			mysqli_query($koneksi, "UPDATE t_keranjang SET jumlah_trx = jumlah_trx-1 WHERE keranjang_id = '$_GET[id]'");
			$sker1 = mysqli_query($koneksi, "SELECT * FROM t_keranjang WHERE keranjang_id = '$_GET[id]'");
			$hker1 = mysqli_fetch_array($sker1);
			if($hker1['jumlah_trx'] < 1 ){
				mysqli_query($koneksi, "DELETE FROM t_keranjang WHERE keranjang_id = '$_GET[id]'");
			}
			?>
            <script>
			window.location = "?i=keranjang";
			</script>
            <?php
		break;
		case md5('plus_jumlah'):
			$sker = mysqli_query($koneksi, "SELECT * FROM t_keranjang WHERE keranjang_id = '$_GET[id]'");
			$hker = mysqli_fetch_array($sker);
			mysqli_query($koneksi, "UPDATE t_keranjang SET jumlah_trx = jumlah_trx+1 WHERE keranjang_id = '$_GET[id]'");
			?>
            <script>
			window.location = "?i=keranjang";
			</script>
            <?php
		break;
		case md5('del_keranjang'):
			mysqli_query($koneksi, "DELETE FROM t_keranjang WHERE keranjang_id = '$_GET[id]'");
			?>
            <script>
			window.location = "?i=keranjang";
			</script>
            <?php
		break;
		case 'saya':
			require_once('akun.php');
		break;
		case 'chekout':
			require_once('checkout.php');
		break;
		case 'dropshiper':
			require_once('dropship.php');
		break;
		case 'bayar':
			require_once('bayar.php');
		break;
		case 'list_pemesanan':
			require_once('list_pemesanan.php');
		break;
		case 'detail-pemesanan':
			require_once('detail_pemesanan.php');
		break;
		case 'diterima':
			$sdata = mysqli_query($koneksi, "SELECT * FROM t_keranjang a
											 LEFT OUTER JOIN m_barang b on a.brg_id = b.brg_id
											 WHERE pemesanan_id = '$_GET[id]'");
			while($data = mysqli_fetch_array($sdata)){
				mysqli_query($koneksi, "UPDATE m_barang SET jml_terjual = jml_terjual+'$data[jumlah_trx]' WHERE brg_id = '$data[brg_id]'");
			}
			mysqli_query($koneksi, "UPDATE t_pemesanan SET status_id = '5' WHERE pemesanan_id = '$_GET[id]'");
			?>
            <script>
			alert("Terimakasih, Semoga Anda Puas Dengan Pelayanan Kami.");
			window.location="?i=";
			</script>
			<?php
		break;
		default:
			require_once('beranda.php');
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
							<img src="../images/home/map.png" alt="" />
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
	
	
    <script src="../js/jquery.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/jquery.scrollUp.min.js"></script>
	<script src="../js/price-range.js"></script>
    <script src="../js/jquery.prettyPhoto.js"></script>
    <script src="../js/main.js"></script>
	<script type="text/javascript">
		function previewImage(input) {
			if (input.files && input.files[0]) {
				var fileReader = new FileReader();
				var imageFile = input.files[0];
				
				
				if(imageFile.type == "image/png" || imageFile.type == "image/jpeg") {
					fileReader.readAsDataURL(imageFile);
					
					fileReader.onload = function (e) {
						$('#preview-image').attr('src', e.target.result);
					}
				}
				else {
					alert("Masukan File Gambar");
				}
			}
		}

		$("[name='file']").change(function(){
			previewImage(this);
		});
	</script>
</body>
</html>
<?php
	}
}
?>