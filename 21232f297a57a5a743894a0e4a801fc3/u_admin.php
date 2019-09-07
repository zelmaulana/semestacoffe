<?php
if(isset($_POST['simpan'])){
	$qa = mysqli_query($koneksi, "SELECT * FROM m_user WHERE user_email = '$_POST[email]'");
	$num = mysqli_num_rows($qa);
	$ha = mysqli_fetch_array($qa);
	if($num == 0){
		$pass = md5('admin123');
		$rand = rand(100000,999999);
		mysqli_query($koneksi, "UPDATE m_user SET user_nama='$_POST[nama]', user_nohp='$_POST[nohp]', user_email='$_POST[email]' WHERE user_id = '$_GET[id]'");
		?>
		<script>
		window.location = "?i=<?php echo md5('v_admin')?>";
		alert("Berhasil Diubah");
		</script>
		<?php
	}
	else{
		if($_POST['email'] == $ha['user_email']){
			$pass = md5('admin123');
			$rand = rand(100000,999999);
			mysqli_query($koneksi, "UPDATE m_user SET user_nama='$_POST[nama]', user_nohp='$_POST[nohp]', user_email='$_POST[email]' WHERE user_id = '$_GET[id]'");
			?>
			<script>
			window.location = "?i=<?php echo md5('v_admin')?>";
			alert("Berhasil Disimpan");
			</script>
			<?php
		}
		else{
			?>
			<script>
			window.location = "?i=<?php echo $_GET['i']?>";
			alert("E-Mail Yang Anda Masukan Sudah Terdaftar");
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
        Form Tambah Admin
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
      <?php
	  $s1 = mysqli_query($koneksi, "SELECT * FROM m_user WHERE user_id = '$_GET[id]'");
	  $h1 = mysqli_fetch_array($s1);
	  ?>
       <form action="" method="post">
        <div class="box-footer">
        <div class="col-md-6">
       	 	<div class="form-group">
                <label>Nama Lengkap</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                     <i class="fa fa-shekel"></i>
                  </div>
                  <input type="text" class="form-control" name="nama" value="<?php echo $h1['user_nama']?>" placeholder="Isi Disini" required >
                  
               	</div>
            </div>
       	 	<div class="form-group">
                <label>Alamat E-Mail</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                     <i class="fa fa-shekel"></i>
                  </div>
                  <input type="email" class="form-control" name="email" style="width:50%" value="<?php echo $h1['user_email']?>" placeholder="Isi Disini" required >
                  
               	</div>
            </div>
       	 	<div class="form-group">
                <label>No. Handphone</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                     <i class="fa fa-shekel"></i>
                  </div>
                  <input type="text" class="form-control" onkeyup="error()" style="width:50%" value="<?php echo $h1['user_nohp']?>" name="nohp" id="nohp" maxlength="20" minlength="8" placeholder="Isi Disini" required > <i id="error" style="color:#E00"></i>
               	</div>
                <script type="text/javascript">
								   function error(){
									   var error = document.getElementById("nohp").value;
					  				   var numberExp = /^[0-9 + -]+$/;
									   if(!error.match(numberExp)){
										   document.getElementById("error").textContent=" Harap Isi Dengan Angka";
										   document.getElementById("submit").disabled=true;
									   }
									   else if(error.match(numberExp)){
										   document.getElementById("error").textContent="";
										   document.getElementById("submit").disabled=false;
									   }
									   if(error == null || error == ""){
										   document.getElementById("error").textContent="";
										   document.getElementById("submit").disabled=false;
									   }
								   }
								   </script>
            </div>
            <button type="submit" class="btn btn-primary" name="simpan" id="submit">Simpan</button>
              <a href="?i=<?php echo md5('v_admin')?>"><button type="button" class="btn btn-primary">Cancel</button> </a>
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