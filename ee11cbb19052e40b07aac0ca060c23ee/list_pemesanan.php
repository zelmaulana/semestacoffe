<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 padding-right">
				<div class="category-tab">
					<!--category-tab-->
					<div class="col-sm-12">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#pesanan" data-toggle="tab">Daftar Pesanan</a></li>
							<li><a href="#proses" data-toggle="tab">Pesanan Diproses</a></li>
							<li><a href="#selesai" data-toggle="tab">Pesanan Selesai</a></li>
						</ul>
					</div>
					<div class="tab-content">
						<div class="tab-pane fade active in" id="pesanan">
							<?php
							$sqlnum = mysqli_query($koneksi, "SELECT a.*, b.* FROM t_pemesanan a
												  			  LEFT OUTER JOIN t_keranjang b on a.pemesanan_id = b.pemesanan_id
															  WHERE status_id = '2' AND a.user_id = '$_SESSION[id]'");

							$sqldata1 = mysqli_query($koneksi, "SELECT SUM(b.jumlah_trx) as jml FROM t_pemesanan a LEFT OUTER JOIN t_keranjang b on a.pemesanan_id = b.pemesanan_id
															   WHERE status_id = '2' AND a.user_id = '$_SESSION[id]'");

							$sqldata = mysqli_query($koneksi, "SELECT a.qty,a.total,a.hargadiskon,a.tanggal,a.pemesanan_id,b.nomeja,b.catatan FROM t_pemesanan a LEFT OUTER JOIN  t_order b ON a.nobill = b.nobill WHERE status_id = '2' AND user_id = '$_SESSION[id]' AND a.ip = '" . getRealIpAddr() . "'  ORDER BY pemesanan_id DESC");

							$jml = mysqli_fetch_array($sqldata1);
							$num = mysqli_num_rows($sqldata);
							$no = 1;
							if ($num == 0) {
								?>
								<div class="col-sm-12">
									<div class="product-image-wrapper">
										<div class="single-products">
											<center>
												<h3>Belum Ada Daftar Transaksi</h3>
												<p>Mulai pesan menu dan cek daftar transaksi Anda disini.</p>
												<a href="?i=" class="btn btn-info pull-center"><i class="fa fa-shopping-cart"></i> Pesan Sekarang</a>
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
												<div class="productinfo text-left">
													<h4><?php echo $no ?>. Menunggu Proses</h4>
													<p>Tanggal = <?php echo date('d-m-Y', strtotime($data['tanggal'])) ?> / <?php echo date('G:i:s', strtotime($data['tanggal'])) ?></p>

													<p style="color: red; font-weight: bold;">Total Bayar = Rp. <?php echo number_format($data['total'], 0, ',', '.') ?></p>
													<a href="?i=detail-pemesanan&id=<?php echo $data['pemesanan_id'] ?>" class="btn btn-warning btn-xs pull-left"><i class="fa fa-eye"></i> Detail Menu</a>
												</div>
											</div>
										</div>
									</div>
							<?php
									$no++;
								}
							}
							?>
						</div>
						<div class="tab-pane fade" id="proses">
							<?php
							$sqlnum = mysqli_query($koneksi, "SELECT a.*, b.* FROM t_pemesanan a
												  			  LEFT OUTER JOIN t_keranjang b on a.pemesanan_id = b.pemesanan_id
															  WHERE status_id = '4' AND a.user_id = '$_SESSION[id]'");

							$sqldata1 = mysqli_query($koneksi, "SELECT SUM(b.jumlah_trx) as jml FROM t_pemesanan a
												  			   LEFT OUTER JOIN t_keranjang b on a.pemesanan_id = b.pemesanan_id
															   WHERE status_id = '4' AND a.user_id = '$_SESSION[id]'");

							// $sqldata = mysqli_query($koneksi, "SELECT a.*, b.* FROM t_pemesanan a LEFT OUTER JOIN  t_order b ON a.nobill = b.nobill WHERE status_id = '3' AND user_id = '$_SESSION[id]' AND a.ip = '" . getRealIpAddr() . "'  ORDER BY pemesanan_id DESC");

							$sqldata = mysqli_query($koneksi, "SELECT a.qty,a.total,a.hargadiskon,a.tanggal,a.pemesanan_id,b.nomeja,b.catatan FROM t_pemesanan a LEFT OUTER JOIN  t_order b ON a.nobill = b.nobill WHERE status_id = '4' AND user_id = '$_SESSION[id]' AND a.ip = '" . getRealIpAddr() . "'  ORDER BY pemesanan_id DESC");

							$jml = mysqli_fetch_array($sqldata1);
							$num = mysqli_num_rows($sqldata);
							$no = 1;
							if ($num == 0) {
								?>
								<div class="col-sm-12">
									<div class="product-image-wrapper">
										<div class="single-products">
											<center>
												<h3>Belum Ada Daftar Transaksi</h3>
												<p>Mulai pesan menu dan cek daftar transaksi Anda disini.</p>
												<a href="?i=" class="btn btn-info pull-center"><i class="fa fa-shopping-cart"></i> Pesan Sekarang</a>
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
												<div class="productinfo text-left">
													<h4><?php echo $no ?>. Pesanan Diproses</h4>
													<p>Tanggal = <?php echo date('d-m-Y', strtotime($data['tanggal'])) ?> / <?php echo date('G:i:s', strtotime($data['tanggal'])) ?></p>

													<p style="color: red; font-weight: bold;">Total Bayar = Rp. <?php echo number_format($data['total'], 0, ',', '.') ?></p>
													<a href="?i=detail-pemesanan&id=<?php echo $data['pemesanan_id'] ?>" class="btn btn-warning btn-xs pull-left"><i class="fa fa-eye"></i> Detail Menu</a>
													&nbsp;
													<a href="tel:+62 8564 2988 418" class="btn btn-success btn-xs pull left"><i class="fa fa-phone"></i> Call Barista</a>
												</div>

											</div>
										</div>
									</div>
							<?php
									$no++;
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
												<h3>Belum Ada Daftar Transaksi</h3>
												<p>Mulai pesan menu dan cek daftar transaksi Anda disini.</p>
												<a href="?i=" class="btn btn-info pull-center"><i class="fa fa-shopping-cart"></i> Pesan Sekarang</a>
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
												<h3>Belum Ada Daftar Transaksi</h3>
												<p>Mulai pesan menu dan cek daftar transaksi Anda disini.</p>
												<a href="?i=" class="btn btn-info pull-center"><i class="fa fa-shopping-cart"></i> Pesan Sekarang</a>
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
							$sqlnum = mysqli_query($koneksi, "SELECT a.*, b.* FROM t_pemesanan a LEFT OUTER JOIN t_keranjang b on a.pemesanan_id = b.pemesanan_id WHERE status_id = '5' AND a.user_id = '$_SESSION[id]'");

							$sqldata1 = mysqli_query($koneksi, "SELECT SUM(b.jumlah_trx) as jml FROM t_pemesanan a
												  			   LEFT OUTER JOIN t_keranjang b on a.pemesanan_id = b.pemesanan_id
															   WHERE status_id = '5' AND a.user_id = '$_SESSION[id]'");

							// $sqldata = mysqli_query($koneksi, "SELECT a.*, b.* FROM t_pemesanan a LEFT OUTER JOIN  t_order b ON a.nobill = b.nobill WHERE status_id = '5' AND user_id = '$_SESSION[id]' AND a.ip = '" . getRealIpAddr() . "'  ORDER BY pemesanan_id DESC LIMIT 4");

							$sqldata = mysqli_query($koneksi, "SELECT a.qty,a.total,a.hargadiskon,a.tanggal,a.pemesanan_id,b.nomeja,b.catatan FROM t_pemesanan a LEFT OUTER JOIN  t_order b ON a.nobill = b.nobill WHERE status_id = '5' AND user_id = '$_SESSION[id]' AND a.ip = '" . getRealIpAddr() . "'  ORDER BY pemesanan_id DESC LIMIT 4");

							$jml = mysqli_fetch_array($sqldata1);
							$num = mysqli_num_rows($sqldata);
							$no = 1;
							if ($num == 0) {
								?>
								<div class="col-sm-12">
									<div class="product-image-wrapper">
										<div class="single-products">
											<center>
												<h3>Belum Ada Daftar Transaksi</h3>
												<p>Mulai pesan menu dan cek daftar transaksi Anda disini.</p>
												<a href="?i=" class="btn btn-info pull-center"><i class="fa fa-shopping-cart"></i> Pesan Sekarang</a>
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
												<div class="productinfo text-left">
													<h4><?php echo $no ?>. Pesanan Selesai</h4>
													<p>Tanggal = <?php echo date('d-m-Y', strtotime($data['tanggal'])) ?> / <?php echo date('G:i:s', strtotime($data['tanggal'])) ?></p>

													<p style="color: red; font-weight: bold;">Total Bayar = Rp. <?php echo number_format($data['total'], 0, ',', '.') ?></p>
													<a href="?i=detail-pemesanan&id=<?php echo $data['pemesanan_id'] ?>" class="btn btn-warning btn-xs pull-left"><i class="fa fa-eye"></i> Detail Menu</a>
												</div>

											</div>
										</div>
									</div>
							<?php
									$no++;
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