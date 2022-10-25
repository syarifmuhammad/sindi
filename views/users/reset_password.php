<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script type="text/javascript">
function reset_password() {
	var values = {
		password: $('#password').val(),
		c_password: $('#c_password').val(),
		forgot_password_key: $('#forgot_password_key').val()
	};
	_H.Loading( true );
	$.post(_BASE_URL + 'reset-password-process', values, function(response) {
		_H.Loading( false );
		var res = _H.StrToObject( response );
		var message = res.message;
		switch (message) {
			case 'expired':
				_H.Notify(res.status, 'Tautan untuk mengubah kata sandi Anda sudah kadaluarsa!');
				setTimeout(function () {
					window.location = _BASE_URL;
				}, 4000);
				break;
			case 'has_updated':
				_H.Notify(res.status, 'Kata sandi sudah diperbaharui. Silahkan login untuk mengelola data Anda!');
				setTimeout(function () {
					window.location = _BASE_URL;
				}, 4000);
				break;
			case 'cannot_updated':
				_H.Notify(res.status, 'Terjadi kesalahan pada sistem kami. Silahkan hubungi Operator!');
				setTimeout(function () {
					window.location = _BASE_URL;
				}, 4000);
				break;
			case 'not_active':
				_H.Notify(res.status, 'Akun Anda sudah dinonaktifkan oleh Operator. Untuk informasi lebih lanjut, silahkan hubungi Operator!');
				setTimeout(function () {
					window.location = _BASE_URL;
				}, 4000);
				break;
			case '404':
				window.location = _BASE_URL;
				break;
			default:
				_H.Notify(res.status, res.message);
				break;
		}
	});
}
</script>
<form role="form" class="login-form">
	<h3 class="form-title" style="text-align:center;color:gold"><?=$page_title?></h3>
	<hr>
	<div class="form-group">
		<label class="control-label visible-ie8 visible-ie9">New Password</label>
		<div class="input-icon">
			<i class="fa fa-key"></i>
			<input id="password" class="form-control placeholder-no-fix" type="password" autofocus autocomplete="off" placeholder="New Password" name="password" /> </div>
	</div>
	<div class="form-group">
		<label class="control-label visible-ie8 visible-ie9">Re-Type New Password</label>
		<div class="input-icon">
			<i class="fa fa-key"></i>
			<input id="c_password" class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Re-Type New Password" name="c_password" /> </div>
	</div>
	<input type="hidden" id="forgot_password_key" name="forgot_password_key" value="<?=$this->uri->segment(2)?>">
	<div class="form-actions">
		<button onclick="reset_password(); return false;" class="btn btn-info btn-block" style="color:white;text-shadow: 2px 2px #000;"> <strong>SUBMIT</strong> </button>
	</div>
	<a style="text-decoration: none;" href="<?=base_url('login')?>">Back to login ?</a>
	<hr>
	<div class="copyright" style="color:gold;">
	Copyright &copy; <?=date('Y');?>
	<br>
	<a style="text-decoration: none;" href="<?=base_url()?>">XPerfect Dev</a>
	</div>
</form>
