<?php

define("BASE_URL", "../");

function kalkulasidiskon($hargaJual, $prosentaseDiskon)
{
    $a = ($prosentaseDiskon / 100) * $hargaJual;
    $b = $hargaJual - $a;
    return $b;
}

function insertKeranjang($user_id, $brg_id)
{
    include 'koneksi.php';

    $product = getDetailsProduct($brg_id);
    $hargadiskon = kalkulasidiskon($product["harga_jual"], $product["diskon"]);
    $hargaTotal = $hargadiskon * 1;

    $sql = " INSERT INTO t_keranjang(user_id,brg_id,jumlah_trx,hargabarang,ip,hargadiskon,total,jenis_pemesanan_id)  ";
    $sql .= " SELECT  " . $user_id . ", '" . $brg_id . "', 1, '" . $product["harga_jual"] . "' , '" . getRealIpAddr() . " ', " . $hargadiskon . " , " . $hargaTotal . ", '1' ";


    if (mysqli_query($koneksi, $sql)) { } else { }

    mysqli_close($koneksi);
}

function getDetailsProduct($id)
{
    include 'koneksi.php';
    $sql = " SELECT * FROM m_barang WHERE  brg_id = '" . $id . "' LIMIT 1";
    $result = mysqli_query($koneksi, $sql);
    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {
            $response = $row;
        }
    } else {
        $response  = null;
    }

    mysqli_close($koneksi);
    return $response;
}


function getTotalPembayaran($user_id)
{
    include 'koneksi.php';
    $sql = "SELECT SUM(TOTAL) as 'TOTAL' FROM t_keranjang WHERE user_id ='" . $user_id . "'  and ip = '" . getRealIpAddr() . "'";
    $result = mysqli_query($koneksi, $sql);
    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {
            $response = $row["TOTAL"];
        }
    } else {
        $response  = null;
    }

    mysqli_close($koneksi);
    return $response;
}

function tambahQty($user_id, $brg_id)
{
    include 'koneksi.php';

    $product = getDetailsProduct($brg_id);
    $detailsBarang = getDetailsBarangCart($user_id, $brg_id);
    $newQty =  ++$detailsBarang["jumlah_trx"];

    //$hargadiskon = kalkulasidiskon($product["harga_jual"], $product["diskon"]);
    $total = $newQty  * $detailsBarang["hargadiskon"];

    $sql = "UPDATE t_keranjang SET jumlah_trx ='" . $newQty . "' , total  = '" . $total . "' WHERE  ip = '" . getRealIpAddr() . "' and  user_id = '" . $user_id . "' and brg_id = '" . $brg_id . "'  ";

    if ($koneksi->query($sql) === TRUE) { } else { }

    mysqli_close($koneksi);
}

function kurangiQty($user_id, $brg_id)
{
    include 'koneksi.php';

    $product = getDetailsProduct($brg_id);
    $detailsBarang = getDetailsBarangCart($user_id, $brg_id);
    $newQty =  --$detailsBarang["jumlah_trx"];

    //$hargadiskon = kalkulasidiskon($product["harga_jual"], $product["diskon"]);
    $total = $newQty  * $detailsBarang["hargadiskon"];

    $sql = "UPDATE t_keranjang SET jumlah_trx ='" . $newQty . "' , total  = '" . $total . "' WHERE  ip = '" . getRealIpAddr() . "' and  user_id = '" . $user_id . "' and brg_id = '" . $brg_id . "'  ";

    if ($koneksi->query($sql) === TRUE) { } else { }

    mysqli_close($koneksi);
}

function getDetailsBarangCart($userid, $brngId)
{
    include 'koneksi.php';
    $sql = " SELECT * FROM t_keranjang WHERE  brg_id = '" . $brngId . "' and user_id  = '" . $userid . "' LIMIT 1";
    $result = mysqli_query($koneksi, $sql);
    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {
            $response = $row;
        }
    } else {
        $response  = null;
    }

    mysqli_close($koneksi);
    return $response;
}


