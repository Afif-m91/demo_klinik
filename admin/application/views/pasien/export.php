<?php

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=Data_Kurir_".$date.".xls");

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
          <br>  <caption> Data Kurir </caption> </b>
          
						  <tr>
              <th style="background-color:yellow;">NO</th>
							<th style="background-color:yellow;">ID KURIR</th>
							<th style="background-color:yellow;">NAMA</th>
							<th style="background-color:yellow;">JENIS KELAMIN</th>
							<th style="background-color:yellow;">TELEPON</th>
							<th style="background-color:yellow;" widht="700">ALAMAT</th>
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
      <td><?php echo $row->id_kurir; ?>
      </td>
      <td><?php echo $row->nama; ?>
      </td>
      <td><?php echo $row->jenis_kelamin; ?>
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