
<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Ekspedisi 
        <small>ADMIN</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-male"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data Ekspedisi</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Ekspedisi</h3>
            </div>
            <br>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
            <a href="?i=<?php echo md5('i_ekspedisi')?>"><button type="button" class="btn btn-primary fa fa-plus"> Tambah Data</button></a>
              <table id="example4" class="table table table-bordered table-striped">
                <thead>
           		<tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
<?php
	$no = 1;
	$sql = mysqli_query($koneksi, "SELECT * FROM l_ekspedisi");
	while ($hasil = mysqli_fetch_assoc($sql)){
?> 
     
                <tr>
                  <td><?php echo $no ?></td>
                  <td><?php echo $hasil['ekspedisi_name']?></td>
                  <td><a href="?i=<?php echo md5('u_ekspedisi')?>&id=<?php echo $hasil['ekspedisi_id']?>">
                  <button type="button" class="btn btn-info fa fa-edit"> Edit</button></a>
                  	  <a href="?i=<?php echo md5('d_ekspedisi')?>&id=<?php echo $hasil['ekspedisi_id']?>">
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