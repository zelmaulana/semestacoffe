<?php
if (isset($_POST['add'])) {
  mysqli_query($koneksi, "INSERT INTO l_kategori VALUES ('','$_POST[nama]')");
  ?>
  <script>
    alert("Data Berhasil Disimpan");
    window.location = "?i=<?php echo $_GET['i'] ?>";
  </script>
<?php
}
if (isset($_POST['updt'])) {
  mysqli_query($koneksi, "UPDATE l_kategori SET kategori_name='$_POST[nama]' WHERE kategori_id = '$_GET[id]'");
  ?>
  <script>
    alert("Data Berhasil Disimpan");
    window.location = "?i=<?php echo $_GET['i'] ?>";
  </script>
<?php
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Kategori
      <small>ADMIN</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-male"></i> Home</a></li>
      <li><a href="#">Tables</a></li>
      <li class="active">Data Kategori</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">

          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <form action="" method="post">
              <table id="example1" class="table table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  $sql = mysqli_query($koneksi, "SELECT * FROM l_kategori");
                  while ($hasil = mysqli_fetch_assoc($sql)) {
                    ?>

                    <tr>
                      <td><?php echo $no ?></td>
                      <td><?php echo $hasil['kategori_name'] ?></td>
                      <td><a href="?i=<?php echo $_GET['i'] ?>&page=updt&id=<?php echo $hasil['kategori_id'] ?>">
                          <button type="button" class="btn btn-success fa fa-edit"> Edit</button></a>
                        <a href="?i=<?php echo md5('d_kategori') ?>&id=<?php echo $hasil['kategori_id'] ?>">
                          <button type="button" onclick="return konf()" class="btn btn-danger fa fa-trash"> Hapus</button></a></td>
                    </tr>
                    <script type="text/javascript" language="javascript">
                      function konf() {
                        tanya = confirm("Apakah Anda Yakin Akan Menghapus Data Ini? Menghapus Data Mengakibatkan Perubahan Data Lainnya.");
                        if (tanya == true) return true;
                        else return false;
                      }
                    </script>
                  <?php
                    $no++;
                  }
                  ?>
                </tbody>
                <tfoot>
                  <?php
                  if (isset($_GET['page'])) {
                    if ($_GET['page'] == 'add') {
                      ?>
                      <tr>
                        <td></td>
                        <td><input type="text" class="form-control" style="width:100%" name="nama" required /></td>
                        <td><button type="submit" name="add" class="btn btn-info fa fa-save"> Simpan</button><a href="?i=<?php echo $_GET['i'] ?>"><button type="button" class="btn btn-danger fa fa-close"> Batal</button></a></td>
                      </tr>
                      <tr>
                        <td colspan="6"><a href="?i=<?php echo $_GET['i'] ?>&page=add"><button type="button" class="btn btn-primary btn-xs btn-block" disabled="disabled">Tambah Data</button></a></td>
                      </tr>
                    <?php
                      } else if ($_GET['page'] == 'updt') {
                        $sp = mysqli_query($koneksi, "SELECT * FROM l_kategori WHERE kategori_id = '$_GET[id]'");
                        $hp = mysqli_fetch_array($sp);
                        ?>
                      <tr>
                        <td></td>
                        <td><input type="text" class="form-control" style="width:100%" name="nama" value="<?php echo $hp['kategori_name'] ?>" required /></td>
                        <td><button type="submit" name="updt" class="btn btn-info fa fa-save"> Simpan</button><a href="?i=<?php echo $_GET['i'] ?>"><button type="button" class="btn btn-danger fa fa-close"> Batal</button></a></td>
                      </tr>
                      <tr>
                        <td colspan="6"><a href="?i=<?php echo $_GET['i'] ?>&page=add"><button type="button" class="btn btn-primary btn-xs btn-block" disabled="disabled">Tambah Data</button></a></td>
                      </tr>
                    <?php
                      } else {
                        ?>
                      <tr>
                        <td colspan="6"><a href="?i=<?php echo $_GET['i'] ?>&page=add"><button type="button" class="btn btn-primary btn-xs btn-block">Tambah Data</button></a></td>
                      </tr>
                    <?php
                      }
                    } else {
                      ?>
                    <tr>
                      <td colspan="6"><a href="?i=<?php echo $_GET['i'] ?>&page=add"><button type="button" class="btn btn-primary btn-xs btn-block">Tambah Data</button></a></td>
                    </tr>
                  <?php
                  }
                  ?>
                </tfoot>
              </table>
            </form>
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