<?php
$val = array('jpg', 'jpeg', 'png');
if (isset($_POST['simpan'])) {
	$valdiskon = $_POST['diskon'] / 100;
	$valdiskon1 = $_POST['harga_jual'] * $valdiskon;
	$diskon = $_POST['harga_jual'] - $valdiskon1;
	if ($diskon < $_POST['harga_beli']) {
		?>
		<script>
			alert("Maaf Diskon Terlalu Besar, Menyebabkan Harga Jual Lebih Rendah Daripada Harga Beli (RUGI)");
			window.location = "?i=<?php echo $_GET['i'] ?>";
		</script>
		<?php
			} else {
				$img = $_FILES['file']['name'];
				$x = strtolower(end(explode('.', $_FILES['file']['name'])));
				if (in_array($x, $val)) {
					move_uploaded_file($_FILES['file']['tmp_name'], 'dist/img/buku/' . $_FILES['file']['name']);
					mysqli_query($koneksi, "INSERT INTO m_barang VALUES ('', '$_POST[judul]', '$_POST[estimasi]', '', 'Null', 'Null', '$_POST[stok]', '1', '$_POST[kategori]', '', '',  '$_POST[harga_beli]', '$_POST[harga_jual]', '', '$_POST[diskon]', '', '', '$img', '$_POST[deskripsi]')");

					?>
			<script>
				window.location = "?i=<?php echo md5('v_buku') ?>";
				alert("Data Berhasil Disimpan");
			</script>
		<?php
				} else {
					?>
			<script>
				alert("Hanya Dapat Memilih File Gambar");
			</script>
<?php
		}
	}
} else {
	echo "hhhhhh";
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Form Tambah Menu Produk
			<small>ADMIN</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-male"></i> Home</a></li>
			<li><a href="#">Forms</a></li>
			<li class="active">Tambah Data</li>
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
									<label>Nama Menu</label>
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fa fa-shekel"></i>
										</div>
										<input type="text" class="form-control" name="judul" placeholder="Isi Disini" required>

									</div>
								</div>
								<div class="form-group">
									<label>Kategori Menu</label>
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fa fa-shekel"></i>
										</div>
										<select name="kategori" class="form-control" required>
											<option value="">Pilih Kategori Menu</option>
											<?php
											$sktgr = mysqli_query($koneksi, "SELECT * FROM l_kategori");
											while ($hktgr = mysqli_fetch_array($sktgr)) {
												?>
												<option value="<?php echo $hktgr['kategori_id'] ?>"><?php echo $hktgr['kategori_name'] ?></option>
											<?php
											}
											?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label>Estimasi Menu (Waktu)</label>
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fa fa-shekel"></i>
										</div>
										<input type="text" class="form-control" name="estimasi" placeholder="Isi Disini" required>

									</div>
								</div>
								<!-- <div class="form-group">
								<label>Penerbit</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-shekel"></i>
									</div>
									<select name="penerbit" class="form-control select2" required>
										<option value="">==Penerbit==</option>
										<?php
										$spenerbit = mysqli_query($koneksi, "SELECT * FROM l_penerbit");
										while ($hpenerbit = mysqli_fetch_array($spenerbit)) {
											?>
											<option value="<?php echo $hpenerbit['penerbit_id'] ?>"><?php echo $hpenerbit['penerbit_name'] ?></option>
                          				  <?php
											}
											?>
                 					 </select>
								</div>
							</div> -->
								<!-- <div class="form-group">
								<label>Tahun Terbit</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-shekel"></i>
									</div>
									<input type="number" class="form-control" name="thn_terbit" placeholder="Isi Disini" required>
								</div>
							</div> -->
								<!-- <div class="form-group">
								<label>Kota Terbit</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-shekel"></i>
									</div>
									<input type="text" class="form-control" name="kota_terbit" placeholder="Isi Disini" required>
								</div>
							</div> -->
								<!-- <div class="form-group">
								<label>Penulis</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-shekel"></i>
									</div>
									<select name="penulis" class="form-control select2" required>
										<option value="">==Penulis==</option>
										<?php
										$spenulis = mysqli_query($koneksi, "SELECT * FROM l_penulis");
										while ($hpenulis = mysqli_fetch_array($spenulis)) {
											?>
											<option value="<?php echo $hpenulis['penulis_id'] ?>"><?php echo $hpenulis['penulis_name'] ?></option>
                          				  <?php
											}
											?>
                 					 </select>
								</div>
							</div> -->
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Stok</label>
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fa fa-shekel"></i>
										</div>
										<input type="number" class="form-control" name="stok" placeholder="Isi Disini" required>
									</div>
								</div>
								<div class="form-group">
									<label>Harga Beli</label>
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fa fa-shekel"></i>
										</div>
										<input type="text" class="form-control" name="harga_beli" placeholder="Isi Disini" required>
									</div>
								</div>
								<div class="form-group">
									<label>Harga Jual</label>
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fa fa-shekel"></i>
										</div>
										<input type="text" class="form-control" name="harga_jual" placeholder="Isi Disini" required>
									</div>
								</div>
								<div class="form-group">
									<label>Diskon</label>
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fa fa-shekel"></i>
										</div>
										<input type="text" class="form-control" name="diskon" placeholder="Isi Disini" required>
									</div>
								</div>
								<!-- <div class="form-group">
								<label>Berat</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-shekel"></i>
									</div>
									<input type="number" class="form-control" name="berat" placeholder="Isi Disini"  required>
								</div>
							</div> -->
								<!-- <div class="form-group">
								<label>Jumlah Halaman</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-shekel"></i>
									</div>
									<input type="number" class="form-control" name="jumlah_halaman" placeholder="Isi Disini" required >
								</div>
							</div> -->
								<button type="submit" class="btn btn-primary" name="simpan" id="submit">Simpan</button>
								<a href="?i=<?php echo md5('v_buku') ?>"><button type="button" class="btn btn-primary">Cancel</button> </a>
							</div>
							<div class="col-xs-3">
								<div class="form-group">
									<label>Gambar/Foto</label>
									<div class="input-group date">
										<div style="border: 1px solid black; float: left;">
											<img id="preview-image" width="150px" src="dist/img/no-image.jpg" alt="your image will be placed here" />
										</div>
										<input type="file" name="file" accept="image/*" required />
									</div>
								</div>
								<div class="form-group">
									<label>Deskripsi Menu</label>
									<div class="input-group date">
										<textarea name="deskripsi" class="form-control" style="width:220px;height:200px" required></textarea>
									</div>
								</div>
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