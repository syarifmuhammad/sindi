<!DOCTYPE html>
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title><?=$page_title?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="theme-color" content="#2f2e28">
        <meta name="mobile-web-app-capable" content="yes">
		<base href="<?=base_url();?>">
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="assets/login/css/fonts.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/font-awesome.css" rel="stylesheet" type="text/css" />
        <link href="assets/login/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="assets/login/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="assets/login/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/login/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="assets/login/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="assets/login/css/plugins.min.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/toastr.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="assets/login/css/login.css" rel="stylesheet" type="text/css" />
        <?=link_tag('assets/plugins/fancybox/jquery.fancybox.min.css');?>
        <?=link_tag('assets/css/loading.css');?>
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
		<link rel="icon" href="<?=base_url('assets/login/img/lock.png');?>">
		<script type="text/javascript">
			const _BASE_URL = '<?=base_url();?>', _CURRENT_URL = '<?=current_url();?>';
		</script>
		<script src="<?=base_url('assets/js/login.min.js');?>"></script>
		<script type="text/javascript">
        var bgimage = '';
        if (navigator.userAgent.match(/Trident/i)) {
            bgimage = ["assets/login/img/bg.jpg"];			
        } else {
            bgimage = ["assets/login/img/bg.jpg"];
        }
        var backstretch = bgimage;		
		</script>
	</head>
	<!-- END HEAD -->

    <body class=" login">
        <!-- BEGIN LOGIN -->
        <div class="content">
            <?php $this->load->view($content);?>
        </div>
        <!-- END LOGIN -->
        <!-- BEGIN COPYRIGHT -->
        
        <!-- END COPYRIGHT -->
        <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
		<script src="assets/login/js/jquery.min.js" type="text/javascript"></script>
        <script src="assets/login/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/login/js/js.cookie.min.js" type="text/javascript"></script>
        <script src="assets/login/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="assets/login/js/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="assets/login/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="assets/login/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="assets/login/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="assets/login/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script src="assets/login/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
        <script src="<?=base_url('assets/plugins/fancybox/jquery.fancybox.min.js');?>"></script>
        <!-- END PAGE LEVEL PLUGINS -->
		<script>
			jQuery(document).ready(function(){$.backstretch(backstretch,{fade:1e3,duration:8e3});});
		</script>
		
    </body>

</html>