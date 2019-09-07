<?php
	session_start();
	error_reporting(0);
	if(isset($_POST["kirim"])){
		if($_POST['pass'] != $_POST['passconf']){
			?>
            <script>
			alert("Password Tidak Cocok");
			window.location = "?i=<?php echo md5('reset')?>";
			</script>
            <?php
		}
		else{
			$pass = md5($_POST['pass']);
			mysqli_query($koneksi, "UPDATE m_user SET user_password = '$pass' WHERE user_id = '$_SESSION[idver]'");
			?>
			<script>
				alert("Password Berhasil Diubah, Silahkan Login Kembali");
				window.location = "../lpip";
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
							<center><h2>Silahkan Masukan Password Baru</h2></center>
							<form action="" method="post">
								<input type="password" name="pass" minlength="6" class="form-control" placeholder="Password Baru" required />
								<input type="password" name="passconf" minlength="6" class="form-control" placeholder="Ulangi Password" required />
								<button type="submit" name="kirim" class="btn btn-primary">Kirim</button><br>
                                <a href="../lpip">Kembali Ke Halaman Login</a>
							</form>
						</div><!--/login form-->
					</div>
				</div>
			</div>
		</section>
<?php
	}
?>