<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('backend/grid_index');?>
<script type="text/javascript">
    DS.JenisKelamin = _H.StrToObject('{"L":"Laki-laki","P":"Perempuan"}');
	DS.GolRu = _H.StrToObject('{"":"-","I/a":"I/a","I/b":"I/b","I/c":"I/c","I/d":"I/d","II/a":"II/a","II/b":"II/b","II/c":"II/c","II/d":"II/d","III/a":"III/a","III/b":"III/b","III/c":"III/c","III/d":"III/d","IV/a":"IV/a","IV/b":"IV/b","IV/c":"IV/c","IV/d":"IV/d","IV/e":"IV/e"}');
	DS.Agama = _H.StrToObject('{"Islam":"Islam","Protestan":"Protestan","Katolik":"Katolik","Hindu":"Hindu","Budha":"Budha","Kong Hu Cu":"Kong Hu Cu"}');
	DS.Kelompok = _H.StrToObject('{"":"-","A":"A","B":"B"}');
	DS.KetGuru = _H.StrToObject('{"PNS":"PNS","GTY":"GTY","GTT":"GTT","INSENDA":"INSENDA","GURU KONTRAK":"GURU KONTRAK","GURU BANTU":"GURU BANTU"}');
	var _grid = 'DATA_GTK', _form = _grid + '_FORM';
	new GridBuilder( _grid , {
        controller:'sekolah/data_gtk',
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
			{
                header: '<i class="fa fa-pencil"></i>',
                renderer: function( row ) {
                    var is_leader = row.leader == 'true' ? '<button title="Pilih Penandatangan" onclick="set_leader('+row.id+')" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top"><i class="fa fa-check-square-o"></i></button>' : '<button title="Pilih Penandatangan" onclick="set_leader('+row.id+')" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top"><i class="fa fa-check-square-o"></i></button>';
					return is_leader;
                },
                exclude_excel: true,
                sorting: false
            },
			{
                header: '<center>NAMA GURU<br>NIP/NUPTK</center>',
                renderer: function( row ) {
                    var nip = row.nip == '' ? row.nuptk : row.nip;
					return '<center><span style="white-space: nowrap;">'+row.nama+'</span><br>'+nip+'</center>';
                },
                exclude_excel: true,
                sorting: false
            },
            { header:'<center>Tempat<br>Lahir</center>', renderer:'tmp_lahir' },
			{ 
				header: '<center>Tanggal<br>Lahir</center>', 
				renderer:function(row) {
				   return '<span style="white-space: nowrap;">'+row.tgl_lahir+'</span>';
				},
				sort_field:'tgl_lahir'
			 },
			{ header:'<center>L/P</center>', renderer:'jenis_kelamin' },
			{ header:'<center>Gol<br>Ruang</center>', renderer:'golru' },
			{ header:'<center>Jabatan</center>', renderer:'jab' },
			{ header:'<center>Ijazah<br>Terakhir</center>', renderer:'ijazah' },
			{ header:'<center>Agama</center>', renderer:'agama' },
			{ header:'<center>Tgl. Mulai Bekerja Di<br>Sekolah Ini</center>', renderer:'tmt' },
			{ header:'<center>Masa Kerja<br>Tahun</center>', renderer:'mk_tahun' },
			{ header:'<center>Masa Kerja<br>Bulan</center>', renderer:'mk_bulan' },
			{ header:'<center>Mengajar<br>Kelompok</center>', renderer:'mengajar_kel' },
			{ header:'<center>Keterangan<br>Guru</center>', renderer:'ket_guru' }
    	],
		to_excel: false,
		resize_column: 4
    });

    new FormBuilder( _form , {
	    controller:'sekolah/data_gtk',
	    fields: [
            { label:'Nama', name:'nama'},
            { label:'NIP', name:'nip'},
			{ label:'NUPTK', name:'nuptk'},
			{ label:'Tempat Lahir', name:'tmp_lahir'},
			{ label:'Tanggal Lahir', name:'tgl_lahir', type:'date'},
            { label:'Jenis Kelamin', name:'jenis_kelamin', type:'select', datasource:DS.JenisKelamin},
			{ label:'Golongan/Ruang', name:'golru', type:'select', datasource:DS.GolRu},
			{ label:'Jabatan', name:'jab'},
			{ label:'Ijazah Terakhir', name:'ijazah'},
			{ label:'Agama', name:'agama', type:'select', datasource:DS.Agama},
			{ label:'Tgl. Mulai Bekerja di Sekolah ini', name:'tmt', type:'date'},
			{ label:'Masa Kerja Tahun', name:'mk_tahun', type:'number'},
			{ label:'Masa Kerja Bulan', name:'mk_bulan', type:'number'},
			{ label:'Mengajar Kelompok', name:'mengajar_kel', type:'select', datasource:DS.Kelompok},
			{ label:'Keterangan Guru', name:'ket_guru', type:'select', datasource:DS.KetGuru}
	    ]
  	});
	

	function import_adminsekolah() {
		$.fancybox.open({
			src  : _BASE_URL + 'dinas/import_adminsekolah',
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
			afterClose: function () {
               USER_LIST.OnReload();  
            }
		});
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
