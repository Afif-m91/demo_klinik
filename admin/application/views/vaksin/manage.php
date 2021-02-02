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
					<form  class="form-horizontal" method="post" action="<?php echo site_url("vaksin/save")?>"  >
						<input type="hidden" class="form-control" id="id" name="id" value="<?php echo $data->id_vaksin; ?>" >
						<div class="box-body">
							<div class="form-group">
								<label for="id_vaksin" class="col-sm-2 control-label">ID Vaksin</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="id_vaksin"  name="id_vaksin" 
									value="<?php echo $data->id_vaksin == "" ? $data->autocode : $data->id_vaksin; ?>"  readonly   >
								</div>
							</div>
							<div class="form-group">
								<label for="nama_vaksin" class="col-sm-2 control-label">Nama Vaksin</label>
								<div class="col-sm-4">
								  <input type="text" class="form-control"  required="required" id="nama_vaksin"  
								  name="nama_vaksin" placeholder="input nama" value="<?php echo $data->nama_vaksin; ?>"></input> 
								</div>
							</div>
							<div class="form-group">
								<label for="usia" class="col-sm-2 control-label">Usia</label>
								<div class="col-sm-4">
								  <input  type="text" class="form-control"  id="usia" name="usia" 
								   placeholder="input usia" required="required" value= "<?php echo $data->usia; ?>"></input>
								</div>
							</div>
							<div class="form-group">
								<label for="kegunaan" class="col-sm-2 control-label">Kegunaan</label>
								<div class="col-sm-4">
								  <input  type="text" class="form-control"  id="kegunaan" name="kegunaan" 
								   placeholder="input kegunaan " required="required" value= "<?php echo $data->kegunaan; ?>"></input>
								</div>
							</div>

						</div>
						
						<div class="box-footer">
							<button type="submit" class="btn btn-primary" name="action" value="save">save</button>
							<button type="submit" class="btn btn-success" name="action" value="saveexit">save & exit</button>
							<button type="reset" class="btn btn-warning">reset</button>
							<a  href="<?php echo site_url("vaksin")?>" class="btn btn-danger">cancel</a>
						</div>
					</form>
					
				</div>
			</div>
		</div>
	</section>
</div>