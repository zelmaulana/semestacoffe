<?php
	session_start();
	error_reporting(0);
	if(isset($_POST["lanjut"])){
		$s1 = mysqli_query($koneksi, "SELECT * FROM m_user WHERE user_email = '$_POST[email]'");
		$n1 = mysqli_num_rows($s1);
		$h1 = mysqli_fetch_array($s1);
		if($n1 == 0){
			?>
            <script>
			alert("Alamat E-Mail Tidak Terdaftar, Silahkan Cek Kembali Alamat E-Mail Anda dan Masukan Dengan Benar");
			window.location = "?i=<?php echo md5('resetpass')?>";
			</script>
            <?php
		}
		else{
			$_SESSION['idver'] = $h1['user_id'];
			$s2 = mysqli_query($koneksi, "SELECT * FROM m_user WHERE user_id = '$_SESSION[idver]'");
			$h2 = mysqli_fetch_array($s2);
			$c = rand(100000,999999);
			require_once('PHPMailer/PHPMailerAutoload.php');
			$mail = new PHPMailer(true);
			$mail->isSMTP();
			$mail->Host = 'smtp.gmail.com';
			$mail->SMTPAuth = true;
			$mail->Username = 'shopeerlpipump@gmail.com';
			$mail->Password = 'lpipshopeer23';
			$mail->SMTPSecure = 'ssl';
			$mail->Port = 465;
			$mail->setFrom('shopeerlpipump@gmail.com', 'PENDAFTARAN OLNINE SMK LPPM RI 2 KEDUNGREJA');
			$mail->addReplyTo('shopeerlpipump@gmail.com', 'PENDAFTARAN OLNINE SMK LPPM RI 2 KEDUNGREJA');
			$mail->addAddress($h2['user_email']);
			$mail->Subject = 'VERIFIKASI AKUN';
			$mail->isHTML(true);
			$mailContent = "<h1>SELAMAT DATANG</h1>
							<p>Hai $h2[user_nama]</p><br>
							<center><p>Terimakasih telah membuat akun di sistem pendaftaran online peserta didik baru<b>SMK LPPM RI 2 Kedungreja</b><br>
							<p>Reset Password Anda</p><br></center>
							   Nama : $h2[user_nama] <br>
				  			   No. HP : $h2[user_nohp]<br>
							   E-mail : $h2[user_email]</p>
							<p>Silahkan Masukan Kode Dibawah Ini Dengan Benar Untuk Melakukan Verifikasi Akun</p>
							<center><h2>$c</h2></center>";
			$mail->Body = $mailContent;
			if(!$mail->send()){
				?>
				<script>
				alert("Pesan Tidak Terkirim, Pastikan Alamat E-Mail Benar");
				window.location = "?i=<?php echo md5('resetpass')?>";
				</script>
				<?php
				session_destroy();
				echo 'Mailer Error: ' . $mail->ErrorInfo;
			}
			else{
				mysqli_query($koneksi, "UPDATE m_user SET no_verif = '$c' WHERE user_id = '$_SESSION[idver]'");
				?>
				<script>
					alert("Silahkan Cek Email Anda Untuk Verifikasi");
					window.location = "?i=<?php echo md5('resetpass_verif')?>";
				</script>
				<?php
			}
		}
	}
	else {
		?>
        <section id=""><!--form-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4 col-sm-offset-4" style="background-color:#DDD">
						<div class="login-form"><!--login form-->
							<center><h2>Masukan Alamat E-Mail Anda</h2></center>
							<form action="" method="post">
								<input type="email" name="email" class="form-control" placeholder="Alamat Email" required />
								<button type="submit" name="lanjut" class="btn btn-primary">Lanjut</button><br>
                                <a href="javascript: history.go(-1)">Kembali Ke Halaman Login</a>
							</form>
						</div><!--/login form-->
					</div>
				</div>
			</div>
		</section>
<?php
	}
?>