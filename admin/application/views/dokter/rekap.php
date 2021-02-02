<link rel="stylesheet" href="<?php echo base_url('assets/template/plugins/datepicker/datepicker3.css')?>">
<script src="<?php echo base_url('assets/template/plugins/datepicker/bootstrap-datepicker.js')?>"></script>
<script>
	$(function(){
		$('#from').datepicker();
		$('#to').datepicker();
	});
</script>
<div class="content-wrapper master">
	<section class="content-header">
	  <h1>
		<?php echo $title?>
	  </h1>
	</section>
	<?php
		 $msg_err = $this->session->flashdata('admin_save_error');
		 $msg_succes = $this->session->flashdata('admin_save_success');
	?>
	<?php if(!empty($msg_err)): ?>
	<div class="alert alert-danger">
		<a href="#" class="close" data-dismiss="alert">&times;</a>
		<strong>Error!</strong> <?php echo $msg_err;?>
	</div>
	<?php endif; ?>
	<?php if(!empty($msg_succes)): ?>
	<div class="alert alert-success">
		<a href="#" class="close" data-dismiss="alert">&times;</a>
		<strong>Succes!</strong> <?php echo $msg_succes;?>
	</div>
	<?php endif; ?>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header">
						<div class="filter-wrapper box-tools pull-right">
								<form class="form-horizontal" method="get" action="<?php echo site_url("barang/rekap")?>" id="filter-form" >
								<div class="panel-heading">
									<div class="row">
										<div class="col-md-5  pull-right">
                      <div class="form-action pull-right">
												<button type="submit" class="btn btn-success" name="action" value="excel">Export to Excel</button>
												<button type="submit" class="btn btn-danger" name="action" value="pdf">Export to PDF</button>
												
												<!-- <button class="btn btn-warning btn-sm" type="button" data-toggle="dropdown"> Export
												<span class="caret"></span></button>
												<ul class="dropdown-menu">
													<li><a href="<?php echo site_url("kurir/export_excel")?>" class="fa fa-file-excel-o" style="color:green">
												&nbsp;Export Excel</a></li>
													<li><a href="<?php echo base_url("kurir_pdf/cetak_pdf.php") ?>"class="fa fa-file-pdf-o" style="color:red"
												 target="_blank">&nbsp; Export PDF</a></li>
												
												</ul> -->
											</div>
										</div>
									</div>
			
								</div>
								<div class="panel-body">
									Periode
									
									<div class="row">
										<div class="col-md-3">
											<div class="input-group">
											 <div class="input-group-addon">dari</div>
											 <input type="text" class="form-control datepicker"
                          id="from" name="from"
                          data-date-format="yyyy/mm/dd"
                          value="<?php echo $this->input->get("from") != ""
                            ? date("Y-m-d",strtotime($this->input->get("from")))
                            : date("Y-m-d",strtotime("-30 days")) ?>">
											  <div class="input-group-addon glyphicon glyphicon-calendar"></div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="input-group">
											 <div class="input-group-addon">sampai</div>
											<input type="text" class="form-control datepicker"
                        id="to" name="to"
                        data-date-format="yyyy/mm/dd"
                        value="<?php echo $this->input->get("to") != ""
                          ? date("Y-m-d",strtotime($this->input->get("to")))
                          : date("Y-m-d") ?>">
											  <div class="input-group-addon glyphicon glyphicon-calendar"></div>
											</div>
										</div>
										<div class="col-sm-3">
                      <select class="form-control" name="id_barang" id="id_barang" required>
                        <option value="all">Pilih ID Barang</option>
                        <?php foreach($barang as $row):?>
                          <option value="<?php echo $row->id_barang; ?>"><?php echo $row->id_barang; ?></option>
                        <?php endforeach;?>
                      </select>
										</div>
										<div class="col-md-2">
											<button type="submit" class="btn btn-success" name="cari" value="cari">show</button>
										</div>
									</div>
								</form>
						</div>
					</div>
						<div class="box-body no-padding">
						<table class="table table-striped">
						<thead>
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
				echo ("Data Tidak Ada");
			
            } else {
              foreach ($data as $row) { ?>
                <tr>
                  <td><?php echo $row->id_barang; ?></td>
                  <td><?php echo $row->tgl_barang; ?></td>
                  <td><?php echo $row->nama; ?></td>
                  <td><?php echo $row->satuan; ?></td>
                  <td><?php echo $row->del_no; ?></td>
                  <td><?php echo $row->id_kategori; ?></td>
                  <td><?php echo $row->nama_kategori; ?></td>
                </tr>
              <?php }
            } ?>
						</tbody>
					</table>
					</div>

				</div>
			</div>
		</div>
	</section>
</div>