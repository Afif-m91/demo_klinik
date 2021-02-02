<link rel="stylesheet" href="<?php echo base_url('assets/template/plugins/datepicker/datepicker3.css')?>">
<script src="<?php echo base_url('assets/template/plugins/datepicker/bootstrap-datepicker.js')?>"></script>


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
<script>
	$(function() {
		$("input[name='tgl_barang']").datepicker();

	}) ;
</script>	
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
					<form  class="form-horizontal" method="post" action="<?php echo site_url("barang/save")?>"  >
						<input type="hidden" class="form-control" id="id" name="id" value="<?php echo $data->id_barang; ?>" >
						<div class="box-body">
							<div class="form-group">
								<label for="id_barang" class="col-sm-2 control-label">ID kurir</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="id_barang"  name="id_barang" 
									value="<?php echo $data->id_barang == "" ? $data->autocode : $data->id_barang; ?>"  readonly   >
								</div>
							</div>
							<div class="form-group">
								
								<div class="col-sm-4">
								  <input type="hidden" required="required" class="form-control datepicker" id="tgl_barang" 
								  data-date-format="Y-m-d" placeholder="select tanggal" name="tgl_barang" value="<?php echo $data->tgl_barang != "" ?
								   date("Y-m-d",strtotime($data->tgl_barang)) : date("Y-m-d"); ?>" >
								</div>
							</div>
							<div class="form-group">
								<label for="nama" class="col-sm-2 control-label">Nama</label>
								<div class="col-sm-4">
								  <input type="text" class="form-control"  required="required" id="nama"  name="nama"
								   placeholder="input nama" value="<?php echo $data->nama; ?>"  >
								</div>
							</div>
							<div class="form-group">
								<label for="satuan" class="col-sm-2 control-label">Satuan</label>
								<div class="col-sm-3">
								<input type="text" class="form-control"  required="required" id="satuan"  name="satuan"
								 placeholder="input satuan" value="<?php echo $data->satuan; ?>"  >
								</div>
							</div>
							<div class="form-group">
								<label for="del no" class="col-sm-2 control-label">Del No</label>
								<div class="col-sm-4">
								  <input type="text" class="form-control"  required="required" id="del_no"  name="del_no"
								   placeholder="input del" value="<?php echo $data->del_no; ?>"  >
								</div>
							</div>
							<div class="form-group">
								<label for="id kategori" class="col-sm-2 control-label">ID Kategori</label>
								<div class="col-sm-4">
								<select class="form-control" name="id_kategori" id="id_kategori" required>
										<option value="">Pilih Kategori</option>
										<?php foreach($kategori as $row):?>
										<option value="<?php echo $row['id_kategori']; ?>"> <?php echo $row['id_kategori']; ?> </option>
										<?php endforeach;?>
										<div class="form-group">
								</select>
							</div>		
							
							<!--	  <textarea class="form-control"  rows="3" id="id_kategori" name="id_kategori"  placeholder="input " required="required"><?php echo $data->id_kategori; ?></textarea> -->	
								
							</div>				
								<div class="form-group">
								<label for="id kategori" class="col-sm-2 control-label">Nama Kategori</label>
								<div class="col-sm-4">
								<select class="form-control" name="nama_kategori" id="nama_kategori" required>
										<option value="">Pilih Nama Kategori</option>
										<?php foreach($kategori as $row):?>
										<option value="<?php echo $row['nama_kategori']; ?>"> (<?php echo $row['id_kategori']; ?>) <?php echo $row['nama_kategori']; ?> </option>
										<?php endforeach;?>
										<div class="form-group">
								</select>
							</div>		
							</div>
						<div class="box-footer">
							<button type="submit" class="btn btn-primary" name="action" value="save">save</button>
							<button type="submit" class="btn btn-success" name="action" value="saveexit">save & exit</button>
							<button type="reset" class="btn btn-warning">reset</button>
							<a  href="<?php echo site_url("barang")?>" class="btn btn-danger">cancel</a>
						</div>
					</form>
					
				</div>
			</div>
		</div>
	</section>
</div>