<?php

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=Data_Harga_".$date.".xls");

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
<table class="table table-striped">
						<thead>
          <br>  <caption> Data Harga </caption> </b>
          
						  <tr>
              <th style="background-color:yellow;">NO</th>
							<th style="background-color:yellow;">ID HARGA</th>
							<th style="background-color:yellow;">KECAMATAN</th>
							<th style="background-color:yellow;">MODA</th>
							<th style="background-color:yellow;">HARGA</th>
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
      <td><?php echo $row->id_harga; ?>
      </td>
      <td><?php echo $row->kecamatan; ?>
      </td>
      <td><?php echo $row->moda; ?>
      </td>
      <td><?php echo $row->harga; ?>
      </td>
        </tr>
    <?php }
            } ?>
            
  </tbody>
</table>