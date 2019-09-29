<?php
session_start();
error_reporting(0);
$id = $_GET['id'];
if (isset($_POST["kirim"])) {
	if ($_POST['pass'] != $_POST['passconf']) {
		?>
		<script>
			Swal.fire({
				title: 'Password Tidak Sama Kakak..',
				animation: false,
				customClass: {
					popup: 'animated tada'
				},
				text: "silahkan coba lagi yaa",
				type: 'warning',
				showCancelButton: false,
				confirmButtonColor: '#FFA500',
				confirmButtonText: 'Yaa'
			}).then((result) => {
				if (result.value) {
					window.location = "?i=<?php echo md5('resetpass') ?>";
				}
			})
		</script>
	<?php
		} else {
			$pass = md5($_POST['pass']);
			mysqli_query($koneksi, "UPDATE m_user SET user_password = '$pass' WHERE user_id = '$id'");
			?>
		<script>
			Swal.fire({
				title: 'Yeaay Password Berhasil Diubah',
				animation: false,
				customClass: {
					popup: 'animated tada'
				},
				text: "silahkan login yaa",
				type: 'success',
				showCancelButton: false,
				confirmButtonColor: '#FFA500',
				confirmButtonText: 'Yaa'
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
					<?php

						$suser = mysqli_query($koneksi, "SELECT * FROM m_user
											 WHERE user_id = '$id'");
						$huser = mysqli_fetch_array($suser);
						?>
					<div class="login-form">
						<!--login form-->
						<center>
							<h2 style="font-weight: bold; color: orange;">Silahkan Masukan Password Baru</h2>
						</center>
						<form action="" method="post">
							<input type="text" name="email" id="email" value="<?php echo $huser['user_email'] ?>" readonly /> 
							<input type="password" name="pass" id="pass" minlength="6" class="form-control" placeholder="Password Baru" required />
							<input type="password" name="passconf" id="passconf" minlength="6" class="form-control" placeholder="Ulangi Password" required />
							<table>
								<tr>
									<td><input type="checkbox" style="width: 15px; height: 15px;" onclick="showPassword()"></td>
									<td>&nbsp;Show Password</td>
								</tr>
							</table>
							<button type="submit" name="kirim" id="kirim" class="btn btn-primary">Reset</button><br>
							<a href="?i=<?php echo md5('login') ?>">Kembali Ke Halaman Login</a>
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
		var x = document.getElementById("pass");
		var z = document.getElementById("passconf");
		if (x.type === "password" && z.type === "password") {
			x.type = "text";
			z.type = "text";
		} else {
			x.type = "password";
			z.type = "password";
		}
	}
</script>