<section id="cart_items">
	<div class="container">
		<div class="table-responsive cart_info">
			<table class="table table-condensed">
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
					$sker = mysqli_query($koneksi, "SELECT b.image,b.judul,b.harga_jual,b.diskon,a.qty,a.total,a.hargadiskon,a.pemesanan_id,c.nomeja,c.catatan FROM t_pemesanan a LEFT OUTER JOIN m_barang b ON a.brg_id = b.brg_id LEFT OUTER JOIN t_order c ON a.nobill = c.nobill WHERE a.user_id = '$_SESSION[id]' AND pemesanan_id = '$_GET[id]' ");

					$nker = mysqli_num_rows($sker);
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
									<p style="color:#F00">Rp. <strike><?php echo number_format($hker['harga_jual'], 0, ',', '.') ?></strike></p>
									<p>Rp. <?php echo number_format($hker['hargadiskon'], 0, ',', '.') ?></p>
								<?php
									} else {
										?>
									<p>Rp. <?php echo number_format($hker['harga_jual'], 0, ',', '.') ?></p>
								<?php
									}
									?>
							</td>
							<td class="cart_quantity" width="15%">
								<p style="align-content: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<?php echo $hker['qty'] ?>)</p>
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
$val1 = mysqli_query($koneksi, "SELECT * FROM t_pemesanan WHERE pemesanan_id = '$_GET[id]'");
$hval1 = mysqli_fetch_array($val1);
if ($hval1['jenis_pemesanan_id'] == '1') {
	$sa = mysqli_query($koneksi, "SELECT * FROM m_alamat a
									  LEFT OUTER JOIN l_desa b on a.desa_id = b.desa_id
									  LEFT OUTER JOIN l_kecamatan c on a.kecamatan_id = c.kecamatan_id
									  LEFT OUTER JOIN l_kabupaten d on a.kabupaten_id = d.kabupaten_id
									  LEFT OUTER JOIN l_propinsi e on a.propinsi_id = e.propinsi_id
									  LEFT OUTER JOIN l_ongkir f on a.kabupaten_id = f.kabupaten_id
									  WHERE a.user_id = '$_SESSION[id]'");
} else if ($hval1['jenis_pemesanan_id'] == '2') {
	$sa = mysqli_query($koneksi, "SELECT * FROM m_dropshiper a
									  LEFT OUTER JOIN l_desa b on a.desa_id = b.desa_id
									  LEFT OUTER JOIN l_kecamatan c on a.kecamatan_id = c.kecamatan_id
									  LEFT OUTER JOIN l_kabupaten d on a.kabupaten_id = d.kabupaten_id
									  LEFT OUTER JOIN l_propinsi e on a.propinsi_id = e.propinsi_id
									  LEFT OUTER JOIN l_ongkir f on a.kabupaten_id = f.kabupaten_id
									  WHERE a.user_id = '$_SESSION[id]' AND pemesanan_id = '$_GET[id]'");
} else { }
$na = mysqli_num_rows($sa);
$ha = mysqli_fetch_array($sa);
?>
<section id="do_action">
	<div class="container">
		<div class="row">
			<?php
			$srinc = mysqli_query($koneksi, "SELECT b.image,b.judul,b.harga_jual,b.diskon,SUM(a.qty) as aa,SUM(a.total) as bb,a.hargadiskon,a.pemesanan_id,c.nomeja,c.catatan FROM t_pemesanan a LEFT OUTER JOIN m_barang b ON a.brg_id = b.brg_id LEFT OUTER JOIN t_order c ON a.nobill = c.nobill WHERE a.user_id = '$_SESSION[id]' AND pemesanan_id = '$_GET[id]' ");

			$hrinc = mysqli_fetch_array($srinc);
			$bayar = $ha['biaya'] + $hrinc['bb'];
			?>
			<div class="col-sm-6">
				<div class="total_area">
					<ul>
						No Meja
						<input style="width: 100px;" type="text" class="form-control" name="nomeja" id="nomeja" disabled value="<?php echo $hrinc['nomeja'] ?>" />

						<br />
						Catatan Menu
						<br />
						<textarea name="catatan" id="catatan" class="form-control" disabled><?php echo $hrinc['catatan'] ?></textarea><br /><br />
						<li>
							<p style="font-weight: bold;">Total Menu <span><?php echo $hrinc['aa'] ?></span></p>
						</li>
						<li>
							<p style="font-size: 14pt; font-weight: bold; color: red;">Total Bayar <span>Rp. <?php echo number_format($hrinc['bb'], 0, ',', '.'); ?></span></p>
						</li>
						<br />
						<a href="?i=list_pemesanan"><button type="button" class="btn btn-warning">Kembali</button></a>
					</ul>

				</div>
			</div>
		</div>
	</div>
</section>
<!--/#do_action-->