
<?php
include '../koneksi.php';
session_start();
if (!empty($_GET['prop'])){
  if (ctype_digit($_GET['prop'])) {
    $query1 = mysqli_query($koneksi, "SELECT * FROM l_kabupaten WHERE propinsi_id='$_GET[prop]' ORDER BY kabupaten_name");
    echo"<option value=''>Pilih Kota/Kabupaten</option>";
    while($data1 = mysqli_fetch_array($query1)){
      ?>
      <option value="<?php echo $data1['kabupaten_id']?>"><?php echo $data1['kabupaten_name']?></option>
      <?php
    }
  }
}
if (!empty($_GET['kab'])){
  if (ctype_digit($_GET['kab'])) {
    $query2 = mysqli_query($koneksi, "SELECT * FROM l_kecamatan WHERE kabupaten_id='$_GET[kab]' ORDER BY kecamatan_name");
    echo"<option value=''>Pilih kecamatan</option>";
    while($data2 = mysqli_fetch_array($query2)){
      ?>
      <option value="<?php echo $data2['kecamatan_id']?>"><?php echo $data2['kecamatan_name']?></option>
      <?php
    }
  }
}
if (!empty($_GET['kec'])){
  if (ctype_digit($_GET['kec'])) {
    $query3 = mysqli_query($koneksi, "SELECT * FROM l_desa WHERE kecamatan_id='$_GET[kec]' ORDER BY desa_name");
    echo"<option value=''>Pilih desa</option>";    
	while($data3 = mysqli_fetch_array($query3)){
      ?>
      <option value="<?php echo $data3['desa_id']?>"><?php echo $data3['desa_name']?></option>
      <?php
    }
  }
}