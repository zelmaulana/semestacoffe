<?php
$listmeja = getListMeja();



$cek = getKeranjang($_SESSION["id"]);
// echo "<pre>";
// print_r($cek);
// echo "</pre>";
?>



<section id="cart_items">
	<div class="container">
		<div class="table-responsive cart_info">
			<?php
			$sker = mysqli_query($koneksi, "SELECT * FROM t_keranjang a
	LEFT OUTER JOIN m_barang b on a.brg_id = b.brg_id
	WHERE a.user_id = '$_SESSION[id]' AND pemesanan_id = '0'");
			$nker = mysqli_num_rows($sker);
			//echo "<pre>";
			//print_r(mysqli_fetch_array($sker));
			//echo "</pre>";


			?>
			<table class="table table-condensed">
				<center>
					<h3>Daftar Pesanan</h3>
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

					<?php foreach ($cek as $hker) {	?>
						<!-- // -->
						<tr>
							<td class="cart_product">
								<a href=""><img src="../<?php echo md5('admin') ?>/dist/img/buku/<?php echo $hker['image'] ?>" style="max-height:50px" alt=""></a>

							</td>
							<td class="cart_description">
								<h4><?php echo $hker['judul'] ?></h4>
								<p>Diskon <?php echo $hker['diskon'] ?>%</p>

							</td>
							<td class="cart_price">
								<?php if ($hker['diskon'] > 0) { 	?>
									<p style="color:#F00">Rp. <strike><?php echo number_format($hker['harga_jual'], 0, ",", ".") ?></strike></p>
									<p>Rp. <?php echo number_format($hrg, 0, ",", ".") ?></p>
								<?php	} else { ?>
									<p>Rp. <?php echo number_format($hker['harga_jual'], 0, ",", ".") ?></p>
								<?php	} ?>

							</td>
							<td class="cart_quantity" width="15%">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" href="?i=<?php echo md5('min_jumlah') ?>&id=<?php echo $hker['keranjang_id'] ?>"> - </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="<?php echo $hker['jumlah_trx'] ?>" autocomplete="off" size="2">
									<a class="cart_quantity_down" href="?i=<?php echo md5('plus_jumlah') ?>&id=<?php echo $hker['keranjang_id'] ?>"> + </a>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">Rp. <?php echo number_format($hker['total'], 0, ",", ".") ?></p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="?i=<?php echo md5('del_keranjang') ?>&id=<?php echo $hker['keranjang_id'] ?>"><i class="fa fa-times"></i></a>

							</td>
						</tr>
					<?php } ?>



					<!-- <?php

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
									<p style="color:#F00">Rp. <strike><?php echo number_format($hker['harga_jual'], 0, ",", ".") ?></strike></p>
									<p>Rp. <?php echo number_format(($hker['total'] / $hker['jumlah_trx']), 0, ",", ".") ?></p>
								<?php
									} else {
										?>
									<p>Rp. <?php echo number_format($hker['harga_jual'], 0, ",", ".") ?></p>
								<?php
									}
									?>
							</td>
							<td class="cart_quantity" width="15%">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" href="?i=<?php echo md5('min_jumlah') ?>&id=<?php echo $hker['keranjang_id'] ?>"> - </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="<?php echo $hker['jumlah_trx'] ?>" autocomplete="off" size="2">
									<a class="cart_quantity_down" href="?i=<?php echo md5('plus_jumlah') ?>&id=<?php echo $hker['keranjang_id'] ?>"> + </a>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">Rp. <?php echo number_format($hker['total'], 0, ",", ".") ?></p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="?i=<?php echo md5('del_keranjang') ?>&id=<?php echo $hker['keranjang_id'] ?>"><i class="fa fa-times"></i></a>
							</td>
						</tr>
					<?php
					}
					?>
				</tbody> -->
			</table>
		</div>
	</div>
</section>
<!--/#cart_items-->
<section id="do_action">
	<div class="container">
		<div class="row">
			<!-- <div class="col-sm-6">
					<div class="chose_area">
						<ul>
                        Catatan Menu
                        <br />
						<textarea name="note" class="form-control"  required></textarea>
						</ul>
					</div>
				</div> -->
			<?php
			$srinc = mysqli_query($koneksi, "SELECT SUM(a.jumlah_trx) as aa, SUM(a.total) as bb FROM t_keranjang a LEFT OUTER JOIN m_barang b on a.brg_id = b.brg_id	WHERE a.user_id = '$_SESSION[id]' AND pemesanan_id = '0'");

			$aa = mysqli_query($koneksi, "SELECT * FROM t_keranjang WHERE user_id = '$_SESSION[id]' AND pemesanan_id = '0'");
			$bb = mysqli_num_rows($aa);
			$hrinc = mysqli_fetch_array($srinc);
			?>
			<div class="col-sm-6">
				<div class="total_area">
					<ul>
						Pilih No Meja
						<select style="width: 100px;" class="form-control" id="nomeja" name="nomeja" required>

							<?php
							foreach ($listmeja as $lm) {
								echo '<option value="' . $lm["kdMeja"] . ' ">' . $lm["nmMeja"] . '</option>';
							}
							?>

						</select>
						<br />
						Catatan Menu
						<br />
						<textarea name="catatan" id="catatan" class="form-control"></textarea><br />
						<li>Total Menu <span><?php echo $hrinc['aa'] ?></span></li>
						<li>Total Harga <span>Rp. <?php echo number_format($hrinc['bb'], 0, ",", ".") ?></span></li><br />
						<a href="?i=chekout"><button type="submit" class="btn-success" <?php if ($bb == 0) {
																							echo "disabled";
																						} else {
																							echo "";
																						} ?>>Pesan</button></a>
						<a href="?i="><button type="button" class="btn-warning">Tambah Menu</button></a>
					</ul>

				</div>
			</div>
		</div>
	</div>
</section>
<!--/#do_action-->