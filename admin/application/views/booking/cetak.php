<style>
	@media print {
		@page {
		  size: 8.267in 5.5in;
		  margin: 0;
		}
		.header-pt
		{
			font-weight:bold;
		}
	}
	.tbl-resi
	{
		font-size:11px;
	}
	.table-wrapper
	{
		border:1px solid gray;
		border-top:4px solid gray;
		height:180px;
		padding-top:5px;
	}
	.border-bottom
	{
		border-bottom:1px solid gray;
	}
	.border-top
	{
		border-top:1px solid gray;
	}
	.border-left
	{
		border-left:1px solid gray;
	}
	.img-qrcode
	{
		position:absolute;
		top:0;
		right:0;
	}
	.img-logo
	{
		position:absolute;
		top:10px;
		left:20px;
	}
</style>			
<div class="content-wrapper print resi">
	<table>
		<tr>
			<td width='450' align="center" valign='top'>
				<img class="img-logo" src="<?php echo base_url("assets/images")."/261218spl-logo.png"; ?>" width="90" height="50" />
				<div class='header-pt'>PT. Sinarmas Pelangi</div>
				<div class='header-address'>Alamat: Jl. Tanah Tinggi Timur No. 1 A,  </div>
				<div class='header-address'>Harapan Mulia Kemayoran, Jakarta Pusat, </div>
				<div class='header-address'>Indonesia 10640, Telp 021-426 8989</div>
			</td>
			<td valign='top'>
				<img class="img-qrcode" src="<?php echo base_url("export")."/".$data->id_pemeriksaan.".png"?>" width="90" height="90" />
				<div >
					Jakarta, <?php echo date('d M Y',strtotime($data->tgl_booking)); ?>
				</div>
				<div class='mt10'>
					KEPADA Yth.
				</div>
				<div>
					<?php echo $data->nama_pasien; ?>
				</div>
				<div class='mt10'>
					<?php echo $data->alamat; ?>
				</div>
			</td>
		</tr>
		<tr>
			<td rowspan="2">
				<div class='header-pt'>SURAT JALAN No. <?php echo $data->id_pemeriksaan; ?></div>
				<div class="mb10">Harap diterima dengan baik barang tsb. Dibawah ini</div>
			</td>
		<tr>
	</table>
	<div class='table-wrapper'>
		<table style="width:100%"  style="mt10"  cellpadding='5' cellspacing='0'>
			<tr >
				<th class="border-bottom border-top " height="10">No</th>
				<th class="border-bottom border-top">Kode Barang</th>
				<th class="border-bottom border-top">Nama Barang</th>
				<th class="border-bottom border-top">Del No</th>
				<th class="border-bottom border-top">QTY</th>
				<th class="border-bottom border-top">Sat</th>
			</tr>
			<tbody>
			<!-- <?php if($data->booking != null): ?>
			<?php $booking = explode("===",$data->booking); ?>
			<?php $i = 1; ?>
			<?php foreach($booking as $br): ?>
			<?php $b = explode("|",$br) ?>
			<tr  class="tbl-resi">
				<td align="center" height="10"><?php echo $i; ?></td>
				<td align="center"><?php echo $b[0]; ?></td>
				<td align="center"><?php echo $b[1]; ?></td>
				<td align="center"><?php echo $b[5]; ?></td>
				<td align="center"><?php echo $b[4]; ?></td>
				<td align="center"><?php echo $b[3]; ?></td>
			</tr>
			<?php $i++; ?>
			<?php endforeach ?>
			
			<?php endif ?> -->
		</tbody>
		</table>
	</div>
	<table style="width:100%">
		<tr>
			<td valign='top' style="width:55%" >
				<div class='mt10'>
					Kendaraan No. <?php echo $data->nama_pasien; ?>
				</div>
				<div class='mt10'>
					PO No. <?php echo $data->id_pasien; ?>
				</div>
			</td>
			<td valign='top' style="width:30%">
				<div class='mt10'>
					Diterima Oleh: <br> <br> <br> <br> <br>(_____________) 
				</div>
			</td>
			<td valign='top' style="width:15%">
				<div class='mt10'>
					Hormat Kami <br> Kurir Surya <br> <br> <br> <br> (_____________)
				</div>
			</td>
		</tr>
	</table>
	
</div>
<script>
	$(function(){
		window.print();
	});
</script>
