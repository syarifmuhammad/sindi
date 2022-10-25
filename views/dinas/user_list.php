<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('backend/grid_index');?>
<script type="text/javascript">
    var _grid = 'USER_LIST', _form = _grid + '_FORM', _form2 = _grid + '_FORM2';
	new GridBuilder( _grid , {
        controller:'dinas/user_list',
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
                    return A(_form2 + '.OnEdit(' + row.id + ')', 'Edit');
                },
                exclude_excel: true,
                sorting: false
            },    		
            { header:'Nama Sekolah', renderer:'user_full_name' },
			{ header:'Username', renderer:'user_name' }
    	],
		to_excel: false,
		resize_column: 3,
		extra_buttons: '<button title="IMPORT" onclick="import_adminsekolah()" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top"><i class="fa fa-upload"></i> IMPORT</button>'
    });

    new FormBuilder( _form , {
	    controller:'dinas/user_list',
	    fields: [
            { label:'Nama Sekolah', name:'user_full_name'},
            { label:'Username', name:'user_name'},
            { label:'Password', name:'user_password', type:'password' }
	    ]
  	});
	
	new FormBuilder( _form2 , {
	    controller:'dinas/user_list',
	    fields: [
            { label:'Nama Sekolah', name:'user_full_name'},
            { label:'Username', name:'user_name', disabled:'disabled'},
            { label:'Password', name:'user_password', type:'password' }
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
</script>
