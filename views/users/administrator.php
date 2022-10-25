<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('backend/grid_index');?>
<script type="text/javascript">
    DS.UserGroups = _H.StrToObject('<?=$user_group_dropdown;?>');
    var _grid = 'USERS', _form = _grid + '_FORM';
	new GridBuilder( _grid , {
        controller:'users/administrator',
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
    		{ header:'Username', renderer:'user_name' },
            { header:'Nama', renderer:'user_full_name' },
            { header:'Group', renderer:'user_group' }
    	],
		to_excel: false,
		resize_column: 2
    });

    new FormBuilder( _form , {
	    controller:'users/administrator',
	    fields: [
            { label:'Nama Lengkap', name:'user_full_name'},
            { label:'Username', name:'user_name'},
            { label:'Password', name:'user_password', type:'password' },
			{ label:'Group', name:'user_group_id', type:'select', datasource:DS.UserGroups }
	    ]
		//extra_params: { user: 'user_name' }
  	});
</script>
