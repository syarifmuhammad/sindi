<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('sekre/aset/kiba_grid');?>
<script type="text/javascript">
    DS.Kompleksitas = _H.StrToObject('{"":"Pilih","BG Sederhana":"BG Sederhana","BG Tidak Sederhana":"BG Tidak Sederhana","BG Khusus":"BG Khusus"}');
    DS.Permanensi = _H.StrToObject('{"":"Pilih","Permanen":"Permanen","NonPermanen":"NonPermanen"}');
    DS.TingkatRisiko = _H.StrToObject('{"":"Pilih","Tinggi":"Tinggi","Sedang":"Sedang","Rendah":"Rendah"}');
    DS.TingkatKepadatan = _H.StrToObject('{"":"Pilih","Padat":"Padat","Sedang":"Sedang","Renggang":"Renggang"}');
    DS.Kepemilikan = _H.StrToObject('{"":"Pilih","BG Negara":"BG Negara","BG NonNegara":"BG NonNegara"}');
    DS.Kondisi = _H.StrToObject('{"":"Pilih","B":"B","RR":"RR","RS":"RS","RB":"RB"}');
	var _grid = 'KIB_A', _form = _grid + '_FORM';
	new GridBuilder( _grid , {
        controller:'sekre/aset/kiba',
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
			{ header:'', renderer:'jenis' },
			{ header:'', renderer:'kode' },
			{ header:'', renderer:'reg' },
			{ header:'', renderer:'luas' },
			{ header:'', renderer:'th_pengadaan' },
			{ header:'', renderer:'letak' },
			{ header:'', renderer:'hak' },
			{ header:'', renderer:'tgl_sertifikat' },
			{ header:'', renderer:'no_sertifikat' },
			{ header:'', renderer:'penggunaan' },
			{ header:'', renderer:'asal_usul' },
			{ header:'', renderer:'harga' },
			{ header:'', renderer:'ket' }
    	],
		to_excel: false,
		resize_column: 3,
		extra_buttons: 	'<button title="IMPORT" onclick="import_excel()" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top"><i class="fa fa-upload"></i> IMPORT DATA</button>'+
						'<button title="CETAK" onclick="printData()" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top"><i class="fa fa-print"></i> CETAK</button>'+
						'<button title="Export Excel" onclick="KIB_A.ExportExcel()" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top"><i class="fa fa-file-excel-o"></i> EXPORT EXCEL</button>'
    });
	
    new FormBuilder( _form , {
	    controller:'sekre/aset/kiba',
	    fields: [
            { label:'Jenis Barang / Nama Barang', name:'jenis'},
            { label:'Nomor Kode Barang', name:'kode'},
			{ label:'Nomor Register', name:'reg'},
			{ label:'Luas', name:'luas'},
			{ label:'Tahun Pengadaan', name:'th_pengadaan'},
			{ label:'Letak / Alamat', name:'letak', type:'textarea'},
			{ label:'Hak', name:'hak'},
			{ label:'Tanggal Sertifikat', name:'tgl_sertifikat', type:'date'},
			{ label:'Nomor Sertifikat', name:'no_sertifikat'},
			{ label:'Penggunaan', name:'penggunaan'},
			{ label:'Asal Usul', name:'asal_usul'},
			{ label:'Harga', name:'harga'},
			{ label:'Keterangan', name:'ket', type:'textarea'}
	    ]
  	});
	

	function import_excel() {
		$.fancybox.open({
			src  : _BASE_URL + 'sekre/aset/kiba/import_excel_form',
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
               KIB_A.OnReload();  
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
	   newWin.document.write("<center><h1>DATA KIB A<br>TANAH</h1><p>Tahun "+tahun+"</p> </center>");
	   newWin.document.write(divToPrint.outerHTML);
	   newWin.document.write("<style> table {width:100%;border-collapse: collapse;} table, th, td {border: 1px solid black;} td.exclude_excel, th.exclude_excel{display:none;} </style>");
	   newWin.print();
	}
</script>
