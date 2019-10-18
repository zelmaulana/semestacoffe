<section>
	<div class="container">
		<div class="row">
			<?php
			$sbuku = mysqli_query($koneksi, "SELECT * FROM m_barang a
								  			 LEFT OUTER JOIN l_kategori b on a.kategori_id = b.kategori_id
											 WHERE brg_id = '$_GET[id]'");
			$hbuku = mysqli_fetch_array($sbuku);
			?>
			<div class="col-sm-12 padding-right">
				<div class="category-tab">
					<!--category-tab-->
					<div class="col-sm-12">
						<ul class="nav nav-tabs">
							<li style="font-size:30px;color:#FFF"></a></li>
						</ul>
					</div>
					<div class="tab-content">
						<div class="tab-pane fade active in">
							<div class="col-sm-2">
								<div class="">
									<div class="single-products">
										<div class="productinfo text-right">
											<img class="img img-responsive" src="../<?php echo md5('admin') ?>/dist/img/buku/<?php echo $hbuku['image'] ?>" style="align-content: center;" />
										</div>

									</div>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="">
									<div class="single-products">
										<div class="text-center">
											<h2><?php echo $hbuku['judul'] ?></h2>
											<p>(Estimasi Waktu Pesan: <?php echo $hbuku['estimasi_menu'] ?> menit)</p>
											<?php
											$diskon = $hbuku['diskon'] / 100;
											if ($diskon > 0) {

												$harga = $hbuku['harga_jual'] * $diskon;
												$hrg = $hbuku['harga_jual'] - $harga;

												?>
												<font style="color:red"><b>Rp. <strike><?php echo number_format($hbuku['harga_jual'], 0, ",", ".") ?></strike></b></font>
												<font>&nbsp;&nbsp;</font>
												<font><b> Rp. <?php echo number_format($hrg, 0, ",", ".") ?></b></font>
												<p></p>
											<?php
											} else {
												?>
												<p><b>Rp. <?php echo number_format($hbuku['harga_jual'], 0, ",", ".") ?></b></p>
											<?php
											}
											?>
											<p>Stok : <?php echo $hbuku['stok'] ?> <small>(<?php echo $hbuku['jml_terjual'] ?>)Terjual</small></p>

											<a href="?i=<?php echo md5('beli') ?>&idbrg=<?php echo $hbuku['brg_id'] ?>" class="btn btn-warning" <?php if ($hbuku['stok'] == 0) {
																																					echo "disabled";
																																				} else {
																																					echo "";
																																				} ?>><i class="fa fa-shopping-cart"></i>
												<?php if ($hbuku['stok'] == 0) {
													echo "Menu Habis";
												} else {
													echo "Pesan Sekarang";
												} ?> </a>
										</div><br />

									</div>
								</div>
							</div>
							<div class="col-sm-7">
								<div class="">
									<div class="single-products">
										<div class="table-responsive">
											<h2></h2>
											<table class="table">
												<tr>
													<!-- <th>Kategori Menu</th>
													<th>Diskon</th> 
													<th>Estimasi Waktu Pesan</th> -->
													<th>Deskripsi Menu</th>
												</tr>
												<tr>
													<!-- <td><?php echo $hbuku['kategori_name'] ?></td>
													<td><?php echo $hbuku['diskon'] ?>%</td> 
													<td><?php echo $hbuku['estimasi_menu'] ?></td> -->
													<td>
														<textarea class="form-control" readonly><?php echo $hbuku['deskripsi'] ?></textarea>
													</td>
												</tr>
											</table>
										</div>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--/category-tab-->
			</div>
		</div>
	</div>
</section><br /><br />