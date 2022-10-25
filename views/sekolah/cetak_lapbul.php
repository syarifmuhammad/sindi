<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Cetak Lapbul</title>
	<style>
	:root{--blue:#007bff;--indigo:#6610f2;--purple:#6f42c1;--pink:#e83e8c;--red:#dc3545;--orange:#fd7e14;--yellow:#ffc107;--green:#28a745;--teal:#20c997;--cyan:#17a2b8;--white:#fff;--gray:#6c757d;--gray-dark:#343a40;--primary:#007bff;--secondary:#6c757d;--success:#28a745;--info:#17a2b8;--warning:#ffc107;--danger:#dc3545;--light:#f8f9fa;--dark:#343a40;--breakpoint-xs:0;--breakpoint-sm:576px;--breakpoint-md:768px;--breakpoint-lg:992px;--breakpoint-xl:1200px;--font-family-sans-serif:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";--font-family-monospace:SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace;}
	*,::after,::before{box-sizing:border-box;}
	html{font-family:sans-serif;line-height:1.15;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;-ms-overflow-style:scrollbar;-webkit-tap-highlight-color:transparent;}
	body{margin:0;font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";font-size:1rem;font-weight:400;line-height:1.5;color:#212529;text-align:left;background-color:#fff;}
	b{font-weight:bolder;}
	table{border-collapse:collapse;}
	.col-md-12{position:relative;width:100%;min-height:1px;padding-right:15px;padding-left:15px;}
	@media (min-width:768px){
	.col-md-12{-webkit-box-flex:0;-ms-flex:0 0 100%;flex:0 0 100%;max-width:100%;}
	}
	@media print{
	*,::after,::before{text-shadow:none!important;box-shadow:none!important;}
	tr{page-break-inside:avoid;}
	body{min-width:992px!important;}
	}
	table.rka, .rka td {
	  border: 1px solid black;
	  border-collapse: collapse;
	}
	@page {
		margin: 0cm 0cm;
	}
	
	.page-break {
		page-break-after: always;
	}

	body {
		margin-top: 1cm;
		margin-left: 1cm;
		margin-right: 1cm;
		margin-bottom: 1cm;
	}
	</style>
</head>
<body>

<main>
<center><h3>LAPORAN BULANAN</h3></center>
<table width="100%" border="0px">
<? foreach($lapbul_index as $data_index){ ?>
<tr>
	<td width="15%">NAMA SEKOLAH</td>
	<td width="10px">:</td>
	<td width="60%"><?=$this->session->user_full_name;?></td>
	<td width="15%">KABUPATEN</td>
	<td width="10px">:</td>
	<td>KOTABARU</td>
</tr>
<tr>
	<td width="15%">ALAMAT</td>
	<td width="10px">:</td>
	<td width="60%"><?=get_value('sp_profil', 'sp_value', ['sp_npsn', 'sp_variable'], [$this->session->user_profile_id,'sp_alamat']);?></td>
	<td width="15%">TAHUN PELAJARAN</td>
	<td width="10px">:</td>
	<td><?=$data_index->ta;?></td>
</tr>
<tr>
	<td width="15%">KECAMATAN</td>
	<td width="10px">:</td>
	<td width="60%"><?=strtoupper(str_replace(['Kec. ','Kec.'],['',''],get_value('sp_profil', 'sp_value', ['sp_npsn', 'sp_variable'], [$this->session->user_profile_id,'sp_kec'])));?></td>
	<td width="15%">BULAN</td>
	<td width="10px">:</td>
	<td><?=strtoupper(xbulan($data_index->bulan));?></td>
</tr>
<? } ?>
</table><br>
<table width="100%" border="2px">
	<tr>
		<td><strong>JUMLAH ROMBONGAN BELAJAR</strong></td>
	</tr>
</table>
<table width="100%" border="2px">		
	<tr>
		<td align="center">KELOMPOK A</td>
		<td align="center">KELOMPOK B</td>
		<td align="center">JUMLAH</td>
	</tr>
	<tr>
		<? foreach($form1 as $data_form1) { ?>
		<td align="center"><?=$data_form1->form1_1;?></td>
		<td align="center"><?=$data_form1->form1_2;?></td>
		<td align="center"><?=$data_form1->form1_3;?></td>
		<? } ?>
	</tr>
</table>
<br>				
<table width="100%" border="2px">
	<tr>
		<td><strong>MURID BERDASARKAN JENIS KELAMIN</strong></td>
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
		<? foreach($form2 as $data_form2) { ?>
		<td align="center"><?=$data_form2->form2_1;?></td>
		<td align="center"><?=$data_form2->form2_2;?></td>
		<td align="center"><?=$data_form2->form2_3;?></td>
		<td align="center"><?=$data_form2->form2_4;?></td>
		<td align="center"><?=$data_form2->form2_5;?></td>
		<td align="center"><?=$data_form2->form2_6;?></td>
		<td align="center"><?=$data_form2->form2_7;?></td>
		<td align="center"><?=$data_form2->form2_8;?></td>
		<td align="center"><?=$data_form2->form2_9;?></td>
		<? } ?>
	</tr>
</table>
<div id="space_form2"><br></div>
<table width="100%" border="2px">
	<tr>
		<td><strong>MURID BERDASARKAN UMUR</strong></td>
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
			<? foreach($form3 as $data_form3) { ?>
			<td align="center"><?=$data_form3->form3_1;?></td>
			<td align="center"><?=$data_form3->form3_2;?></td>
			<td align="center"><?=$data_form3->form3_3;?></td>
			<td align="center"><?=$data_form3->form3_4;?></td>
			<td align="center"><?=$data_form3->form3_5;?></td>
			<? } ?>
		</tr>
	</table>
</div>
<div class="page-break"></div>
<table width="100%" border="2px">
	<tr>
		<td><strong>DAFTAR KEADAAN GURU</strong></td>
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
</div>
<div class="page-break"></div>
<table width="100%" border="2px">
	<tr>
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
			   <td align="center"><?=$data_gtk->sakit;?></td>
			   <td align="center"><?=$data_gtk->izin;?></td>
			   <td align="center"><?=$data_gtk->alfa;?></td>
			   </tr>
		<?   $no++;} ?>
		
	</table>
</div>
<br><br>
<table width="100%">
<tr>
	<td width="70%"></td>
	<td>Kotabaru, <?=indo_date($tanggal);?></td>
</tr>
<? foreach($pejabat as $data_pejabat){ ?>
<tr>
<td height="80px"></td>
<td style="vertical-align: top"><?=$data_pejabat->jab;?>,</td>
</tr>
<tr>
	<td></td>
	<td><b><u><?=$data_pejabat->nama;?></u></b></td>
</tr>
<tr>
	<td></td>
	<td><?=$data_pejabat->nip == '' ? '' : 'NIP. '.$data_pejabat->nip;?></td>
</tr>
<? } ?>
</table>
</main>
</body>
</html>