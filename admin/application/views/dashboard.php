<div class="content-wrapper">
	<section class="content-header">
	  <h1>
		<?php echo $title?>
	  </h1>
	  

<style>
.info-box-content {
    padding: 5px 10px;
    margin-left: 90px;
	  }

.info-box {
    display: block;
    min-height: 90px;
    background: #fff;
    width: 100%;
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    border-radius: 2px;
    margin-bottom: 15px;
}

.info-box-text {
    text-transform: uppercase;
}
</style>
	  <hr> </hr>
	  <hr> </hr>

	   <?php 
$conn=mysqli_connect("localhost","root","","klinik");
?>

<div class="row">
<div class="col-lg-3 col-xs-3">
	<div class="info-box">
		<span class="info-box-icon bg-grey">
			<?php
			$result=mysqli_query($conn,"SELECT*,COUNT(*) as 'count' FROM pemeriksaan WHERE status='1' GROUP BY 'status' ");
			while($comp=mysqli_fetch_array($result)) 
			{
			echo $comp['count'];	 
			}
			?>
		</span>
		
	<div class= "info-box-content">
				<span class ="info-text">
				Data Booking Pasien Yang Masuk				
				</span>
					
			</div>
		</div>
	</div>

 <div class="col-lg-3 col-xs-3">
	<div class="info-box">
		<span class="info-box-icon bg-green">
			<?php
			$result=mysqli_query($conn,"SELECT*,COUNT(*) as 'count' FROM pemeriksaan WHERE status='2' GROUP BY 'status' ");
			while($comp=mysqli_fetch_array($result)) 
			{
			echo $comp['count'];	 
			}
			?>
		</span>
	
	<div class= "info-box-content">
				<span class ="info-text">
				Data Booking Pasien Yang Sudah Selesai				
				</span>
					
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-xs-3">
	<div class="info-box">
		<span class="info-box-icon bg-yellow">
			<?php
			$result=mysqli_query($conn,"SELECT*,COUNT(*) as 'count' FROM pemeriksaan WHERE status='3' GROUP BY 'status' ");
			while($comp=mysqli_fetch_array($result)) 
			{
			echo $comp['count'];	 
			}
			?>
		</span>
		
	<div class= "info-box-content">
				<span class ="info-text">
				Data Booking Pasien Yang Sedang Berjalan				
				</span>
					
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-xs-3">
	<div class="info-box">
		<span class="info-box-icon bg-red">
			<?php
			$result=mysqli_query($conn,"SELECT*,COUNT(*) as 'count' FROM pemeriksaan WHERE status='4' GROUP BY 'status' ");
			while($comp=mysqli_fetch_array($result)) 
			{
			echo $comp['count'];	 
			}
			?>
		</span>
		<?php
		$conn=mysqli_connect("localhost","root","","klinik");
		?>
	<div class= "info-box-content">
				<span class ="info-text">
				Data Booking Pasien Yang Dibatalkan				
				</span>
					
			</div>
		</div>
	</div>		
	<div class="col-lg-3 col-xs-3">
	<div class="info-box">
		<span class="info-box-icon bg-blue">
			<?php
			$result=mysqli_query($conn, "SELECT count(*) as total from pemeriksaan");
			$data=mysqli_fetch_assoc($result);
			echo $data['total'];
			?>
		</span>
		
	<div class= "info-box-content">
				<span class ="info-text">
				Total Data Booking Pasien Yang Masuk				
				</span>
					
			</div>
		</div>
	</div>		

</div>


	</section>
	<section class="content">
	</section>
</div>
