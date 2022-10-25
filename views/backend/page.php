<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
	<title><?=isset($title) ? ' :: '.$title : ''?></title>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta http-equiv="Expires" content="0">
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="Cache-Control" content="no-cache">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?=link_tag('assets/css/bootstrap.css');?>
	<?=link_tag('assets/css/font-awesome.css');?>
	<?=link_tag('assets/css/toastr.css');?>
	<?=link_tag('assets/css/bootstrap-datetimepicker.css');?>
	<?=link_tag('assets/css/Page.css');?>
	<?=link_tag('assets/css/backend-style.css');?>
	<?=link_tag('assets/css/magnific-popup.css');?>
	<?=link_tag('assets/css/select2.css');?>
	<?=link_tag('assets/css/jquery.tagsinput.min.css');?>
	<?=link_tag('assets/css/jquery.nestable.css');?>	
	<?=link_tag('assets/plugins/fancybox/jquery.fancybox.min.css');?>
	<?=link_tag('assets/css/irigasi.css');?>
	<script type="text/javascript">
	const _BASE_URL = '<?=base_url();?>';
	const _CURRENT_URL = '<?=current_url();?>';
	const _SUBJECT = '<?=$this->session->_subject;?>';
	</script>
	<script src="<?=base_url('assets/js/backend.min.js');?>"></script>	
</head>
<body class="skin-blue fixed">
	<div id="fancyclsbtn" class="pull-right"></div>
	<div class="content-wrapper">		
		<?php $this->load->view($content);?>
	</div>
	<script src="<?=base_url('assets/js/jquery.slimscroll.min.js');?>"></script>
	<script src="<?=base_url('assets/js/accounting.min.js');?>"></script>
	<script src="<?=base_url('assets/plugins/fancybox/jquery.fancybox.min.js');?>"></script>
	<script type="text/javascript">
	if ($('#isfancy').length){
		$("#fancyclsbtn").html('<button class="btn btn-danger btn-sm" title="Close" onclick="parent.jQuery.fancybox.getInstance().close();">X</button>');
	}
	</script>
</body>
</html>
