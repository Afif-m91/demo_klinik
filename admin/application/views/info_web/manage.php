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
					<form  class="form-horizontal" method="post" action="<?php echo site_url("info_web/save")?>"  >
						<input type="hidden" class="form-control" id="id" name="id" value="<?php echo $data->id_web; ?>" >
						<div class="box-body">
							<div class="form-group">
								<label for="id_web" class="col-sm-2 control-label">ID spesialis</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="id_web"  name="id_web" 
									value="<?php echo $data->id_web == "" ? $data->autocode : $data->id_web; ?>"  readonly   >
								</div>
							</div>
							<div class="form-group">
								<label for="nama_web" class="col-sm-2 control-label">Nama Website</label>
								<div class="col-sm-4">
								  <input type="text" class="form-control"  required="required" id="nama_web"  name="nama_web" 
								  placeholder="input nama Website" value="<?php echo $data->nama_web; ?>"  >
								</div>
							</div>
							<div class="form-group">
								<label for="alamat_klinik" class="col-sm-2 control-label">Alamat Klinik</label>
								<div class="col-sm-4">
								  <textarea class="form-control"  rows="3" id="alamat_klinik" name="alamat_klinik" 
								   placeholder="input alamat klinik" required="required"><?php echo $data->alamat_klinik; ?></textarea>
								</div>
							</div>
						</div>
						<div class="form-group">
								<label for="no_hp" class="col-sm-2 control-label">No Telepon</label>
								<div class="col-sm-4">
								  <input type="text" class="form-control"  required="required" id="no_hp"  name="no_hp" 
								  placeholder="input nama telepon" value="<?php echo $data->no_hp; ?>"  >
								</div>
							</div>
						<div class="form-group">
								<label for="no_fax" class="col-sm-2 control-label">No Fax</label>
								<div class="col-sm-4">
								  <input type="text" class="form-control"  required="required" id="no_fax"  name="no_fax" 
								  placeholder="input no fax" value="<?php echo $data->no_fax; ?>"  >
								</div>
							</div>
							
							<div class="form-group">
								<label for="email" class="col-sm-2 control-label">Email</label>
								<div class="col-sm-4">
								  <input type="text" class="form-control"  required="required" id="email"  name="email" 
								  placeholder="input nama email" value="<?php echo $data->email; ?>"  >
								</div>
							</div>

						<div class="box-footer">
							<button type="submit" class="btn btn-primary" name="action" value="save">save</button>
							<button type="submit" class="btn btn-success" name="action" value="saveexit">save & exit</button>
							<button type="reset" class="btn btn-warning">reset</button>
							<a  href="<?php echo site_url("info_web")?>" class="btn btn-danger">cancel</a>
						</div>
					</form>
					
				</div>
			</div>
		</div>
	</section>
</div>