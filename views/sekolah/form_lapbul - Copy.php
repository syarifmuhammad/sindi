<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div id="isfancy"></div>
<section class="content-header">
   <div class="row">
      <div class="col-xs-12">
         <h3 style="margin:0;"><i class="fa fa-sign-out text-green"></i> <span class="table-header">Form Laporan Bulan <?=xbulan($query->bulan);?></span>
            <br><small style="margin-left:29px;">Tahun Pelajaran <?=$query->ta;?></small>
         </h3>
      </div>
   </div>
</section>
<section class="content">
   <div class="box">
      <div class="box-body">
         <div class="table-responsive">
            <table class="table table-hover table-bordered table-striped table-condensed">
               <tr>
					<td width="5">I</td>
					<td colspan="2">PENERIMAAN MURID KELAS 1 TAHUN PELAJARAN <?=$query->ta;?></td>
					<td align="right"><button onclick="form1(<?=$query->id;?>)" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Input</button> <button onclick="" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Selesai</button></td>
			   </tr>
			   <tr>
					<td>II</td>
					<td colspan="2">ASAL MURID KELAS 1 TAHUN PELAJARAN <?=$query->ta;?></td>
					<td align="right"><button onclick="" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Input</button> <button onclick="" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Selesai</button></td>
			   </tr>
			   <tr>
					<td>III</td>
					<td colspan="3">KEADAAN MURID</td>
			   </tr>
			   <tr>
					<td></td>
					<td>1</td>
					<td>Jumlah Murid Akhir Bulan Yang Lalu</td>
					<td align="right"><button onclick="" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Input</button> <button onclick="" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Selesai</button></td>
			   </tr>
			   <tr>
					<td></td>
					<td>2</td>
					<td>Jumlah Murid Keluar dalam bulan ini</td>
					<td align="right"><button onclick="" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Input</button> <button onclick="" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Selesai</button></td>
			   </tr>
			   <tr>
					<td></td>
					<td>3</td>
					<td>Jumlah Murid Masuk dalam bulan ini</td>
					<td align="right"><button onclick="" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Input</button> <button onclick="" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Selesai</button></td>
			   </tr>
			   <tr>
					<td width="5">A</td>
					<td colspan="2">JUMLAH MURID MENURUT AGAMA</td>
					<td align="right"><button onclick="" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Input</button> <button onclick="" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Selesai</button></td>
			   </tr>
			   <tr>
					<td width="5">B</td>
					<td colspan="2">ABSEN MURID</td>
					<td align="right"><button onclick="" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Input</button> <button onclick="" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Selesai</button></td>
			   </tr>
			   <tr>
					<td width="5">C</td>
					<td colspan="2">MURID KELUAR KARENA</td>
					<td align="right"><button onclick="" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Input</button> <button onclick="" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Selesai</button></td>
			   </tr>
			   <tr>
					<td></td>
					<td width="5">*)</td>
					<td>Catatan Murid yang berhenti</td>
					<td align="right"><button onclick="" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Input</button> <button onclick="" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Selesai</button></td>
			   </tr>
			   <tr>
					<td width="5">D</td>
					<td colspan="2">JUMLAH RUANG KELAS</td>
					<td align="right"><button onclick="" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Input</button> <button onclick="" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Selesai</button></td>
			   </tr>
			   <tr>
					<td></td>
					<td width="5">*)</td>
					<td>Status Kepemilikan Ruang Kelas</td>
					<td align="right"><button onclick="" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Input</button> <button onclick="" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Selesai</button></td>
			   </tr>
			   <tr>
					<td width="5">E</td>
					<td colspan="2">JUMLAH ROMBEL</td>
					<td align="right"><button onclick="" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Input</button> <button onclick="" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Selesai</button></td>
			   </tr>
			   <tr>
					<td width="5">F</td>
					<td colspan="2">JUMLAH GURU</td>
					<td align="right"><button onclick="" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Input</button> <button onclick="" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Selesai</button></td>
			   </tr>
			   <tr>
					<td width="5">G</td>
					<td colspan="2">BANTUAN</td>
					<td align="right"><button onclick="" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Input</button> <button onclick="" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Selesai</button></td>
			   </tr>
			   <tr>
					<td width="5">H</td>
					<td colspan="2">SEBAB-SEBAB MUTASI PEGAWAI</td>
					<td align="right"><button onclick="" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Input</button> <button onclick="" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Selesai</button></td>
			   </tr>
			   <tr>
					<td width="5">I</td>
					<td colspan="2">KEADAAN GEDUNG</td>
					<td align="right"><button onclick="" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Input</button> <button onclick="" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Selesai</button></td>
			   </tr>
			   <tr>
					<td width="5">J</td>
					<td colspan="2">RUMAH DINAS</td>
					<td align="right"><button onclick="" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Input</button> <button onclick="" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Selesai</button></td>
			   </tr>
            </table>
         </div>
      </div>
   </div>
</section>
<script type="text/javascript">
	var _grid = 'DUMMY_GRID';
	new GridBuilder( _grid , {
		controller:'sekolah/form_lapbul',
		fields: []
	});

	function form1(id) {
		$.fancybox.open({
			src  : _BASE_URL + 'sekolah/lapbul_form/form1/input/'+id,
			type : 'iframe',
			toolbar : false,
			smallBtn : false,
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
				// $("#adminsekolah").focus();
			// },
			// afterClose: function () {
               // LAPBUL_CREATE.OnReload();  
            // }
		});
    }
</script>