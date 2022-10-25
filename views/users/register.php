<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script type="text/javascript">
function register() {
	var checkBox = document.getElementById("rules");
	if (checkBox.checked == true){
		var rules = $('#rules').val();
	} else {
		var rules = '';
	}
	var values = {
		user_name: $('#user_name').val(),
		user_password: $('#user_password').val(),
		c_password: $('#c_password').val(),
		user_email: $('#user_email').val(),
		user_full_name: $('#user_full_name').val(),
		pin: $('#pin').val(),
		rules: rules
	};
	_H.Loading( true );
	$.post(_BASE_URL + 'register-process', values, function(response) {
		_H.Loading( false );
		var res = _H.StrToObject( response );
		var message = res.message;
		switch (message) {
			case 'berhasil':
				_H.Notify(res.status, 'Registrasi berhasil, login dengan username dan password yang Anda buat.');
				setTimeout(function () {
					window.location = _BASE_URL;
				}, 3000);
				break;
			default:
				_H.Notify(res.status, res.message);
				break;
		}
	});
}
</script>
<form role="form" class="login-form">
	<? if(check_gamedb()=='true'){ ?>
	<h3 class="form-title" style="text-align:center;color:gold;"><?=$page_title?></h3>
	<hr>
	<div class="form-group">
		<label class="control-label visible-ie8 visible-ie9">Full Name</label>
		<div class="input-icon">
			<i class="fa fa-user"></i>
			<input id="user_full_name" class="form-control placeholder-no-fix" type="text" autofocus autocomplete="off" placeholder="Full Name" name="user_full_name" /> </div>
	</div>
	<div class="form-group">
		<label class="control-label visible-ie8 visible-ie9">User Name</label>
		<div class="input-icon">
			<i class="fa fa-user"></i>
			<input id="user_name" class="form-control placeholder-no-fix" type="text" autofocus autocomplete="off" placeholder="User Name" name="user_name" /> </div>
	</div>
	<div class="form-group">
		<label class="control-label visible-ie8 visible-ie9">Email</label>
		<div class="input-icon">
			<i class="fa fa-envelope"></i>
			<input id="user_email" class="form-control placeholder-no-fix" type="text" autofocus autocomplete="off" placeholder="Email" name="user_email" /> </div>
	</div>	
	<div class="form-group">
		<label class="control-label visible-ie8 visible-ie9">Password</label>
		<div class="input-icon">
			<i class="fa fa-key"></i>
			<input id="user_password" class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="user_password" /> </div>
	</div>
	<div class="form-group">
		<label class="control-label visible-ie8 visible-ie9">Re-Type Your Password</label>
		<div class="input-icon">
			<i class="fa fa-key"></i>
			<input id="c_password" class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Re-Type Your Password" name="c_password" /> </div>
	</div>
	<div class="form-group">
		<label class="control-label visible-ie8 visible-ie9">PIN</label>
		<div class="input-icon">
			<i class="fa fa-calculator"></i>
			<input id="pin" class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="PIN" name="pin" onkeypress="return xisNumberx(event);"/> </div>
	</div>
	<div class="form-actions">
		<input type="checkbox" id="rules" name="rules" value="agree"> <a data-fancybox data-src="#terms-and-conditions" style="text-decoration:none;cursor: pointer;">Aturan, Syarat dan Ketentuan</a><hr>
		<button onclick="register(); return false;" class="btn btn-info btn-block" style="color:white;text-shadow: 2px 2px #000;"> <strong>REGISTER</strong> </button>
	</div>
	<? } else { ?>
	<h3 class="form-title" style="text-align:center;color:red;">Register Closed by Admin</h3>
	<hr>
	<? } ?>
	<a class="btn btn-success btn-xs" style="text-decoration: none;" href="<?=base_url('login')?>">< BACK TO LOGIN</a>
	<hr>
	<div class="copyright" style="color:gold;">
	Copyright &copy; <?=date('Y');?> Corona Perfectworld
	</div>
	<div style="width:80%; height: 80%; display: none;background-color:black;color:white;" id="terms-and-conditions">
	<?php $this->load->view('termcond');?>
	</div>
</form>
