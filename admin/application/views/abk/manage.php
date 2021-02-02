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
					<form  class="form-horizontal" method="post" action="<?php echo site_url("abk/save")?>"  >
						<input type="hidden" class="form-control" id="id" name="id" value="<?php echo $data->id_abk; ?>" >
						<div class="box-body">
							<div class="form-group">
								<label for="id_abk" class="col-sm-2 control-label">ID abk</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="id_abk"  name="id_abk" 
									value="<?php echo $data->id_abk == "" ? $data->autocode : $data->id_abk; ?>"  readonly   >
								</div>
							</div>
							<div class="form-group">
								<label for="nama_abk" class="col-sm-2 control-label">Nama Tindakan</label>
								<div class="col-sm-4">
								  <input type="text" class="form-control"  required="required" id="nama_abk"  
								  name="nama_abk" placeholder="input nama" value="<?php echo $data->nama_abk; ?>"></input> 
								</div>
							</div>
							<div class="form-group">
								<label for="isi_abk" class="col-md-2 control-label">Keterangan </label>
								<div class="col-sm-8">
								<textarea class="form-control"  rows="10" id="ckeditor" name="isi_abk" 
								   placeholder="input Keterangan" required="required"><?php echo $data->isi_abk; ?></textarea>
								</div>
							</div>
						</div>
						
						<div class="box-footer">
							<button type="submit" class="btn btn-primary" name="action" value="save">save</button>
							<button type="submit" class="btn btn-success" name="action" value="saveexit">save & exit</button>
							<button type="reset" class="btn btn-warning">reset</button>
							<a  href="<?php echo site_url("abk")?>" class="btn btn-danger">cancel</a>
						</div>
					</form>
					
				</div>
			</div>
		</div>
	</section>
</div>

<script src="<?php echo base_url().'assets/jquery/jquery-2.2.3.min.js'?>"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>
    <script src="<?php echo base_url().'assets/ckeditor/ckeditor.js'?>"></script>
    <script type="text/javascript">
      $(function () {
        CKEDITOR.replace('ckeditor');
      });
    </script>