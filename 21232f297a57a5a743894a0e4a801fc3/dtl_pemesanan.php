<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Transaksi
      <small>ADMIN</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-male"></i> Home</a></li>
      <li><a href="#">Tables</a></li>
      <li class="active">Data Transaksi</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Detail Pemesanan</h3>
          </div>
          <br>
          <!-- /.box-header -->
          <?php
          $val1 = mysqli_query($koneksi, "SELECT * FROM t_pemesanan WHERE pemesanan_id = '$_GET[id]'");

          $hval1 = mysqli_fetch_array($val1);
          if ($hval1['jenis_pemesanan_id'] == '1') {
            $sql = mysqli_query($koneksi, "SELECT a.total, a.tanggal, b.nobill, b.nomeja, b.catatan, c.user_nama, c.user_nohp, d.alamat_spesifik, e.brg_id FROM t_pemesanan a
								   LEFT OUTER JOIN t_order b on a.nobill = b.nobill
								   LEFT OUTER JOIN m_user c on a.user_id = c.user_id
								   LEFT OUTER JOIN m_alamat d on a.user_id = d.user_id
                   LEFT OUTER JOIN m_barang e on a.brg_id = e.brg_id
								   WHERE a.pemesanan_id = '$_GET[id]'");
          } else if ($hval1['jenis_pemesanan_id'] == '2') {
            $sql = mysqli_query($koneksi, "SELECT a.*, b.user_id, c.*, d.*, e.*, f.*, g.*, h.* FROM t_pemesanan a
								   LEFT OUTER JOIN t_keranjang b on a.pemesanan_id = b.pemesanan_id
								   LEFT OUTER JOIN m_user c on b.user_id = c.user_id
								   LEFT OUTER JOIN m_dropshiper d on b.pemesanan_id = d.pemesanan_id
								   LEFT OUTER JOIN l_propinsi e on d.propinsi_id = e.propinsi_id
								   LEFT OUTER JOIN l_kabupaten f on d.kabupaten_id = f.kabupaten_id
								   LEFT OUTER JOIN l_kecamatan g on d.kecamatan_id = g.kecamatan_id
								   LEFT OUTER JOIN l_desa h on d.desa_id = h.desa_id
								   WHERE a.pemesanan_id = '$_GET[id]'");
          }
          $hasil = mysqli_fetch_assoc($sql);
          ?>
          <div class="box-body table-responsive">
            <div class="col-sm-8">
              <table id="" class="table" style="font-size:13px;width:100%">
                <thead>
                  <tr>
                    <th width="20%">Nama Pemesan</th>
                    <th>:</th>
                    <td><?php echo $hasil['user_nama'] ?></td>
                  </tr>
                  <tr>
                    <th>No.HP</th>
                    <th>:</th>
                    <td><?php echo $hasil['user_nohp'] ?></td>
                  </tr>
                  <tr>
                    <th>Tanggal Order</th>
                    <th>:</th>
                    <td><?php echo date('d-m-Y', strtotime($hasil['tanggal'])) ?> / <?php echo date('G:i:s', strtotime($hasil['tanggal'])) ?></td>
                  </tr>
                  <tr>
                    <th>Alamat</th>
                    <th>:</th>
                    <td><?php echo $hasil['alamat_spesifik'] ?></td>
                  </tr>
                  <tr>
                    <th>Catatan</th>
                    <th>:</th>
                    <td><?php echo $hasil['catatan'] ?></td>
                  </tr>
                  <tr>
                    <th>
                      <p style="font-weight: bold; font-size: 12pt;">No Meja</p>
                    </th>
                    <th>
                      <p style="font-size: 12pt;">:</p>
                    </th>
                    <td>
                      <p style="font-weight: bold; font-size: 12pt;">Meja <?php echo $hasil['nomeja'] ?></p>
                    </td>
                  </tr>
                  <tr>
                    <th>
                      <p style="font-weight: bold; color: red; font-size: 14pt;">Total Bayar</p>
                    </th>
                    <th>
                      <p style="font-size: 14pt;">:</p>
                    </th>
                    <td>
                      <p style="font-weight: bold; color: red; font-size: 14pt;">Rp. <?php echo number_format($hasil['total'], 0, ',', '.') ?></p>
                    </td>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
          <div class="box-body table-responsive">
            <h3>Detail Menu</h3>
            <table id="example2" class="table table table-bordered table-striped" style="font-size:13px">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Menu</th>
                  <th>Kategori Menu</th>
                  <th>Qty</th>
                  <th>Harga</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                $sql = mysqli_query($koneksi, "SELECT * FROM t_pemesanan a
								   LEFT OUTER JOIN m_barang b on a.brg_id = b.brg_id
								   LEFT OUTER JOIN l_kategori c on b.kategori_id = c.kategori_id
								   WHERE a.pemesanan_id = '$_GET[id]'");
                while ($hasil = mysqli_fetch_assoc($sql)) {
                  //$harga = $hasil['total'] / $hasil['jumlah_trx'];
                  ?>

                  <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $hasil['judul'] ?></td>
                    <td><?php echo $hasil['kategori_name'] ?></td>
                    <td><?php echo $hasil['qty'] ?></td>
                    <td>Rp. <?php echo number_format($hasil['hargadiskon'], 0, ',', '.') ?></td>
                    <td>Rp. <?php echo number_format($hasil['total'], 0, ',', '.') ?></td>
                  </tr>
                <?php
                  $no++;
                }
                $num = mysqli_num_rows($sql);
                ?>
              </tbody>
            </table>
            <br>
            <br>
            <button type="button" onclick="window.history.go(-1)" class="btn btn-danger fa fa-close"> Kembali</button>
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