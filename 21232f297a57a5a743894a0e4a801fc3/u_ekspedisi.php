<?php
if(isset($_POST['simpan'])){
	$qpr = mysqli_query($koneksi, "SELECT * FROM l_ekspedisi WHERE ekspedisi_name = '$_POST[nama]'");
	$num = mysqli_num_rows($qpr);
	if($num == 0){
		mysqli_query($koneksi, "UPDATE l_ekspedisi SET ekspedisi_name='$_POST[nama]' WHERE ekspedisi_id='$_GET[id]'");
		?>
		<script>
		window.location = "?i=<?php echo md5('v_ekspedisi')?>";
		alert("Berhasil Diubah");
		</script>
		<?php
	}
	else{
		$h = mysqli_fetch_array($qpr);
		if($_POST['nama'] == $h['ekspedisi_name']){
			mysqli_query($koneksi, "UPDATE l_ekspedisi SET ekspedisi_name='$_POST[nama]'  WHERE ekspedisi_id='$_GET[id]'");
			?>
			<script>
			window.location = "?i=<?php echo md5('v_ekspedisi')?>";
			alert("Berhasil Diubah");
			</script>
			<?php
		}
		else{
			?>
			<script>
			window.location = "?i=<?php echo $_GET['i']?>";
			alert("Ekspedisi Sudah Ada");
			</script>
			<?php
		}
	}
}
else{
}
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Form Tambah Ekspedisi
        <small>ADMIN</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-male"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Tambah Data</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
       <form action="" method="post">
        <div class="box-footer">
        <div class="col-md-6">
        <?php
		$se = mysqli_query($koneksi, "SELECT * FROM l_ekspedisi WHERE ekspedisi_id = '$_GET[id]'");
		$he = mysqli_fetch_array($se);
		?>
       	 	<div class="form-group">
                <label>Nama Ekspedisi</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                     <i class="fa fa-shekel"></i>
                  </div>
                  <input type="text" class="form-control" name="nama" placeholder="Isi Disini" value="<?php echo $he['ekspedisi_name']?>" required >
                  
               	</div>
            </div>
            <button type="submit" class="btn btn-primary" name="simpan" id="submit">Simpan</button>
              <a href="?i=<?php echo md5('v_ekspedisi')?>"><button type="button" class="btn btn-primary">Cancel</button> </a>
         </div>
         </form>
         <div class="col-md-6" style="margin-top:1cm">
     </div>
    </div>
   </div>
      <!-- /.row -->
 </section>
    <!-- /.content -->
</div>