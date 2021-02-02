<?php include 'config/koneksi.php';?>

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
    <?php include 'top_header.php';?>
   </div>

  <nav class="navbar navbar-default navbar-menu">
    <?php include 'menu.php';?>
  </nav>

</header>
<section id="inner-title" class="inner-title">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-lg-6"><h2>Profil Kami</h2></div>
      <div class="col-md-6 col-lg-6">
        <div class="breadcrumbs">
          <ul>
            <li>Current Page:</li>
            <li><a href="index.php">Home</a></li>
            <li><a href="profil.php">Profil Kami</a></li>
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
      <?php 
						$data = mysqli_query($connect, "SELECT * From profil order by id_profil DESC LIMIT 1");
						while($d = mysqli_fetch_array($data)){
					?>	
        <div class="textcont">
          <h3><?php echo $d ['judul_profil'];?></h3>
          <p> <?php echo $d ['isi_profil'] ;?></p>          
        </div>  
        
      </div>
      <div class="col-md-4 col-lg-4 wow fadeInUp" data-wow-delay=".2s">
        <div class="section-18-img">
      
          <img src="admin/uploads/profil/<?php echo $d ['gambar'] ;?>"  class="img-responsive" alt=""/>
        </div>
        <?php }
        ?>
      </div>
    </div>

  </div>
</section>
<section  id="section5" class="section-5 section-margine">
  <div class="container">
    <div class="row my-team">
      <div class="col-md-12">
        <header class="title-head">
          <h2>Produk Kami</h2>
          
          <div class="line-heading">
            <span class="line-left"></span>
            <span class="line-middle">+</span>
            <span class="line-right"></span>
          </div>
        </header>
      </div>
      <?php 
						$data = mysqli_query($connect, "SELECT * From spesialis order by id_spesialis limit 4");
						while($d = mysqli_fetch_array($data)){
					?>	
      <div class="col-md-3 col-sm-6 my-team-member wow fadeInUp">
        <div class="my-member-img">
          <img src="images/team/1.jpg" class="img-responsive" alt="team01">
        </div>
        <div class="my-team-detail text-center">
       
          <h4 class="my-member-name"><a href ="produk.php?id=<?php echo $d['id_spesialis']; ?>"><?php echo $d ['nama_spesialis'] ?> </a></h4>
          <!-- <class="muted"><a href="event.php?id=<?php echo $d['kd_event']; ?>" style="color: blue;">Read More ></class></a> -->
					   
        </div>    
        </div>
        <?php
						}
						?> 
      
    </div>
  </div>
</section>
<section id="section14" class="section-margine">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-lg-12">
        <header class="title-head">
          <h2>Tips dan Berita</h2>
          <!-- <p>Using many font styles canslow down your webpage, so only select the font styles that you</p> -->
          <div class="line-heading">
            <span class="line-left"></span>
            <span class="line-middle">+</span>
            <span class="line-right"></span>
          </div>
        </header>
      </div>
    </div>
    <div class="row">
    <?php 
						$data = mysqli_query($connect, "SELECT * From berita order by id_berita DESC limit 0,3");
						while($d = mysqli_fetch_array($data)){
					?>	
      <div class="col-md-4 col-lg-4">
        <div class="section-14-box wow fadeInUp">
          <img src="admin/uploads/berita/<?php echo $d ['gambar'] ;?>" class="img-responsive" alt="Blog image 1">
          <h3 align = "justify"><a href="berita.php?id=<?php echo $d ['id_berita'];?>"><?php echo $d ['judul_berita'] ;?></a></h3>
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="comments">
                <a class="btn btn-primary btn-sm"><?php echo $d ['tgl_update'];?></a>
                <a href="berita.php?id=<?php echo $d ['id_berita'];?>" class="btn btn-primary btn-sm">Lihat</a>
              </div>
            </div>
          </div>
          <p align = "justify"><?php echo substr($d ['isi_berita'],0,400);?>..
         </p>
        </div>
      </div>
            <?php } ?>
     
    </div>
  </div>
</section>

<section id="section9" class="section-margine section-9-background">
  <div class="container">
    <div class="row">
      <div class="col-md-2 col-sm-4 col-xs-6"><img src="images/clients/1.png" class="img-responsive wow fadeInUp" alt=""></div>
      <div class="col-md-2 col-sm-4 col-xs-6"><img src="images/clients/2.png" class="img-responsive wow fadeInUp" alt=""></div>
      <div class="col-md-2 col-sm-4 col-xs-6"><img src="images/clients/3.png" class="img-responsive wow fadeInUp" alt=""></div>
      <div class="col-md-2 col-sm-4 col-xs-6"><img src="images/clients/4.png" class="img-responsive wow fadeInUp" alt=""></div>
      <div class="col-md-2 col-sm-4 col-xs-6"><img src="images/clients/5.png" class="img-responsive wow fadeInUp" alt=""></div>
      <div class="col-md-2 col-sm-4 col-xs-6"><img src="images/clients/6.png" class="img-responsive wow fadeInUp" alt=""></div>
    </div>
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