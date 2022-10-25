<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script type="text/javascript">
	function change_type(elem_id) {
      var input_type = $('#' + elem_id).attr('type');
      var change_type = input_type === 'password' ? 'text' : 'password';
      $('#' + elem_id).attr('type', change_type);
   }
	
	// Save Changes
	function save_changes() {
		var values = {
			user_full_name: $('#user_full_name').val(),
			user_email: $('#user_email').val()
		};
		_H.Loading( true );
		$.post(_BASE_URL + 'profile/save', values, function( response ) {
			_H.Loading( false );
			var res = _H.StrToObject( response );
			var status = res.status;
			switch (status) {
				case 'success':
					_H.Notify(res.status, res.message);
					setTimeout(function () {
						window.location = _CURRENT_URL;
					}, 3000);
					break;				
				default:
					_H.Notify(res.status, res.message);
					break;
			}
		});
	}
</script>
<section class="content">
 	<div class="panel panel-primary">
		<div class="panel-heading"><i class="fa fa-sign-out"></i> UBAH PROFIL USER</div>
		<div class="panel-body">
			<form class="form-horizontal">
				<div class="box-body">
					<div class="form-group has-warning">
						<label for="user_name" class="col-sm-3 control-label">User Name</label>
						<div class="col-sm-9">
						  <input type="text" disabled="disabled" class="form-control" id="user_name" value="<?=$query->user_name ? $query->user_name : '';?>">
						  <span class="help-block">User Name tidak dapat diubah</span>
						</div>
					</div>
					<div class="form-group">
						<label for="user_full_name" class="col-sm-3 control-label">Nama Lengkap</label>
						<div class="col-sm-9">
						  <input type="text" class="form-control" id="user_full_name" value="<?=$query->user_full_name ? $query->user_full_name : '';?>">
						</div>
					</div>					
					<div class="form-group">
						<label for="user_email" class="col-sm-3 control-label">Email</label>
						<div class="col-sm-9">
						  <input type="text" class="form-control" id="user_email" value="<?=$query->user_email ? $query->user_email : '';?>">
						</div>
					</div>
					<div class="btn-group col-sm-9 col-sm-offset-3">
						<button type="submit" onclick="save_changes(); return false;" class="btn btn-success submit"><i class="fa fa-save"></i> SIMPAN</button>
					</div>
				</div>
			</form>
		</div>
	</div>
 </section>
