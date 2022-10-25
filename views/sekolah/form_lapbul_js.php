<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script type="text/javascript">
	$("#form1_1,#form1_2").change(function(){
		var form1_1 = parseInt($("#form1_1").val())||0;
		var form1_2 = parseInt($("#form1_2").val())||0;
		var form1_3 = form1_1+form1_2;
		$("#form1_3").val(form1_3);
	});
	
	$("#form2_1,#form2_2,#form2_4,#form2_5").change(function(){
		var form2_1 = parseInt($("#form2_1").val())||0;
		var form2_2 = parseInt($("#form2_2").val())||0;
		var form2_3 = form2_1+form2_2;
		var form2_4 = parseInt($("#form2_4").val())||0;
		var form2_5 = parseInt($("#form2_5").val())||0;
		var form2_6 = form2_4+form2_5;
		var form2_7 = form2_1+form2_4;
		var form2_8 = form2_2+form2_5;
		var form2_9 = form2_1+form2_2+form2_4+form2_5;
		$("#form2_3").val(form2_3);
		$("#form2_6").val(form2_6);
		$("#form2_7").val(form2_7);
		$("#form2_8").val(form2_8);
		$("#form2_9").val(form2_9);
	});

	
	$("#form3_1,#form3_2,#form3_3,#form3_4").change(function(){
		var form3_1 = parseInt($("#form3_1").val())||0;
		var form3_2 = parseInt($("#form3_2").val())||0;
		var form3_3 = parseInt($("#form3_3").val())||0;
		var form3_4 = parseInt($("#form3_4").val())||0;
		var form3_5 = form3_1+form3_2+form3_3+form3_4;
		$("#form3_5").val(form3_5);
		
		var form2_9 = parseInt($("#form2_9").val())||0;
		if(form3_5 != form2_9){
			$('#form2_9').attr('style','text-align: center; background: red');
			$('#form3_5').attr('style','text-align: center; background: red');
			$('#error_form3').show();
		} else {
			$('#form2_9').attr('style','text-align: center; background: green');
			$('#form3_5').attr('style','text-align: center; background: green');
			$('#error_form3').hide();
		}
		
		
	});
	
	
	function simpan(id) {
		var values = {
			id_index : id,
			form1_1 : parseInt($("#form1_1").val())||0,
			form1_2 : parseInt($("#form1_2").val())||0,
			form1_3 : parseInt($("#form1_3").val())||0,			
			form2_1 : parseInt($("#form2_1").val())||0,
			form2_2 : parseInt($("#form2_2").val())||0,
			form2_3 : parseInt($("#form2_3").val())||0,
			form2_4 : parseInt($("#form2_4").val())||0,
			form2_5 : parseInt($("#form2_5").val())||0,
			form2_6 : parseInt($("#form2_6").val())||0,
			form2_7 : parseInt($("#form2_7").val())||0,
			form2_8 : parseInt($("#form2_8").val())||0,
			form2_9 : parseInt($("#form2_9").val())||0,			
			form3_1 : parseInt($("#form3_1").val())||0,
			form3_2 : parseInt($("#form3_2").val())||0,
			form3_3 : parseInt($("#form3_3").val())||0,
			form3_4 : parseInt($("#form3_4").val())||0,
			form3_5 : parseInt($("#form3_5").val())||0,						
		}
		$.post(_BASE_URL + 'sekolah/form_lapbul/save', values, function(response) {
			var res = _H.StrToObject( response );
			if (res.status == 'error') {
				_H.Notify(res.status, _H.Message(res.message));
			}
			if (res.status == 'success') {
				_H.Notify(res.status, _H.Message(res.message));
				setTimeout(function () {
					location.reload();
				}, 3000);
			}
		});
	}
	
	function update_gtk(id) {
		var values = {
			id_index : id					
		}
		$.post(_BASE_URL + 'sekolah/form_lapbul/update_gtk', values, function(response) {
			var res = _H.StrToObject( response );
			if (res.status == 'error') {
				_H.Notify(res.status, _H.Message(res.message));
			}
			if (res.status == 'success') {
				_H.Notify(res.status, _H.Message(res.message));
				setTimeout(function () {
					location.reload();
				}, 3000);
			}
		});
	}
	
	function update_sakit(id,jumlah) {
		var values = {
			id : id,
			jumlah : jumlah
		}
		$.post(_BASE_URL + 'sekolah/form_lapbul/update_sakit', values, function(response) {
			
		});
	}
	
	function update_izin(id,jumlah) {
		var values = {
			id : id,
			jumlah : jumlah
		}
		$.post(_BASE_URL + 'sekolah/form_lapbul/update_izin', values, function(response) {
			
		});
	}
	
	function update_alfa(id,jumlah) {
		var values = {
			id : id,
			jumlah : jumlah
		}
		$.post(_BASE_URL + 'sekolah/form_lapbul/update_alfa', values, function(response) {
			
		});
	}
			
	function DL_FormI(bulan){
	$.post(_BASE_URL + 'sekolah/form_lapbul/data_bulan_lalu/lapbul_form1/'+bulan, {}, function(response) {
		var res = _H.StrToObject( response );
		if (res.status == 'error') {
			_H.Notify(res.status, _H.Message(res.message));
		}
		if (res.status == 'success') {
			form1_1 = parseInt(res.data.form1_1)||0;
			form1_2 = parseInt(res.data.form1_2)||0;
			$("#form1_1").val(form1_1).change();
			$("#form1_2").val(form1_2).change();
		}
	});
	}
	
	function DL_FormII(bulan){
		$.post(_BASE_URL + 'sekolah/form_lapbul/data_bulan_lalu/lapbul_form2/'+bulan, {}, function(response) {
			var res = _H.StrToObject( response );
			if (res.status == 'error') {
				_H.Notify(res.status, _H.Message(res.message));
			}
			if (res.status == 'success') {
				form2_1 = parseInt(res.data.form2_1)||0;
				form2_2 = parseInt(res.data.form2_2)||0;
				form2_4 = parseInt(res.data.form2_4)||0;
				form2_5 = parseInt(res.data.form2_5)||0;
				$("#form2_1").val(form2_1).change();
				$("#form2_2").val(form2_2).change();
				$("#form2_4").val(form2_4).change();
				$("#form2_5").val(form2_5).change();
			}
		});
	}
	
	function DL_FormIII(bulan){
		$.post(_BASE_URL + 'sekolah/form_lapbul/data_bulan_lalu/lapbul_form3/'+bulan, {}, function(response) {
			var res = _H.StrToObject( response );
			if (res.status == 'error') {
				_H.Notify(res.status, _H.Message(res.message));
			}
			if (res.status == 'success') {
				form3_1 = parseInt(res.data.form3_1)||0;
				form3_2 = parseInt(res.data.form3_2)||0;
				form3_3 = parseInt(res.data.form3_3)||0;
				form3_4 = parseInt(res.data.form3_4)||0;
				$("#form3_1").val(form3_1).change();
				$("#form3_2").val(form3_2).change();
				$("#form3_3").val(form3_3).change();
				$("#form3_4").val(form3_4).change();
			}
		});
	}
		
	function DL_FormIV(bulan){
		$.post(_BASE_URL + 'sekolah/form_lapbul/data_bulan_lalu/lapbul_form4/'+bulan, {}, function(response) {
			var res = _H.StrToObject( response );
			if (res.status == 'error') {
				_H.Notify(res.status, _H.Message(res.message));
			}
			if (res.status == 'success') {
				form4_1 = parseInt(res.data.form4_1)||0;
				form4_2 = parseInt(res.data.form4_2)||0;
				form4_3 = parseInt(res.data.form4_3)||0;
				form4_4 = parseInt(res.data.form4_4)||0;
				form4_5 = parseInt(res.data.form4_4)||0;
				form4_6 = parseInt(res.data.form4_4)||0;
				form4_7 = form4_1 + form4_2 + form4_3 + form4_4 + form4_5 + form4_6;
				$("#form4_1").val(form4_1).change();
				$("#form4_2").val(form4_2).change();
				$("#form4_3").val(form4_3).change();
				$("#form4_4").val(form4_4).change();
				$("#form4_5").val(form4_5).change();
				$("#form4_6").val(form4_6).change();
				$("#form4_7").val(form4_7).change();
			}
		});
	}

		function DL_FormV(bulan){
		$.post(_BASE_URL + 'sekolah/form_lapbul/data_bulan_lalu/lapbul_form5/'+bulan, {}, function(response) {
			var res = _H.StrToObject( response );
			if (res.status == 'error') {
				_H.Notify(res.status, _H.Message(res.message));
			}
			if (res.status == 'success') {
				form5_1 = parseInt(res.data.form5_1)||0;
				form5_2 = parseInt(res.data.form5_2)||0;
				form5_3 = parseInt(res.data.form5_3)||0;
				$("#form5_1").val(form5_1).change();
				$("#form5_2").val(form5_2).change();
				$("#form5_3").val(form5_3).change();
			}
		});
	}
	
	function DL_FormVI(bulan){
		$.post(_BASE_URL + 'sekolah/form_lapbul/data_bulan_lalu/lapbul_form6/'+bulan, {}, function(response) {
			var res = _H.StrToObject( response );
			if (res.status == 'error') {
				_H.Notify(res.status, _H.Message(res.message));
			}
			if (res.status == 'success') {
				form6_1 = parseInt(res.data.form6_1)||0;
				form6_2 = parseInt(res.data.form6_2)||0;
				form6_3 = parseInt(res.data.form6_3)||0;
				$("#form6_1").val(form6_1).change();
				$("#form6_2").val(form6_2).change();
				$("#form6_3").val(form6_3).change();
			}
		});
	}
	
	function DL_FormVII(bulan){
		$.post(_BASE_URL + 'sekolah/form_lapbul/data_bulan_lalu/lapbul_form7/'+bulan, {}, function(response) {
			var res = _H.StrToObject( response );
			if (res.status == 'error') {
				_H.Notify(res.status, _H.Message(res.message));
			}
			if (res.status == 'success') {
				form7_1 = parseInt(res.data.form7_1)||0;
				form7_2 = parseInt(res.data.form7_2)||0;
				form7_3 = parseInt(res.data.form7_3)||0;
				form7_4 = parseInt(res.data.form7_4)||0;
				$("#form7_1").val(form7_1).change();
				$("#form7_2").val(form7_2).change();
				$("#form7_3").val(form7_3).change();
				$("#form7_4").val(form7_4).change();
			}
		});
	}
	
	function DL_FormIX(bulan){
		$.post(_BASE_URL + 'sekolah/form_lapbul/data_bulan_lalu/lapbul_form9/'+bulan, {}, function(response) {
			var res = _H.StrToObject( response );
			if (res.status == 'error') {
				_H.Notify(res.status, _H.Message(res.message));
			}
			if (res.status == 'success') {
				form9_1 = parseInt(res.data.form9_1)||0;
				form9_2 = parseInt(res.data.form9_2)||0;
				$("#form9_1").val(form9_1).change();
				$("#form9_2").val(form9_2).change();
			}
		});
	}
	
	function DL_FormX(bulan){
		$.post(_BASE_URL + 'sekolah/form_lapbul/data_bulan_lalu/lapbul_form10/'+bulan, {}, function(response) {
			var res = _H.StrToObject( response );
			if (res.status == 'error') {
				_H.Notify(res.status, _H.Message(res.message));
			}
			if (res.status == 'success') {
				form10_1 = parseInt(res.data.form10_1)||0;
				form10_2 = parseInt(res.data.form10_2)||0;
				form10_3 = parseInt(res.data.form10_3)||0;
				form10_4 = parseInt(res.data.form10_4)||0;
				$("#form10_1").val(form10_1).change();
				$("#form10_2").val(form10_2).change();
				$("#form10_3").val(form10_3).change();
				$("#form10_4").val(form10_4).change();
			}
		});
	}
	
	function DL_FormXI(bulan){
		$.post(_BASE_URL + 'sekolah/form_lapbul/data_bulan_lalu/lapbul_form11/'+bulan, {}, function(response) {
			var res = _H.StrToObject( response );
			if (res.status == 'error') {
				_H.Notify(res.status, _H.Message(res.message));
			}
			if (res.status == 'success') {
				form11_1 = parseInt(res.data.form11_1)||0;
				form11_2 = parseInt(res.data.form11_2)||0;
				form11_3 = parseInt(res.data.form11_3)||0;
				form11_4 = parseInt(res.data.form11_4)||0;
				$("#form11_1").val(form11_1).change();
				$("#form11_2").val(form11_2).change();
				$("#form11_3").val(form11_3).change();
				$("#form11_4").val(form11_4).change();
			}
		});
	}
	
	function DL_FormXII(bulan){
		$.post(_BASE_URL + 'sekolah/form_lapbul/data_bulan_lalu/lapbul_form12/'+bulan, {}, function(response) {
			var res = _H.StrToObject( response );
			if (res.status == 'error') {
				_H.Notify(res.status, _H.Message(res.message));
			}
			if (res.status == 'success') {
				form12_1 = parseInt(res.data.form12_1)||0;
				form12_2 = parseInt(res.data.form12_2)||0;
				form12_3 = parseInt(res.data.form12_3)||0;
				$("#form12_1").val(form12_1).change();
				$("#form12_2").val(form12_2).change();
				$("#form12_3").val(form12_3).change();
			}
		});
	}
	
	function DL_FormXIII(bulan){
		$.post(_BASE_URL + 'sekolah/form_lapbul/data_bulan_lalu/lapbul_form13/'+bulan, {}, function(response) {
			var res = _H.StrToObject( response );
			if (res.status == 'error') {
				_H.Notify(res.status, _H.Message(res.message));
			}
			if (res.status == 'success') {
				form13_1 = parseInt(res.data.form13_1)||0;
				form13_2 = parseInt(res.data.form13_2)||0;
				form13_3 = parseInt(res.data.form13_3)||0;
				$("#form13_1").val(form13_1).change();
				$("#form13_2").val(form13_2).change();
				$("#form13_3").val(form13_3).change();
			}
		});
	}
</script>