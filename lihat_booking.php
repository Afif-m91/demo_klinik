<?php session_start();
if(!isset($_SESSION['id']))
$id_pasien=$_SESSION['username'];
$nama=$_SESSION['nama_pasien'];
// $nama=$_SESSION['nama_pasien'];
// $email=$_SESSION['email'];
// $id=$_SESSION['id_pasien'];

 include "config/koneksi.php";

// $qPasien="SELECT * FROM pasien_online";
// $resultPasien = mysqli_query($connect, $qPasien);

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
        <h2>Lihat Booking Pemeriksaan</h2>
      </div>
      <div class="col-md-6 col-lg-6">
        <div class="breadcrumbs">
          <ul>
            <li>Current Page:</li>
            <li><a href="index.php">Home</a></li>
            <li><a href="lihat_booking.php">Lihat Booking Pemeriksaan</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
<section id="section16" class="section16">
  <div class="container">
    <div class="col-lg-12">
      <table class="table table-bordered">
     
      <!-- <?php
      echo "<pre>";
      print_r($nama);
      print_r($id_pasien);
      echo "</pre>";

      ?> -->

        <thead>
          <tr>
          <!-- <?php echo $_SESSION['nama_pasien']; ?> -->
        
            <th>No</th>
            <th>Nama Pasien</th>
            <th>Keluhan</th>
            <th>Spesialis</th>
            <th>No Handphone</th>
            <th>Email</th>
            <th>Tanggal Booking</th>
            <th>Jam Booking</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>

          <?php
          
          // Memanggil data berdasarkan SESSION login
        
          // if(!isset($_SESSION['id_pasien']))
          // {}
          $no = 1 ;
          $query = mysqli_query($connect, "SELECT * FROM pemeriksaan,spesialis 
          WHERE pemeriksaan.id_spesialis=spesialis.id_spesialis AND id_pasien='$_SESSION[id_pasien]'");
          while($data = mysqli_fetch_array($query)) 
          {
          ?>
        <tbody>
         <!-- <?php
      echo "<pre>";
      print_r($data);
     echo "</pre>";
     ?> -->
          <tr>
          
            <td><?php echo $no++; ?></td>
            <td> <?php echo $_SESSION['nama_pasien']; ?></td>
            <td><?php echo $data ['keluhan'];?></td>
            <td><?php echo $data ['nama_spesialis'];?></td>
            <td><?php echo $data ['no_hp']; ?></td>
            <td><?php echo $data ['email']; ?></td>
            <td><?php echo $data ['tgl_booking']; ?></td>
            <td><?php echo $data ['jam_booking']; ?></td>
            <!-- <td><?php echo $data ['status']; ?></td> -->
            <?php
							
								$status = "<span class='label label-default'>Booking Masuk</span>";
								if($data['status'] == 2)
									$status = "<span class='label label-success'>Sudah Selesai</span>";
								else if($data['status'] == 3)
									$status = "<span class='label label-warning'>Sedang Berjalan</span>";
								else if($data['status'] == 4)
									$status = "<span class='label label-danger'>Booking Ditolak</span>";
							?>
							<td><?php echo $status;?></td>
              <td>
					<a href="edit_booking.php?id=<?php echo $data['id_pemeriksaan'];?>">
						<button class="btn btn-success btn-sm"> <i class="fa fa-edit"></i> Edit </button>
					</a>
					<a href="hapus_booking.php?id=<?php echo $data['id_pemeriksaan'];?>"onclick="return confirm('Yakin hapus data?')">
						<button class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> Hapus </button>
					</a>
				</td>
          </tr>
 <?php 
 }
 ?>     
        </tbody>
     
      </table>
    </div>
  </div>
</section>

<?php include "footer.php";?>

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