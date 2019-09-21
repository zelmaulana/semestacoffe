<section id="cart_items">
	<div class="container">
		<div class="table-responsive cart_info">

			<table class="table table-condensed">
				<center>
					<h3>Konfirmasi Pesanan</h3>
				</center>
				<thead>
					<tr class="cart_menu">
						<td class="image">Item</td>
						<td class="description"></td>
						<td class="price">Harga</td>
						<td class="quantity">Jumlah</td>
						<td class="total">Total</td>
						<td></td>
					</tr>
				</thead>
				<tbody>
					<?php
					$sker = mysqli_query($koneksi, "SELECT * FROM t_keranjang a
										 			LEFT OUTER JOIN m_barang b on a.brg_id = b.brg_id
													WHERE a.user_id = '$_SESSION[id]' AND pemesanan_id = '0'");
					$nker = mysqli_num_rows($sker);
					while ($hker = mysqli_fetch_array($sker)) {
						$hrg = $hker['total'] / $hker['jumlah_trx'];
						?>
						<tr>
							<td class="cart_product">
								<a href=""><img src="../<?php echo md5('admin') ?>/dist/img/buku/<?php echo $hker['image'] ?>" style="max-height:50px" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><?php echo $hker['judul'] ?></h4>
								<p>Diskon <?php echo $hker['diskon'] ?>%</p>
							</td>

							<td class="cart_price">
								<?php
									if ($hker['diskon'] > 0) {
										?>
									<p style="color:#F00">Rp. <strike><?php echo $hker['harga_jual'] ?></strike></p>
									<p>Rp. <?php echo number_format($hrg, 0, ',', '.') ?></p>
								<?php
									} else {
										?>
									<p>Rp. <?php echo number_format($hker['harga_jual'], 0, ',', '.') ?></p>
								<?php
									}
									?>
							</td>
							<td class="cart_quantity">
								<p style="text-align: center;"><?php echo $hker['jumlah_trx'] ?></p>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">Rp. <?php echo number_format($hker['total'], 0, ',', '.') ?></p>
							</td>
						</tr>
					<?php
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</section>
<!--/#cart_items-->
<?php
$sa = mysqli_query($koneksi, "SELECT * FROM m_alamat a
					   			  LEFT OUTER JOIN l_desa b on a.desa_id = b.desa_id
								  LEFT OUTER JOIN l_kecamatan c on a.kecamatan_id = c.kecamatan_id
								  LEFT OUTER JOIN l_kabupaten d on a.kabupaten_id = d.kabupaten_id
								  LEFT OUTER JOIN l_propinsi e on a.propinsi_id = e.propinsi_id
								  LEFT OUTER JOIN l_ongkir f on a.kabupaten_id = f.kabupaten_id
								  WHERE a.user_id = '$_SESSION[id]'");
$na = mysqli_num_rows($sa);
$ha = mysqli_fetch_array($sa);
?>
<section id="do_action">
	<div class="container">
		<div class="row">
			<!-- <div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
                        <?php
						if ($na == 0) {
							?>
							<h3 style="color:#E00">Isikan Alamat Terlebih Dahulu!!!</h3>
                            <font>Masuk Ke Menu "Akun", Lalu Isikan Data Alamat dengan lengkap dan benar</font>
                            <?php
							} else {
								?>
							<h3>Alamat Tujuan</h3><br />
                            <?php echo $ha['alamat_spesifik'] ?> Desa <?php echo $ha['desa_name'] ?>, RT <?php echo $ha['rt'] ?> RW <?php echo $ha['rw'] ?>, Kec. <?php echo $ha['kecamatan_name'] ?>, <?php echo $ha['kabupaten_name'] ?>, <?php echo $ha['propinsi_name'] ?> <?php echo $ha['kode_pos'] ?>
                            <p>
                            <br />
                            <br />
                            <h2 style="color:#E00"> PERHATIAN!!!</h2>
                            <h2 style="color:#E00"> Pengiriman Hanya Melalui JNT</h2>
                            <?php
							}
							?>
                            <br />
                            <br />
						</ul>
					</div>
				</div> -->
			<?php
			$srinc = mysqli_query($koneksi, "SELECT SUM(a.jumlah_trx) as aa, SUM(a.total) as bb, id_meja as mm FROM t_keranjang a LEFT OUTER JOIN m_barang b on a.brg_id = b.brg_id WHERE a.user_id = '$_SESSION[id]' AND pemesanan_id = '0'");

			$hrinc = mysqli_fetch_array($srinc);
			$bayar = $ha['biaya'] + $hrinc['bb'];

			print_r($hrinc['mm']);

			?>
			<div class="col-sm-6">
				<div class="total_area">
					<ul>
						No Meja
						<input style="width: 100px;" type="text" class="form-control" name="nomeja" id="nomeja" disabled value="<?php echo $hrinc['mm'] ?>" />

						<br />
						Catatan Menu
						<br />
						<textarea name="catatan" id="catatan" class="form-control" disabled></textarea><br />
						<li>Total Menu <span><?php echo $hrinc['aa'] ?></span></li>
						<li>Total Bayar <span>Rp. <?php echo number_format($bayar, 0, ',', '.') ?></span></li><br />
						<a href="?i=keranjang"><button type="button" class="btn-warning">Kembali ke Keranjang</button></a>
						<a href="?i=bayar&id=<?php echo md5('byr') ?>"><button type="button" class=" btn-info" <?php if ($na == 0) {
																													echo "disabled";
																												} else {
																													echo "";
																												} ?>>Checkout</button></a>

					</ul>

				</div>
			</div>
		</div>
	</div>
</section>
<!--/#do_action-->