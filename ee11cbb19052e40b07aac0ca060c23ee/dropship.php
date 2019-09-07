<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<script type="text/javascript" src="ajax_daerah.js"></script>
<?php
if(isset($_POST['simpan'])){
	$query1 = mysqli_query($koneksi, "SELECT * FROM m_alamat WHERE user_id = '$_SESSION[id]'");
	$data1 = mysqli_num_rows($query1);
		mysqli_query($koneksi, "INSERT INTO m_dropshiper VALUES ('', '$_SESSION[id]', '', '$_POST[nama]', '$_POST[alamat]', '$_POST[kel]', '$_POST[rt]', '$_POST[rw]', '$_POST[kec]', '$_POST[kota]', '$_POST[prop]', '$_POST[kd_pos]')"); 
	?>
    <script>
		alert("Berhasil Disimpan");
		window.location = "?i=bayar&id=<?php echo md5('drp')?>";
	</script>
    <?php
}
?>
<section id="cart_items">
		<div class="container">
			<div class="table-responsive cart_info">
            
            <form action="" method="post">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td colspan="7" align="center">Info Pribadi</td>
						</tr>
					</thead>
					<tbody>
						<tr>
                        	<td width="20%">Nama</td>
                        	<td>:</td>
                            <td><input type="text" class="col-sm-12" name="nama" required /></td>
						</tr>
						<tr>
                        	<td>Alamat</td>
                        	<td>:</td>
                            <td><input type="text" class="col-sm-12" name="alamat" required /></td>
						</tr>
						<tr>
                        <tr>
                        	<td>Provinsi</td>
                        	<td>:</td>
                            <td>
                                <select name="prop" id="prop" onChange="ajaxkota(this.value)" required>
                                    <option value="">Pilih Provinsi</option>
                                    <?php 
                                    $queryProvinsi=mysqli_query($koneksi, "SELECT * FROM l_propinsi ORDER by propinsi_name");
                                    while ($dataProvinsi=mysqli_fetch_array($queryProvinsi)){
                                        ?><option value="<?php echo $dataProvinsi['propinsi_id']?>"><?php echo $dataProvinsi['propinsi_name']?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
               				</td>
						</tr>
						<tr>
                        	<td>Kota/Kabupaten</td>
                        	<td>:</td>
                            <td><select name="kota" id="kota" onchange="ajaxkec(this.value)" required>
                                	<option value="">Pilih Propinsi Terlebih Dahulu</option>
									<?php
									$skota = mysqli_query($koneksi, "SELECT * FROM l_kabupaten WHERE propinsi_id = '$huser[propinsi_id]' ORDER by kabupaten_name");
									while($hkota = mysqli_fetch_array($skota)){
										?>
										<option value="<?php echo $hkota['kabupaten_id']?>"><?php echo $hkota['kabupaten_name']?></option>
                                        <?php
									}
									?>
                            	</select>
                            </td>
						</tr>
						<tr>
                        	<td>Kecamatan</td>
                        	<td>:</td>
                            <td><select name="kec" id="kec" onChange="ajaxkel(this.value)" required>
                                    <option value="">Pilih Kota/Kabupaten Terlebih Dahulu</option>
                                    <?php
									$skec = mysqli_query($koneksi, "SELECT * FROM l_kecamatan WHERE kabupaten_id = '$huser[kabupaten_id]' ORDER by kecamatan_name");
									while($hkec = mysqli_fetch_array($skec)){
										?>
										<option value="<?php echo $hkec['kecamatan_id']?>"><?php echo $hkec['kecamatan_name']?></option>
                                        <?php
									}
									?>
                                </select>
                			</td>
                        	<td align="right" width="10%">Kode Pos</td>
                            <td width="10%"><input type="text" class="col-sm-12" name="kd_pos" value="<?php echo $huser['kode_pos']?>" required /></td>
						</tr>
                        	<td>Desa</td>
                        	<td>:</td>
                            <td><select name="kel" id="kel" required>
                                    <option value="">Pilih Kecamatan Terlebih Dahulu</option>
                                    <?php
									$sdes = mysqli_query($koneksi, "SELECT * FROM l_desa WHERE kecamatan_id = '$huser[kecamatan_id]' ORDER by desa_name");
									while($hdes = mysqli_fetch_array($sdes)){
										?>
										<option value="<?php echo $hdes['desa_id']?>"><?php echo $hdes['desa_name']?></option>
                                        <?php
									}
									?>
                                </select>
                			</td>
                        	<td align="right">RT</td>
                            <td width="10%"><input type="text" class="col-sm-12" name="rt" required /></td>
                        	<td align="right">RW</td>
                            <td width="10%"><input type="text" class="col-sm-12" name="rw" required /></td>
						</tr>
					</tbody>
                    
						<tr>
                        	<td><input type="submit" name="simpan" id="simpan" class="btn btn-info fa fa-save" value="Bayar" />
                            	<a href="?i=keranjang"><input type="button" name="kembali" id="kembali" class="btn btn-succes fa fa-back" value="KEMBALI" /></a></td>
						</tr>
				</table>
            </form>
			</div>
		</div>
	</section>