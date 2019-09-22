<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<script type="text/javascript" src="ajax_daerah.js"></script>
<?php
if (isset($_POST['simpan'])) {
	$query1 = mysqli_query($koneksi, "SELECT * FROM m_alamat WHERE user_id = '$_SESSION[id]'");
	$data1 = mysqli_num_rows($query1);
	if ($data1 == 0) {
		mysqli_query($koneksi, "UPDATE m_user SET user_nama = '$_POST[nama]', user_ttl = '$_POST[ttl]', user_jeniskelamin = '$_POST[jk]' WHERE user_id = '$_SESSION[id]'");

		mysqli_query($koneksi, "INSERT INTO m_alamat VALUES ('', '$_POST[alamat]', '', '', '', '', '', '', '')");
	} else {
		mysqli_query($koneksi, "UPDATE m_user SET user_nama = '$_POST[nama]', user_ttl = '$_POST[ttl]', user_jeniskelamin = '$_POST[jk]'  WHERE user_id = '$_SESSION[id]'");

		mysqli_query($koneksi, "UPDATE m_alamat SET alamat_spesifik='$_POST[alamat]' WHERE user_id = '$_SESSION[id]'");
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
							<td colspan="7" align="center">
								<h4>Data Akun Anda</h4>
							</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="col-sm-3">
								<h4><u>Biodata</u></h4>
							</td>
							<td class="col-sm-0"></td>
							<td class="col-sm-12"></td>
						</tr>
						<tr>
							<td>Nama Lengkap</td>
							<td>:</td>
							<td><input type="text" class="form-control" name="nama" value="<?php echo $huser['user_nama'] ?>" required /></td>
						</tr>
						<tr>
							<td>Tanggal Lahir</td>
							<td>:</td>
							<td><input type="date" class="form-control" name="ttl" value="<?php echo $huser['user_ttl'] ?>" required /></td>
						</tr>
						<tr>
							<td>Jenis Kelamin</td>
							<td>:</td>
							<td>
								<input type="radio" name="jk" value="Laki-laki" checked> Laki-laki<br />
								<input type="radio" name="jk" value="Perempuan"> Perempuan
							</td>
						</tr>
						<tr>
							<td>
								<h4><u>Kontak</u></h4>
							</td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>Nomor HP</td>
							<td>:</td>
							<td><input type="text" class="form-control" name="nohp" value="<?php echo $huser['user_nohp'] ?>" required /></td>
						</tr>
						<tr>
							<td>Email</td>
							<td>:</td>
							<td><input type="text" class="form-control" name="email" value="<?php echo $huser['user_email'] ?>" required /></td>
						</tr>
						<tr>
							<td>Alamat</td>
							<td>:</td>
							<td>
								<textarea name="alamat" class="form-control" placeholder="Isikan Alamat Anda" required><?php echo $huser['alamat_spesifik'] ?></textarea>
							</td>
						</tr>

						<tr>
							<td></td>
							<td></td>
							<td><br />
								<input type="submit" name="simpan" id="simpan" class="btn btn-info" value="SIMPAN" />&nbsp;<a href="?i="><input type="button" name="kembali" id="kembali" class="btn btn-warning" value="KEMBALI" /></a>
							</td>
						</tr>

					</tbody>

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