function getLastNobill($p = 0)
{
    include 'koneksi.php';
    $sql = "select nobill as nobill from t_order order by id desc limit 1";
    $result = mysqli_query($koneksi, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $response = $row["nobill"];
        }
    } else {
        $response  = 0;
    }
    mysqli_close($koneksi);


    $num = intval($response);

    $v = $num + $p;

    if ($v < 10) {
        $value = '00000' . $v;
    } else if ($v < 100) {
        $value = '0000' . $v;
    } else if ($v < 1000) {
        $value = '000' . $v;
    } else if ($v < 10000) {
        $value = '00' . $v;
    } else if ($v < 100000) {
        $value = '0' . $v;
    } else {
        $value = $v;
    }
    return strval($value);
}

function simpanOrder($userid)
{
    date_default_timezone_set('Asia/Jakarta');
    include 'koneksi.php';
    $tgl = date('d-m-Y G:i:s');
    $newNobil = getLastNobill(1);

    $sql = " INSERT INTO t_order (nobill,catatan,tanggal,userid,total,nomeja,ip)  ";
    $sql .= " SELECT  '" . $newNobil . "', '" . $_POST["catatan"] . "',  '" . $tgl . "','" . $userid . "' ,   '" . getTotalPembayaran($userid) . "' ,'" . $_POST["nomeja"] . "', '" . getRealIpAddr() . "' ";


    if (mysqli_query($koneksi, $sql)) {
        echo "New record created successfully";

        simpanPemesanan($userid, $newNobil);
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}

function getListMeja()
{
    $listMeja = [
        ['kdMeja' => '1', 'nmMeja' => 'Meja 1',],
        ['kdMeja' => '2', 'nmMeja' => 'Meja 2',],
        ['kdMeja' => '3', 'nmMeja' => 'Meja 3',],
        ['kdMeja' => '4', 'nmMeja' => 'Meja 4',],
        ['kdMeja' => '5', 'nmMeja' => 'Meja 5',],
        ['kdMeja' => '6', 'nmMeja' => 'Meja 6',],
        ['kdMeja' => '7', 'nmMeja' => 'Meja 7',],
        ['kdMeja' => '8', 'nmMeja' => 'Meja 8',],
        ['kdMeja' => '9', 'nmMeja' => 'Meja 9',],
        ['kdMeja' => '10', 'nmMeja' => 'Meja 10',],
        ['kdMeja' => '11', 'nmMeja' => 'Meja 11',],
        ['kdMeja' => '12', 'nmMeja' => 'Meja 12',],
        ['kdMeja' => '13', 'nmMeja' => 'Meja 13',],
        ['kdMeja' => '14', 'nmMeja' => 'Meja 14',],
        ['kdMeja' => '15', 'nmMeja' => 'Meja 15',],
        ['kdMeja' => '16', 'nmMeja' => 'Meja 16',],
        ['kdMeja' => '17', 'nmMeja' => 'Meja 17',],
        ['kdMeja' => '18', 'nmMeja' => 'Meja 18',],
        ['kdMeja' => '19', 'nmMeja' => 'Meja 19',],
        ['kdMeja' => '20', 'nmMeja' => 'Meja 20',],
    ];
    return $listMeja;
}

function getJenisKelamin()
{
    $jeniskelamin = [
        ['kd' => 'P', 'nama' => 'Cewe'],
        ['kd' => 'L', 'nama' => 'Cowo']
    ];
    return $jeniskelamin;
}




function getKeranjang($userid)
{
    include 'koneksi.php';

    $response = array();


    $sql = "SELECT a.brg_id,b.image,b.judul,a.keranjang_id,b.harga_jual,b.diskon,a.jumlah_trx,a.total FROM t_keranjang a
    LEFT OUTER JOIN m_barang b on a.brg_id = b.brg_id
    WHERE a.user_id = '" . $userid . "'  and  ip = '" . getRealIpAddr() . "' ";


    $result = mysqli_query($koneksi, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            $response[] = $row;
        }
    } else {
        $response[] = null;
    }

    mysqli_close($koneksi);
    return $response;
}



