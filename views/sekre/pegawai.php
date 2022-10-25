<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('sekre/pegawai_grid');?>
<script type="text/javascript">
    DS.Agama    = _H.StrToObject('{"Islam":"Islam","Kristen":"Kristen","Kristen Protestan":"Kristen Protestan","Hindu":"Hindu","Budha":"Budha"}');
    DS.Kelamin  = _H.StrToObject('{"Perempuan":"Perempuan","Laki - Laki":"Laki - Laki"}');
    var _grid = 'PEGAWAI', _form = _grid + '_FORM';
	new GridBuilder( _grid , {
        controller:'sekre/pegawai',
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
			{ header:'<center>Pola Ruang RTRW</center>', renderer:'nama' },
			{ header:'<center>Luas (Ha)</center>', renderer:'nip' },
			{ header:'<center>Persentase (%)</center>', renderer:'tempat_lahir' },
			{ header:'<center>Persentase (%)</center>', renderer:'tanggal_lahir' },
			{ header:'<center>Persentase (%)</center>', renderer:'pangkat' },
			{ header:'<center>Persentase (%)</center>', renderer:'golongan' },
			{ header:'<center>Persentase (%)</center>', renderer:'tmt_gol' },
			{ header:'<center>Persentase (%)</center>', renderer:'jabatan' },
			{ header:'<center>Persentase (%)</center>', renderer:'tmt_jabatan' },
			{ header:'<center>Persentase (%)</center>', renderer:'kerja_tahun' },
			{ header:'<center>Persentase (%)</center>', renderer:'kerja_bulan' },
			{ header:'<center>Persentase (%)</center>', renderer:'pendidikan' },
			{ header:'<center>Persentase (%)</center>', renderer:'tahun_lulus' },
			{ header:'<center>Persentase (%)</center>', renderer:'sekolah' },
			{ header:'<center>Persentase (%)</center>', renderer:'lulus_sekolah' },
			{ header:'<center>Persentase (%)</center>', renderer:'usia_tahun' },
			{ header:'<center>Persentase (%)</center>', renderer:'usia_bulan' },
			{ header:'<center>Persentase (%)</center>', renderer:'jenis_kelamin' },
			{ header:'<center>Persentase (%)</center>', renderer:'agama' },
			{ header:'<center>Persentase (%)</center>', renderer:'tahun_pensiun' },
    	],
		to_excel: false,
		resize_column: 2,
		extra_buttons:
			'<button title="IMPORT" onclick="import_excel()" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top"><i class="fa fa-upload"></i> IMPORT DATA</button>'+
			'<button title="CETAK" onclick="printData()" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top"><i class="fa fa-print"></i> CETAK</button>'+
			'<button title="Export Excel" onclick="PEGAWAI.ExportExcel()" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top"><i class="fa fa-file-excel-o"></i> EXPORT EXCEL</button>'
    });
	// $(".thead").hide();

    new FormBuilder( _form , {
	    controller:'sekre/pegawai',
	    fields: [
            { label:'Nama Lengkap', name:'nama'},
            { label:'NIP', name:'nip'},
			{ label:'Tempat Lahir', name:'tempat_lahir'},
			{ label:'Tanggal Lahir', name:'tanggal_lahir'},
			{ label:'Pangkat', name:'pangkat'},
			{ label:'Gol. Ruang', name:'golongan'},
			{ label:'TMT Gol. Ruang', name:'tmt_gol'},
			{ label:'Jabatan', name:'jabatan'},
			{ label:'TMT Jabatan', name:'tmt_jabatan'},
			{ label:'Masa Kerja Tahun', name:'kerja_tahun'},
			{ label:'Masa Kerja Bulan', name:'kerja_bulan'},
			{ label:'Nama Pendidikan', name:'pendidikan'},
			{ label:'Tahun Lulus Pendidikan', name:'tahun_lulus'},
			{ label:'Nama Sekolah', name:'sekolah'},
			{ label:'Tahun Lulus Sekolah', name:'lulus_sekolah'},
			{ label:'Usia Tahun', name:'usia_tahun'},
			{ label:'Usia Bulan', name:'usia_bulan'},
			{ label:'Jenis Kelamin', name:'jenis_kelamin', type:'select', datasource:DS.Kelamin},
            { label:'Agama', name:'agama', type:'select', datasource:DS.Agama},
			{ label:'Tahun Pensiun', name:'tahun_pensiun'},
	    ]
  	});
	

	function import_excel() {
		$.fancybox.open({
			src  : _BASE_URL + 'sekre/import_pegawai',
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
               PEGAWAI.OnReload();  
            }
		});
    }
	
	function printData()
	{
	   var divToPrint=document.getElementById("printTable");
	   var tahun = "<?=$this->session->tahun;?>";
	   newWin= window.open("");
	   newWin.document.write("<center><h1>DATA KEPEGAWAIAN</h1><p>Tahun "+tahun+"</p> </center>");
	   newWin.document.write(divToPrint.outerHTML);
	   newWin.document.write("<style> table {width:100%;border-collapse: collapse; text-align: center} table, th, td {border: 1px solid black;} td.exclude_excel, th.exclude_excel{display:none;} </style>");
	   newWin.print();
	   newWin.close();
	}
	
	function set_leader(id) {
		var values = {
			id : id					
		}
		$.post(_BASE_URL + 'sekolah/data_gtk/set_leader', values, function(response) {
			var res = _H.StrToObject( response );
			if (res.status == 'error') {
				_H.Notify(res.status, _H.Message(res.message));
			}
			if (res.status == 'success') {
				_H.Notify(res.status, _H.Message(res.message));
				DATA_GTK.OnReload();
			}
		});
	}
</script>