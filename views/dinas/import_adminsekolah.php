<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div id="isfancy" style="display:none;"></div>
<script type="text/javascript">
// Import Admin Sekolah
function import_adminsekolah() {
	$('#submit').attr('disabled', 'disabled');
	_H.Loading( true );
	var values = {
		adminsekolah: $('#adminsekolah').val()
	};
	$.post(_BASE_URL + 'dinas/import_adminsekolah/save', values, function(response) {
		var res = _H.StrToObject( response );
		_H.Notify(res.status, _H.Message(res.message));
		$('#adminsekolah').val('');
		$('#submit').removeAttr('disabled');
		_H.Loading( false );
	});
}
</script>
<section class="content-header">
   <div class="row">
      <div class="col-xs-12">
         <h3 style="margin:0;"><i class="fa fa-sign-out text-green"></i> <span class="table-header"><?=isset($title) ? $title : ''?></span>
            <?=isset($sub_title) ? '<br><small style="margin-left:29px;">'.$sub_title.'</small>' : ''?>
         </h3>
      </div>
   </div>
</section>
<section class="content">
	<div class="callout callout-info">
		<h4>Petunjuk Singkat</h4>
		<ol>
			<li>Buka Aplikasi Microsoft Excel untuk pengguna Windows atau Libre Office Calc untuk pengguna Linux</li>			
		</ol>
	</div>
	<div class="box">
		<div class="box-body">
			<form role="form">
				<div class="form-group">
					<textarea autofocus id="adminsekolah" name="adminsekolah" class="form-control" rows="10" placeholder="Paste here..."></textarea>
				</div>
			</form>
		</div>
		<div class="box-footer">
			<button type="submit" onclick="import_adminsekolah(); return false;" class="btn btn-primary"><i class="fa fa-upload"></i> IMPORT</button>
		</div>
	</div>
</section>
