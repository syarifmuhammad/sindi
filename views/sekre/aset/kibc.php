<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('sekre/aset/kibc_grid');?>
<script type="text/javascript">
    DS.Kompleksitas = _H.StrToObject('{"":"Pilih","BG Sederhana":"BG Sederhana","BG Tidak Sederhana":"BG Tidak Sederhana","BG Khusus":"BG Khusus"}');
    DS.Permanensi = _H.StrToObject('{"":"Pilih","Permanen":"Permanen","NonPermanen":"NonPermanen"}');
    DS.TingkatRisiko = _H.StrToObject('{"":"Pilih","Tinggi":"Tinggi","Sedang":"Sedang","Rendah":"Rendah"}');
    DS.TingkatKepadatan = _H.StrToObject('{"":"Pilih","Padat":"Padat","Sedang":"Sedang","Renggang":"Renggang"}');
    DS.Kepemilikan = _H.StrToObject('{"":"Pilih","BG Negara":"BG Negara","BG NonNegara":"BG NonNegara"}');
    DS.Kondisi = _H.StrToObject('{"":"Pilih","B":"B","RR":"RR","RS":"RS","RB":"RB"}');
	var _grid = 'KIB_C', _form = _grid + '_FORM';
	new GridBuilder( _grid , {
        controller:'sekre/aset/kibc',
        fields: [
            {
                header: '<input type="checkbox" class="check-all">',
                renderer: function( row ) {
                    return CHECKBOX(row.id, 'id');
                },
                exclude_excel: true,
                sorting: false
            },
			{
                header: '<i class="fa fa-edit"></i>',
                renderer: function( row ) {
                    return A(_form + '.OnEdit(' + row.id + ')', 'Edit');
                },
                exclude_excel: true,
                sorting: false
            },
			{header:'', renderer:'jenis'},
			{header:'', renderer:'kode'},
			{header:'', renderer:'reg'},
			{header:'', renderer:'kondisi_bangunan'},
			{header:'', renderer:'bertingkat'},
			{header:'', renderer:'beton'},
			{header:'', renderer:'luas_lantai'},
			{header:'', renderer:'alamat'},
			{header:'', renderer:'tanggal_dokumen'},
			{header:'', renderer:'nomor_dokumen'},
			{header:'', renderer:'luas'},
			{header:'', renderer:'status_tanah'},
			{header:'', renderer:'kode_tanah'},
			{header:'', renderer:'asal_usul'},
			{header:'', renderer:'harga'},
			{header:'', renderer:'keterangan'},
    	],
		to_excel: false,
		resize_column: 3,
		extra_buttons: 	'<button title="IMPORT" onclick="import_excel()" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top"><i class="fa fa-upload"></i> IMPORT DATA</button>'+
						'<button title="CETAK" onclick="printData()" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top"><i class="fa fa-print"></i> CETAK</button>'+
						'<button title="Export Excel" onclick="KIB_C.ExportExcel()" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top"><i class="fa fa-file-excel-o"></i> EXPORT EXCEL</button>'
    });
	
    new FormBuilder( _form , {
	    controller:'sekre/aset/kibc',
	    fields: [
            { label:'Jenis Barang / Nama Barang', name:'jenis'},
            { label:'Nomor Kode Barang', name:'kode'},
			{ label:'Nomor Register', name:'reg'},
			{ label:'Kondisi Bangunan ', name:'kondisi_bangunan'},
			{ label:'Bertingkat / Tidak', name:'bertingkat'},
			{ label:'Beton / Tidak', name:'beton'},
			{ label:'Luas Lantai (m2)', name:'luas_lantai'},
			{ label:'Letak/ Lokasi Alamat', name:'alamat', type:'textarea'},
			{ label:'Tanggal Dokumen', name:'tanggal_dokumen', type:'date'},
			{ label:'Nomor Dokumen', name:'nomor_dokumen'},
			{ label:'Luas (m2)', name:'luas'},
			{ label:'Status Tanah', name:'status_tanah'},
			{ label:'Kode Tanah', name:'kode_tanah'},
			{ label:'Asal Usul', name:'asal_usul'},
			{ label:'Harga', name:'harga'},
			{ label:'Keterangan', name:'keterangan'},
	    ]
  	});
	

	function import_excel() {
		$.fancybox.open({
			src  : _BASE_URL + 'sekre/aset/kibc/import_excel_form',
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
			afterClose: function () {
               KIB_C.OnReload();  
            }
		});
    }
	var ee = $("#printTable").find(".exclude_excel").length;
	function printData()
	{
	   var divToPrint=document.getElementById("printTable");
	   var tahun = "<?=$this->session->tahun;?>";
	   newWin= window.open("");
	   newWin.document.write("<center><h1>DATA KIB C<br>GEDUNG DAN BANGUNAN</h1><p>Tahun "+tahun+"</p> </center>");
	   newWin.document.write(divToPrint.outerHTML);
	   newWin.document.write("<style> table {width:100%;border-collapse: collapse;} table, th, td {border: 1px solid black;} td.exclude_excel, th.exclude_excel{display:none;} </style>");
	   newWin.print();
	}
</script>
