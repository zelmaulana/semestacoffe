<?php
	session_start();
	error_reporting(0);
	if(isset($_POST["daftar"])){
		$s1 = mysqli_query($koneksi, "SELECT * FROM m_user WHERE user_email = '$_POST[email]'");
		$n1 = mysqli_num_rows($s1);
		if($n1 == 0){
			if($_POST['password'] == $_POST['upass']){
				/*$a = rand(100000,999999);
				require_once('PHPMailer/PHPMailerAutoload.php');
				$mail = new PHPMailer(true);
				$mail->isSMTP();
				$mail->Host = 'smtp.gmail.com';
				$mail->SMTPAuth = true;
				$mail->Username = 'shopeerlpipump@gmail.com';
				$mail->Password = 'lpipshopeer23';
				$mail->SMTPSecure = 'ssl';
				$mail->Port = 465;
				$mail->setFrom('shopeerlpipump@gmail.com', 'Semesta Coffee');
				$mail->addReplyTo('shopeerlpipump@gmail.com', 'Semesta Coffee');
				$mail->addAddress($_POST['email']);
				$mail->Subject = 'VERIFIKASI AKUN';
				
				$mail->isHTML(true);
				$mailContent = "<h1>SELAMAT BERGABUNG </h1>
					<p>hai $_POST[nama]</p><br>
					<p>Tinggal 1 Lagkah Lagi Untuk Verifikasi Akun Anda</p><br>
					<p>Terimakasih telah bergabung bersama kami di <b>Semesta Coffe.</b><br>
					Nama : $_POST[nama] <br>
					No. HP : $_POST[nohp]<br>
					E-mail : $_POST[email]</p>
					<p>Silahkan Masukan Kode Dibawah Ini Dengan Benar Untuk Melakukan Verifikasi Akun Anda</p>
					<h2>$a</h2>";
				$mail->Body = $mailContent;*/




				if(!$mail->send()){
					echo 'Pesan tidak dapat dikirim.';
					echo 'Mailer Error: ' . $mail->ErrorInfo;
				}else{
					session_start();
					$pass = md5($_POST['password']);
					mysqli_query($koneksi, "INSERT INTO m_user VALUES ('', '$_POST[nama]', '$pass', '$_POST[nohp]', '$_POST[email]', 'nothing.png', '000', 'verif', '2')");
                    /*$s1 = mysqli_query($koneksi, "SELECT * FROM m_user WHERE user_email = '$_POST[email]'");
					$h1 = mysqli_fetch_array($s1);
					$_SESSION['idver'] = $h1['user_id'];*/
					?>
					<script>
						alert("Pendaftaran Berhasil, Silahkan Login Dengan Akun Anda");
						window.location = "?i=<?php echo md5('login')?>";
					</script>
					<?php
				}
			}
			else{
				?>
				<script>
                    alert("PASSWORD BERBEDA. MOHON KOREKSI PASSWORD DENGAN BENAR");
					window.location = "?i=<?php echo md5('regis')?>";
                </script>
                <?php
			}
		}
		else{
			?>
            <script>
				alert("MAAF E-EMAIL SUDAH TERDAFTAR, SILAHKAN LOGIN DENGAN AKUN ANDA");
				window.location = "?i=<?php echo md5('regis')?>";
			</script>
            <?php
		}
	}
	else {
		?>
		<section id=""><!--form-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4 col-sm-offset-4">
						<div class="login-form"><!--login form-->
							<center><h2 style="font-weight: bold; color: orange;">Isi Data Diri Anda Dengan Benar</h2></center>
							<form action="" method="post">
								<input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required />
								<input type="text" name="nohp" id="nohp" class="form-control" onKeyUp="Function()" placeholder="Nomor WhatsApp" required />
                                <script type="text/javascript">
				  					function Function(){
					  					var no = document.getElementById("nohp").value;
					 					var numberExp = /^[0-9]+$/;
										if(!no.match(numberExp)){
											document.getElementById("error").visibled=true;
											document.getElementById("error").value="Nomor WhatsApp Harus Diisi Dengan Angka";
											document.getElementById("daftar").disabled=true;
										}
										else if(no.match(numberExp)){
											document.getElementById("error").visibled=false;
											document.getElementById("error").value="";
											document.getElementById("daftar").disabled=false;
										};
										if(no == null || no == ""){
											document.getElementById("error").visibled=false;
											document.getElementById("error").value="";
											document.getElementById("daftar").disabled=false;
										}
									}
								</script>
								<input type="email" name="email" class="form-control" placeholder="Alamat E-Mail" required />
								<input type="password" name="password" class="form-control" placeholder="Password" minlength="6" required />
								<input type="password" name="upass" class="form-control" placeholder="Ulangi Password" minlength="6" required />
								<button type="submit" name="daftar" id="daftar" class="btn btn-primary">Daftar</button>
                                <input type="text" id="error" style="background-color:white; color:red;" readonly>Sudah Punya Akun? <a href="?i=<?php echo md5('login')?>">Login</a>
							</form>
						</div><!--/login form-->
					</div>
				</div>
			</div>
		</section>
	<?php
	}
	?>