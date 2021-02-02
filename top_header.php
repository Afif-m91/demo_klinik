<?php include 'config/koneksi.php';?>
<div class="top-header">
     <div class="container">
       <div class="row ">
       <?php 
						$data = mysqli_query($connect, "SELECT * From info_web order by id_web LIMIT 1");
						while($d = mysqli_fetch_array($data)){
					?>	
         <ul class="contact-detail2 col-md-6 pull-left">
           <li> <a href="#" target="_blank"><i class="fa fa-mobile"></i><?php echo $d ['no_hp'] ;?></a> </li>
           <li> <a href="#" target="_blank"><i class="fa fa-envelope-o"></i> <?php echo $d ['email'];?></a> </li>
         </ul>
            <?php }
            ?> 
         <div class="social-links col-md-6 pull-right">
           <ul class="social-icons pull-right">
             <li> <a href="http://facebook.com" target="_blank"><i class="fa fa-facebook"></i></a> </li>
             <li> <a href="http://twitter.com" target="_blank"><i class="fa fa-twitter"></i></a> </li>
             <li> <a href="http://pinterest.com" target="_blank"><i class="fa fa-pinterest"></i></a> </li>
             <li> <a href="http://dribble.com/" target="_blank"><i class="fa fa-skype"></i></a> </li>
             <li> <a href="http://pinterest.com" target="_blank"><i class="fa fa-dribbble"></i></a> </li>
             <input class="search_input" type="text" name="" placeholder="Search...">
            <a href="#" class="search_icon"><i class="fa fa-search icon"></i></a>
            </ul>
         </div>
       </div>
     </div>
    </div>