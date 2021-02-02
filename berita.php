<?php session_start();
 include "config/koneksi.php" ;?>

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
  <div class="top-header">
    <?php include 'top_header.php';?>
   </div>

  <nav class="navbar navbar-default navbar-menu">
    <?php include 'menu.php';?>
  </nav>

<section id="inner-title" class="inner-title">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-lg-6">
        <h2>Berita</h2>
      </div>
      <div class="col-md-6 col-lg-6">
        <div class="breadcrumbs">
          <ul>
            <li>Current Page:</li>
            <li><a href="index.php">Home</a></li>
            <li><a href="#">Pages</a></li>
            <li><a href="#">Blog</a></li>
            <li><a href="berita.php">Berita</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- <?php $data=mysqli_query($connect,"select * from berita 
		  where id_berita='".$_GET['id']."' ");
		  $d=mysqli_fetch_assoc($data)  
		  ?>
			<div class="row ">
				<div class="col-lg-3-1 col-md-3  col-sm-3 ">
								<h3><strong>Berita</strong> </h3> 
								<hr>
				<?php 
					  $data = mysqli_query($connect,"SELECT * from berita order by id_berita desc limit 0,5");
					  while($d=mysqli_fetch_array($data))
					  {
					  ?>
            
                <div class="media"> <a href="berita.php?id=<?php echo $d['id_berita']; ?>" class="media-left">
				
                 <p><i class="fa fa-circle-o"></i><a href="berita.php?id=<?php echo $d['id_berita']; ?>" style="color: blue;"><?php echo $d['judul_berita']; ?></a> </p>
                </div>
             
				<?php } ?>
				</div>
			  <?php $query=mysqli_query($connect,"select * from berita 
			  where id_berita='".$_GET['id']."' ");
			  $data=mysqli_fetch_assoc($query)  
			  ?> -->
<section id="section14" class="section-margine blog-list">
  <div class="container">
    <div class="row">

    <?php $data=mysqli_query($connect,"select * from berita 
		  where id_berita='".$_GET['id']."' ");
		  $d=mysqli_fetch_assoc($data)  
      ?>
      
      <div class="col-md-9 col-lg-9">
   
        <div class="section-14-box">
          <img src="admin/uploads/berita/<?php echo $d ['gambar'];?>" width="100%" class="img-responsive" alt="Blog image 1">
          <h3><a href="#"><?php echo $d ['judul_berita'] ;?></a></h3>
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="comments">
                <a class=""><i class="fa fa-calendar"></i> <?php echo $d ['tgl_update'] ;?></a>
                <!-- <a class=""><i class="fa fa-user"></i> rkwebdes</a> -->
              </div>
            </div>
          </div>
          <p> <?php echo $d ['isi_berita'] ;?></?>
          
          <div class="comment-form-container wow fadeInLeft">
      
        </div>
        </div>
      </div>
     
        <div class="section-14-box"> 
          <h4 class="underline">BERITA</h4>
          <ul>
          <?php 
					  $data = mysqli_query($connect,"SELECT * from berita order by id_berita desc limit 0,5");
					  while($d=mysqli_fetch_array($data))
					  {
					  ?>
             <li><a href="berita.php?id=<?php echo $d ['id_berita'];?>"><?php echo $d ['judul_berita'] ;?></a></li>
             <?php }?>
          </ul>
       </div>
         
    
      </div>
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