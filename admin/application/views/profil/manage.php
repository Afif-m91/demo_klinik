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
					<form  class="form-horizontal" method="post" action="<?php echo site_url("profil/save")?>"  >
						<input type="hidden" class="form-control" id="id" name="id" value="<?php echo $data->id_profil; ?>" >
						<div class="box-body">
							<div class="form-group">
								<label for="id_profil" class="col-sm-2 control-label">ID Profil</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="id_profil"  name="id_profil" 
									value="<?php echo $data->id_profil == "" ? $data->autocode : $data->id_profil; ?>"  readonly   >
								</div>
							</div>
							<div class="form-group">
								<label for="judul_profil" class="col-sm-2 control-label">Judul Profil</label>
								<div class="col-sm-4">
								  <input type="text" class="form-control"  required="required" id="judul_profil"  name="judul_profil" 
								  placeholder="input nama Website" value="<?php echo $data->judul_profil; ?>"  >
								</div>
							</div>
							<div class="form-group">
								<label for="isi_profil" class="col-sm-2 control-label">Isi Profil</label>
								<div class="col-sm-8">
								  <textarea class="form-control"  rows="10" id="ckeditor" name="isi_profil" 
								   placeholder="input alamat klinik" required="required"><?php echo $data->isi_profil; ?></textarea>
								</div>
							</div>
						</div>
						<!-- <div class="form-group">
								<label for="no_hp" class="col-sm-2 control-label">No Telepon</label>
								<div class="col-sm-4">
								  <input type="text" class="form-control"  required="required" id="no_hp"  name="no_hp" 
								  placeholder="input nama telepon" value="<?php echo $data->no_hp; ?>"  >
								</div>
							</div> -->
						<!-- <div class="form-group">
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
							</div> -->

						<div class="box-footer">
							<button type="submit" class="btn btn-primary" name="action" value="save">save</button>
							<button type="submit" class="btn btn-success" name="action" value="saveexit">save & exit</button>
							<button type="reset" class="btn btn-warning">reset</button>
							<a  href="<?php echo site_url("profil")?>" class="btn btn-danger">cancel</a>
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