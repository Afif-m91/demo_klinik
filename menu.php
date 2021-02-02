<?php session_start();
 $id_pasien=$_SESSION['username'];
include "config/koneksi.php";?>


<style type="text/css">
    body {
		font-family: 'Varela Round', sans-serif;
	}
	.modal-login {		
		color: #636363;
		width: 350px;
	}
	.modal-login .modal-content {
		padding: 20px;
		border-radius: 5px;
		border: none;
	}
	.modal-login .modal-header {
		border-bottom: none;   
        position: relative;
        justify-content: center;
	}
	.modal-login h4 {
		text-align: center;
		font-size: 26px;
		margin: 30px 0 -15px;
	}
	.modal-login .form-control:focus {
		border-color: #70c5c0;
	}
	.modal-login .form-control, .modal-login .btn {
		min-height: 40px;
		border-radius: 3px; 
	}
	.modal-login .close {
        position: absolute;
		top: -5px;
		right: -5px;
	}	
	.modal-login .modal-footer {
		background: #ecf0f1;
		border-color: #dee4e7;
		text-align: center;
        justify-content: center;
		margin: 0 -20px -20px;
		border-radius: 5px;
		font-size: 13px;
	}
	.modal-login .modal-footer a {
		color: #999;
	}		
	.modal-login .avatar {
		position: absolute;
		margin: 0 auto;
		left: 0;
		right: 0;
		top: -70px;
		width: 95px;
		height: 95px;
		border-radius: 50%;
		z-index: 9;
		background: #00aef0;
		padding: 15px;
		box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
	}
	.modal-login .avatar img {
		width: 100%;
	}
	.modal-login.modal-dialog {
		margin-top: 80px;
	}
    .modal-login .btn {
        color: #fff;
        border-radius: 4px;
		background: #00aef0;
		text-decoration: none;
		transition: all 0.4s;
        line-height: normal;
        border: none;
    }
	.modal-login .btn:hover, .modal-login .btn:focus {
		background: #00cff0;
		outline: none;
	}
	.trigger-btn {
		display: inline-block;
		margin: 10px auto;
	}
</style>
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> 
            <span class="sr-only">Toggle navigation</span> 
            <span class="icon-bar"></span> 
            <span class="icon-bar"></span> 
            <span class="icon-bar"></span> 
          </button>
          <a class="navbar-brand" href="index.php">
            <div class="logo-text"><span><samp>J</samp> MEDICAL HOMECARE</span></div>
            <!-- <img src="images/logo.png" alt="logo"> -->
          </a> 
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" data-hover="dropdown" data-animations="fadeIn">
          <ul class="nav navbar-nav navbar-right-dropdown-menu multi-level"class= "right">
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="profil.php">Profil</a></li>
            <li><a href="#">Konten </a></li>
            <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Produk <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="pengobatan.php">Pemeriksaan & Pengobatan</a></li>
                <li><a href="vaksin.php">Vaksin (Vendor)</a></li>
                <li><a href="fisioterapi.php">Fisioterapi</a></li>
                <li><a href="#">Konsultasi Gizi</a></li>
                <li><a href="abk.php">Konsultasi Psikologi mengenai ABK</a></li>
                <li><a href="#">Asesmen Perkembangan & Psikotes</a></li>
                <li class="divider"></li>
              <li class="dropdown-submenu">
                <a tabindex="-1" href="#">Kulit (Perawatan Wanita)</a>
                <ul class="dropdown-menu">
                  <li><a tabindex="-1" href="#">Facial</a></li>
                  <li><a tabindex="-1" href="#">Body SPA</a></li>
                  <li><a tabindex="-1" href="#">Message</a></li>
                  <li><a tabindex="-1" href="#">Ratus</a></li>
                                   
                </ul>
              </li>
                    
                       
                <li><a href="#">Visit Terapi Untuk Anak</a></li>
              </ul>
            </li>
            <!-- <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Blog <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="blog-listing.html">Blog Listing</a></li>
                <li><a href="blog-details.html">Blog Details</a></li>
              </ul>
            </li> -->
            <li><a href="#">Dokter Umum/MCU</a></li>
            <li><a href="#">Tentang Kami</a></li>
            <!-- <li><a href="#loginModal" data-toggle="modal">Booking Pemeriksaan</a></li> -->
			<?php if(isset($_SESSION['id_pasien']))
		  {
		  echo'
		  <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"
		   role="button" aria-expanded="false">Booking <span class="caret"></span></a>
            <ul class="dropdown-menu">
				<li><a href="booking.php">Booking Pemeriksaan</a></li>
            	<li><a href="lihat_booking.php">Lihat Booking</a></li>
              </ul>
            </li> 
         
		  ';
		  }
		  ?>
          <?php if(!isset($_SESSION['id_pasien']))
		  {
		  echo'
          <li><a href="#loginModal" data-toggle="modal">Booking Pemeriksaan</a></li>
		  ';
		  }
		  else
		  {
		  echo"
          <li><a href='logout.php'>Log Out [ $id_pasien ]</a></li>
		  "; } ?>  
	<!-- Button HTML (to Trigger Modal) -->
	
<!-- Modal HTML -->
<div id="loginModal" class="modal fade">
	<div class="modal-dialog modal-login">
		<div class="modal-content">
			<div class="modal-header">
				<div class="avatar">
					<img src="images/avatar.png" alt="Avatar">
				</div>				
				<h4 class="modal-title">Member Login</h4>	
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<form action="proses_login.php" method="post">
					<div class="form-group">
						<input type="text" class="form-control" name="username" placeholder="Username" >		
					</div>
					<div class="form-group">
						<input type="password" class="form-control" name="password" placeholder="Password">	
					</div>        
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-lg btn-block login-btn">Login</button>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<a href="daftar.php">Belum Punya Akun ? Daftar</a>
			</div>
		</div>
	</div>
</div>     
          </ul>
        </div>
        <!--/.nav-collapse --> 
        
      </div>
    

     