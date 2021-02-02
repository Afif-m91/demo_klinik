<?php 
include 'config/koneksi.php';
$id = $_GET['id'];
$query = mysqli_query($connect, "DELETE FROM pemeriksaan WHERE id_pemeriksaan = '$id'") or die(mysql_error());
if($query) {
    echo "<script>alert('Data berhasil dihapus!'); window.location='index.php';</script>";
} else {
    echo "<script>alert('Data gagal dihapus'); window.location='index.php';</script>";
}
?>