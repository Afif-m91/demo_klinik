<html>
<head>
	<title>Cetak PDF</title>
</head>
<body>

<h1 style="text-align: center;">Data Pelanggan</h1>

<style>
table {
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
}
</style>

<table border="1" align="center">
<tr>
	<th>No</th>
	<th>NIS</th>
	<th>Nama</th>
	<th>Jenis Kelamin</th>
	<th>Telepon</th>
	<th>Alamat</th>
</tr>
<?php
if( ! empty($pelanggan)){
	$no = 1;
	foreach($pelanggan as $data){
		echo "<tr>";
		echo "<td>".$no."</td>";
		echo "<td>".$data->id_pelanggan."</td>";
		echo "<td>".$data->nama."</td>";
		echo "<td>".$data->jenis_kelamin."</td>";
		echo "<td>".$data->telp."</td>";
		echo "<td>".$data->alamat."</td>";
		echo "</tr>";
		$no++;
	}
}
?>
</table>

</body>
</html>
