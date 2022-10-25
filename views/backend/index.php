<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>

<head>
	<title><?=config_item('apps');?><?=isset($title) ? ' :: '.$title : ''?>
	</title>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta http-equiv="Expires" content="0">
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="Cache-Control" content="no-cache">
	<meta name="viewport" content="minimal-ui, width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="theme-color" content="#2f2e28">
	<link rel="icon" href="<?=base_url('assets/img/logo.png');?>">
	<?=link_tag('assets/css/bootstrap.css');?>
	<?=link_tag('assets/css/font-awesome.css');?>
	<?=link_tag('assets/css/toastr.css');?>
	<?=link_tag('assets/css/bootstrap-datetimepicker.css');?>
	<?=link_tag('assets/css/AdminLTE.css');?>
	<?=link_tag('assets/css/irigasi.css');?>
	<?=link_tag('assets/css/backend-style.css');?>
	<?=link_tag('assets/css/magnific-popup.css');?>
	<?=link_tag('assets/css/select2.css');?>
	<?=link_tag('assets/css/jquery.tagsinput.min.css');?>
	<?=link_tag('assets/css/jquery.nestable.css');?>
	<?=link_tag('assets/plugins/fancybox/jquery.fancybox.min.css');?>
	<?=link_tag('assets/css/loading.css');?>
	<?=link_tag('assets/plugins/datatables/datatables.min.css');?>
	<script type="text/javascript">
		const _BASE_URL = '<?=base_url();?>';
		const _CURRENT_URL = '<?=current_url();?>';
	</script>
	<script src="<?=base_url('assets/js/backend.min.js');?>"></script>	
</head>
<!-- sidebar-collapse -->

<body class="hold-transition skin-green sidebar-mini <?=$this->session->sidebar_collapse ? 'sidebar-collapse':''?> fixed">
	<div class="wrapper">
		<header class="main-header">
			<a href="javascript:void(0)" class="logo">
				<span class="logo-mini"><img src="<?=base_url('assets/img/logo.png');?>" class="brand-image elevation-3"></span>
				<span class="logo-lg"><img src="<?=base_url('assets/img/logo.png');?>" class="brand-image elevation-3"><?=config_item('apps');?></span>
			</a>
			<nav class="navbar navbar-static-top">
				<a onclick="sidebarCollapse(); return false;" class="sidebar-toggle" data-toggle="push-menu" role="button">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<li><a href="javascript:;" class="current-time"></a></li>
						<li class="bg-red">
							<a href="javascript:;" title="User Control" data-toggle="control-sidebar"><i class="fa fa-chevron-down"></i></a>
						</li>					
					</ul>
				</div>
			</nav>
		</header>
		<aside class="main-sidebar">
			<?php $this->load->view("backend/sidebar_".$this->session->user_group);?>
		</aside>
		<div class="content-wrapper">
			<?php $this->load->view($content);?>
		</div>
		<footer class="main-footer">
			<div class="pull-right hidden-xs">
				<p><?=config_item('apps');?> <?=config_item('version');?></p>
			</div>
			<p>Copyright &copy;
				<?=config_item('copyright');?></p>
		</footer>
		<?php $this->load->view("backend/rightbar_".$this->session->user_group);?>
		<!-- /.control-sidebar -->
		<div class="control-sidebar-bg"></div>
	</div>
	<a href="javascript:" id="return-to-top"><i class="fa fa-angle-double-up"></i></a>

	<script src="<?=base_url('assets/js/jquery.slimscroll.min.js');?>"></script>
	<script src="<?=base_url('assets/js/accounting.min.js');?>"></script>
	<script src="<?=base_url('assets/plugins/fancybox/jquery.fancybox.min.js');?>"></script>
	<script src="<?=base_url('assets/plugins/datatables/datatables.min.js');?>"></script>
	<script>
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})
	</script>
</body>

</html>