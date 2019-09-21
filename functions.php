<?php

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


function getKeranjang($userid)
{
    include 'koneksi.php';

    $response = array();


    $sql = "SELECT a.brg_id,b.image,b.judul,a.keranjang_id,b.harga_jual,b.diskon,a.jumlah_trx,a.total, a.id_meja, a.jumlah_trx, a.total FROM t_keranjang a
 LEFT OUTER JOIN m_barang b on a.brg_id = b.brg_id
   WHERE a.user_id = '" . $userid . "' AND pemesanan_id = '0'";


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
