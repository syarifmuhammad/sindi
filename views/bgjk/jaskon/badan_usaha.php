<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('bgjk/jaskon/grid_badan_usaha');?>
<script type="text/javascript">
    DS.SifatKlasifikasiUsaha = _H.StrToObject('{"":"Pilih","Umum":"Umum","Spesialis":"Spesialis"}');
    DS.Kualifikasi = _H.StrToObject('{"":"Pilih","K":"K","M":"M","B":"B"}');
    var _grid = 'BADAN_USAHA', _form = _grid + '_FORM';
	new GridBuilder( _grid , {
        controller:'bgjk/jaskon/badan_usaha',
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
			{ header:'', renderer:'nama' },
			{ header:'', renderer:'jenis' },
			{ header:'', renderer:'sifat' },
			{ header:'', renderer:'no_izin' },
			{ header:'', renderer:'tgl_izin' },
			{ header:'', renderer:'penerbit_izin' },
			{ header:'', renderer:'no_sbu' },
			{ header:'', renderer:'tgl_sbu' },
			{ header:'', renderer:'penerbit_sbu' },
			{ header:'', renderer:'kualifikasi' },
			{ header:'', renderer:'penanggung_jawab' },
			{ header:'', renderer:'penanggung_jawab_teknis' },
			{ header:'', renderer:'alamat' },
			{ header:'', renderer:'email' }
    	],
		to_excel: false,
		resize_column: 3,
		extra_buttons: 	'<button title="IMPORT" onclick="import_excel()" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top"><i class="fa fa-upload"></i> IMPORT DATA</button>'+
						'<button title="CETAK" onclick="printData()" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top"><i class="fa fa-print"></i> CETAK</button>'+
						'<button title="Export Excel" onclick="BADAN_USAHA.ExportExcel()" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top"><i class="fa fa-file-excel-o"></i> EXPORT EXCEL</button>'
    });
	// console.log(SANITASI.options.fields.length);
    new FormBuilder( _form , {
	    controller:'bgjk/jaskon/badan_usaha',
	    fields: [
            { label:'Nama Badan Usaha Jasa Konstruksi', name:'nama'},
            { label:'Jenis Usaha', name:'jenis'},
			{ label:'Sifat Klasifikasi Usaha', name:'sifat', type:'select', datasource:DS.SifatKlasifikasiUsaha},
			{ label:'Nomor Izin Usaha', name:'no_izin'},
			{ label:'Tanggal Izin Usaha', name:'tgl_izin', type:'date'},
			{ label:'Penerbit Izin Usaha', name:'penerbit_izin'},
			{ label:'Nomor SBU', name:'no_sbu'},
			{ label:'Tanggal SBU', name:'tgl_sbu', type:'date'},
			{ label:'Penerbit SBU', name:'penerbit_sbu'},
			{ label:'Kualifikasi', name:'kualifikasi', type:'select', datasource:DS.Kualifikasi},
			{ label:'Penanggung Jawab', name:'penanggung_jawab'},
			{ label:'Penanggung Jawab Teknis', name:'penanggung_jawab_teknis'},
			{ label:'Alamat', name:'alamat', type:'textarea'},
			{ label:'Email', name:'email', type:'email'}
	    ]
  	});
	

	function import_excel() {
		$.fancybox.open({
			src  : _BASE_URL + 'bgjk/jaskon/badan_usaha/import_excel_form',
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
               BADAN_USAHA.OnReload();  
            }
		});
    }
	var ee = $("#printTable").find(".exclude_excel").length;
	console.log(ee);
	function printData()
	{
	   var divToPrint=document.getElementById("printTable");
	   var tahun = "<?=$this->session->tahun;?>";
	   newWin= window.open("");
	   newWin.document.write("<center><h1>DATA BADAN USAHA JASA KONSTRUKSI</h1><p>Tahun "+tahun+"</p> </center>");
	   newWin.document.write(divToPrint.outerHTML);
	   newWin.document.write("<style> table {width:100%;border-collapse: collapse;} table, th, td {border: 1px solid black;} td.exclude_excel, th.exclude_excel{display:none;} </style>");
	   newWin.print();	   
	   newWin.onfocus=function(){ newWin.close();}
	}
</script>
