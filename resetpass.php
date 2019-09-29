<?php
session_start();
error_reporting(0);
if (isset($_POST["lanjut"])) {
	$s1 = mysqli_query($koneksi, "SELECT * FROM m_user WHERE user_email = '$_POST[email]'");
	$n1 = mysqli_num_rows($s1);
	$h1 = mysqli_fetch_array($s1);
	if ($n1 == 0) {
		?>
		<script>
			Swal.fire({
				title: 'Alamat E-Mail Tidak Terdaftar',
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

			?>
		<script>
			Swal.fire({
				title: 'Lanjut Reset Password??',
				animation: false,
				customClass: {
					popup: 'animated tada'
				},
				text: "",
				type: 'success',
				showCancelButton: true,
				confirmButtonColor: '#FFA500',
				confirmButtonText: 'Yaa',
				cancelButtonText: 'Batal'
			}).then((result) => {
				if (result.value) {
					window.location = "?i=<?php echo md5('reset') ?>&id=<?php echo $h1['user_id'] ?>";
				} else {
					window.location = "?i=<?php echo md5('login') ?>";
				}
			})
			//?i=bayar&id=<?php echo md5('byr') ?>
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
							<h2 style="font-weight: bold; color: orange;">Masukan Alamat E-Mail Anda</h2>
						</center>
						<form action="" method="post">
							<input type="email" name="email" class="form-control" placeholder="Alamat Email" required />
							<button type="submit" name="lanjut" class="btn btn-primary">Lanjut</button><br>
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