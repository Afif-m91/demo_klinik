<?php
session_start();

include "config/koneksi.php";

$username = $_POST["username"];
$p = md5($_POST["password"]);

$sql = "select * from pasien_online where username='".$username."' and password='".$p."' limit 1";
$hasil = mysqli_query ($connect,$sql);
$jumlah = mysqli_num_rows($hasil);


	if ($jumlah>0) {
		$row = mysqli_fetch_assoc($hasil);
		$_SESSION["id_pasien"]=$row["id_pasien"];
		$_SESSION["username"]=$row["username"];
		$_SESSION["nama_pasien"]=$row["nama_pasien"];
		$_SESSION["email"]=$row["email"];
		$_SESSION["no_hp"]=$row["no_hp"];
		$_SESSION["alamat"]=$row["alamat"];
	
		echo "<script>alert('Selamat Datang $_SESSION[nama_pasien] di Klinik')</script>";
		header("Location:beranda_member.php");
		
	}else {
       echo '<script>alert("Username Dan Password Anda Salah.!!")
	location=("index.php")</script>'; 
		// echo "Username atau password salah <br><a href='index.php'>Kembali</a>";
        // echo "<pre>";
        // print_r($username);
        // print_r();
    
        // print_r($p);
        
        // echo "</pre>";
    }
?>