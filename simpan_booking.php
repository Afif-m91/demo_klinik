<?php
//Include file koneksi ke database
include "config/koneksi.php";

//menerima nilai dari kiriman form pendaftaran
// $date = date('Y-m-d H:i:s');
// $nama_pasien = $_POST['nama_pasien'];
$id = $_POST['id_pasien'];
$keluhan= $_POST['keluhan'];
$email= $_POST['email'];
$alamat= $_POST['alamat'];
$nama_spesialis= $_POST['nama_spesialis'];
$no_hp= $_POST['no_hp'];
$tgl_booking = $_POST['tgl_booking'];
$jam_booking = $_POST['jam_booking'];

$query = mysqli_query($connect,"INSERT INTO pemeriksaan (id_pasien,keluhan,email,alamat,id_spesialis,no_hp,tgl_booking,jam_booking) 
VALUES ('$id','$keluhan','$email','$alamat','$nama_spesialis','$no_hp','$tgl_booking','$jam_booking')") or die(mysqli_error($connect));


//Mengeksekusi/menjalankan query diatas	
//   $hasil=mysqli_query($connect,$sql);
  

//Kondisi apakah berhasil atau tidak
if($query) {
  echo "<script>alert('Data berhasil ditambahkan!'); window.location='index.php';</script>";
} else {
  echo "<script>alert('Data gagal ditambahkan');</script>";
}
?>