<?php
$sdata = mysqli_query($koneksi, "SELECT * FROM l_resi WHERE resi_id = '$_GET[id]'");
$data = mysqli_fetch_array($sdata);
if (isset($_POST['simpan'])) {
	$val = mysqli_query($koneksi, "SELECT * FROM l_resi WHERE no_resi = '$_POST[resi]'");
	$num = mysqli_num_rows($val);
	if ($num == 0) {
		mysqli_query($koneksi, "UPDATE l_resi SET no_resi = '$_POST[resi]' WHERE resi_id = '$_GET[id]'");
		?>
		<script>
			alert("Update Data Berhasil Disimpan");
			window.location = "?i=<?php echo md5('dikirim') ?>";
		</script>
		<?php
			} else {
				if ($data['no_resi'] == $_POST['resi']) {
					mysqli_query($koneksi, "UPDATE l_resi SET no_resi = '$_POST[resi]' WHERE resi_id = '$_GET[id]'");
					?>
			<script>
				alert("Update Data Berhasil Disimpan");
				window.location = "?i=<?php echo md5('dikirim') ?>";
			</script>
		<?php
				} else {
					?>
			<script>
				alert("Maaf Nomor Meja Sudah Terisi");
			</script>
<?php
		}
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
									<label>Ubah Nomor Meja</label>
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fa fa-shekel"></i>
										</div>
										<input type="text" class="form-control" name="resi" placeholder="Isi Disini" value="<?php echo $data['no_resi'] ?>" required>
									</div>
								</div>
								<button type="submit" class="btn btn-primary" name="simpan" id="submit">Simpan</button>
								<a href="?i=<?php echo md5('dikirim') ?>"><button type="button" class="btn btn-primary">Cancel</button> </a>
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