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
		$("input[name='tgl_dokter']").datepicker();

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
					<form  class="form-horizontal" method="post" action="<?php echo site_url("dokter/save")?>"  >
						<input type="hidden" class="form-control" id="id" name="id" value="<?php echo $data->id_dokter; ?>" >
						<div class="box-body">
							<div class="form-group">
								<label for="id_dokter" class="col-sm-2 control-label">ID kurir</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="id_dokter"  name="id_dokter" 
									value="<?php echo $data->id_dokter == "" ? $data->autocode : $data->id_dokter; ?>"  readonly   >
								</div>
							</div>
							<div class="form-group">
								
								<div class="col-sm-4">
								  <input type="hidden" required="required" class="form-control datepicker" id="tgl_dokter" 
								  data-date-format="Y-m-d" placeholder="select tanggal" name="tgl_dokter" value="<?php echo $data->tgl_dokter != "" ?
								   date("Y-m-d",strtotime($data->tgl_dokter)) : date("Y-m-d"); ?>" >
								</div>
							</div>
							<div class="form-group">
								<label for="nama dokter" class="col-sm-2 control-label">Nama Dokter</label>
								<div class="col-sm-4">
								  <input type="text" class="form-control"  required="required" id="nama_dokter"  name="nama_dokter"
								   placeholder="input nama" value="<?php echo $data->nama_dokter; ?>"  >
								</div>
							</div>
							<div class="form-group">
								<label for="jenis_kelamin" class="col-sm-2 control-label">Jenis Kelamin</label>
								<div class="col-sm-3">
								   <select class="form-control input-sm" name="jenis_kelamin">
									   <option value="Laki-Laki" <?php echo $data->jenis_kelamin == "Laki-Laki" ? ' selected' : '';?> >Laki-Laki</option>
									   <option value="Perempuan" <?php echo $data->jenis_kelamin == "Perempuan" ? ' selected' : '';?> >Perempuan</option>				  
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="telepon" class="col-sm-2 control-label">Telepon</label>
								<div class="col-sm-3">
								<input type="text" class="form-control"  required="required" id="telepon"  name="telepon"
								 placeholder="input telepon" value="<?php echo $data->telepon; ?>"  >
								</div>
							</div>
							<div class="form-group">
								<label for="alamat" class="col-sm-2 control-label">Alamat</label>
								<div class="col-sm-4">
								  <textarea class="form-control"  rows="3" id="alamat" name="alamat"  
								  placeholder="input alamat" required="required"><?php echo $data->alamat; ?></textarea>
								</div>
							</div>
							<!-- <div class="form-group">
								<label for="id spesialis" class="col-sm-2 control-label">ID spesialis</label>
								<div class="col-sm-4">
								<select class="form-control" name="id_spesialis" id="id_spesialis" required>
										<option value="">Pilih spesialis</option>
										<?php foreach($spesialis as $row):?>
										<option value="<?php echo $row['id_spesialis']; ?>"> <?php echo $row['id_spesialis']; ?> </option>
										<?php endforeach;?>
										<div class="form-group">
								</select> -->
							<!-- </div>		 -->
							
							<!--	  <textarea class="form-control"  rows="3" id="id_spesialis" name="id_spesialis"  placeholder="input " required="required"><?php echo $data->id_spesialis; ?></textarea> -->	
								
							<!-- </div>				 -->
								<div class="form-group">
								<label for="id spesialis" class="col-sm-2 control-label">Nama Spesialis</label>
								<div class="col-sm-4">
								<select class="form-control" name="nama_spesialis" id="nama_spesialis" required>
										<option value="">Pilih Nama spesialis</option>
										<?php foreach($spesialis as $row):?>
										<option value="<?php echo $row['nama_spesialis']; ?>"> (<?php echo $row['id_spesialis']; ?>) <?php echo $row['nama_spesialis']; ?> </option>
										<?php endforeach;?>
										<div class="form-group">
								</select>
							</div>		
							</div>
						<div class="box-footer">
							<button type="submit" class="btn btn-primary" name="action" value="save">save</button>
							<button type="submit" class="btn btn-success" name="action" value="saveexit">save & exit</button>
							<button type="reset" class="btn btn-warning">reset</button>
							<a  href="<?php echo site_url("dokter")?>" class="btn btn-danger">cancel</a>
						</div>
					</form>
					
				</div>
			</div>
		</div>
	</section>
</div>