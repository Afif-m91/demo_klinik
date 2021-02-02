<?php session_start();
include "config/koneksi.php";
if(!isset($_SESSION['id']))
// $qSpesialis="SELECT * FROM spesialis";
// $resultSpesialis = mysqli_query($connect, $qSpesialis);

//  $id_pemeriksaan=$_SESSION['id_pemeriksaan'];
// $nama=$_SESSION['nama_pasien'];
// $email=$_SESSION['email'];
// $id=$_SESSION['id_pasien'];
// $alamat=$_SESSION['alamat'];
// $no_hp=$_SESSION['no_hp'];
// $keluhan=$_SESSION['keluhan'];
// $tgl_booking=$_SESSION['tgl_booking'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Medicamp Responsive Bootstrap Template">
<meta name="keywords" content="Pixel">
<meta name="author" content="rkwebdesigns">
<!-- Site Title   -->
<title>Klinik</title>
<!-- Fav Icons   -->
<link rel="icon" href="images/favicon.png" type="image/x-icon">
<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-dropdownhover.min.css" rel="stylesheet">
<!-- Fonts Awesome -->
<link href="css/font-awesome.min.css" rel="stylesheet">
<!-- Google Fonts -->
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,800italic,800,600italic,600,400italic,700,700italic' rel='stylesheet' type='text/css'>
<!-- animate Effect -->
<link href="css/animate.css" rel="stylesheet">
<!-- Main CSS -->
<link href="css/style.css" rel="stylesheet">
<!-- Responsive CSS -->
<link href="css/responsive.css" rel="stylesheet">
</head>
<body>
<header id="header" class="head">
<?php include 'top_header.php';?>
  <nav class="navbar navbar-default navbar-menu">
  <?php include 'menu.php';?>
</header>
<section id="inner-title" class="inner-title">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-lg-6">
        <h2>Booking Online Pemeriksaan</h2>
      </div>
      <div class="col-md-6 col-lg-6">
        <div class="breadcrumbs">
          <ul>
            <li>Current Page:</li>
            <li><a href="index.php">Home</a></li>
            <li><a href="booking.php">Booking Pemeriksaan</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  
</section>
<section id="section16" class="section16">
  <div class="container">
    <div class="row">
   
    <div class="row">
      <div class="col-md-6 col-lg-6">
      <?php
      include 'config/koneksi.php';
      	$id = $_GET['id'];
        $query = mysqli_query($connect,"SELECT * FROM pemeriksaan, spesialis WHERE spesialis.id_spesialis=pemeriksaan.id_spesialis
                              AND id_pemeriksaan='$id'") or die(mysqli_error());
        $data = mysqli_fetch_array($query);
          ?>     
      
       <form action="proses_update_booking.php" method="post">
     
          <!-- successfully -->
          <p class="success alert alert-success"><i class="fa fa-check"></i> Data diri sudah sukses. </p>
          <!-- unsuccessfully -->
          <p class="error alert alert-danger"><i class="fa fa-times"></i> E-mail anda harus benar. </p>
          <div class="control-group form-group">
            <div class="controls">
              <label> Nama Lengkap</label>
              <input  class="form-control" id="id_pasien" type="text" name="id_pasien" value="<?php echo $_SESSION['nama_pasien']; ?>" readonly>
              <input  class="hidden" id="id_pasien" type="text" name="id_pasien" value="<?php echo $data ['id_pemeriksaan']; ?>" readonly>
              <p class="help-block"></p>
            </div>
          </div>
          <div class="control-group form-group">
            <div class="controls">
            <label> Email</label>
              <input class="form-control" id="email" type="email" name="email" placeholder="Email" value="<?php echo $data ['email']; ?>" readonly>
            </div>
          </div>
          <div class="control-group form-group">
            <div class="controls">
            <label> Keluhan</label>
                <input class="form-control" id="keluhan" type="text" name="keluhan" placeholder="Keluhan" value="<?php echo $data ['keluhan']; ?>" >
               <!-- <input class="form-control" id="id_pasien" type="text" required="required" name="id_pasien" <?php echo $id_pasien ?> readonly> -->
            </div>
          </div>

          <div class="control-group form-group">
            <div class="controls">
            <label>Spesialis</label>
              <select name="nama_spesialis" class="form-control">
              <?php 
						$query2 = mysqli_query($connect, "SELECT * From spesialis WHERE id_spesialis ! ='$data[id_spesialis]'");
					
          ?>	
            <!-- <option value="pilih spesialis">-- Pilih Spesialis -- </option> -->
            <option value="<?php echo $data['id_spesialis']?>"><?php echo $data['nama_spesialis']?> </option>
            <?php 
						$query = mysqli_query($connect, "SELECT * From spesialis ");
						while($row = mysqli_fetch_array($query)){
          ?>	
              <option value="<?=$row['id_spesialis']?>"><?=$row['nama_spesialis']?> </option>
           <?php
           }
           ?> 
              </select>
             </div>
          </div>

          <div class="control-group form-group">
            <div class="controls">
            <label> No Handphone </label>
             <input class="form-control" id="no_hp" type="text" name="no_hp" placeholder="No Handphone"
              value="<?php echo $data ['no_hp'];?>">  </textarea>
            </div>
          </div>
         
          <div class="control-group form-group">
            <div class="controls">
            <label> Tanggal Booking </label>
             <input class="form-control" id="tgl_booking" type="date" name="tgl_booking" value="<?php echo $data ['tgl_booking'];?>" >
            </div>
          </div>
          
          <div class="control-group form-group">
            <div class="controls">
            <label> Jam Booking </label>
            <input type="time" name="jam_booking" id="jam_booking"  class="form-control" onkeyup="jam_booking();"  value="<?php echo $data ['jam_booking'];?>" /> 
            </div>
          </div>
          <!-- <?php
      echo "<pre>";
       print_r($data);
      echo "</pre>";

      ?> -->
      </div>
      <div class="col-md-6 col-lg-6">
      <div class="control-group form-group">
        <div class="controls">
            <label> Alamat</label>
          <textarea class="form-control custom-control" id="alamat" rows="4" name="alamat" placeholder="Alamat" > <?php echo $data ['alamat']; ?> </textarea>
        </div>
      </div>
       
    <div id="success"></div>
          <!-- For success/fail messages -->
          <button type="submit" name="submit" class="btn btn-primary">SUBMIT</button>
        </form>
        
  </div>
</section>
<?php include 'footer.php';?>

<script src="js/jquery.min.js"></script> 
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.plugin.min.js"></script>
<script src="js/jquery.isotope.min.js"></script> 
<script src="js/jquery.magnific-popup.min.js"></script> 
<script src="js/bootstrap-dropdownhover.min.js"></script>
<script src="js/wow.min.js"></script> 
<script src="js/waypoints.min.js"></script> 
<script src="js/jquery.counterup.min.js"></script> 
<script src="js/main.js"></script>
</body>
</html>