function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}


function simpanPemesanan($userid, $nobill)
{
    date_default_timezone_set('Asia/Jakarta');
    include 'koneksi.php';
    $tgl = date('d-m-Y G:i:s');

    $sql = " INSERT INTO t_pemesanan (nobill,user_id,brg_id,status_id,tanggal,hargabarang,hargadiskon,qty,total,ip,jenis_pemesanan_id)  ";
    $sql .= " SELECT '" . $nobill . "', user_id, brg_id, '2', '" . $tgl . "', hargabarang, hargadiskon,jumlah_trx,total,'" . getRealIpAddr() . "', '1'   FROM t_keranjang WHERE ip='" . getRealIpAddr() . "' and user_id = '" . $userid . "'  ";


    if (mysqli_query($koneksi, $sql)) {
        updateStok($userid);
        updateJmlterjual($userid);
        hapuskeranjang($userid);
        header('Location: ' . BASE_URL);
    } else {
        //
    }

    mysqli_close($koneksi);
}

function updateStok($userid)
{
    include 'koneksi.php';
    $data  = getKeranjang($userid);

    foreach ($data as $d) {
        $sql = "UPDATE m_barang SET stok = stok -'" . $d["jumlah_trx"] . "'  WHERE brg_id = '" . $d["brg_id"]  . "' ";

        if ($koneksi->query($sql) === TRUE) { } else { }
    }

    mysqli_close($koneksi);
}

function getPemesanan($userid)
{
    include 'koneksi.php';

    $response = array();

    $sql = "SELECT * FROM t_pemesanan a
    LEFT OUTER JOIN m_barang b on a.brg_id = b.brg_id
    WHERE a.user_id = '" . $userid . "'  and  ip = '" . getRealIpAddr() . "' ";


    $result = mysqli_query($koneksi, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            $response[] = $row;
        }
    } else {
        $response[] = null;
    }

    mysqli_close($koneksi);
    return $response;
}

function updateJmlterjual($userid)
{
    include 'koneksi.php';
    $data  = getPemesanan($userid);

    foreach ($data as $d) {
        $sql = "UPDATE m_barang SET jml_terjual = jml_terjual +'" . $d["qty"] . "'  WHERE brg_id = '" . $d["brg_id"]  . "' ";

        if ($koneksi->query($sql) === TRUE) { } else { }
    }

    mysqli_close($koneksi);
}

function hapuskeranjang($userid)
{
    include 'koneksi.php';

    $sql = " DELETE FROM t_keranjang WHERE  user_id = '" . $userid . "'  ";

    if (mysqli_query($koneksi, $sql)) { } else { }

    mysqli_close($koneksi);
}

function ubah_pemesananid($userid)
{
    //return null;
    include 'koneksi.php';

    $sql = "UPDATE t_keranjang SET pemesanan_id='2' WHERE  ip = '" . getRealIpAddr() . "' and  user_id = '" . $userid . "'  ";

    if ($koneksi->query($sql) === TRUE) {
        // echo "Record updated successfully";
    } else {
        // echo "Error updating record: " . $conn->error;
    }

    mysqli_close($koneksi);
    // ubah status pesanan disni
    // update pemesanan_id = 2

    // $newURL = '?i=beranda';
    // header('Location: ' . $newURL);
}

function getTotal($userid)
{
    include 'koneksi.php';
    $sql = " SELECT SUM(total) as 'TOTAL' FROM t_keranjang WHERE user_id = '" . $userid . "' and ip = '" . getRealIpAddr() . "' and pemesanan_id = 0 ";
    $result = mysqli_query($koneksi, $sql);
    $row = mysqli_fetch_assoc($result);
    $response = $row;
    return $response["TOTAL"];
    mysqli_close($koneksi);
}

function update_kodepemesanan_keranjang()
{
    include 'koneksi.php';
    $sql_update = " UPDATE t_keranjang SET    ";
    mysqli_close($koneksi);
}
