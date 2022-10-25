<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('backend/grid_index');?>
<script type="text/javascript">
    var _grid = 'SP_PROFIL',
        _form1 = _grid + '_FORM1',
        _form2 = _grid + '_FORM2',
        _form3 = _grid + '_FORM3',
		_form4 = _grid + '_FORM4',
		_form5 = _grid + '_FORM5';

	new GridBuilder( _grid , {
        controller:'sekolah/profil',
        fields: [
            { header:'Description', renderer: 'sp_description' },
            {
                header:'Value',
                renderer: function(row){
                    return row.sp_value ? row.sp_value : '';
                },
                sort_field:'sp_value'
            },
			{
                header: '<i class="fa fa-edit"></i>',
                renderer: function( row ) {
                    if (row.sp_variable == 'sp_nama') {
                        return A(_form1 + '.OnEdit(' + row.id + ')');
                    }
					if (row.sp_variable == 'sp_alamat') {
                        return A(_form2 + '.OnEdit(' + row.id + ')');
                    }
                    if (row.sp_variable == 'sp_kec') {
                        return A(_form3 + '.OnEdit(' + row.id + ')');
                    }
					if (row.sp_variable == 'sp_kab') {
                        return A(_form4 + '.OnEdit(' + row.id + ')');
                    }
					if (row.sp_variable == 'sp_prov') {
                        return A(_form5 + '.OnEdit(' + row.id + ')');
                    }
                },
                exclude_excel: true,
                sorting: false
            }
    	],
        can_add: false,
        can_delete: false,
		no_number: true,
		can_search:false,
        can_restore: false,
		to_excel:false,
        resize_column: 1
    });

    new FormBuilder( _form1 , {
        controller:'sekolah/profil',
        fields: [
            { label:'Nama Satuan Pendidikan', name:'sp_value' }
        ]
    });
	
	new FormBuilder( _form2 , {
        controller:'sekolah/profil',
        fields: [
            { label:'Alamat', name:'sp_value', type:'textarea' }
        ]
    });


    new FormBuilder( _form3 , {
        controller:'sekolah/profil',
        fields: [
            { label:'Kecamatan', name:'sp_value' }
        ]
    });
	
	new FormBuilder( _form4 , {
        controller:'sekolah/profil',
        fields: [
            { label:'Kabupaten', name:'sp_value' }
        ]
    });
	
	new FormBuilder( _form5 , {
        controller:'sekolah/profil',
        fields: [
            { label:'Provinsi', name:'sp_value' }
        ]
    });
	$("#search-icon").hide();
	$(".box-footer").hide();
	$("thead").hide();
</script>
