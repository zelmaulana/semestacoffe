<?php
$listmeja = getListMeja();

$cek = getKeranjang($_SESSION["id"]);
?>

<section id="cart_items">
	<div class="container">
		<div class="table-responsive cart_info">
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
					</tr>
				</thead>
				<tbody>

					<?php

					$sker = mysqli_query($koneksi, "SELECT * FROM t_keranjang a
					LEFT OUTER JOIN m_barang b on a.brg_id = b.brg_id
					WHERE a.user_id = '$_SESSION[id]' AND pemesanan_id = '0'");

					$nker = mysqli_num_rows($sker);

					if ($nker == 0) {
						?>
						<table class="table table-condensed">
							<div class="col-sm-12">
								<div class="product-image-wrapper">
									<div class="single-products">
										<center>
											<h4>Wah, keranjang menu kakak masih kosong ni..</h4>
											<p>Daripada dianggurin, mending isi dengan menu-menu spesial dari Semesta Coffee. Yuk, pesan sekarang.</p>
											<a href="?i=" class="btn btn-info pull-center"><i class="fa fa-shopping-cart"></i> Pesan Menu</a>
										</center>
									</div>
								</div>
							</div>
						</table>
						<?php
						} else {

							while ($hker = mysqli_fetch_array($sker)) {
								$hrg = $hker['total'] / $hker['jumlah_trx'];
								?>
							<tr>
								<td class="cart_product">
									<a href=""><img class="img img-responsive" src="../<?php echo md5('admin') ?>/dist/img/buku/<?php echo $hker['image'] ?>" style="align-content: left; max-width: 50px;"></a>
								</td>
								<td class="cart_description">
									<h4>&nbsp;&nbsp;&nbsp;<?php echo $hker['judul'] ?></h4>
									<p><br /></p>
									<!-- <p>Diskon <?php echo $hker['diskon'] ?>%</p> -->
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

							</tr>
							<tr>
								<td class="cart_delete">
									<a href="?i=<?php echo md5('del_keranjang') ?>&id=<?php echo $hker['keranjang_id'] ?>"><i class="fa fa-trash-o"></i> Hapus</a>
								</td>
							</tr>
					<?php
						}
					}
					?>
				</tbody>
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
						<select name="nomeja" id="nomeja" class="form-control" style="width: 100px;" required>
							<option value="">Pilih</option>
							<?php
							$sktgr = mysqli_query($koneksi, "SELECT * FROM l_meja");
							while ($hktgr = mysqli_fetch_array($sktgr)) {
								?>
								<option value="<?php echo $hktgr['id_meja'] ?>"><?php echo $hktgr['nama_meja'] ?></option>
							<?php
							}
							?>
						</select>
						<br />
						Catatan Menu
						<br />
						<textarea name="catatan" id="catatan" class="form-control"></textarea><br />
						<li>Total Menu <span><?php echo $hrinc['aa'] ?></span></li>
						<li>Total Harga <span>Rp. <?php echo number_format($hrinc['bb'], 0, ",", ".") ?></span></li><br />
						<!-- <a href="?i=chekout"><button type="submit" class="btn-info" <?php if ($bb == 0) {
																								echo "disabled";
																							} else {
																								echo "";
																							} ?>>Pesan</button></a> -->
						<input type="button" class="btn btn-info" name="pesan" id="pesan" onclick="myFunction()" value="Pesan" <?php if ($bb == 0) {
																																	echo "disabled";
																																} else {
																																	echo "";
																																} ?> />
					</ul>

				</div>
			</div>
		</div>
	</div>
</section>
<!--/#do_action-->


<script>
	function myFunction() {
		Swal.fire({
			title: 'Pesanan kakak akan kami proses, mau pesan lagi??',
			animation: true,
			customClass: {
				popup: 'animated tada'
			},
			text: "pilih proses untuk lanjut",
			type: 'success',
			showCancelButton: true,
			cancelButtonColor: '#1E90FF',
			cancelButtonText: 'Proses',
			confirmButtonColor: '#FFA500',
			confirmButtonText: 'Yaa'
		}).then((result) => {
			if (result.value) {
				window.location = "?i=";
			} else {
				Swal.fire({
					title: 'Terimakasih, Pesanan Kakak Kami Proses Yaa',
					animation: false,
					customClass: {
						popup: 'animated tada'
					},
					text: "silahkan bayar di kasir yaa kak",
					type: 'success',
					showCancelButton: false,
					confirmButtonColor: '#FFA500',
					confirmButtonText: 'Okey'
				}).then((result) => {
					if (result.value) {
						window.location = "?i=bayar&id=<?php echo md5('byr') ?>";
					}
				})
			}
		})

		// if (r == true) {
		// 	window.location = "?i=";
		// } else {
		// 	// alert('Terimakasih Pesanan Kakak Kami Proses, Silahkan Melakukan Pembayaran di Kasir ^__^');
		// 	// window.location = "?i=bayar&id=<?php echo md5('byr') ?>";


		// }
	}
</script>