<div class="content-wrapper master">
	<section class="content-header">
	  <h1>
		<?php echo $title?>
	  </h1>
	</section>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/dropify/dropify.min.css'?>">
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
				
					<form  class="form-horizontal" method="post" action="<?php echo site_url("slider/save")?>" enctype="multipart/form-data" >
						<input type="hidden" class="form-control" id="id" name="id" value="<?php echo $data->id_slider; ?>" >
						<div class="box-body">
							<div class="form-group">
								<label for="id_slider" class="col-sm-2 control-label">ID Slider</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="id_slider"  name="id_slider" value="<?php echo $data->id_slider == "" ? $data->autocode : $data->id_slider; ?>"  readonly   >
								</div>
							</div>
							<div class="form-group">
								<label for="nama_slider" class="col-sm-2 control-label">Nama</label>
								<div class="col-sm-4">
								  <input type="text" class="form-control"  required="required" id="nama_slider"  name="nama_slider" placeholder="input nama" value="<?php echo $data->nama_slider; ?>"  >
								</div>
							</div>
							<div class="form-group">
								<label for="keterangan" class="col-sm-2 control-label">Keterangan</label>
								<div class="col-sm-4">
								  <textarea class="form-control"  rows="3" id="keterangan" name="keterangan"  placeholder="input keterangan" required="required"><?php echo $data->keterangan; ?></textarea>
								</div>
							</div>
							<div class="form-group">
							<label for="foto_slider" class="col-sm-2 control-label">Foto</label>
							<div class="col-sm-4">
								<input type="file"  class="dropify" name="foto_slider" id="foto_slider">
							</div>
							</div>
						</div>
						
						<div class="box-footer">
							<button type="submit" class="btn btn-primary" name="action" value="save">save</button>
							<button type="submit" class="btn btn-success" name="action" value="saveexit">save & exit</button>
							<button type="reset" class="btn btn-warning">reset</button>
							<a  href="<?php echo site_url("slider")?>" class="btn btn-danger">cancel</a>
						</div>
					</form>
					
				</div>
			</div>
		</div>
	</section>
</div>
<script type="text/javascript" src="<?php echo base_url().'assets/dropify/dropify.min.js'?>"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.dropify').dropify({
            messages: {
                default: 'Drag atau drop untuk memilih gambar',
                replace: 'Ganti',
                remove:  'Hapus',
                error:   'error'
            }
        });
    });
     
</script>