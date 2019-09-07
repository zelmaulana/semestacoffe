<?php
include '../koneksi.php';
session_start();
if (!empty($_GET['q'])){
  if (ctype_digit($_GET['q'])) {
    $query1 = mysqli_query($koneksi, "SELECT * FROM l_desa WHERE desa_id='$_GET[q]' ORDER BY desa_name");
    while($data1 = mysqli_fetch_array($query1)){
      ?>
     <input type="text" name="kd_pos" id="kd_pos" class="col-sm-12" value="<?php echo $data1['kode_pos']?>" readonly required>
      <?php
    }
  }
}
?>