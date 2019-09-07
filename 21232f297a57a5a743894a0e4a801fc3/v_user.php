
<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data User 
        <small>ADMIN</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-male"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data User</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data User</h3>
            </div>
            <br>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example4" class="table table table-bordered table-striped">
                <thead>
           		<tr>
                  <th>No</th>
                  <th>Nama Pengguna</th>
                  <th>E-Mail</th>
                  <th>No.HP</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
<?php
	$no = 1;
	$sql = mysqli_query($koneksi, "SELECT * FROM m_user WHERE level_id = '2'");
	while ($hasil = mysqli_fetch_assoc($sql)){
?> 
     
                <tr>
                  <td><?php echo $no ?></td>
                  <td><?php echo $hasil['user_nama']?></td>
                  <td><?php echo $hasil['user_email']?></td>
                  <td><?php echo $hasil['user_nohp']?></td>
                  <td><?php echo $hasil['status']?></td>
                  <td><a href="?i=<?php echo md5('d_user')?>&id=<?php echo $hasil['user_id']?>">
                  <button type="button" onclick="return konf()" class="btn btn-danger fa fa-trash"> Hapus</button></a></td>
                  </tr> 
                  <script type="text/javascript" language="javascript">
					function konf(){
					tanya = confirm("Apakah Anda Yakin Akan Menghapus Data Ini?");
					if (tanya == true) return true;
					else return false;
					}
				  </script>
 <?php     
 				$no++;
 				}
				$num = mysqli_num_rows($sql);
 ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->