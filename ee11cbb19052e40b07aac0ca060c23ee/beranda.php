<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Kategori Menu</h2>
                        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                        	<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a href="?i=&kat=all">
											<span class="badge pull-right"><i class="fa fa-coffee"></i>&nbsp;<i class="fa fa-cutlery"></i>&nbsp;<i class="fa fa-beer"></i></span> 
											All Menu
										</a>
									</h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a href="?i=&id=1&kat=all">
											<span class="badge pull-right"><i class="fa fa-coffee"></i></span> 
											Single Original
										</a>
									</h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a href="?i=&id=2&kat=all">
											<span class="badge pull-right"><i class="fa fa-coffee"></i></span> 
											Espresso Based
										</a>
									</h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a href="?i=&id=3&kat=all">
											<span class="badge pull-right"><i class="fa fa-beer"></i></span> 
											Milk Based
										</a>
									</h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a href="?i=&id=4&kat=all">
											<span class="badge pull-right"><i class="fa fa-cutlery"></i></span> 
											Food		
										</a>
									</h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a href="?i=&id=5&kat=all">
											<span class="badge pull-right"><i class="fa fa-cutlery"></i></span> 
											Snack		
										</a>
									</h4>
								</div>
							</div>
                         </div>
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="category-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#rekomendasi" data-toggle="tab">Menu Terbaru</a></li>
								<li><a href="#terlaris" data-toggle="tab">Terlaris</a></li>
								<!-- <li><a href="#diskon" data-toggle="tab">Diskon</a></li> -->
							</ul>
						</div>
                        <?php
						if(isset($_GET['id'])){
							if($_GET['id'] == '1' || $_GET['id'] == '2' || $_GET['id'] == '3' || $_GET['id'] == '4' || $_GET['id'] == '5'){
								if($_GET['kat'] != 'all'){
								?>
								<div class="tab-content">
									<div class="tab-pane fade active in" id="rekomendasi" >
									<?php
									$sbarang = mysqli_query($koneksi, "SELECT * FROM m_barang a LEFT OUTER JOIN l_kategori b on a.kategori_id = b.kategori_id WHERE a.kategori_id = '$_GET[id]' AND a.kategori_id = '$_GET[kat]' AND a.judul LIKE '%$_POST[cari]%' ");
									while ($hbarang = mysqli_fetch_array($sbarang)){
										?>
										<div class="col-sm-3">
											<div class="product-image-wrapper">
											<div class="single-products">
													<div class="productinfo text-center">
														<a href="?i=detail-barang&id=<?php echo $hbarang['brg_id']?>"><img src="../<?php echo md5('admin')?>/dist/img/buku/<?php echo $hbarang['image']?>" alt="" style="width:auto;height:80px" /></a>
														<?php
														$diskon = $hbarang['diskon'] / 100;
														if($diskon > 0){
															
														$harga = $hbarang['harga_jual'] * $diskon;
														$hrg = $hbarang['harga_jual'] - $harga;
                                                        
														?>
														<h2>Rp. <strike><?php echo number_format($hbarang['harga_jual'],0,',','.')?></strike><p> disc <?php echo $hbarang['diskon'] ?>% </p></h2>
                                                        
                                                        <p style="color:orange; font-weight: bold;">Rp. <?php echo number_format($hrg,0,',','.') ?></p>
                                                        <?php
														}
														else{
															?>
															<h2>Rp. <?php echo number_format($hbarang['harga_jual'],0,',','.')?><p>&nbsp;</p></h2>
                                                            <p>&nbsp;</p>
                                                            <?php
														}
														?>
														<p><?php echo $hbarang['judul']?></p>
														<p><small>(Klik Gambar Melihat Detail Menu)</small></p>
														<!-- <p>(<?php echo $hbarang['kategori_name']?>)</p> -->
														<a href="?i=<?php echo md5('beli')?>&idbrg=<?php echo $hbarang['brg_id']?>" class="btn btn-warning" <?php if ($hbarang['stok'] == 0) {
																																									echo "disabled";
																																								} else {
																																									echo "";
																																								} ?>><i class="fa fa-shopping-cart"></i>
														<?php if ($hbarang['stok'] == 0) {
															echo "Menu Habis";
														} else {
															echo "Pesan Menu";
														} ?></a>
													</div>
													
												</div>
											</div>
										</div>
										<?php
									}
									?>
									</div>
									<div class="tab-pane fade" id="terlaris" >
									<?php
									$sbarang = mysqli_query($koneksi, "SELECT * FROM m_barang a LEFT OUTER JOIN l_kategori b on a.kategori_id = b.kategori_id WHERE a.kategori_id = '$_GET[id]' AND a.jml_terjual > '10' AND a.kategori_id = '$_GET[id]' AND a.kategori_id = '$_GET[kat]' AND a.judul LIKE '%$_POST[cari]%'");
									while ($hbarang = mysqli_fetch_array($sbarang)){
										?>
										<div class="col-sm-3">
											<div class="product-image-wrapper">
											<div class="single-products">
													<div class="productinfo text-center">
														<a href="?i=detail-barang&id=<?php echo $hbarang['brg_id']?>"><img src="../<?php echo md5('admin')?>/dist/img/buku/<?php echo $hbarang['buku_image']?>" alt="" style="width:auto;height:80px" /></a>
														<?php
														$diskon = $hbarang['diskon'] / 100;
														if($diskon > 0){
															
														$harga = $hbarang['harga_jual'] * $diskon;
														$hrg = $hbarang['harga_jual'] - $harga;
                                                        
														?>
														<h2>Rp. <strike><?php echo number_format($hbarang['harga_jual'],0,',','.')?></strike><p> disc <?php echo $hbarang['diskon'] ?>% </p></h2>
                                                        
                                                        <p style="color:orange; font-weight: bold;">Rp. <?php echo number_format($hrg,0,',','.') ?></p>
                                                        <?php
														}
														else{
															?>
															<h2>Rp. <?php echo number_format($hbarang['harga_jual'],0,',','.')?><p>&nbsp;</p></h2>
                                                            <p>&nbsp;</p>
                                                            <?php
														}
														?>
														<p><?php echo $hbarang['judul']?></p>
														<p><small>(Klik Gambar Melihat Detail Menu)</small></p>
														<!-- <p>(<?php echo $hbarang['kategori_name']?>)</p> -->
														<a href="?i=<?php echo md5('beli')?>&idbrg=<?php echo $hbarang['brg_id']?>" class="btn btn-warning" <?php if ($hbarang['stok'] == 0) {
																																									echo "disabled";
																																								} else {
																																									echo "";
																																								} ?>><i class="fa fa-shopping-cart"></i> 
														<?php if ($hbarang['stok'] == 0) {
															echo "Menu Habis";
														} else {
															echo "Pesan Menu";
														} ?></a>
													</div>
													
												</div>
											</div>
										</div>
										<?php
									}
									?>
									</div>
									<div class="tab-pane fade" id="diskon" >
									<?php
									$sbarang = mysqli_query($koneksi, "SELECT * FROM m_barang a
																   LEFT OUTER JOIN l_jenis b on a.jenis_id = b.jenis_id
																   WHERE a.jenis_id = '$_GET[id]' AND diskon > '1' AND jenis_id = '$_GET[id]' AND kategori_id = '$_GET[kat]' AND judul LIKE '%$_POST[cari]%'");
									while ($hbarang = mysqli_fetch_array($sbarang)){
										?>
										<div class="col-sm-3">
											<div class="product-image-wrapper">
											<div class="single-products">
													<div class="productinfo text-center">
														<a href="?i=detail-barang&id=<?php echo $hbarang['brg_id']?>"><img src="../<?php echo md5('admin')?>/dist/img/buku/<?php echo $hbarang['buku_image']?>" alt="" style="width:auto;height:80px" /></a>
														<?php
														$diskon = $hbarang['diskon'] / 100;
														if($diskon > 0){
															
														$harga = $hbarang['harga_jual'] * $diskon;
														$hrg = $hbarang['harga_jual'] - $harga;
                                                        
														?>
														<h2>Rp. <strike><?php echo number_format($hbarang['harga_jual'],0,',','.')?></strike><p> disc <?php echo $hbarang['diskon'] ?>% </p></h2>
                                                        
                                                        <p style="color:orange; font-weight: bold;">Rp. <?php echo number_format($hrg,0,',','.') ?></p>
                                                        <?php
														}
														else{
															?>
															<h2>Rp. <?php echo number_format($hbarang['harga_jual'],0,',','.')?><p>&nbsp;</p></h2>
                                                            <p>&nbsp;</p>
                                                            <?php
														}
														?>
														<p><?php echo $hbarang['judul']?></p>
														<p><small>(Klik Gambar Melihat Detail Menu)</small></p>
														<!-- <p>(<?php echo $hbarang['kategori_name']?>)</p> -->
														<a href="?i=<?php echo md5('beli')?>&idbrg=<?php echo $hbarang['brg_id']?>" class="btn btn-warning" <?php if ($hbarang['stok'] == 0) {
																																									echo "disabled";
																																								} else {
																																									echo "";
																																								} ?>><i class="fa fa-shopping-cart"></i> 
														<?php if ($hbarang['stok'] == 0) {
															echo "Menu Habis";
														} else {
															echo "Pesan Menu";
														} ?></a>
													</div>
													
												</div>
											</div>
										</div>
										<?php
									}
									?>
									</div>
								</div>
								<?php
								}
								else{
									?>
                                    <div class="tab-content">
                                        <div class="tab-pane fade active in" id="rekomendasi" >
                                        <?php
                                        $sbarang = mysqli_query($koneksi, "SELECT * FROM m_barang a LEFT OUTER JOIN l_kategori b on a.kategori_id = b.kategori_id WHERE a.kategori_id = '$_GET[id]' AND a.judul LIKE '%$_POST[cari]%' ");
                                        while ($hbarang = mysqli_fetch_array($sbarang)){
                                            ?>
                                            <div class="col-sm-3">
                                                <div class="product-image-wrapper">
												<div class="single-products">
                                                        <div class="productinfo text-center">
														<a href="?i=detail-barang&id=<?php echo $hbarang['brg_id']?>"><img src="../<?php echo md5('admin')?>/dist/img/buku/<?php echo $hbarang['image']?>" alt="" style="width:auto;height:80px" /></a>
                                                            <?php
														$diskon = $hbarang['diskon'] / 100;
														if($diskon > 0){
															
														$harga = $hbarang['harga_jual'] * $diskon;
														$hrg = $hbarang['harga_jual'] - $harga;
                                                        
														?>
														<h2>Rp. <strike><?php echo number_format($hbarang['harga_jual'],0,',','.')?></strike><p> disc <?php echo $hbarang['diskon'] ?>% </p></h2>
                                                        
                                                        <p style="color:orange; font-weight: bold;">Rp. <?php echo number_format($hrg,0,',','.') ?></p>
                                                        <?php
														}
														else{
															?>
															<h2>Rp. <?php echo number_format($hbarang['harga_jual'],0,',','.')?><p>&nbsp;</p></h2>
                                                            <p>&nbsp;</p>
                                                            <?php
														}
														?>
															<p><?php echo $hbarang['judul']?></p> 
															<p><small>(Klik Gambar Melihat Detail Menu)</small></p>
															<!-- <p>(<?php echo $hbarang['kategori_name']?>)</p> -->
                                                            <a href="?i=<?php echo md5('beli')?>&idbrg=<?php echo $hbarang['brg_id']?>" class="btn btn-warning" <?php if ($hbarang['stok'] == 0) {
																																									echo "disabled";
																																								} else {
																																									echo "";
																																								} ?>><i class="fa fa-shopping-cart"></i> 
														<?php if ($hbarang['stok'] == 0) {
															echo "Menu Habis";
														} else {
															echo "Pesan Menu";
														} ?></a>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        </div>
                                        <div class="tab-pane fade" id="terlaris" >
                                        <?php
                                        $sbarang = mysqli_query($koneksi, "SELECT * FROM m_barang a LEFT OUTER JOIN l_kategori b on a.kategori_id = b.kategori_id WHERE a.kategori_id = '$_GET[id]' AND a.jml_terjual > '10' AND a.judul LIKE '%$_POST[cari]%'");
                                        while ($hbarang = mysqli_fetch_array($sbarang)){
                                            ?>
                                            <div class="col-sm-3">
                                                <div class="product-image-wrapper">
												<div class="single-products">
                                                        <div class="productinfo text-center">
														<a href="?i=detail-barang&id=<?php echo $hbarang['brg_id']?>"><img src="../<?php echo md5('admin')?>/dist/img/buku/<?php echo $hbarang['image']?>" alt="" style="width:auto;height:80px" /></a>
                                                            <?php
														$diskon = $hbarang['diskon'] / 100;
														if($diskon > 0){
															
														$harga = $hbarang['harga_jual'] * $diskon;
														$hrg = $hbarang['harga_jual'] - $harga;
                                                        
														?>
														<h2>Rp. <strike><?php echo number_format($hbarang['harga_jual'],0,',','.')?></strike><p> disc <?php echo $hbarang['diskon'] ?>% </p></h2>
                                                        
                                                        <p style="color:orange; font-weight: bold;">Rp. <?php echo number_format($hrg,0,',','.') ?></p>
                                                        <?php
														}
														else{
															?>
															<h2>Rp. <?php echo number_format($hbarang['harga_jual'],0,',','.')?><p>&nbsp;</p></h2>
                                                            <p>&nbsp;</p>
                                                            <?php
														}
														?>
															<p><?php echo $hbarang['judul']?></p> 
															<p><small>(Klik Gambar Melihat Detail Menu)</small></p>
															<!-- <p>(<?php echo $hbarang['kategori_name']?>)</p> -->
                                                            <a href="?i=<?php echo md5('beli')?>&idbrg=<?php echo $hbarang['brg_id']?>" class="btn btn-warning" <?php if ($hbarang['stok'] == 0) {
																																									echo "disabled";
																																								} else {
																																									echo "";
																																								} ?>><i class="fa fa-shopping-cart"></i> 
														<?php if ($hbarang['stok'] == 0) {
															echo "Menu Habis";
														} else {
															echo "Pesan Menu";
														} ?></a>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        </div>
                                        <div class="tab-pane fade" id="diskon" >
                                        <?php
                                        $sbarang = mysqli_query($koneksi, "SELECT * FROM m_barang a
                                                                           LEFT OUTER JOIN l_jenis b on a.jenis_id = b.jenis_id
                                                                           WHERE a.jenis_id = '$_GET[id]' AND diskon > '1' AND judul LIKE '%$_POST[cari]%'");
                                        while ($hbarang = mysqli_fetch_array($sbarang)){
                                            ?>
                                            <div class="col-sm-3">
                                                <div class="product-image-wrapper">
												<div class="single-products">
                                                        <div class="productinfo text-center">
														<a href="?i=detail-barang&id=<?php echo $hbarang['brg_id']?>"><img src="../<?php echo md5('admin')?>/dist/img/buku/<?php echo $hbarang['image']?>" alt="" style="width:auto;height:80px" /></a>
                                                        <?php
														$diskon = $hbarang['diskon'] / 100;
														if($diskon > 0){
															
														$harga = $hbarang['harga_jual'] * $diskon;
														$hrg = $hbarang['harga_jual'] - $harga;
                                                        
														?>
														<h2>Rp. <strike><?php echo number_format($hbarang['harga_jual'],0,',','.')?></strike><p> disc <?php echo $hbarang['diskon'] ?>% </p></h2>
                                                        
                                                        <p style="color:orange; font-weight: bold;">Rp. <?php echo number_format($hrg,0,',','.') ?></p>
                                                        <?php
														}
														else{
															?>
															<h2>Rp. <?php echo number_format($hbarang['harga_jual'],0,',','.')?><p>&nbsp;</p></h2>
                                                            <p>&nbsp;</p>
                                                            <?php
														}
														?>
                                                            <p><?php echo $hbarang['judul']?></p> 
															<p><small>(Klik Gambar Melihat Detail Menu)</small></p>
															<!-- <p>(<?php echo $hbarang['kategori_name']?>)</p> -->
                                                            <a href="?i=<?php echo md5('beli')?>&idbrg=<?php echo $hbarang['brg_id']?>" class="btn btn-warning" <?php if ($hbarang['stok'] == 0) {
																																									echo "disabled";
																																								} else {
																																									echo "";
																																								} ?>><i class="fa fa-shopping-cart"></i> 
														<?php if ($hbarang['stok'] == 0) {
															echo "Menu Habis";
														} else {
															echo "Pesan Menu";
														} ?></a>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        </div>
                                    </div>
                                    <?php
								}
							}
							else if($_GET['id'] == '3'){
								?>
                                <div class="tab-content">
                                    <div class="tab-pane fade active in" id="rekomendasi" >
                                        <div class="col-sm-12">
                                            <div class="product-image-wrapper">
                                                <div class="single-products">
                                                    <div class="productinfo text-center">
                                                        <h2> COMING SOON </h2>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="terlaris" >
                                        <div class="col-sm-12">
                                            <div class="product-image-wrapper">
                                                <div class="single-products">
                                                    <div class="productinfo text-center">
                                                        <h2> COMING SOON </h2>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="diskon" >
                                        <div class="col-sm-12">
                                            <div class="product-image-wrapper">
                                                <div class="single-products">
                                                    <div class="productinfo text-center">
                                                        <h2> COMING SOON </h2>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
							}
						}

						else{
							?>
							<div class="tab-content">
								<div class="tab-pane fade active in" id="rekomendasi" >
								<?php
								$sbarang = mysqli_query($koneksi, "SELECT * FROM m_barang a LEFT OUTER JOIN l_kategori b on a.kategori_id = b.kategori_id WHERE a.judul LIKE '%$_POST[cari]%' ORDER BY judul DESC LIMIT 8 ");
								while ($hbarang = mysqli_fetch_array($sbarang)){
									?>
									<div class="col-sm-3">
										<div class="product-image-wrapper">
										<div class="single-products">
												<div class="productinfo text-center">
												<a href="?i=detail-barang&id=<?php echo $hbarang['brg_id']?>"><img src="../<?php echo md5('admin')?>/dist/img/buku/<?php echo $hbarang['image']?>" alt="" style="width:auto;height:80px" /></a>
													<?php
														$diskon = $hbarang['diskon'] / 100;
														if($diskon > 0){
															
														$harga = $hbarang['harga_jual'] * $diskon;
														$hrg = $hbarang['harga_jual'] - $harga;
                                                        
														?>
														<h2>Rp. <strike><?php echo number_format($hbarang['harga_jual'],0,',','.')?></strike><p> disc <?php echo $hbarang['diskon'] ?>% </p></h2>
                                                        
                                                        <p style="color:orange; font-weight: bold;">Rp. <?php echo number_format($hrg,0,',','.') ?></p>
                                                        <?php
														}
														else{
															?>
															<h2>Rp. <?php echo number_format($hbarang['harga_jual'],0,',','.')?><p>&nbsp;</p></h2>
                                                            <p>&nbsp;</p>
                                                            <?php
														}
														?>
															<p><?php echo $hbarang['judul']?></p> 
															<p><small>(Klik Gambar Melihat Detail Menu)</small></p>
															<!-- <p>(<?php echo $hbarang['kategori_name']?>)</p> -->
													<a href="?i=<?php echo md5('beli')?>&idbrg=<?php echo $hbarang['brg_id']?>" class="btn btn-warning" <?php if ($hbarang['stok'] == 0) {
																																									echo "disabled";
																																								} else {
																																									echo "";
																																								} ?>><i class="fa fa-shopping-cart"></i> 
														<?php if ($hbarang['stok'] == 0) {
															echo "Menu Habis";
														} else {
															echo "Pesan Menu";
														} ?></a>
												</div>
												
											</div>
										</div>
									</div>
									<?php
								}
								?>
								</div>
								<div class="tab-pane fade" id="terlaris" >
								<?php
								$sbarang = mysqli_query($koneksi, "SELECT * FROM m_barang a LEFT OUTER JOIN l_kategori b on a.kategori_id = b.kategori_id WHERE a.jml_terjual > '10' AND a.judul LIKE '%$_POST[cari]%'");
								while ($hbarang = mysqli_fetch_array($sbarang)){
									?>
									<div class="col-sm-3">
										<div class="product-image-wrapper">
										<div class="single-products">
												<div class="productinfo text-center">
												<a href="?i=detail-barang&id=<?php echo $hbarang['brg_id']?>"><img src="../<?php echo md5('admin')?>/dist/img/buku/<?php echo $hbarang['image']?>" alt="" style="width:auto;height:80px" /></a>
													<?php
														$diskon = $hbarang['diskon'] / 100;
														if($diskon > 0){
															
														$harga = $hbarang['harga_jual'] * $diskon;
														$hrg = $hbarang['harga_jual'] - $harga;
                                                        
														?>
														<h2>Rp. <strike><?php echo number_format($hbarang['harga_jual'],0,',','.')?></strike><p> disc <?php echo $hbarang['diskon'] ?>% </p></h2>
                                                        
                                                        <p style="color:orange; font-weight: bold;">Rp. <?php echo number_format($hrg,0,',','.') ?></p>
                                                        <?php
														}
														else{
															?>
															<h2>Rp. <?php echo number_format($hbarang['harga_jual'],0,',','.')?><p>&nbsp;</p></h2>
                                                            <p>&nbsp;</p>
                                                            <?php
														}
														?>
															<p><?php echo $hbarang['judul']?></p> 
															<p><small>(Klik Gambar Melihat Detail Menu)</small></p>
															<!-- <p>(<?php echo $hbarang['kategori_name']?>)</p> -->
													<a href="?i=<?php echo md5('beli')?>&idbrg=<?php echo $hbarang['brg_id']?>" class="btn btn-warning" <?php if ($hbarang['stok'] == 0) {
																																									echo "disabled";
																																								} else {
																																									echo "";
																																								} ?>><i class="fa fa-shopping-cart"></i> 
														<?php if ($hbarang['stok'] == 0) {
															echo "Menu Habis";
														} else {
															echo "Pesan Menu";
														} ?></a>
												</div>
												
											</div>
										</div>
									</div>
									<?php
								}
								?>
								</div>
								<div class="tab-pane fade" id="diskon" >
								<?php
								$sbarang = mysqli_query($koneksi, "SELECT * FROM m_barang a
																   LEFT OUTER JOIN l_jenis b on a.jenis_id = b.jenis_id
																   WHERE diskon > '0' AND judul LIKE '%$_POST[cari]%'");
								while ($hbarang = mysqli_fetch_array($sbarang)){
									?>
									<div class="col-sm-3">
										<div class="product-image-wrapper">
										<div class="single-products">
												<div class="productinfo text-center">
												<a href="?i=detail-barang&id=<?php echo $hbarang['brg_id']?>"><img src="../<?php echo md5('admin')?>/dist/img/buku/<?php echo $hbarang['image']?>" alt="" style="width:auto;height:80px" /></a>
													<?php
														$diskon = $hbarang['diskon'] / 100;
														if($diskon > 0){
															
														$harga = $hbarang['harga_jual'] * $diskon;
														$hrg = $hbarang['harga_jual'] - $harga;
                                                        
														?>
														<h2>Rp. <strike><?php echo number_format($hbarang['harga_jual'],0,',','.')?></strike><p> disc <?php echo $hbarang['diskon'] ?>% </p></h2>
                                                        
                                                        <p style="color:orange; font-weight: bold;">Rp. <?php echo number_format($hrg,0,',','.') ?></p>
                                                        <?php
														}
														else{
															?>
															<h2>Rp. <?php echo number_format($hbarang['harga_jual'],0,',','.')?><p>&nbsp;</p></h2>
                                                            <p>&nbsp;</p>
                                                            <?php
														}
														?>
															<p><?php echo $hbarang['judul']?></p> 
															<p><small>(Klik Gambar Melihat Detail Menu)</small></p>
															<!-- <p>(<?php echo $hbarang['kategori_name']?>)</p> -->
													<a href="?i=<?php echo md5('beli')?>&idbrg=<?php echo $hbarang['brg_id']?>" class="btn btn-warning" <?php if ($hbarang['stok'] == 0) {
																																									echo "disabled";
																																								} else {
																																									echo "";
																																								} ?>><i class="fa fa-shopping-cart"></i> 
														<?php if ($hbarang['stok'] == 0) {
															echo "Menu Habis";
														} else {
															echo "Pesan Menu";
														} ?></a>
												</div>
												
											</div>
										</div>
									</div>
                                    <?php
								}
								?>
								</div>
							</div>
							<?php
						}
						?>
							</div>
						</div>
                        
					</div><!--/category-tab-->
				</div>
			</div>
		</div>
	</section>