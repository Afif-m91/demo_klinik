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

$query = mysqli_query($connect,"UPDATE  pemeriksaan SET keluhan='$keluhan',email='$email',
alamat='$alamat',id_spesialis='$nama_spesialis',no_hp='$no_hp',tgl_booking='$tgl_booking',
jam_booking='$jam_booking' where id_pemeriksaan='$id'") or die(mysqli_error());


//Mengeksekusi/menjalankan query diatas	
//   $hasil=mysqli_query($connect,$sql);
  

//Kondisi apakah berhasil atau tidak
if($query) {
  echo "<script>alert('Data berhasil di Update!'); window.location='lihat_booking.php';</script>";
} else {
  echo "<script>alert('Data gagal ditambahkan');</script>";
}
?>