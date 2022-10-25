<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('backend/grid_index');?>
<script type="text/javascript">
    DS.Bulan = _H.StrToObject('<?=$bulan;?>');
	DS.TahunAjaran = _H.StrToObject('<?=$tahun_ajaran;?>');
	function nm_bulan(x) {
		var bln = '';
		switch(x){
			case "1":
			bln = 'Januari';
			break;
			case "2":
			bln = 'Februari';
			break;
			case "3":
			bln = 'Maret';
			break;
			case "4":
			bln = 'April';
			break;
			case "5":
			bln = 'Mei';
			break;
			case "6":
			bln = 'Juni';
			break;
			case "7":
			bln = 'Juli';
			break;
			case "8":
			bln = 'Agustus';
			break;
			case "9":
			bln = 'September';
			break;
			case "10":
			bln = 'Oktober';
			break;
			case "11":
			bln = 'November';
			break;
			case "12":
			bln = 'Desember';
			break;
		}
			return bln;
	}
	
	var _grid = 'LAPBUL_CREATE', _form = _grid + '_FORM';
	var _form_upload = _grid + '_FORM_UPLOAD';
	new GridBuilder( _grid , {
        controller:'sekolah/lapbul_create',
        fields: [
            {
                header: '<i class="fa fa-edit"></i>',
                renderer: function( row ) {
                    var edit = row.status && row.status == 0 ? A(_form + '.OnEdit(' + row.id + ')', 'Edit') : '';
					return edit;
                },
                exclude_excel: true,
                sorting: false
            },
			{
                header: 'Bulan',
                renderer: function( row ) {
                    return nm_bulan(row.bulan);
                },
                exclude_excel: true,
                sorting: false
            },
			{
                header: '',
                renderer: function( row ) {
                    var status = parseInt(row.status);
					var variasi_buat = status == 0 ? 'warning' : 'success';
					var variasi_cetak = status == 1 ? 'warning' : 'success';
					var btn1 = ' <button onclick="form_lapbul('+row.id+')" class="btn btn-'+variasi_buat+' btn-xs"><i class="fa fa-edit"></i> Buat</button>';
					var btn2 = ' <button onclick="cetak_lapbul('+row.id+')" class="btn btn-'+variasi_cetak+' btn-xs"><i class="fa fa-print"></i> Cetak</button>';
					var xtombol = status > 0 ? btn1+btn2 : btn1;
					return xtombol;
                },
                exclude_excel: true,
                sorting: false
            },
			{
                header: '',
                renderer: function( row ) {
                    var status = parseInt(row.status);
					var tombol = status == 1 ? '<button title="Upload file yang telah dibubuhi tanda tangan" onclick="LAPBUL_CREATE_FORM_UPLOAD.OnUpload('+row.id+')" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top"><i class="fa fa-upload"></i> Upload</button>' : ( status >= 2 ? '<button title="Tampilkan file yang telah diupload" onclick="preview('+row.id+')" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top"><i class="fa fa-search"></i> Preview</button>' : '');
					return tombol;
                },
                exclude_excel: true,
                sorting: false
            },
			{
                header: '',
                renderer: function( row ) {
                    var btn1 = '<button onclick="xfinal('+row.id+')" class="btn btn-warning btn-xs"><i class="fa fa-check"></i> Selesai</button>';
					var btn2 = '<button onclick="send('+row.id+')" class="btn btn-warning btn-xs"><i class="fa fa-send"></i> Kirim</button>';
					var btn3 = '<button class="btn btn-success btn-xs" disabled><i class="fa fa-check"></i> Terkirim</button>';
					var btn4 = '<button class="btn btn-success btn-xs" disabled><i class="fa fa-check"></i> Terverifikasi</button>';
					var btn = row.status && row.status == 2 ? btn1 : ( row.status == 3 ? btn2 : ( row.status == 4 ? btn3 : ( row.status == 5 ? btn4 : '')));
					return btn;
                },
                exclude_excel: true,
                sorting: false
            }
    	],
		to_excel: false,
		can_delete: false,
		can_restore: false,
		no_number: true,
		can_search:false,
		resize_column: 2,
		per_page: 12
	});

    new FormBuilder( _form , {
	    controller:'sekolah/lapbul_create',
	    fields: [
            { label:'Bulan', name:'bulan', type:'select', datasource:DS.Bulan }
	    ]
  	});
	
	new FormBuilder( _form_upload , {
        controller:'sekolah/lapbul_create',
        fields: [
            { label:'Lapbul', name:'file' }
        ]
    });
	
	function form_lapbul(id) {
		$.fancybox.open({
			src  : _BASE_URL + 'sekolah/form_lapbul/buat/'+id,
			type : 'iframe',
			toolbar : false,
			smallBtn : true,
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
               LAPBUL_CREATE.OnReload();  
            }
		});
    }
	
	function cetak_lapbul(id) {
		eModal.confirm('<div class="box-body form-fields"><div class="form-group"><label class="col-sm-4 control-label" for="tanggal">Tanggal Cetak</label><div class="col-sm-8"><div class="input-group date"><input type="text" class="form-control input-sm date" id="tanggal" name="tanggal" placeholder=""><div class="input-group-addon input-sm" ><i class="fa fa-calendar"></i></div></div></div></div></div>', 'Cetak Laporan Bulanan').then(function() {
		_H.Loading( true );
		var tanggal = $("#tanggal").val();
		if(tanggal==''){
			_H.Loading( false );
			_H.Notify('error', _H.Message('Tanggal tidak boleh kosong !'));
		} else {
		$.post(_BASE_URL + 'sekolah/lapbul_create/cetak_lapbul', {'tanggal':tanggal, 'id':id}, function(response) {
			_H.Loading( false );
			var res = _H.StrToObject( response );
			if (res.status == 'success') {
				$.fancybox.open({
					src  : _BASE_URL + 'public/pdf_viewer/view_pdf/' + res.folder + '/' + res.file_name,
					type : 'iframe',
					toolbar : false,
					smallBtn : true,
					iframe : {
						css : {
							width : $(window).width() - 88 + 'px',
							height : $(window).height() - 88 + 'px',
							'max-width' : '100%',
							'max-height' : '100%'
						}
					}
				});
			}
		}).fail(function(xhr) {
			console.log(xhr);
		});
		}
		});
	}
	
	$("#search-icon").hide();
	$(".box-footer").hide();
	
	function preview( id ) {
		_H.Loading( true );
		$.post(_BASE_URL + 'sekolah/lapbul_create/preview', {'id':id}, function(response) {
			_H.Loading( false );
			var res = _H.StrToObject( response );
			if (res.status == 'success') {
				$.fancybox.open({
					src  : _BASE_URL + 'public/pdf_viewer/view_pdf/' + res.folder + '/' + res.file_name,
					type : 'iframe',
					toolbar : false,
					smallBtn : true,
					iframe : {
						css : {
							width : $(window).width() - 88 + 'px',
							height : $(window).height() - 88 + 'px',
							'max-width' : '100%',
							'max-height' : '100%'
						}
					}
				});
			}
		}).fail(function(xhr) {
			console.log(xhr);
		});
	}
	
	function xfinal(id) {
		var values = {
			id : id					
		}
		$.post(_BASE_URL + 'sekolah/lapbul_create/xfinal', values, function(response) {
			var res = _H.StrToObject( response );
			if (res.status == 'error') {
				_H.Notify(res.status, _H.Message(res.message));
			}
			if (res.status == 'success') {
				_H.Notify(res.status, _H.Message(res.message));
				LAPBUL_CREATE.OnReload();
			}
		});
	}
	
	function send(id) {
		var values = {
			id : id					
		}
		$.post(_BASE_URL + 'sekolah/lapbul_create/send', values, function(response) {
			var res = _H.StrToObject( response );
			if (res.status == 'error') {
				_H.Notify(res.status, _H.Message(res.message));
			}
			if (res.status == 'success') {
				_H.Notify(res.status, _H.Message(res.message));
				LAPBUL_CREATE.OnReload();
			}
		});
	}
	
	$(window).on('shown.bs.modal', function() { 
		$('#tanggal').datetimepicker({format: 'yyyy-mm-dd',weekStart: 1,todayBtn:  1,autoclose: 1,todayHighlight: 1,startView: 2,minView: 2,forceParse: 0}).on('hide', function(e) {e.stopPropagation();});
	});
</script>
