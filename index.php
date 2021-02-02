<?php session_start();
// $username=$_SESSION['username'];
	include "config/koneksi.php";?>
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
<!-- <title>JAKARTA MEDICAL HOMECARE</title> -->
<?php include 'title.php'?>
<!-- Fav Icons   -->
<link rel="icon" href="images/favicon.png" type="image/x-icon">
<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-dropdownhover.min.css" rel="stylesheet">
<!-- Fonts Awesome -->
<link href="css/font-awesome.min.css" rel="stylesheet">
<!-- Google Fonts -->
<link href='https://fonts.googleapis.com/css?family=Raleway:400,200,300,100,500,600,700,800,900' rel='stylesheet' type='text/css'>
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400" rel="stylesheet">
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
<section id="slider" class="">
  <!-- Carousel -->
  <div id="main-slide" class="carousel slide" data-ride="carousel">

    <!-- Indicators -->
    <ol class="carousel-indicators visible-lg visible-md">
        <li data-target="#main-slide" data-slide-to="0" class="active"></li>
       <li data-target="#main-slide" data-slide-to="1"></li>
       <li data-target="#main-slide" data-slide-to="2"></li>
    </ol><!--/ Indicators end-->

    <!-- Carousel inner -->
    <div class="carousel-inner">

      <div class="item active" style="background-image:url(images/slide/slide1.jpg)">
            <div class="slider-content text-left">
               <div class="col-md-12">
                   <!-- <h2 class="slide-title effect2">Empowering People</h2>
                   <h3 class="slide-sub-title effect3">To Improve Their Lives</h3>
                   <p class="slider-description lead effect3">Praesent convallis tortor et enim laoreet, vel consectetur purus latoque.</p>
                   <p class="effect3">
                    <a href="#" class="slider btn btn-primary">Our Service</a>
                    <a href="#" class="slider btn btn-secondary">About Us</a>
                   </p>       -->
               </div>
            </div>
       </div><!--/ Carousel item 1 end -->


      <div class="item" style="background-image:url(images/slide/slide2.jpg)">
            <div class="slider-content">
               <div class="col-md-12 text-center">
                   <!-- <h2 class="slide-title effect4">Of care every day</h2>
                   <h3 class="slide-sub-title effect5">Higher standards</h3>
                   <p>
                    <a href="#" class="slider btn btn-primary">Our Services</a>
                   </p>       -->
               </div>
            </div>
       </div><!--/ Carousel item 2 end -->


       <div class="item" style="background-image:url(images/slide/slide3.jpg)">
            <div class="slider-content text-right">
               <div class="col-md-12">
                   <!-- <h2 class="slide-title effect6">To better healthcare</h2>
                   <h3 class="slide-sub-title effect7">Leading the way</h3>
                   <p class="slider-description lead effect7">Praesent convallis tortor et enim laoreet, vel consectetur purus latoque.</p>
                   <p>
                    <a href="#" class="slider btn btn-primary">Consultation</a>
                    <a href="#" class="slider btn btn-primary border">Know More</a>
                   </p>       -->
               </div>
            </div>
        </div><!--/ Carousel item 3 end -->
        
    </div><!-- Carousel inner end-->

    <!-- Controllers -->
    <a class="left carousel-control" href="#main-slide" data-slide="prev">
        <span><i class="fa fa-angle-left"></i></span>
    </a>
    <a class="right carousel-control" href="#main-slide" data-slide="next">
        <span><i class="fa fa-angle-right"></i></span>
    </a>
  </div><!--/ Carousel end -->
</section>
<section id="section1" class="section-margine">
  <div class="container">
    <div class="row">

    <div class="container">
		<div class="row ">
			<div class="col-lg-14 col-md-4  col-sm-4 "> 
                <div class="section-1-box wow bounceIn">
				    <div id="box-layanan">
                     <br>
				    <a href="pickup.php"><i class="fa fa-search fa-5x"></a></i>
					<p><h4><strong>Dokter Kami</strong> </h4></p>
                    <br>
                    <p class="text-center">Pilih Berdasarkan Nama, Spesialis dan Lainya</p>
					<a href="pickup.php" button class="btn btn-primary" type button="submit">Cari Dokter</button></a>
                 </div>
            </div>
					</p>
		</div>
                
        <div class="col-lg-14 col-md-4  col-sm-4 "> 
                <div class="section-1-box wow bounceIn">
				    <div id="box-layanan">
                     <br>
				    <a href="pickup.php"><i class="fa fa-map-marker fa-5x"></a></i>
					<p><h4><strong>Klinik Kami</strong> </h4> </p>
                    <br>
                    <p class="text-center">Temukan Kami</p>
                    <br>
					<a href="pickup.php" button class="btn btn-primary" type button="submit">Cari Klinik</button></a>
                 </div>
            </div>
					</p>
		</div>
					

		<div class="col-lg-14 col-md-4  col-sm-4 "> 
            <div class="section-1-box wow bounceIn">
                <div id="box-layanan">
                    <br>
                    <a href="pickup.php"><i class="fa fa-ambulance fa-5x"></a></i>
                    <p><h4><strong>Ambulace</strong> </h4></p>
                    <br>
                    <p class="text-center">Dapatkan Bantuan Gawat Darurat Medis Dari Klinik Kami</p>
                    <a href="pickup.php" button class="btn btn-danger" type button="submit">Ambulance (021) 888 888 88 </button></a>
                    </div>
                    </p>
                </div>     
            </div>
            	
		</div>
	</div>

     
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

