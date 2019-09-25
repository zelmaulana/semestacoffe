<?php
session_start();
error_reporting(0);
if (isset($_POST["daftar"])) {
	$s1 = mysqli_query($koneksi, "SELECT * FROM m_user WHERE user_email = '$_POST[email]'");
	$n1 = mysqli_num_rows($s1);
	if ($n1 == 0) {
		if ($_POST['password'] == $_POST['upass']) {

			if ($n1 == 0) {
				session_start();
				$pass = md5($_POST['password']);
				mysqli_query($koneksi, "INSERT INTO m_user VALUES ('', '$_POST[nama]', '$pass', '$_POST[nohp]', '$_POST[email]', '', '', 'nothing.png', '000000', 'verif', '2')");

				mysqli_query($koneksi, "INSERT INTO m_alamat VALUES ('', '', '', '', '', '', '', '', '')");

				?>
				<script>
					// alert("Pendaftaran Akun Kakak Berhasil, Silahkan Login Yaa Kak");
					// window.location = "?i=<?php echo md5('login') ?>";

					Swal.fire({
						title: 'Pendaftaran Akun Kakak Berhasil',
						animation: false,
						customClass: {
							popup: 'animated tada'
						},
						text: "silahkan login dulu yaaa",
						type: 'success',
						showCancelButton: false,
						confirmButtonColor: '#FFA500',
						confirmButtonText: 'Yaa, login'
					}).then((result) => {
						if (result.value) {
							window.location = "?i=<?php echo md5('login') ?>";
						}
					})
				</script>
			<?php

						}
					} else {
						?>
			<script>
				// alert("Konfirmasi Password Anda Salah, Silahkan Ulang Kembali!");
				// window.location = "?i=<?php echo md5('regis') ?>";

				Swal.fire({
					title: 'Konfirmasi Password Kakak Salah',
					animation: false,
					customClass: {
						popup: 'animated tada'
					},
					text: "silahkan ulang lagi yaaa",
					type: 'warning',
					showCancelButton: false,
					confirmButtonColor: '#FFA500',
					confirmButtonText: 'Yaa, ulang'
				}).then((result) => {
					if (result.value) {
						window.location = "?i=<?php echo md5('regis') ?>";
					}
				})
			</script>
		<?php
				}
			} else {
				?>
		<script>
			// alert("Email Sudah Terdaftar, Silahkan Login Dengan Akun Anda.");
			// window.location = "?i=<?php echo md5('login') ?>";

			Swal.fire({
				title: 'Sorry Email Sudah Terdaftar Yaa',
				animation: false,
				customClass: {
					popup: 'animated tada'
				},
				text: "silahkan login dengan akun kamu yaaa",
				type: 'warning',
				showCancelButton: false,
				confirmButtonColor: '#FFA500',
				confirmButtonText: 'Yaa, login'
			}).then((result) => {
				if (result.value) {
					window.location = "?i=<?php echo md5('login') ?>";
				}
			})
		</script>
	<?php
		}
	} else {
		?>
	<section id="">
		<!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-4">
					<div class="login-form">
						<!--login form-->
						<center>
							<h2 style="font-weight: bold; color: orange;">Isi Data Diri Anda Dengan Benar</h2>
						</center>
						<form action="" method="post">
							<input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required />
							<input type="text" name="nohp" id="nohp" class="form-control" onKeyUp="Function()" placeholder="Nomor WhatsApp" required />
							<script type="text/javascript">
								function Function() {
									var no = document.getElementById("nohp").value;
									var numberExp = /^[0-9]+$/;
									if (!no.match(numberExp)) {
										document.getElementById("error").visibled = true;
										document.getElementById("error").value = "Nomor WhatsApp Harus Diisi Dengan Angka";
										document.getElementById("daftar").disabled = true;
									} else if (no.match(numberExp)) {
										document.getElementById("error").visibled = false;
										document.getElementById("error").value = "";
										document.getElementById("daftar").disabled = false;
									};
									if (no == null || no == "") {
										document.getElementById("error").visibled = false;
										document.getElementById("error").value = "";
										document.getElementById("daftar").disabled = false;
									}
								}
							</script>
							<input type="email" name="email" class="form-control" placeholder="Alamat E-Mail" required />
							<input type="password" name="password" id="password" class="form-control" placeholder="Password" minlength="6" required />
							<input type="password" name="upass" id="upass" class="form-control" placeholder="Ulangi Password" minlength="6" required />
							<!-- <i class="fa fa-eye-slash"></i> Show password -->
							<table>
								<tr>
									<td><input type="checkbox" style="width: 15px; height: 15px;" onclick="showPassword()"></td>
									<td>&nbsp;Show Password</td>
								</tr>
							</table>
							<button type="submit" name="daftar" id="daftar" class="btn btn-warning">Daftar</button>
							<input type="text" id="error" style="background-color:white; color:red;" readonly>Sudah Punya Akun? <a href="?i=<?php echo md5('login') ?>">Login</a>
						</form>
					</div>
					<!--/login form-->
				</div>
			</div>
		</div>
	</section>
<?php
}
?>

<script type="text/javascript">
	function showPassword() {
		var x = document.getElementById("password");
		var z = document.getElementById("upass");
		if (x.type === "password" && z.type === "password") {
			x.type = "text";
			z.type = "text";
		} else {
			x.type = "password";
			z.type = "password";
		}
	}
</script>