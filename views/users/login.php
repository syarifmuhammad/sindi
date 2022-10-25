<!-- BEGIN LOGIN FORM -->
<script type="text/javascript">
	$(document).ready(function(){
		var segment_str = parent.location.pathname;
		var segment_array = segment_str.split('/');
		var last_segment = segment_array.pop();
		if (last_segment != "login"){
			parent.$.fancybox.close();
			parent.location.reload();	
		}
	});
	function login() {
		$('#submit, #user_name, #user_password, #tahun').attr('disabled', 'disabled');
		var values = {
			user_name: $('#user_name').val(),
			user_password: $('#user_password').val(),
			tahun: $('#tahun').val()
		};
		_H.Loading( true );
		$.post(_BASE_URL + 'login/process', values, function(response) {
			_H.Loading( false );
			var res = _H.StrToObject( response );			
			if (res.status == 'success') {
				window.location = _BASE_URL + 'dashboard';
			} else {
				_H.Notify(res.status, _H.Message(res.message));
				$('#user_name, #user_password').val('');
				if ( res.ip_banned ) {
					$('#submit, #user_name, #user_password, #tahun').attr('disabled', 'disabled');
					$('#login-info').text('Blocked for 10 minutes');
					$('#login-info').attr("style", "text-align: center; color: red;");
				} else {
					$('#submit, #user_name, #user_password, #tahun').removeAttr('disabled');
				}
			}
		});
	}
	
	function isNumber(evt) {
		evt = (evt) ? evt : window.event;
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
		}
		return true;
	}
	
</script>
<form role="form" class="login-form">
	<center>
	<img width="100" src="<?=base_url('assets/img/logo.png');?>">
	</center>
	<h5 class="form-title" style="text-align:center;color:gold;">SISTEM INFORMASI MANAJEMEN<br>DATA INFRASTRUKTUR</h5>
	<p id="login-info" <?=$ip_banned ? 'style="text-align: center; color: red"':'style="text-align: center"';?>><?=$login_info;?></p>
	<hr>
	<div class="form-group">
		<label class="control-label visible-ie8 visible-ie9">Username</label>
		<div class="input-icon">
			<i class="fa fa-user"></i>
			<input <?=$ip_banned ? 'disabled="disabled"' : '';?> id="user_name" class="form-control placeholder-no-fix" type="text" autofocus autocomplete="off" placeholder="Username" name="username" /> </div>
	</div>
	<div class="form-group">
		<label class="control-label visible-ie8 visible-ie9">Password</label>
		<div class="input-icon">
			<i class="fa fa-key"></i>
			<input <?=$ip_banned ? 'disabled="disabled"' : '';?> id="user_password" class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" /> </div>
	</div>
	<div class="form-group">
		<label class="control-label visible-ie8 visible-ie9">Tahun</label>
		<div class="input-icon">
			<i class="fa fa-calendar"></i>
			<input <?=$ip_banned ? 'disabled="disabled"' : '';?> id="tahun" class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Tahun" name="tahun" value="<?=date('Y');?>" onkeypress="return isNumber(event)" /> </div>
	</div>
	<div class="form-actions">
		<button <?=$ip_banned ? 'disabled="disabled"' : '';?> onclick="login(); return false;" class="btn btn-info btn-block" id="submit"  style="color:white;text-shadow: 2px 2px #000;"> <strong>LOGIN</strong> </button>
	</div>
	<div class="copyright" style="color:gold;">
	Copyright &copy; <?=config_item('copyright');?><br><?=config_item('apps');?> <?=config_item('version');?></a>
	</div>
</form>
<!-- END LOGIN FORM -->