<!-- <section id="section10" class="section-10-background">
  <div class="container">
    <div class="row">
      <div class="col-md-9 col-lg-9">
        <div class="section-10-box-text-cont">
          <h3>We Are Ready to Check Your Health,<span class="color-yellow">  Call : +81-2356-65896</span></h3>
        </div>
      </div>
      <div class="col-md-3 col-lg-3">
        <div class="section-10-btn-cont"><a href="#" class="btn btn-secondary wow fadeInUp">Get a quote</a></div>
      </div>
    </div>
  </div>
</section> -->
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
          <div classpe="row">
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

<!-- <section id="section8" class="mytestimonial">
  <div class="container"> -->
    <!-- <div class="row">
      <div data-ride="carousel" class="carousel slide" id="testimonial">
        <ol class="carousel-indicators">
          <li data-target="#testimonial" data-slide-to="0" class="active"><img alt="Testimonial" class="img-responsive" src="images/people/1.jpg">
          </li>
          <li data-target="#testimonial" data-slide-to="1"><img alt="Testimonial" class="img-responsive" src="images/people/2.jpg">
          </li>
        </ol> -->
        <!-- <div class="carousel-inner">
          <div class="item text-center quotes-detail active left">
            <p class="client-quote"><i class="fa fa-quote-left"></i>Focus on what really matters: your product. Create beautiful, unique websites with impact full landing pages and banners, without any coding or design skills<i class="fa fa-quote-right "></i></p>
            <h5 class="client-name">John</h5>             
          </div>
          <div class="item text-center quotes-detail next left">
            <p class="client-quote"><i class="fa fa-quote-left "></i>Focus on what really matters: your product. Create beautiful, unique websites with impact full landing pages and banners, without any coding or design skills<i class="fa fa-quote-right "></i></p>
            <h5 class="client-name">John</h5>
          </div> -->
        </div> <!-- end carosel-inner --> 
      </div> <!-- end Quotes -->
    <!-- </div> -->
  <!-- </div>
</section> -->
<section id="section9" class="section-9-background">
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
<section id="section23" class="appointment">
  <div class="modal fade" id="appointment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog style-one" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Make an Appoinment</h4>
        </div>
        <div class="modal-body">
          <div class="appoinment-form-outer">
            <form action="" method="post">
              <h4>Fill Up Appointment Form.</h4>
                <div class="form-group">
                  <label>Name <span class="required">*</span></label>
                  <input type="text" class="form-control" required="" placeholder="First Name" value="" name="name">
                </div>
                <div class="form-group">
                  <label>Email <span class="required">*</span></label>
                  <input type="email" class="form-control" required="" placeholder="Email" value="" name="name">
                </div>
                <div class="form-group">
                  <label>Phone <span class="required">*</span></label>
                  <input type="text" class="form-control" required="" placeholder="Phone" value="" name="name">
                </div>
                <div class="form-group">
                  <label>Age <span class="required">*</span></label>
                  <input type="text" class="form-control" required="" placeholder="age" value="" name="name">
                </div>
                <div class="form-group">
                  <label>Appoinment Date <span class="required">*</span></label>
                  <input class="datepicker form-control" type="text" required="" placeholder="MM/DD/Year" value="" name="name">
                </div>
                <div class="form-group">
                  <label>Time<span class="required">*</span></label>
                  <input type="text"  class="timepicker form-control" required="" placeholder="Time" value="" name="name">
                </div>
                <div class="form-group">
                  <label>Address <span class="required">*</span></label>
                  <input type="text" class="form-control" required="" placeholder="Address" value="" name="name">
                </div>
                <div class="text-left">
                  <button type="button" class="btn btn-primary">Send Message</button>
                </div>
            </form>
          </div>
        </div>
      </div>
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