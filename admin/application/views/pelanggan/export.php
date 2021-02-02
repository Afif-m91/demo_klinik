<?php

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=Data_Pelanggan_".$date.".xls");

header("Pragma: no-cache");

header("Expires: 0");

?>
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 15px;
 
}

</style>

<table class="table table-bordered" table-bordered="1">

						<thead>
           <b> <caption> Data Pelanggan</caption></b>
           <!-- <p><b> Data Pelanggan </b> </p>  -->

              <tr>
              <th style="background-color:yellow;">NO</th>
							<th style="background-color:yellow;">ID PELANGGAN</th>
							<th style="background-color:yellow;">NAMA PELANGGAN</th>
							<th style="background-color:yellow;">TELEPON</th>
							<th style="background-color:yellow;" width="700" >ALAMAT</th>
						  </tr>
						</thead>
				
  <tbody>
    <?php
    $no = 1;
            if (!$data) {
                echo("Data Tidak Ada");
            } else {
              
                foreach ($data as $row) { ?>
    <tr>
    <td><?php echo $no++ ;?></td>
      <td><?php echo $row->id_pelanggan; ?>
      </td>
      <td><?php echo $row->nama; ?>
      </td>
      <td><?php echo $row->telepon; ?>
      </td>
      <td><?php echo $row->alamat; ?>
      </td>
        </tr>
    <?php }
            } ?>
            
  </tbody>
</table>