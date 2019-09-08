
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "semestacoffee";

// Create connection
$koneksi = mysqli_connect($servername, $username, $password, $dbname);

if (!$koneksi) {
    die("Connection failed: " . mysqli_connect_error());
}


$sql = "SELECT * FROM t_keranjang a LEFT OUTER JOIN m_barang b on a.brg_id = b.brg_id WHERE a.user_id = '14' AND pemesanan_id = '0'";
$result = mysqli_query($koneksi, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
        $rr[] =  $row;
    }
} else {
    // echo "0 results";
}

mysqli_close($koneksi);
echo "<pre>";
print_r($rr);
echo "</pre>";

?> 
