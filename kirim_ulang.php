<?php
session_start();
error_reporting();
require_once("koneksi.php");
$s1 = mysqli_query($koneksi, "SELECT * FROM m_user WHERE user_id = '$_SESSION[idver]'");
$h1 = mysqli_fetch_array($s1);
$c = rand(100000,999999);
require_once('PHPMailer/PHPMailerAutoload.php');
$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'shopeerlpipump@gmail.com';
$mail->Password = 'lpipshopeer23';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
$mail->setFrom('shopeerlpipump@gmail.com', 'BOOK STORE LPIP UMP');
$mail->addReplyTo('shopeerlpipump@gmail.com', 'BOOK STORE LPIP UMP');
$mail->addAddress($h1['user_email']);
$mail->Subject = 'VERIFIKASI AKUN';
				
$mail->isHTML(true);
$mailContent = "<h1>SELAMAT BERGABUNG </h1>
				<p>hai $h1[user_nama]</p><br>
				<p>Tinggal 1 Lagkah Lagi Untuk Verifikasi Akun Anda</p><br>
				<p>Terimakasih telah bergabung bersama kami di <b>BOOK STORE LPIP UMP.</b><br>
				Nama : $h1[user_nama] <br>
				No. HP : $h1[user_nohp]<br>
				E-mail : $h1[user_email]</p>
				<p>Silahkan Masukan Kode Dibawah Ini Dengan Benar Untuk Melakukan Verifikasi Akun Anda</p>
				<center><h2>$c</h2></center>";
$mail->Body = $mailContent;
if(!$mail->send()){
	echo 'Pesan tidak dapat dikirim.';
	echo 'Mailer Error: ' . $mail->ErrorInfo;
}
else{
	mysqli_query($koneksi, "UPDATE m_user SET no_verif = '$c' WHERE user_id = '$_SESSION[idver]'");
	?>
	<script>
    	alert("Kode Verifikasi Telah Dikirim, Silahkan Cek E-Mail Anda");
    	window.location = "?i=<?php echo md5('verif')?>";
    </script>
    <?php
}
?>