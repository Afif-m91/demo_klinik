<?php
//Include file koneksi ke database
include "config/koneksi.php";

//menerima nilai dari kiriman form pendaftaran
$id_pasien=$_POST["id_pasien"];
$nama_pasien=$_POST["nama_pasien"];
$username=$_POST["username"];
$jenis_kelamin=$_POST["jenis_kelamin"];
$no_hp=$_POST["no_hp"];
$email=$_POST["email"];
$tanggal_lahir=$_POST["tanggal_lahir"];
$tempat_lahir=$_POST["tempat_lahir"];
$agama=$_POST["agama"];
$status_perkawinan=$_POST["status_perkawinan"];
$no_ktp=$_POST["no_ktp"];
$alamat=$_POST["alamat"];
$password=md5($_POST["password"]); //untuk password digunakan enskripsi md5

// Validasi

// if (empty($_POST['nama_pasien']) || empty($_POST['jenis_kelamin']) || empty($_POST['email']) || empty($_POST['no_hp']) || 
//     empty($_POST['alamat']) || empty($_POST['username']) || empty($_POST['tanggal_lahir']) || empty($_POST['agama']) || 
//     empty($_POST['status_perkawinan']) || empty($_POST['no_ktp']) || empty($_POST['password']))
// {
// echo'
// 	<script language="javascript">
// 	window.alert("Maaf, data yang anda masukkan tidak lengkap. silakan lengkapi data anda")
// 	 window:history.go(-1)</script>';
	    
//    }

//Query input menginput data kedalam tabel anggota
//   $sql="insert into pasien (id_pasien,nama_pasien,username,jenis_kelamin,no_hp,email,tanggal_lahir,tempat_lahir,agama,
//   		status_perkawinan,no_ktp,alamat,password) values
// 		('$id_pasien','$nama_pasien','$username','$jenis_kelamin','$no_hp','$email','$tanggal_lahir','$tempat_lahir','$agama',
// 		'$status_perkawinan','$no_hp','$alamat','$password')";
$hasil=mysqli_query($connect,"INSERT INTO pasien_online VALUES ('$id_pasien','$nama_pasien','$username','$jenis_kelamin','$no_hp','$email','$tanggal_lahir','$tempat_lahir','$agama',
	'$status_perkawinan','$no_hp','$alamat','$password')")or die(mysqli_error($connect));
 


//Mengeksekusi/menjalankan query diatas	
//   $hasil=mysqli_query($connect,$sql);
  

//Kondisi apakah berhasil atau tidak
  if ($hasil) {
	echo '<script language="javascript">
              alert ("Registrasi Berhasil Di Lakukan!");
              window.location="index.php";
              </script>';
              exit();
  }
else {
	echo '<script language="javascript">
              alert ("Registrasi Gagal Di Lakukan!");
              window.location="daftar.php";
              </script>';
              exit();
}  

?>