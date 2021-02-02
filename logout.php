<?php 
session_start();
require "config/koneksi.php";
// $hapus=mysqli_query("delete from keranjang where id_member='$_SESSION[id_pasien]'") or die("query");
// if ($hapus)
{
	session_destroy();
	echo '<script>alert("Anda Sudah Keluar")
	location=("index.php")</script>'; 
}
?>