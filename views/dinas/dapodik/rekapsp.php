<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('backend/dt_index');?>
<script type="text/javascript">
function usulan_pip(npsn) {
		$.fancybox.open({
			src  : _BASE_URL + 'dinas/sipintar/index/'+npsn,
			type : 'iframe',
			toolbar : false,
			smallBtn : true,
			clickSlide : false,
			clickOutside : false,
			iframe : {
				css : {
					width : $(window).width() - 88 + 'px',
					height : $(window).height() - 88 + 'px',
					'max-width' : '100%',
					'max-height' : '100%'
				}
			},
			// afterLoad : function() {
				// $("#sub_title").html(sekolah);
			// },
			// afterClose: function () {
               // LAPBUL_CREATE.OnReload();  
            // }
		});
    }
</script>
