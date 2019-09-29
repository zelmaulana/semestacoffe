	<?php
	if (isset($_GET['id'])) {
		$a = md5('byr');
		$b = md5('drp');
		if ($_GET['id'] == $a) {
			$sqlex = mysqli_query($koneksi, "SELECT * FROM t_keranjang a
								  			 LEFT OUTER JOIN m_barang b on a.brg_id = b.brg_id
											 LEFT OUTER JOIN l_meja c on a.id_meja = c.id_meja
											 WHERE user_id = '$_SESSION[id]' AND pemesanan_id = '0'");
			while ($etc = mysqli_fetch_array($sqlex)) {
				mysqli_query($koneksi, "UPDATE m_barang SET stok = stok-'$etc[jumlah_trx]' WHERE brg_id = '$etc[brg_id]'");

				mysqli_query($koneksi, "UPDATE t_keranjang SET id_meja = '$_GET[nomeja]' WHERE id_meja = '$etc[id_meja]' ");
			}
			$sa = mysqli_query($koneksi, "SELECT * FROM m_alamat a
										  LEFT OUTER JOIN l_desa b on a.desa_id = b.desa_id
										  LEFT OUTER JOIN l_kecamatan c on a.kecamatan_id = c.kecamatan_id
										  LEFT OUTER JOIN l_kabupaten d on a.kabupaten_id = d.kabupaten_id
										  LEFT OUTER JOIN l_propinsi e on a.propinsi_id = e.propinsi_id
										  LEFT OUTER JOIN l_ongkir f on a.kabupaten_id = f.kabupaten_id
										  WHERE a.user_id = '$_SESSION[id]'");
			$na = mysqli_num_rows($sa);
			$ha = mysqli_fetch_array($sa);
			$srinc = mysqli_query($koneksi, "SELECT SUM(a.jumlah_trx) as aa, SUM(a.total) as bb FROM 							t_keranjang a LEFT OUTER JOIN m_barang b on a.brg_id = b.brg_id
									WHERE a.user_id = '$_SESSION[id]' AND pemesanan_id = '0'");
			$hrinc = mysqli_fetch_array($srinc);
			$tot = $ha['biaya'] + $hrinc['bb'];
			$time = date("Y-m-d");
			$tgl = date('Y-m-d G:i:s');
			mysqli_query($koneksi, "INSERT INTO t_pemesanan VALUES ('','$_SESSION[id]', '$ha[biaya]', '$hrinc[id_meja]', '$tot', '2', '$tgl', 'NULL', '1')");
			$maxq = mysqli_query($koneksi, "SELECT MAX(pemesanan_id) as aa FROM t_keranjang
								    		WHERE user_id = '$_SESSION[id]'");
			$max = mysqli_fetch_array($maxq);
			?>
			<script>
				//alert('Terimakasih Pesanan Anda Kami Terima, Silahkan Melakukan Pembayaran di Kasir');
				window.location = "?i=list_pemesanan";
			</script>
		<?php
			} else if ($_GET['id'] == $b) {
				$sqlex = mysqli_query($koneksi, "SELECT * FROM t_keranjang a
								  			 LEFT OUTER JOIN m_barang b on a.brg_id = b.brg_id
											 WHERE user_id = '$_SESSION[id]' AND pemesanan_id = '0'");
				while ($etc = mysqli_fetch_array($sqlex)) {
					mysqli_query($koneksi, "UPDATE m_barang SET stok = stok-'$etc[jumlah_trx]' WHERE brg_id = '$etc[brg_id]'");
				}
				$sa = mysqli_query($koneksi, "SELECT * FROM m_dropshiper a
										  LEFT OUTER JOIN l_desa b on a.desa_id = b.desa_id
										  LEFT OUTER JOIN l_kecamatan c on a.kecamatan_id = c.kecamatan_id
										  LEFT OUTER JOIN l_kabupaten d on a.kabupaten_id = d.kabupaten_id
										  LEFT OUTER JOIN l_propinsi e on a.propinsi_id = e.propinsi_id
										  LEFT OUTER JOIN l_ongkir f on a.kabupaten_id = f.kabupaten_id
										  LEFT OUTER JOIN t_pemesanan g on a.pemesanan_id = g.pemesanan_id
										  WHERE a.user_id = '$_SESSION[id]'");
				$na = mysqli_num_rows($sa);
				$ha = mysqli_fetch_array($sa);
				$srinc = mysqli_query($koneksi, "SELECT SUM(a.jumlah_trx) as aa, SUM(a.total) as bb FROM t_keranjang a
											 LEFT OUTER JOIN m_barang b on a.brg_id = b.brg_id
											 WHERE a.user_id = '$_SESSION[id]' AND pemesanan_id = '0'");
				$hrinc = mysqli_fetch_array($srinc);
				$tot = $ha['biaya'] + $hrinc['bb'];
				$time = date("Y-m-d");
				$tgl = date('Y-m-d G:i:s');
				mysqli_query($koneksi, "INSERT INTO t_pemesanan VALUES ('','$_SESSION[id]', '$ha[biaya]', '$hrinc[id_meja]', '$tot', '2', '$tgl', 'NULL', '2')");
				$maxq = mysqli_query($koneksi, "SELECT MAX(pemesanan_id) as aa FROM t_keranjang
								    		WHERE user_id = '$_SESSION[id]'");
				$max = mysqli_fetch_array($maxq);
				?>
			<script>
				alert('Terimakasih Pesanan Anda Kami Terima, Silahkan Melakukan Pembayaran di Kasir');
				window.location = "?i=list_pemesanan";
			</script>
		<?php
			} else { }
		}
		$val = array('jpg', 'jpeg', 'png');
		if (isset($_POST['simpan'])) {
			$img = $_FILES['file']['name'];
			$xa = strtolower(end(explode('.', $_FILES['file']['name'])));
			if (in_array($xa, $val)) {
				move_uploaded_file($_FILES['file']['tmp_name'], '../21232f297a57a5a743894a0e4a801fc3/dist/img/buktiBayar/' . $_FILES['file']['name']);
				mysqli_query($koneksi, "UPDATE t_pemesanan SET status_id = '2', bukti_pembayaran = '$img' WHERE pemesanan_id = '$_GET[idp]'");
				?>
			<script>
				alert("Berhasil Disimpan");
				window.location = "?i=<?php echo md5('v_buku') ?>";
			</script>
		<?php
			} else {
				?>
			<script>
				alert("Hanya Dapat Memilih File Gambar");
			</script>
	<?php
		}
	} else { }
	$maxq = mysqli_query($koneksi, "SELECT MAX(pemesanan_id) as aa FROM t_keranjang
								    WHERE user_id = '$_SESSION[id]'");
	$max = mysqli_fetch_array($maxq);
	$sqltotal = mysqli_query($koneksi, "SELECT * FROM t_pemesanan WHERE pemesanan_id = '$max[aa]' AND status_id = '1'");
	$total = mysqli_fetch_array($sqltotal);
	$tot = $total['total'];

	?>
	<section id="do_action">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<h3>Tata Cara Pembayaran</h3><br />
							<br />
							<br />
							<font>Di menu ATM, Pilih Transfer<br /> Pilih Transfer Ke Bank BRI<br /> Masukan Nomor Tujuan : <b>1792-01-005460-50-0(AN: Gilang Eksa Yuda)</b><br />Masukan Jumlah Transfer : <b>Rp. <?php echo $tot ?></b><br />Jika Sudah, Kirim Bukti Pembayaran<br /> </font><br />
							<?php
							$rr = mysqli_query($koneksi, "SELECT * FROM t_pemesanan WHERE pemesanan_id = '$_GET[idp]'");
							$rrr = mysqli_fetch_array($rr);
							$tgl = date('d-m-Y', strtotime('+6 hours', strtotime($rrr['tanggal'])));
							$time = date('G:i:s', strtotime('+6 hours', strtotime($rrr['tanggal'])));
							?>
							<font style="color:#E00">Lakukan Pembayaran Sebelum Tanggal <?php echo $tgl; ?> Pukul: <?php echo $time; ?> WIB </font>
							<br />
							<br />
							<h2 style="color:#E00"> PERHATIAN!!!</h2>
							<h2 style="color:#E00"> Pengiriman Hanya Melalui JNT</h2>
						</ul>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul class="user_option">
							<form action="" method="post" enctype="multipart/form-data">
								<label>Gambar/Foto</label>
								<div class="input-group date">
									<div style="border: 1px solid black; float: left;">
										<img id="preview-image" width="150px" src="../<?php echo md5('admin') ?>/dist/img/no-image.jpg" alt="your image will be placed here" />
									</div>
									<input type="file" name="file" accept="image/*" required />
								</div><br /><br />
								<button type="submit" name="simpan" class="btn btn-info fa fa-upload"> Upload</button>
							</form>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--/#do_action-->