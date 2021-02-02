<?php

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=Report_Barang_".$date.".xls");

header("Pragma: no-cache");

header("Expires: 0");

?>

<table class="table table-striped">
  <thead>
    <tr>
      <th colspan="7"><?php echo $title ?></th>
    </tr>
    <tr>
      <th>ID BARANG</th>
      <th>TANGGAL</th>
      <th>NAMA BARANG</th>
      <th>SATUAN</th>
      <th>DEL NO</th>
      <th>ID KATEGORI</th>
      <th>NAMA KATEGORI</th>
    </tr>
  </thead>
  <tbody>
    <?php
            if (!$data) {
                echo("Data Tidak Ada");
            } else {
                foreach ($data as $row) { ?>
    <tr>
      <td><?php echo $row->id_barang; ?>
      </td>
      <td><?php echo $row->tgl_barang; ?>
      </td>
      <td><?php echo $row->nama; ?>
      </td>
      <td><?php echo $row->satuan; ?>
      </td>
      <td><?php echo $row->del_no; ?>
      </td>
      <td><?php echo $row->id_kategori; ?>
      </td>
      <td><?php echo $row->nama_kategori; ?>
      </td>
    </tr>
    <?php }
            } ?>
  </tbody>
</table>