<?php
session_start();
error_reporting(0);
if (isset($_POST["login"])) {
	require_once("koneksi.php");
	if (isset($_POST["email"]) and isset($_POST["password"])) {
		$email = $_POST["email"];
		$password = md5($_POST["password"]);
		if ($email == "" || $password == "") {
			echo "<script>alert('Form Harus Diisi')</script>";
		} else {
			$login_query  = mysqli_query($koneksi, "SELECT * FROM m_user WHERE user_email = '$_POST[email]'");
			$login_num_rows = mysqli_num_rows($login_query);
			if ($login_num_rows > 0) {
				$login_fetch_array  = mysqli_fetch_assoc($login_query);
				if ($password == $login_fetch_array['user_password']) {
					if ($login_fetch_array['status'] == 'verif') {
						$_SESSION['id'] = $login_fetch_array['user_id'];
						$p = md5('home');
						header("Location: login_val.php?lv=$login_fetch_array[level_id]");
					} else {
						$_SESSION['idver'] = $login_fetch_array['user_id'];
						?>
						<script>
							alert("Maaf, Akun Anda Belum di Verifikasi, Silahkan Verifikasi Akun Anda");
							window.location = "?i=<?php echo md5('verif') ?>";
						</script>
					<?php
										}
									} else {
										?>
					<script>
						Swal.fire({
							title: 'Maaf password kamu salah,',
							animation: false,
							customClass: {
								popup: 'animated tada'
							},
							text: "silahkan ulangi lagi",
							type: 'warning',
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
								}
							} else {
								?>
				<script>
					Swal.fire({
						title: 'Maaf username kamu tidak terdaftar,',
						animation: false,
						customClass: {
							popup: 'animated tada'
						},
						text: "silahkan daftar",
						type: 'warning',
						showCancelButton: false,
						confirmButtonColor: '#FFA500',
						confirmButtonText: 'Oke'
					}).then((result) => {
						if (result.value) {
							window.location = "?i=<?php echo md5('regis') ?>";
						}
					})
				</script>
<?php
			}
		}
	} else {
		header("location: ./?login=gagal");
	}
} else { }
?>
<section id="">
	<!--form-->
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-sm-offset-4">
				<div class="login-form">
					<!--login form-->
					<center>
						<h2 style="font-weight: bold; color: orange;">Masuk ke Akun Kamu</h2>
					</center>
					<form action="" method="post">
						<input type="email" name="email" class="form-control" placeholder="Alamat Email" required />
						<input type="password" name="password" id="password" class="form-control" placeholder="Password" required />
						<!-- <i class="fa fa-eye-slash"></i> Show password -->
						<table>
							<tr>
								<td><input type="checkbox" style="width: 15px; height: 15px;" onclick="showPassword()"></td>
								<td>&nbsp;Show Password</td>
							</tr>
						</table>
						<table>
							<tr>
								<td><button type="submit" name="login" class="btn btn-warning">Masuk</button></td>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td><a href="?i=<?php echo md5('regis') ?>"><button type="button" name="regis" class="btn btn-warning">Daftar</button></a></td>
							</tr>
						</table>
						<a href="?i=<?php echo md5('resetpass') ?>" style="color:#D00"><br>Lupa Password</a><br>Belum Punya Akun? <a href="?i=<?php echo md5('regis') ?>">Daftar</a>
					</form>
				</div>
				<!--/login form-->
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	function showPassword() {
		var x = document.getElementById("password");
		if (x.type === "password") {
			x.type = "text";
		} else {
			x.type = "password";
		}
	}
</script>