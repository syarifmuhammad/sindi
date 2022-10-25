<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('backend/grid_index');?>
<script type="text/javascript">
    var _grid = 'AIR_MINUM', _form = _grid + '_FORM';
	new GridBuilder( _grid , {
        controller:'ampl/air_minum',
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
			{ header:'<center>Kecamatan</center>', renderer:'kec' },
			{ header:'<center>Desa</center>', renderer:'desa' }
    	],
		to_excel: false,
		resize_column: 2
    });

    new FormBuilder( _form , {
	    controller:'ampl/air_minum',
	    fields: [
            { label:'Kecamatan', name:'kec'},
            { label:'Desa', name:'desa'},
			{ label:'Jumlah Penduduk Perdesaan', name:'jp_pedesaan'},
			{ label:'Jumlah Penduduk Perkotaan', name:'jp_perkotaan'}
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
