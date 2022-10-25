<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<style>
.content-wrapper {
	padding-top : 0px !important;
}
</style>
<? $status = get_value('lapbul_index', 'status', 'id', $id_index);
$tombol =  $status > 2 ? 'disabled' : '';
?>
<section class="content">
    <h4 style="margin-top : 0px;">LAPORAN BULANAN UNTUK BULAN <?=strtoupper(xbulan($query->bulan));?> <?=$this->session->tahun;?></h4>
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#form_1" data-toggle="tab" aria-expanded="true">DAFTAR KEADAAN MURID</a></li>
			<li class=""><a href="#form_2" data-toggle="tab" aria-expanded="false">DAFTAR KEADAAN GURU</a></li>
			<li class=""><a href="#form_3" data-toggle="tab" aria-expanded="false">REKAP ABSENSI GURU</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="form_1">				
				<table width="100%" border="2px">
					<tr>
						<td width="20" style="border-right: solid 1px #FFF;"></td>
						<td><strong>JUMLAH ROMBONGAN BELAJAR</strong></td>
						<td align="right" width="50" style="border-left: solid 1px #FFF;"><div class="btn-group"><button onclick="DL_FormI(<?=$query->bulan;?>);" class="btn btn-flat btn-info btn-xs" <?=$tombol;?>><i class="fa fa-database"></i> Ambil Data Bulan Lalu</button></div></td>
					</tr>
				</table>
				<table width="100%" border="2px">		
					<tr>
						<td align="center">KELOMPOK A</td>
						<td align="center">KELOMPOK B</td>
						<td align="center">JUMLAH</td>
					</tr>
					<tr>
						<td align="center"><input style="text-align:center;" size="1" autocomplete="off" name="form1_1" type="text" id="form1_1" onkeypress="return xisNumberx(event);" value="<?=$form1->form1_1;?>" <?=$tombol;?>></td>
						<td align="center"><input style="text-align:center;" size="1" autocomplete="off" name="form1_2" type="text" id="form1_2" onkeypress="return xisNumberx(event);" value="<?=$form1->form1_2;?>" <?=$tombol;?>></td>
						<td align="center"><input style="text-align:center;" size="1" autocomplete="off" name="form1_3" type="text" id="form1_3" onkeypress="return xisNumberx(event);" value="<?=$form1->form1_1+$form1->form1_2;?>" disabled></td>
					</tr>
				</table>
				<br>				
				<table width="100%" border="2px">
					<tr>
						<td width="20" style="border-right: solid 1px #FFF;"></td>
						<td><strong>MURID BERDASARKAN JENIS KELAMIN</strong></td>
						<td align="right" width="50" style="border-left: solid 1px #FFF;"><div class="btn-group"><button onclick="DL_FormII(<?=$query->bulan;?>);" class="btn btn-flat btn-info btn-xs" <?=$tombol;?>><i class="fa fa-database"></i> Ambil Data Bulan Lalu</button></div></td>
					</tr>
				</table>
				<table width="100%" border="2px">
					<tr>
						<td align="center" colspan="3"><b>KELOMPOK A</b></td>
						<td align="center" colspan="3"><b>KELOMPOK B</b></td>
						<td align="center"colspan="3"><b>JUMLAH</b></td>
					</tr>
					<tr>
						<td align="center"><b>LK</b></td>
						<td align="center"><b>PR</b></td>
						<td align="center"><b>JUMLAH</b></td>
						<td align="center"><b>LK</b></td>
						<td align="center"><b>PR</b></td>
						<td align="center"><b>JUMLAH</b></td>
						<td align="center"><b>LK</b></td>
						<td align="center"><b>PR</b></td>
						<td align="center"><b>JUMLAH</b></td>
					</tr>
					<tr>
						<td align="center"><input style="text-align:center;" size="1" autocomplete="off" name="form2_1" type="text" id="form2_1" onkeypress="return xisNumberx(event);" value="<?=$form2->form2_1;?>" <?=$tombol;?>></td>
						<td align="center"><input style="text-align:center;" size="1" autocomplete="off" name="form2_2" type="text" id="form2_2" onkeypress="return xisNumberx(event);" value="<?=$form2->form2_2;?>" <?=$tombol;?>></td>
						<td align="center"><input style="text-align:center;" size="1" autocomplete="off" name="form2_3" type="text" id="form2_3" onkeypress="return xisNumberx(event);" value="<?=$form2->form2_1+$form2->form2_2;?>" disabled></td>
						<td align="center"><input style="text-align:center;" size="1" autocomplete="off" name="form2_4" type="text" id="form2_4" onkeypress="return xisNumberx(event);" value="<?=$form2->form2_4;?>" <?=$tombol;?>></td>
						<td align="center"><input style="text-align:center;" size="1" autocomplete="off" name="form2_5" type="text" id="form2_5" onkeypress="return xisNumberx(event);" value="<?=$form2->form2_5;?>" <?=$tombol;?>></td>
						<td align="center"><input style="text-align:center;" size="1" autocomplete="off" name="form2_6" type="text" id="form2_6"  value="<?=$form2->form2_4+$form2->form2_5;?>" disabled></td>
						<td align="center"><input style="text-align:center;" size="1" autocomplete="off" name="form2_7" type="text" id="form2_7" onkeypress="return xisNumberx(event);" value="<?=$form2->form2_1+$form2->form2_4;?>" disabled></td>
						<td align="center"><input style="text-align:center;" size="1" autocomplete="off" name="form2_8" type="text" id="form2_8" onkeypress="return xisNumberx(event);" value="<?=$form2->form2_2+$form2->form2_5;?>" disabled></td>
						<td align="center"><input style="text-align:center;" size="1" autocomplete="off" name="form2_9" type="text" id="form2_9"  value="<?=$form2->form2_1+$form2->form2_4+$form2->form2_2+$form2->form2_5;?>" disabled></td>
					</tr>
				</table>
				<div id="space_form2"><br></div>
				<table width="100%" border="2px">
					<tr>
						<td width="20" style="border-right: solid 1px #FFF;"></td>
						<td><strong>MURID BERDASARKAN UMUR</strong></td>
						<td width="50" align="right" style="border-left: solid 1px #FFF;"><div class="btn-group"><button onclick="DL_FormIII(<?=$query->bulan;?>);" class="btn btn-flat btn-info btn-xs" <?=$tombol;?>><i class="fa fa-database"></i> Ambil Data Bulan Lalu</button></div></td>
					</tr>
				</table>
				<div class="table-responsive">
					<table width="100%" border="2px">
						<tr>
							<td align="center" colspan="4"><b>UMUR</b></td>
							<td rowspan="2" align="center"><b>JUMLAH</b></td>
						</tr>
						<tr>
							<td align="center"><b>4 TAHUN</b></td>
							<td align="center"><b>5 TAHUN</b></td>
							<td align="center"><b>6 TAHUN</b></td>
							<td align="center"><b>7 TAHUN</b></td>
						</tr>
						<tr>
							<td align="center"><input style="text-align:center;" size="1" autocomplete="off" name="form3_1" type="text" id="form3_1" onkeypress="return xisNumberx(event);" value="<?=$form3->form3_1;?>" <?=$tombol;?>></td>
							<td align="center"><input style="text-align:center;" size="1" autocomplete="off" name="form3_2" type="text" id="form3_2" onkeypress="return xisNumberx(event);" value="<?=$form3->form3_2;?>" <?=$tombol;?>></td>
							<td align="center"><input style="text-align:center;" size="1" autocomplete="off" name="form3_3" type="text" id="form3_3" onkeypress="return xisNumberx(event);" value="<?=$form3->form3_3;?>" <?=$tombol;?>></td>
							<td align="center"><input style="text-align:center;" size="1" autocomplete="off" name="form3_4" type="text" id="form3_4" onkeypress="return xisNumberx(event);" value="<?=$form3->form3_4;?>" <?=$tombol;?>></td>
							<td align="center"><input style="text-align:center;" size="1" autocomplete="off" name="form3_5" type="text" id="form3_5" onkeypress="return xisNumberx(event);" value="<?=$form3->form3_1+$form3->form3_2+$form3->form3_3+$form3->form3_4;?>" disabled></td>
						</tr>
					</table>
					<div id="error_form3" style="color:red;display:none"><i>Jumlah Murid berdasarkan umur harus sesuai dengan jumlah murid berdasarkan jenis kelamin !</i></div>
				</div>
			</div>
			<div class="tab-pane" id="form_2">
				<table width="100%" border="2px">
					<tr>
						<td width="20" style="border-right: solid 1px #FFF;"></td>
						<td><strong>DAFTAR KEADAAN GURU</strong> <small style="color:red;">Perubahan data hanya dapat dilakukan melalui menu Data GTK kemudian tekan tombol >>></small></td>
						<td align="right" width="50" style="border-left: solid 1px #FFF;"><div class="btn-group"><button onclick="update_gtk(<?=$id_index;?>);" class="btn btn-flat btn-info btn-xs" <?=$tombol;?>><i class="fa fa-refresh"></i> Update data GTK</button></div></td>
					</tr>
				</table>
				<div class="table-responsive">
					<table width="100%" border="2px">
						<tr>
							<td align="center" rowspan="2"><b>NO</b></td>
							<td align="center" rowspan="2"><b>NAMA GURU<br>NIP/NUPTK</b></td>
							<td align="center" colspan="2"><b>KELAHIRAN</b></td>
							<td align="center" rowspan="2"><b>L/P</b></td>
							<td align="center" rowspan="2"><b>GOL/RUANG</b></td>
							<td align="center" rowspan="2"><b>JABATAN</b></td>
							<td align="center" rowspan="2"><b>IJAZAH<br>TERAKHIR</b></td>
							<td align="center" rowspan="2"><b>AGAMA</b></td>
							<td align="center" rowspan="2"><b>TGL MULAI BEKERJA DI<br>SEKOLAH INI</b></td>
							<td align="center" colspan="2"><b>MASA KERJA</b></td>
							<td align="center" rowspan="2"><b>MENGAJAR<br>KELOMPOK</b></td>
							<td align="center" rowspan="2"><b>KETERANGAN<br>GURU</b></td>
						</tr>
						<tr>
							<td align="center"><b>TEMPAT</b></td>
							<td align="center"><b>TANGGAL</b></td>
							<td align="center"><b>TAHUN</b></td>
							<td align="center"><b>BULAN</b></td>
						</tr>
						<? $no = 1;
						   foreach ($daftar_keadaan_guru as $data_gtk){ ?>
							   <tr>
							   <td align="center"><?=$no;?></td>
							   <td align="center"><?=$data_gtk->nama;?><br><?=$data_gtk->nip == '' ? $data_gtk->nuptk : $data_gtk->nip;?></td>
							   <td align="center"><?=$data_gtk->tmp_lahir;?></td>
							   <td align="center"><?=indo_date($data_gtk->tgl_lahir);?></td>
							   <td align="center"><?=$data_gtk->jenis_kelamin;?></td>
							   <td align="center"><?=$data_gtk->golru;?></td>
							   <td align="center"><?=$data_gtk->jab;?></td>
							   <td align="center"><?=$data_gtk->ijazah;?></td>
							   <td align="center"><?=$data_gtk->agama;?></td>
							   <td align="center"><?=indo_date($data_gtk->tmt);?></td>
							   <td align="center"><?=$data_gtk->mk_tahun;?></td>
							   <td align="center"><?=$data_gtk->mk_bulan;?></td>
							   <td align="center"><?=$data_gtk->mengajar_kel;?></td>
							   <td align="center"><?=$data_gtk->ket_guru;?></td>
							   </tr>
						<?   $no++;} ?>
						
					</table>
					<div id="error_form3" style="color:red;display:none"><i>Jumlah Murid berdasarkan umur harus sesuai dengan jumlah murid berdasarkan jenis kelamin !</i></div>
				</div>
			</div>
			<div class="tab-pane" id="form_3">
				<table width="100%" border="2px">
					<tr>
						<td width="20" style="border-right: solid 1px #FFF;"></td>
						<td><strong>DAFTAR HADIR/TIDAK HADIR GURU</strong></td>
					</tr>
				</table>
				<div class="table-responsive">
					<table width="100%" border="2px">
						<tr>
							<td align="center" rowspan="2"><b>NO</b></td>
							<td align="center" rowspan="2"><b>NAMA GURU<br>NIP/NUPTK</b></td>
							<td align="center" colspan="3"><b>ABSENSI</b></td>
						</tr>
						<tr>
							<td align="center"><b>SAKIT</b></td>
							<td align="center"><b>IZIN</b></td>
							<td align="center"><b>ALFA</b></td>
						</tr>
						<? $no = 1;
						   foreach ($daftar_keadaan_guru as $data_gtk){ ?>
							   <tr>
							   <td align="center"><?=$no;?></td>
							   <td align="center"><?=$data_gtk->nama;?><br><?=$data_gtk->nip == '' ? $data_gtk->nuptk : $data_gtk->nip;?></td>
							   <td align="center"><input style="text-align:center;" size="1" autocomplete="off" name="sakit[]" type="text" onchange="update_sakit(<?=$data_gtk->id;?>,this.value)" onkeypress="return xisNumberx(event);" value="<?=$data_gtk->sakit;?>" <?=$tombol;?>></td>
							   <td align="center"><input style="text-align:center;" size="1" autocomplete="off" name="izin[]" type="text" onchange="update_izin(<?=$data_gtk->id;?>,this.value)" onkeypress="return xisNumberx(event);" value="<?=$data_gtk->izin;?>" <?=$tombol;?>></td>
							   <td align="center"><input style="text-align:center;" size="1" autocomplete="off" name="alfa[]" type="text" onchange="update_alfa(<?=$data_gtk->id;?>,this.value)" onkeypress="return xisNumberx(event);" value="<?=$data_gtk->alfa;?>" <?=$tombol;?>></td>
							   </tr>
						<?   $no++;} ?>
						
					</table>
					<div id="error_form3" style="color:red;display:none"><i>Jumlah Murid berdasarkan umur harus sesuai dengan jumlah murid berdasarkan jenis kelamin !</i></div>
				</div>
				<br>
				<center><button onclick="simpan(<?=$id_index;?>);" class="btn btn-success btn-sm" <?=$tombol;?>><i class="fa fa-save"></i> SIMPAN</button></center>
			</div>
		</div>
		
	</div>
</section>
<? $this->load->view('sekolah/form_lapbul_js');?>

<script type="text/javascript">
	var _grid = 'DUMMY_GRID';
	new GridBuilder( _grid , {
		controller:'sekolah/form_lapbul',
		fields: []
	});

	function CatatanMuridKeluar(id) {
		$.fancybox.open({
			src  : _BASE_URL + 'sekolah/murid_keluar/input/'+id,
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