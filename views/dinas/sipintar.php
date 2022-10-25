<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('backend/dt_index');?>
<script type="text/javascript">
	function verifikasi(id) {
	_H.Loading( true );
	$.post(_BASE_URL + 'dinas/sipintar/usulkan/'+<?=$npsn;?>, {'usul_id':id}, function(response) {
		_H.Loading( false );
		var res = _H.StrToObject( response );
		if (res.status == 'success') {
			window.location = _BASE_URL + 'dashboard';
		}
	}).fail(function(xhr) {
		console.log(xhr);
	});
}
</script>
