<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('bgjk/jaskon/grid_tenaga_terampil');?>
<script type="text/javascript">
    DS.JenisKelamin = _H.StrToObject('{"":"Pilih","Laki-laki":"Laki-laki","Perempuan":"Perempuan"}');
    var _grid = 'TENAGA_TERAMPIL', _form = _grid + '_FORM';
	new GridBuilder( _grid , {
        controller:'bgjk/jaskon/tenaga_terampil',
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
			{ header:'', renderer:'nik' },
			{ header:'', renderer:'jk' },
			{ header:'', renderer:'alamat' },
			{ header:'', renderer:'no_skt' },
			{ header:'', renderer:'tgl_skt' },
			{ header:'', renderer:'jenis_keterampilan' },
			{ header:'', renderer:'penerbit_skt' },
			{ header:'', renderer:'telp' },
			{ header:'', renderer:'email' }
    	],
		to_excel: false,
		resize_column: 3,
		extra_buttons: 	'<button title="IMPORT" onclick="import_excel()" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top"><i class="fa fa-upload"></i> IMPORT DATA</button>'+
						'<button title="CETAK" onclick="printData()" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top"><i class="fa fa-print"></i> CETAK</button>'+
						'<button title="Export Excel" onclick="TENAGA_TERAMPIL.ExportExcel()" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top"><i class="fa fa-file-excel-o"></i> EXPORT EXCEL</button>'
    });
	// console.log(SANITASI.options.fields.length);
    new FormBuilder( _form , {
	    controller:'bgjk/jaskon/tenaga_terampil',
	    fields: [
            { label:'Nama Tenaga Terampil', name:'nama'},
            { label:'NIK', name:'nik'},
			{ label:'Jenis Kelamin', name:'jk', type:'select', datasource:DS.JenisKelamin},
			{ label:'Alamat', name:'alamat', type:'textarea'},
			{ label:'Nomor SKT', name:'no_skt'},
			{ label:'Tanggal SKT', name:'tgl_skt', type:'date'},
			{ label:'Jenis Keterampilan SKT', name:'jenis_keterampilan'},
			{ label:'Penerbit SKT', name:'penerbit_skt'},
			{ label:'No. Telpon', name:'telp'},
			{ label:'Email', name:'email', type:'email'}
	    ]
  	});
	

	function import_excel() {
		$.fancybox.open({
			src  : _BASE_URL + 'bgjk/jaskon/tenaga_terampil/import_excel_form',
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
               TENAGA_TERAMPIL.OnReload();  
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
	   newWin.document.write("<center><h1>DATA TENAGA TERAMPIL</h1><p>Tahun "+tahun+"</p> </center>");
	   newWin.document.write(divToPrint.outerHTML);
	   newWin.document.write("<style> table {width:100%;border-collapse: collapse;} table, th, td {border: 1px solid black;} td.exclude_excel, th.exclude_excel{display:none;} </style>");
	   newWin.print();	   
	   newWin.onfocus=function(){ newWin.close();}
	}
</script>
