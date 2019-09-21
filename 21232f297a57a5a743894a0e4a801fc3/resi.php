<?php
if (isset($_POST['simpan'])) {
	$val = mysqli_query($koneksi, "SELECT * FROM l_resi WHERE no_resi = '$_POST[resi]'");
	$num = mysqli_num_rows($val);
	if ($num == 0) {
		mysqli_query($koneksi, "INSERT INTO l_resi VALUES ('', '$_GET[id]', '$_POST[resi]')");
		mysqli_query($koneksi, "UPDATE t_pemesanan SET status_id = '4' WHERE pemesanan_id = '$_GET[id]'");
		?>
		<script>
			alert("Data Berhasil Disimpan");
			window.location = "?i=<?php echo md5('perlu-dikirim') ?>";
		</script>
	<?php
		} else {
			?>
		<script>
			alert("Maaf No Meja Sudah Terisi");
		</script>
<?php
	}
} else { }
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Form Pengiriman Pesanan
			<small>ADMIN</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-male"></i> Home</a></li>
			<li><a href="#">Form</a></li>
			<li class="active">Pengiriman</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<!-- left column -->
			<div class="col-md-12">
				<!-- SELECT2 EXAMPLE -->
				<div class="box box-default">
					<form action="" method="post" enctype="multipart/form-data">
						<div class="box-footer">
							<div class="col-md-5">
								<div class="form-group">
									<label>Masukan Nomor Meja</label>
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fa fa-shekel"></i>
										</div>
										<input type="text" class="form-control" name="resi" placeholder="Isi Disini" required>
									</div>
								</div>
								<button type="submit" class="btn btn-primary" name="simpan" id="submit">Simpan</button>
								<a href="?i=<?php echo md5('perlu-dikirim') ?>"><button type="button" class="btn btn-primary">Cancel</button> </a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- /.row -->
	</section>
	<!-- /.content -->
</div>