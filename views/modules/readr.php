<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('backend/grid_index');?>
<script type="text/javascript">
   var _grid = 'MODULESR', _form = _grid + '_FORM';
   new GridBuilder( _grid , {
      controller:'users/modulesr',
      fields: [
         {
         header: '<input type="checkbox" class="check-all">',
         renderer: function( row ) {
            return CHECKBOX(row.id, 'id');
         },
         exclude_excel: true,
         sorting: false
		 },
		 { header:'Modul', renderer:'module_name' },
         { header:'URL', renderer:'module_url' },
		 { header:'Keterangan', renderer:'module_description' }
      ],
      can_add:false,
	  can_delete:false,
	  to_excel:false,
	  resize_column:2,
	  extra_buttons: '<button title="Kembali ke daftar modul" onclick="window.location.href=\''+ _BASE_URL +'users/modules\'" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top"><i class="fa fa-backward"></i></button>'
   });

   new FormBuilder( _form , {
      controller:'users/modulesr',
      fields: [
         { label:'Modul', name:'module_name' },
         { label:'URL', name:'module_url' },
		 { label:'Keterangan', name:'module_description' }
      ]
   });
</script>
