<?php
$listmeja = getListMeja();

$nobill = getLastNobill(1);
// echo "<pre>";
// print_r(getKeranjang($_SESSION[id]));
// echo "</pre>";
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
					$sql  = "SELECT b.image,b.judul,b.deskripsi,b.estimasi_menu,b.harga_jual,b.diskon,a.jumlah_trx,a.total,a.hargadiskon,a.keranjang_id FROM t_keranjang a
					LEFT OUTER JOIN m_barang b on a.brg_id = b.brg_id
					WHERE a.user_id = '$_SESSION[id]' AND ip = '" . getRealIpAddr() . "' AND  pemesanan_id = 1";

					$sker = mysqli_query($koneksi, $sql);
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
											<a href="?i=" class="btn btn-info pull-center"><i class="fa fa-shopping-cart"></i> Pesan Sekarang</a>
										</center>
									</div>
								</div>
							</div>
						</table>
						<?php
						} else {

							while ($hker = mysqli_fetch_array($sker)) {
								$diskon = $hker['diskon'] / 100;
								$user_id = $hker['user_id'];
								$brg_id = $hker['brg_id'];
								$hrg = $hker['total'] / $hker['jumlah_trx'];
								?>
							<tr>
								<td class="cart_product">
									<a href=""><img class="img img-responsive" src="../<?php echo md5('admin') ?>/dist/img/buku/<?php echo $hker['image'] ?>" style="align-content: left; max-width: 50px;"></a>
								</td>
								<td class="cart_description">
									<h4>&nbsp;&nbsp;&nbsp;<?php echo $hker['judul'] ?></h4>
								</td>

								<td class="cart_price">
									<?php
											if ($hker['diskon'] > 0) {
												?>
										<p style="color:#F00">Rp. <strike><?php echo number_format($hker['harga_jual'], 0, ",", ".") ?></strike></p>
										<p>Rp. <?php echo number_format(kalkulasidiskon($hker['harga_jual'], $hker['diskon']), 0, ",", "."); ?></p>
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
										<a href="?i=<?php echo md5('min_jumlah') ?>&id=<?php echo $hker['keranjang_id'] ?> 
										<?php if ($hker['jumlah_trx'] == 1) {
													echo "class='not_allowed'";
												} else {
													echo "";
												}  ?>"> - </a>


										<input class="cart_quantity_input" type="text" name="quantity" value="<?php echo $hker['jumlah_trx'] ?>" autocomplete="off" size="2" disabled>

										<a class="cart_quantity_down" href="?i=<?php echo md5('plus_jumlah') ?>&id=<?php echo $hker['keranjang_id'] ?>"> + </a>
									</div>
								</td>
								<td class="cart_total">
									<p class="cart_total_price">Rp. <?php echo number_format($hker['total'], 0, ",", ".") ?></p>
								</td>

							</tr>
							<a>
								<td class="cart_delete">
									<a href="?i=<?php echo md5('del_keranjang') ?>&id=<?php echo $hker['keranjang_id'] ?>"><i class="fa fa-trash-o"></i> Hapus</a>
								</td>
							</a>
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
			<?php
			$srinc = mysqli_query($koneksi, "SELECT SUM(a.jumlah_trx) as aa, a.total as bb FROM t_keranjang a LEFT OUTER JOIN m_barang b on a.brg_id = b.brg_id	WHERE a.user_id = '$_SESSION[id]' AND ip = '" . getRealIpAddr() . "' AND pemesanan_id = '1'");

			$aa = mysqli_query($koneksi, "SELECT * FROM t_keranjang WHERE user_id = '$_SESSION[id]' AND pemesanan_id = '1' AND ip = '" . getRealIpAddr() . "' ");
			$bb = mysqli_num_rows($aa);
			$hrinc = mysqli_fetch_array($srinc);
			?>
			<div class="col-sm-6">
				<div class="total_area">
					<form method="POST" action="cek_proses.php">

						<input class="user" type="hidden" name="user" value="<?php echo $_SESSION['id']; ?>" autocomplete="off">
						<input type="hidden" name="totbayar" value="<?php echo getTotalPembayaran($_SESSION["id"]); ?>" autocomplete="off">

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
							Catatan Menu (Opsional)
							<br />
							<textarea name="catatan" id="catatan" class="form-control" placeholder="Contoh: Toping, Varian Rasa"></textarea><br />
							<br />
							<!-- <li>Total Bayar 
								Rp. <?php echo number_format(getTotalPembayaran($_SESSION["id"]), 0, ",", "."); ?></li> -->
							<li>
								<p style="font-weight: bold;">Total Menu <span><?php echo $hrinc['aa'] ?></span></p>
							</li>
							<li>
								<p style="font-size: 14pt; font-weight: bold; color: red;">Total Bayar <span>Rp. <?php echo number_format(getTotalPembayaran($_SESSION["id"]), 0, ",", "."); ?></span></p>
							</li>
							<br />

							<input type="submit" class="btn btn-info" name="pesan" id="pesan" value="Pesan Sekarang" <?php if ($bb == 0) {
																															echo "disabled";
																														} else {
																															echo "";
																														}  ?> />
						</ul>
					</form>

				</div>
			</div>
		</div>
	</div>
</section>
<!--/#do_action-->

<style type="text/css">
	.disabled {
		color: currentColor;
		pointer-events: none;
		cursor: not-allowed;
		opacity: 0.5;
		text-decoration: none;
	}

	.not_allowed {
		pointer-events: none;
		cursor: default;
	}

	a[disabled="disabled"] {
		pointer-events: none;
	}
</style>


<script>
	function myFunction() {
		Swal.fire({
			title: 'Mau tambah menu lagi?',
			animation: true,
			customClass: {
				popup: 'animated tada'
			},
			text: "Tidak, langsung proses",
			type: 'success',
			showCancelButton: true,
			cancelButtonColor: '#1E90FF',
			cancelButtonText: 'Tidak',
			confirmButtonColor: '#FFA500',
			confirmButtonText: 'Ya'
		}).then((result) => {
			if (result.value) {
				window.location = "?i=";
			} else {
				Swal.fire({
					title: 'Pesanan sedang di proses, mohon menunggu',
					animation: false,
					customClass: {
						popup: 'animated tada'
					},
					text: "lihat di menu pesanan untuk mengetahui status pesanan",
					type: 'success',
					showCancelButton: false,
					confirmButtonColor: '#FFA500',
					confirmButtonText: 'Oke'
				}).then((result) => {
					if (result.value) {
						window.location = "?i=bayar&id=<?php echo md5('byr') ?>";
					}
				})
			}
		})


	}
</script>