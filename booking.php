<?php session_start();
$nama=$_SESSION['nama_pasien'];
$email=$_SESSION['email'];
$id=$_SESSION['id_pasien'];
$alamat=$_SESSION['alamat'];
$no_hp=$_SESSION['no_hp'];

 include "config/koneksi.php";

$qPasien="SELECT * FROM pasien_online";
$resultPasien = mysqli_query($connect, $qPasien);

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
       <form action="simpan_booking.php" method="post">
          
          <!-- successfully -->
          <p class="success alert alert-success"><i class="fa fa-check"></i> Data diri sudah sukses. </p>
          <!-- unsuccessfully -->
          <p class="error alert alert-danger"><i class="fa fa-times"></i> E-mail anda harus benar. </p>
          <div class="control-group form-group">
            <div class="controls">
              <label> Nama Lengkap</label>
              <!-- <input type="" name="id" value="<?php echo $qPasien['id_pemeriksaan']; ?>"> -->
             
        <!-- Select Data tables       -->
              <!-- <?php
				echo '<select name="nama_pasien">';
				while($pasien=mysqli_fetch_array($resultPasien)){
				echo '<option value="' . $pasien['id_pasien'] . '" required>' . $pasien['nama_pasien'] . '</option>';
				}
				echo '</select>';
				?> -->
              <input  class="form-control" id="id_pasien" type="text" name="id_pasien" value="<?php echo $nama ?>" readonly>
              <input  class="hidden" id="id_pasien" type="text" name="id_pasien" required="required" value="<?php echo $id ?>" readonly>
              <p class="help-block"></p>
            </div>
          </div>
          <div class="control-group form-group">
            <div class="controls">
            <label> Email</label>
              <input class="form-control" id="email" type="email" name="email" placeholder="Email" required="required" value="<?php echo $email ?>" readonly>
            </div>
          </div>
          <div class="control-group form-group">
            <div class="controls">
            <label> Keluhan</label>
                <input class="form-control" id="keluhan" type="text" name="keluhan" required="required" placeholder="Keluhan">
               <!-- <input class="form-control" id="id_pasien" type="text" required="required" name="id_pasien" <?php echo $id_pasien ?> readonly> -->
            </div>
          </div>
          <div class="control-group form-group">
            <div class="controls">
            <label>Spesialis</label>
              <select name="nama_spesialis" class="form-control">
             
            <option value="pilih spesialis">-- Pilih Spesialis -- </option>
            <?php 
						$query = mysqli_query($connect, "SELECT * From spesialis ");
						while($data = mysqli_fetch_array($query)){
          ?>	
              <option value="<?=$data['id_spesialis']?>"><?=$data['nama_spesialis']?> </option>
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
              value="<?php echo $no_hp ?>">  </textarea>
            </div>
          </div>
           <!-- <div class="control-group form-group">
            <div class="controls">
          <label>Jenis Kelamin</label>
              <select name="jenis_kelamin" class="form-control">
              <option value="laki-laki" <?php echo $jenis_kelamin == "laki-laki" ? "selected" : "" ?>>Laki-laki</option>
              <option value="perempuan" <?php echo $jenis_kelamin == "perempuan" ? "selected" : "" ?>>Perempuan</option>
              </select>
            </div>
          </div> -->
          <div class="control-group form-group">
            <div class="controls">
            <label> Tanggal Booking </label>
             <input class="form-control" id="tgl_booking" type="date" name="tgl_booking">
            </div>
          </div>
          
          <div class="control-group form-group">
            <div class="controls">
            <label> Jam Booking </label>
            <input type="time" name="jam_booking" id="jam_booking"  class="form-control" onkeyup="jam_booking();" /> 
            </div>
          </div>
          <!-- <div class="control-group form-group">
            <div class="controls">
            <label> Tempat Lahir </label>
             <input class="form-control" id="tempat_lahir" type="text" name="tempat_lahir" placeholder="Tempat Lahir">
            </div>
          </div> -->
          <!-- <div class="control-group form-group">
            <div class="controls">
              <textarea class="form-control custom-control" id="cf-message" rows="4" name="cf-message" placeholder="Alamat "></textarea>
            </div>
          </div> -->
         
      </div>
      <div class="col-md-6 col-lg-6">
      <div class="control-group form-group">
        <div class="controls">
            <label> Alamat</label>
          <textarea class="form-control custom-control" id="alamat" rows="4" name="alamat" placeholder="Alamat "> <?php echo $alamat ?> </textarea>
        </div>
      </div>
        <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.4515050296823!2d85.30938781439113!3d27.70334258279361!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m3!3e6!4m0!4m0!5e0!3m2!1sen!2snp!4v1469920087323" width="800" height="370" frameborder="0" style="border:0" allowfullscreen></iframe> -->
<!--           
          <div class="control-group form-group">
            <div class="controls">
            <label>Agama</label>
              <select name="agama" class="form-control">
             
            <option value="pilih agama">-- Pilih Agama -- </option>
            <?php 
						$data = mysqli_query($connect, "SELECT * From agama ");
						while($d = mysqli_fetch_array($data)){
          ?>	
              <option value="<?=$d['nama_agama']?>"><?=$d['nama_agama']?> </option>
           <?php
           }
           ?> 
              </select>
             </div>
          <br/>
             <div class="control-group form-group">
            <div class="controls">
          <label>Status Perkawinan</label>
              <select name="status_perkawinan" class="form-control">
              <option value="-" <?php echo $status_perkawinan == "-" ? "selected" : "" ?>>-- Pilih Status --</option>
              <option value="Sudah Menikah" <?php echo $status_perkawinan == "Sudah Menikah" ? "selected" : "" ?>>Sudah Menikah</option>
              <option value="Belum Menikah" <?php echo $status_perkawinan == "Belum Menikah" ? "selected" : "" ?>>Belum Menikah</option>
              <option value="Sudah Bercerai" <?php echo $status_perkawinan == "Sudah Bercerai" ? "selected" : "" ?>>Sudah Bercerai</option>
              </select>
            </div>
          </div>

          </div>
          <div class="control-group form-group">
            <div class="controls">
            <label>No KTP </label>
             <input class="form-control" id="no_ktp" type="text" name="no_ktp" placeholder="No KTP">
            </div>
          </div>
        </div>
              
    </div> -->
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