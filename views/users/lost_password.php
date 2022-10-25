<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script type="text/javascript">
	function lost_password() {
		var values = {
			email: $('#email').val()
		};
		_H.Loading( true );
		$.post(_BASE_URL + 'lost-password/process', values, function( response ) {
			_H.Loading( false );
			var res = _H.StrToObject( response );
			_H.Notify(res.status, res.message);
			$('#email').val('');
		});
	}
</script>
<form role="form" class="login-form">
	<h3 class="form-title" style="text-align:center;color:gold">Lost Password</h3>
	<p style="text-align: center">Please enter your email address. You will receive a link to create a new password by email.</p>
	<hr>
	<div class="form-group">
		<label class="control-label visible-ie8 visible-ie9">Email</label>
		<div class="input-icon">
			<i class="fa fa-envelope"></i>
			<input id="email" class="form-control placeholder-no-fix" type="text" autofocus autocomplete="off" placeholder="Email" name="email" /> </div>
	</div>
	<div class="form-actions">
		<button onclick="lost_password(); return false;" class="btn btn-info btn-block"  style="color:white;text-shadow: 2px 2px #000;"> <strong>SEND</strong> </button>
	</div>
	<a style="text-decoration: none;" href="<?=base_url('login')?>">Back to login ?</a>
	<hr>
	<div class="copyright" style="color:gold;">
	Copyright &copy; <?=date('Y');?>
	<br>
	<a style="text-decoration: none;" href="<?=base_url()?>">XPerfect Dev</a>
	</div>
</form>
