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
<?php include "title.php";?>
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
  <div class="top-header">
  <?php include "top_header.php" ;?>
  
    </div>
  <nav class="navbar navbar-default navbar-menu">
  <?php include "menu.php" ;?>
  </nav>
</header>
<section id="inner-title" class="inner-title">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-lg-6"><h2>Produk & Layanan</h2></div>
      <div class="col-md-6 col-lg-6">
        <div class="breadcrumbs">
          <ul>
            <li>Current Page:</li>
            <li><a href="index.php">Home</a></li>
            <li><a href="#">Produk & Layanan</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>      
<section id="section18" class="section-margine">
  <div class="container">
  <div class="section18">
    <div class="row">
      <div class="col-md-8 col-lg-8 wow fadeInUp">
      <!-- <?php 
						$data = mysqli_query($connect, "SELECT * From profil order by id_profil DESC LIMIT 1");
						while($d = mysqli_fetch_array($data)){
					?>	 -->
        <div class="textcont">
          <!-- <h3><?php echo $d ['judul_profil'];?></h3> -->
          <p align ="justify"> <h3> Pemeriksaan mengenai keluhan fisiologis yang dialami serta pengobatan yang dilakukan 
              oleh dokter </h3></p>          
        </div>  
        
      </div>
      <div class="col-md-4 col-lg-4 wow fadeInUp" data-wow-delay=".2s">
        <div class="section-18-img">
      
          <img src="admin/uploads/pengobatan.jpg"  class="img-responsive" alt=""/>
        </div>
        <?php }
        ?>
      </div>
    </div>
  </div>
</section>

<section id="section14" class="section-margine">
  <div class="container">
    
     
   
  </div>
</section>

<?php include "footer.php" ;?>

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