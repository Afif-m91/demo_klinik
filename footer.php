<?php session_start();
$nama=$_SESSION['nama'];
	include "config/koneksi.php";?>

<section id="footer-top" class="footer-top">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-lg-3">
        <div class="footer-top-box">
          <h4>Tentang Kami</h4>
          <p> </p>
        </div>
        <div class="footer-top-box">
          <h4>Jam Operasional</h4>
          <b>Mon-Fri :</b> 09am to 06pm<br/>
          <b>Tues-Wed :</b> Special Appointment
        </div>
      </div>
      <div class="col-md-3 col-lg-3">
        <div class="footer-top-box">
          <h4>Latest Posts</h4>
          <ul>
            <li>
              <div class="recent-post-widget">
                <a href="#" class="widget-img-thumb">
                  <img src="images/post-1.jpg" class="img-responsive">
                </a>
                <div class="widget-content">
                  <h5><a href="#" class="sidebar-item-title">Enterprise Video Solutions</a></h5>
                  <a href="#">
                    <p class="widget-date">Posted: 3 day ago</p>
                  </a>
                </div>
                <div class="clearfix"></div>
              </div>
            </li>
            <li>
              <div class="recent-post-widget">
                <a href="#" class="widget-img-thumb">
                  <img src="images/post-2.jpg" class="img-responsive">
                </a>
                <div class="widget-content">
                  <h5><a href="#" class="sidebar-item-title">Medical Instruments</a></h5>
                  <a href="#">
                    <p class="widget-date">Posted: 6 month ago</p>
                  </a>
                </div>
                <div class="clearfix"></div>
              </div>
            </li>
          </ul>
        </div>
      </div>
       
      <div class="col-md-3 col-lg-3">
        <div class="footer-top-box">
       
          <h4>Tags</h4>
          <?php 
						$data = mysqli_query($connect, "SELECT * From spesialis order by id_spesialis");
						while($d = mysqli_fetch_array($data)){
					?>	
          <div class="tag"><a href="#"><?php echo $d ['nama_spesialis'];?></a></div>
          <?php }?>
        </div>
           
      </div>
      <?php 
						$data = mysqli_query($connect, "SELECT * From info_web order by id_web");
						while($d = mysqli_fetch_array($data)){
					?>	
      <div class="col-md-3 col-lg-3">
        <div class="footer-top-box">
          <h4>Alamat Kami</h4>
          <p><b>Location :<?php echo $d['alamat_klinik']; ?></b> <br/>
            <b>Mob: </b> <?php echo $d['no_hp'];?><br/>
            <b>Mail: </b>  <?php echo $d['email'];?> </p>
        </div>
         <?php
				}
			    ?> 
        
      </div>
    </div>
  </div>
</section>
<section id="footer-bottom" class="footer-bottom">
  <div class="container">
    <div class="row">
      <div class="col-md-9 col-lg-9">
        <div class="copyright">Copyright &copy; 2020. All Rights Reserved</div>
      </div>
      <div class="col-lg-3">
        <ul class="list-inline social-buttons">
          <li><a href="#"><i class="fa fa-twitter"></i></a></li>
          <li><a href="#"><i class="fa fa-facebook"></i></a></li>
          <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
          <li><a href="#"><i class="fa fa-youtube"></i></a></li>
        </ul>
      </div>
    </div>
  </div>
</section>