<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('bgjk/grid_bangunan_gedung');?>
<script type="text/javascript">
    DS.Kompleksitas = _H.StrToObject('{"":"Pilih","BG Sederhana":"BG Sederhana","BG Tidak Sederhana":"BG Tidak Sederhana","BG Khusus":"BG Khusus"}');
    DS.Permanensi = _H.StrToObject('{"":"Pilih","Permanen":"Permanen","NonPermanen":"NonPermanen"}');
    DS.TingkatRisiko = _H.StrToObject('{"":"Pilih","Tinggi":"Tinggi","Sedang":"Sedang","Rendah":"Rendah"}');
    DS.TingkatKepadatan = _H.StrToObject('{"":"Pilih","Padat":"Padat","Sedang":"Sedang","Renggang":"Renggang"}');
    DS.Kepemilikan = _H.StrToObject('{"":"Pilih","BG Negara":"BG Negara","BG NonNegara":"BG NonNegara"}');
    DS.Kondisi = _H.StrToObject('{"":"Pilih","B":"B","RR":"RR","RS":"RS","RB":"RB"}');
	var _grid = 'BANGUNAN_GEDUNG', _form = _grid + '_FORM';
	new GridBuilder( _grid , {
        controller:'bgjk/bangunan_gedung',
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
			{ header:'', renderer:'lokasi_jalan' },
			{ header:'', renderer:'lokasi_desa' },
			{ header:'', renderer:'lokasi_kecamatan' },
			{ header:'', renderer:'koor_x' },
			{ header:'', renderer:'koor_y' },
			{ header:'', renderer:'fungsi' },
			{ header:'', renderer:'klas_kompleksitas' },
			{ header:'', renderer:'klas_permanensi' },
			{ header:'', renderer:'klas_tingkat_risiko' },
			{ header:'', renderer:'klas_tingkat_kepadatan' },
			{ header:'', renderer:'klas_kepemilikan' },
			{ header:'', renderer:'jumlah_lantai' },
			{ header:'', renderer:'luas_lantai' },
			{ header:'', renderer:'luas_tanah' },
			{ header:'', renderer:'imb_no' },
			{ header:'', renderer:'imb_tgl' },
			{ header:'', renderer:'imb_penerbit' },
			{ header:'', renderer:'slf_no' },
			{ header:'', renderer:'slf_tgl' },
			{ header:'', renderer:'slf_penerbit' },
			{ header:'', renderer:'kondisi' },
			{ header:'', renderer:'pemilik' }
    	],
		to_excel: false,
		resize_column: 3,
		extra_buttons: '<button title="IMPORT" onclick="import_excel()" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top"><i class="fa fa-upload"></i> IMPORT DATA</button> <button title="CETAK" onclick="printData()" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top"><i class="fa fa-print"></i> CETAK</button><button title="Export Excel" onclick="BANGUNAN_GEDUNG.ExportExcel()" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top"><i class="fa fa-file-excel-o"></i> EXPORT EXCEL</button>'
    });
	// console.log(SANITASI.options.fields.length);
    new FormBuilder( _form , {
	    controller:'bgjk/bangunan_gedung',
	    fields: [
            { label:'Nama Bangunan Gedung', name:'nama'},
            { label:'Jalan', name:'lokasi_jalan'},
			{ label:'Desa', name:'lokasi_desa'},
			{ label:'Kecamatan', name:'lokasi_kecamatan'},
			{ label:'Koordinat (X)', name:'koor_x'},
			{ label:'Koordinat (Y)', name:'koor_y'},
			{ label:'Fungsi', name:'fungsi'},
			{ label:'Kompleksitas', name:'klas_kompleksitas', type:'select', datasource:DS.Kompleksitas},
			{ label:'Permanensi', name:'klas_permanensi', type:'select', datasource:DS.Permanensi},
			{ label:'Tingkat Risiko thd Bahaya Kebakaran', name:'klas_tingkat_risiko', type:'select', datasource:DS.TingkatRisiko},
			{ label:'Tingkat Kepadatan Lokasi BG', name:'klas_tingkat_kepadatan', type:'select', datasource:DS.TingkatKepadatan},
			{ label:'Kepemilikan', name:'klas_kepemilikan', type:'select', datasource:DS.Kepemilikan},
			{ label:'Jumlah Lantai', name:'jumlah_lantai'},
			{ label:'Luas Lantai (m2)', name:'luas_lantai'},
			{ label:'Luas Tanah (m2)', name:'luas_tanah'},
			{ label:'Nomor IMB/PBG', name:'imb_no'},
			{ label:'Tanggal IMB/PBG', name:'imb_tgl', type:'date'},
			{ label:'Penerbit IMB/PBG', name:'imb_penerbit'},
			{ label:'Nomor SLF', name:'slf_no'},
			{ label:'Tanggal SLF', name:'slf_tgl', type:'date'},
			{ label:'Penerbit SLF', name:'slf_penerbit'},
			{ label:'Kondisi', name:'kondisi', type:'select', datasource:DS.Kondisi},
			{ label:'Pemilik', name:'pemilik'}
	    ]
  	});
	

	function import_excel() {
		$.fancybox.open({
			src  : _BASE_URL + 'bgjk/bangunan_gedung/import_excel_form',
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
               BANGUNAN_GEDUNG.OnReload();  
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
	   newWin.document.write("<center><h1>DATA INFRASTRUKTUR BANGUNAN GEDUNG</h1><p>Tahun "+tahun+"</p> </center>");
	   newWin.document.write(divToPrint.outerHTML);
	   newWin.document.write("<style> table {width:100%;border-collapse: collapse;} table, th, td {border: 1px solid black;} td.exclude_excel, th.exclude_excel{display:none;} </style>");
	   newWin.print();	   
	   // newWin.onafterprint=function(){ console.log('finish'); newWin.close();}
	}
</script>
