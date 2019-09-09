<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<script type="text/javascript" src="ajax_daerah.js"></script>
<?php
if (isset($_POST['simpan'])) {
	$query1 = mysqli_query($koneksi, "SELECT * FROM m_alamat WHERE user_id = '$_SESSION[id]'");
	$data1 = mysqli_num_rows($query1);
	if ($data1 == 0) {
		mysqli_query($koneksi, "UPDATE m_user SET user_nama = '$_POST[nama]' WHERE user_id = '$_SESSION[id]'");
		mysqli_query($koneksi, "INSERT INTO m_alamat VALUES ('', '$_SESSION[id]', '$_POST[alamat]', '$_POST[kel]', '$_POST[rt]', '$_POST[rw]', '$_POST[kec]', '$_POST[kota]', '$_POST[prop]', '$_POST[kd_pos]')");
	} else {
		mysqli_query($koneksi, "UPDATE m_user SET user_nama = '$_POST[nama]' WHERE user_id = '$_SESSION[id]'");
		mysqli_query($koneksi, "UPDATE m_alamat SET alamat_spesifik='$_POST[alamat]', desa_id='$_POST[kel]', rt='$_POST[rt]', rw='$_POST[rw]', kecamatan_id='$_POST[kec]', kabupaten_id='$_POST[kota]', propinsi_id='$_POST[prop]', kode_pos='$_POST[kd_pos]' WHERE user_id = '$_SESSION[id]'");
	}
	?>
	<script>
		alert("Berhasil Disimpan");
		window.location = "?i=<?php echo $_GET['i'] ?>";
	</script>
<?php
}
?>
<section id="cart_items">
	<div class="container">
		<div class="table-responsive cart_info">
			<?php
			$suser = mysqli_query($koneksi, "SELECT * FROM m_alamat a
								  			 LEFT OUTER JOIN m_user b on a.user_id = b.user_id
											 WHERE a.user_id = '$_SESSION[id]'");
			$huser = mysqli_fetch_array($suser);
			?>
			<form action="" method="post">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td colspan="7" align="center">Silahkan Lengkapi Data Pribadi Anda untuk Dapatkan Special Diskon dari Kami</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td width="20%">Nama Lengkap</td>
							<td>:</td>
							<td><input type="text" class="col-sm-12" name="nama" value="<?php echo $huser['user_nama'] ?>" required /></td>
						</tr>
						<tr>
							<td>Alamat</td>
							<td>:</td>
							<td><input type="text" class="col-sm-12" name="alamat" value="<?php echo $huser['alamat_spesifik'] ?>" required /></td>
						</tr>
						<tr>
						<tr id="prop_box">
							<td>Provinsi</td>
							<td>:</td>
							<td>
								<select name="prop" id="prop" onChange="ajaxkota(this.value)" required>
									<option value="">Pilih Provinsi</option>
									<?php
									$queryProvinsi = mysqli_query($koneksi, "SELECT * FROM l_propinsi ORDER by propinsi_name");
									while ($dataProvinsi = mysqli_fetch_array($queryProvinsi)) {
										?><option value="<?php echo $dataProvinsi['propinsi_id'] ?>" <?php
																											if ($dataProvinsi['propinsi_id'] == $huser['propinsi_id']) {
																												echo "selected";
																											}
																											?>><?php echo $dataProvinsi['propinsi_name'] ?></option>
									<?php
									}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Kota/Kabupaten</td>
							<td>:</td>
							<td><select name="kota" id="kota" onchange="ajaxkec(this.value)" required>
									<option value="">Pilih Propinsi Terlebih Dahulu</option>
									<?php
									$skota = mysqli_query($koneksi, "SELECT * FROM l_kabupaten WHERE propinsi_id = '$huser[propinsi_id]' ORDER by kabupaten_name");
									while ($hkota = mysqli_fetch_array($skota)) {
										?>
										<option value="<?php echo $hkota['kabupaten_id'] ?>" <?php
																									if ($hkota['kabupaten_id'] == $huser['kabupaten_id']) {
																										echo "selected";
																									}
																									?>><?php echo $hkota['kabupaten_name'] ?></option>
									<?php
									}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Kecamatan</td>
							<td>:</td>
							<td><select name="kec" id="kec" onChange="ajaxkel(this.value)" required>
									<option value="">Pilih Kota/Kabupaten Terlebih Dahulu</option>
									<?php
									$skec = mysqli_query($koneksi, "SELECT * FROM l_kecamatan WHERE kabupaten_id = '$huser[kabupaten_id]' ORDER by kecamatan_name");
									while ($hkec = mysqli_fetch_array($skec)) {
										?>
										<option value="<?php echo $hkec['kecamatan_id'] ?>" <?php
																								if ($hkec['kecamatan_id'] == $huser['kecamatan_id']) {
																									echo "selected";
																								}
																								?>><?php echo $hkec['kecamatan_name'] ?></option>
									<?php
									}
									?>
								</select>
							</td>
							<td align="right" width="10%">Kode Pos</td>
							<td width="10%" id="kode_box"><input type="text" readonly="readonly" class="col-sm-12" name="kd_pos" id="kd_pos" value="<?php echo $huser['kode_pos'] ?>" required /></td>
						</tr>
						<tr>
							<td>Desa</td>
							<td>:</td>
							<td><select name="kel" id="kel" onChange="ajaxkd(this.value)" required>
									<option value="">Pilih Kecamatan Terlebih Dahulu</option>
									<?php
									$sdes = mysqli_query($koneksi, "SELECT * FROM l_desa WHERE kecamatan_id = '$huser[kecamatan_id]' ORDER BY desa_name asc");
									while ($hdes = mysqli_fetch_array($sdes)) {

										?>
										<option value="<?php echo $hdes['desa_id'] ?>" <?php
																							if ($hdes['desa_id'] == $huser['desa_id']) {
																								echo "selected";
																							}
																							?>><?php echo $hdes['desa_name'] ?></option>

									<?php
									}
									?>
								</select>
							</td>
							<td align="right">RT</td>
							<td width="10%"><input type="text" class="col-sm-12" name="rt" value="<?php echo $huser['rt'] ?>" required /></td>
							<td align="right">RW</td>
							<td width="10%"><input type="text" class="col-sm-12" name="rw" value="<?php echo $huser['rw'] ?>" required /></td>
						</tr>
					</tbody>

					<tr>
						<td>
						<input type="submit" name="simpan" id="simpan" class="btn btn-info" value="SIMPAN" />&nbsp;<a href="?i="><input type="button" name="kembali" id="kembali" class="btn btn-warning" value="KEMBALI" /></a>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</section>
<script>
	function ajaxkd(str) {
		var xhttp;
		if (str == "") {
			document.getElementById("kode_box").innerHTML = "";
			return;
		}
		xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("kode_box").innerHTML = this.responseText;
			}
		};
		xhttp.open("GET", "select_kdpos.php?q=" + str, true);
		xhttp.send();

	}

	function kode(kdpos) {
		document.getElementById("kd_pos").value = kdpos
	}
</script>