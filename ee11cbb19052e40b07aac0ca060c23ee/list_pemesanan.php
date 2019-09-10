<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 padding-right">
				<div class="category-tab">
					<!--category-tab-->
					<div class="col-sm-12">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#belumbayar" data-toggle="tab">Pesanan</a></li>
							<li><a href="#lunas" data-toggle="tab">Menunggu</a></li>
							<!-- <li><a href="#proses" data-toggle="tab">Menunggu Pengiriman</a></li>
								<li><a href="#dikirim" data-toggle="tab">Dikirim</a></li> -->
							<li><a href="#selesai" data-toggle="tab">Selesai</a></li>
						</ul>
					</div>
					<div class="tab-content">
						<div class="tab-pane fade active in" id="belumbayar">
							<?php
							$sqlnum = mysqli_query($koneksi, "SELECT a.*, b.* FROM t_pemesanan a
												  			  LEFT OUTER JOIN t_keranjang b on a.pemesanan_id = b.pemesanan_id
															  WHERE status_id = '1' AND a.user_id = '$_SESSION[id]'");
							$sqldata1 = mysqli_query($koneksi, "SELECT SUM(b.jumlah_trx) as jml FROM t_pemesanan a
												  			   LEFT OUTER JOIN t_keranjang b on a.pemesanan_id = b.pemesanan_id
															   WHERE status_id = '1' AND a.user_id = '$_SESSION[id]'");
							$sqldata = mysqli_query($koneksi, "SELECT * FROM t_pemesanan 
															   WHERE status_id = '1' AND user_id = '$_SESSION[id]'");
							$num = mysqli_num_rows($sqlnum);
							if ($num == 0) {
								?>
								<div class="col-sm-12">
									<div class="product-image-wrapper">
										<div class="single-products">
											<center>
												<h2>Tidak Ada Data</h2>
											</center>
										</div>
									</div>
								</div>
								<?php
								} else {
									while ($data = mysqli_fetch_array($sqldata)) {
										$tot = $data['total'] - $data['ongkos_kirim'];
										?>
									<div class="col-sm-3">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-right">
													<center>
														<h2>Tagihan Pembayaran</h2>
													</center>
													<p>Total Belanja = Rp. <?php echo $tot ?></p>
													<p>Ongkos Kirim = Rp. <?php echo $data['ongkos_kirim'] ?></p>
													<p>Total Bayar = Rp. <?php echo $data['total'] ?></p>
													<a href="?i=detail-pemesanan&id=<?php echo $data['pemesanan_id'] ?>" class="btn btn-default add-to-cart btn-xs pull-left"><i class="fa fa-eye"></i>Detail Barang</a>
													<a href="?i=bayar&idp=<?php echo $data['pemesanan_id'] ?>" class="btn btn-default add-to-cart btn-xs "><i class="fa fa-money"></i>Bayar Tagihan</a>
												</div>

											</div>
										</div>
									</div>
							<?php
								}
							}
							?>
						</div>
						<div class="tab-pane fade" id="lunas">
							<?php
							$sqlnum = mysqli_query($koneksi, "SELECT a.*, b.* FROM t_pemesanan a
												  			  LEFT OUTER JOIN t_keranjang b on a.pemesanan_id = b.pemesanan_id
															  WHERE status_id = '2' AND a.user_id = '$_SESSION[id]'");
							$sqldata1 = mysqli_query($koneksi, "SELECT SUM(b.jumlah_trx) as jml FROM t_pemesanan a
												  			   LEFT OUTER JOIN t_keranjang b on a.pemesanan_id = b.pemesanan_id
															   WHERE status_id = '2' AND a.user_id = '$_SESSION[id]'");
							$sqldata = mysqli_query($koneksi, "SELECT * FROM t_pemesanan 
															   WHERE status_id = '2' AND user_id = '$_SESSION[id]'");
							$num = mysqli_num_rows($sqlnum);
							if ($num == 0) {
								?>
								<div class="col-sm-12">
									<div class="product-image-wrapper">
										<div class="single-products">
											<center>
												<h2>Tidak Ada Data</h2>
											</center>
										</div>
									</div>
								</div>
								<?php
								} else {
									while ($data = mysqli_fetch_array($sqldata)) {
										$tot = $data['total'] - $data['ongkos_kirim'];
										?>
									<div class="col-sm-3">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-right">
													<center>
														<h2>Tagihan Pembayaran</h2>
													</center>
													<p>Total Belanja = Rp. <?php echo $tot ?></p>
													<p>Ongkos Kirim = Rp. <?php echo $data['ongkos_kirim'] ?></p>
													<p>Total Bayar = Rp. <?php echo $data['total'] ?></p>
													<a href="?i=detail-pemesanan&id=<?php echo $data['pemesanan_id'] ?>" class="btn btn-default add-to-cart btn-xs pull-right"><i class="fa fa-eye"></i>Detail Barang</a>
												</div>

											</div>
										</div>
									</div>
							<?php
								}
							}
							?>
						</div>
						<div class="tab-pane fade" id="proses">
							<?php
							$sqlnum = mysqli_query($koneksi, "SELECT a.*, b.* FROM t_pemesanan a
												  			  LEFT OUTER JOIN t_keranjang b on a.pemesanan_id = b.pemesanan_id
															  WHERE status_id = '3' AND a.user_id = '$_SESSION[id]'");
							$sqldata1 = mysqli_query($koneksi, "SELECT SUM(b.jumlah_trx) as jml FROM t_pemesanan a
												  			   LEFT OUTER JOIN t_keranjang b on a.pemesanan_id = b.pemesanan_id
															   WHERE status_id = '3' AND a.user_id = '$_SESSION[id]'");
							$sqldata = mysqli_query($koneksi, "SELECT * FROM t_pemesanan
															   WHERE status_id = '3' AND user_id = '$_SESSION[id]'");
							$num = mysqli_num_rows($sqlnum);
							if ($num == 0) {
								?>
								<div class="col-sm-12">
									<div class="product-image-wrapper">
										<div class="single-products">
											<center>
												<h2>Tidak Ada Data</h2>
											</center>
										</div>
									</div>
								</div>
								<?php
								} else {
									while ($data = mysqli_fetch_array($sqldata)) {
										$tot = $data['total'] - $data['ongkos_kirim'];
										?>
									<div class="col-sm-3">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-right">
													<center>
														<h2>Tagihan Pembayaran</h2>
													</center>
													<p>Total Belanja = Rp. <?php echo $tot ?></p>
													<p>Ongkos Kirim = Rp. <?php echo $data['ongkos_kirim'] ?></p>
													<p>Total Bayar = Rp. <?php echo $data['total'] ?></p>
													<a href="?i=detail-pemesanan&id=<?php echo $data['pemesanan_id'] ?>" class="btn btn-default add-to-cart btn-xs pull-right"><i class="fa fa-eye"></i>Detail Barang</a>
												</div>

											</div>
										</div>
									</div>
							<?php
								}
							}
							?>
						</div>
						<div class="tab-pane fade" id="dikirim">
							<?php
							$sqlnum = mysqli_query($koneksi, "SELECT a.*, b.* FROM t_pemesanan a
												  			  LEFT OUTER JOIN t_keranjang b on a.pemesanan_id = b.pemesanan_id
															  WHERE status_id = '4' AND a.user_id = '$_SESSION[id]'");
							$sqldata1 = mysqli_query($koneksi, "SELECT SUM(b.jumlah_trx) as jml FROM t_pemesanan a
												  			   LEFT OUTER JOIN t_keranjang b on a.pemesanan_id = b.pemesanan_id
															   WHERE status_id = '4' AND a.user_id = '$_SESSION[id]'");
							$sqldata = mysqli_query($koneksi, "SELECT * FROM t_pemesanan a
															   LEFT OUTER JOIN l_resi c on a.pemesanan_id = c.pemesanan_id
															   WHERE a.status_id = '4' AND a.user_id = '$_SESSION[id]'");
							$num = mysqli_num_rows($sqlnum);
							if ($num == 0) {
								?>
								<div class="col-sm-12">
									<div class="product-image-wrapper">
										<div class="single-products">
											<center>
												<h2>Tidak Ada Data</h2>
											</center>
										</div>
									</div>
								</div>
								<?php
								} else {
									while ($data = mysqli_fetch_array($sqldata)) {
										$tot = $data['total'] - $data['ongkos_kirim'];
										?>
									<div class="col-sm-3">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-right">
													<center>
														<h2>Tagihan Pembayaran</h2>
													</center>
													<p>Total Belanja = Rp. <?php echo $tot ?></p>
													<p>Ongkos Kirim = Rp. <?php echo $data['ongkos_kirim'] ?></p>
													<p>Total Bayar = Rp. <?php echo $data['total'] ?></p>
													<p>Nomor Resi = <?php echo $data['no_resi'] ?></p>
													<a href="?i=diterima&id=<?php echo $data['pemesanan_id'] ?>" onclick="return konf()" class="btn btn-default add-to-cart btn-xs" style="width:100%"><i class="fa fa-check"></i>Diterima</a>
													<a href="?i=detail-pemesanan&id=<?php echo $data['pemesanan_id'] ?>" class="btn btn-default add-to-cart btn-xs pull-left"><i class="fa fa-eye"></i>Detail Barang</a>
													<a href="http://www.jet.co.id/track" target="new" class="btn btn-default add-to-cart btn-xs pull-right"><i class="fa fa-eye"></i>Cek Resi</a>
													<script type="text/javascript" language="javascript">
														function konf() {
															tanya = confirm("Apakah Anda Yakin Bahwa Barang Sudah Diterima?");
															if (tanya == true) return true;
															else return false;
														}
													</script>
												</div>

											</div>
										</div>
									</div>
							<?php
								}
							}
							?>
						</div>
						<div class="tab-pane fade" id="selesai">
							<?php
							$sqlnum = mysqli_query($koneksi, "SELECT a.*, b.* FROM t_pemesanan a
												  			  LEFT OUTER JOIN t_keranjang b on a.pemesanan_id = b.pemesanan_id
															  WHERE status_id = '5' AND a.user_id = '$_SESSION[id]'");
							$sqldata1 = mysqli_query($koneksi, "SELECT SUM(b.jumlah_trx) as jml FROM t_pemesanan a
												  			   LEFT OUTER JOIN t_keranjang b on a.pemesanan_id = b.pemesanan_id
															   WHERE status_id = '5' AND a.user_id = '$_SESSION[id]'");
							$sqldata = mysqli_query($koneksi, "SELECT * FROM t_pemesanan
															   WHERE status_id = '5' AND user_id = '$_SESSION[id]'");
							$num = mysqli_num_rows($sqlnum);
							if ($num == 0) {
								?>
								<div class="col-sm-12">
									<div class="product-image-wrapper">
										<div class="single-products">
											<center>
												<h2>Tidak Ada Data</h2>
											</center>
										</div>
									</div>
								</div>
								<?php
								} else {
									while ($data = mysqli_fetch_array($sqldata)) {
										$tot = $data['total'] - $data['ongkos_kirim'];
										?>
									<div class="col-sm-3">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-right">
													<center>
														<h2>Tagihan Pembayaran</h2>
													</center>
													<p>Total Belanja = Rp. <?php echo $tot ?></p>
													<p>Ongkos Kirim = Rp. <?php echo $data['ongkos_kirim'] ?></p>
													<p>Total Bayar = Rp. <?php echo $data['total'] ?></p>
													<a href="?i=detail-pemesanan&id=<?php echo $data['pemesanan_id'] ?>" class="btn btn-default add-to-cart btn-xs pull-right"><i class="fa fa-eye"></i>Detail Barang</a>
												</div>

											</div>
										</div>
									</div>
							<?php
								}
							}
							?>
						</div>
					</div>
				</div>
				<!--/category-tab-->
			</div>
		</div>
	</div>
</section>