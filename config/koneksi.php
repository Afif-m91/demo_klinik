	
<?php
// konfigurasi database
$host       =   "localhost";
$user       =   "root";
$password   =   "";
$database   =   "klinik";
// perintah php untuk akses ke database
$connect = mysqli_connect($host, $user, $password, $database);
error_reporting(E_ALL ^ E_NOTICE);
// session_start();
?>