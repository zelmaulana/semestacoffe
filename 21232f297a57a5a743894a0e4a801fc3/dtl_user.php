<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Data Pelanggan
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-male"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data Pelanggan</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <!-- /.box-header -->
                    <?php
                    $val1 = mysqli_query($koneksi, "SELECT a.*, b.* FROM m_user a LEFT OUTER JOIN m_alamat b ON a.user_id = b.user_id WHERE a.user_id = '$_GET[id]'");
                    $data = mysqli_fetch_array($val1);
                    ?>
                    <div class="box-body table-responsive">
                        <div class="col-sm-8">
                            <table id="" class="table" style="font-size:13px;width:100%">
                                <thead>
                                    <tr>
                                        <th width="20%">Nama Lengkap</th>
                                        <th>:</th>
                                        <th><?php echo $data['user_nama'] ?></th>
                                    </tr>
                                    <tr>
                                        <th>No.HP</th>
                                        <th>:</th>
                                        <th><?php echo $data['user_nohp'] ?></th>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <th>:</th>
                                        <th><?php echo $data['user_email'] ?></th>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Lahir</th>
                                        <th>:</th>
                                        <th><?php echo date('d-m-Y', strtotime($data['user_ttl'])) ?></th>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <th>:</th>
                                        <th><?php echo $data['alamat_spesifik'] ?></th>
                                    </tr>
                                </thead>
                            </table>
                            <button type="button" onclick="window.history.go(-1)" class="btn btn-warning fa fa-mail-reply"> Kembali</button>
                        </div>
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