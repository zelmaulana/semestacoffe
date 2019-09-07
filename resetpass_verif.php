<?php
	session_start();
	error_reporting(0);
	if(isset($_POST["verif"])){
		$s1 = mysqli_query($koneksi, "SELECT * FROM m_user WHERE user_id = '$_SESSION[idver]'");
		$h1 = mysqli_fetch_array($s1);
		if($_POST['kode'] == $h1['no_verif']){
			?>
            <script>
				window.location = "?i=<?php echo md5('reset')?>";
			</script>
            <?php
		}
	}
	else {
		?>
			<section id=""><!--form-->
				<div class="container">
					<div class="row">
						<div class="col-sm-4 col-sm-offset-4" style="background-color:#DDD">
							<div class="login-form"><!--login form-->
							<center><h2>Masukan Kode Verifikasi</h2></center>
							<form action="" method="post">
								<input type="text" name="kode" class="form-control" placeholder="Masukan Kode Verifikasi" required />
								<button type="submit" name="verif" class="btn btn-primary">Verifikasi</button><br>Belum Mendapatkan Kode?<a href="kirim_ulang.php" style="color:#D00"> Kirim Ulang Kode</a><br> <a href="../lpip">Kembali Ke Menu Login</a>
							</form>
						</div><!--/login form-->
					</div>
				</div>
			</div>
		</section>
<?php
	}
?>