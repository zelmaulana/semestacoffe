
<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Jurnal 
        <small>ADMIN</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-male"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data Jurnal</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Jurnal Yang Tersedia</h3>
            </div>
            <br>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
            <a href="?i=<?php echo md5('i_jurnal')?>"><button type="button" class="btn btn-primary fa fa-plus"> Tambah Data</button></a>
              <table id="example4" class="table table table-bordered table-striped">
                <thead>
           		<tr>
                  <th>No</th>
                  <th>Judul Jurnal</th>
                  <th>Kategori</th>
                  <th>Harga Beli</th>
                  <th>Harga Jual</th>
                  <th>Stok</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
<?php
	$no = 1;
	$sql = mysqli_query($koneksi, "SELECT * FROM m_barang a
								   LEFT OUTER JOIN l_kategori b on a.kategori_id = b.kategori_id
								   WHERE jenis_id = '2'");
	while ($hasil = mysqli_fetch_assoc($sql)){
?> 
     
                <tr>
                  <td><?php echo $no ?></td>
                  <td><?php echo $hasil['judul']?></td>
                  <td><?php echo $hasil['kategori_name']?></td>
                  <td><?php echo $hasil['harga_beli']?></td>
                  <td><?php echo $hasil['harga_jual']?></td>
                  <td><?php echo $hasil['stok']?></td>
                  <td><a href="?i=<?php echo md5('u_jurnal')?>&id=<?php echo $hasil['brg_id']?>">
                  <button type="button" class="btn btn-info fa fa-edit"> Edit</button></a>
                  <a href="?i=<?php echo md5('d_jurnal')?>&id=<?php echo $hasil['brg_id']?>">
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