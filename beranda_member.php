<?php if(isset($_SESSION['id_pasien']))
{
	?>
<div style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; font-size:16px;" align="justify">
<p>&nbsp;</p>
<p>&nbsp;</p>
<p><strong>Hallo <?php echo $_SESSION['nama']; ?>, Selamat datang ditoko kami..</strong></p>
<table width="250" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th width="79" scope="col"><div align="left"><a href="?r=keranjang"><img src="images/Check_out_cart.png" width="69" height="60" title="Lihat Keranjang" /></a></div></th>
    <th width="171" scope="col"><div align="left">Keranjang Belanja</div></th>
    </tr>
  <tr>
    <td><div align="left"><a href="?r=histori"><img src="images/finance.png" width="66" height="61" title="Lihat Transaksi" /></a></div></td>
    <td><div align="left"><strong>Data Transaksi</strong></div></td>
    </tr>
</table>
<div style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; font-size:16px;" align="justify">
  <p>&nbsp;</p>
  <p><strong>Selamat Datang Di Jam Tangan Online </strong></p>
  <p>Jam tangan dengan model terbaru dan modern barang berkualitas dengan harga terjangkau, pilihan merk terbaik dengan gaya dan brand ternama untuk pria dan wanita.<br />
  <p>Seluruh transaksi kami akan diantar dengan kurir JNE</p>
  <p>&nbsp;</p>
  <p><img src="images/JNE.png" width="251" height="146" /></p>
  <p>&nbsp;</p>
</div>


</div>
<?php } 
else {echo"
	<script>location=('index.php?r=beranda')</script>";
}
?>