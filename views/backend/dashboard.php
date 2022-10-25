<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section class="content">
	<?php if ($this->session->user_type === 'super_user') { ?>
	<?php } ?>
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4>
			<?=salam();?> <?=$this->session->user_full_name;?>,
		</h4>
		<p>
		Selamat datang di aplikasi <?=config_item('apps');?> <?=config_item('version');?> <?=config_item('copyright');?><br>
		Saat ini Anda login dengan akses data tahun  <?=$this->session->tahun;?>		
		</p>
		
	</div>
	
	  <div class="row">
		<div class="col-md-12">
		  <div class="box box-solid">
			<div class="box-body clearfix">
			  <blockquote class="pull-right">
				<p>You can have data without information, but you cannot have information without data.</p>
				<small><cite title="Source Title">Daniel Keys Moran</cite></small>
			  </blockquote>
			</div>
			<!-- /.box-body -->
		  </div>
		  <!-- /.box -->
		</div>
		<!-- ./col -->
	  </div>
</section>