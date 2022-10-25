<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('backend/grid_index');?>
<script type="text/javascript">
   var _grid = 'MODULES', _form = _grid + '_FORM';
   new GridBuilder( _grid , {
      controller:'users/modules',
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
         { header:'Modul', renderer:'module_name' },
         { header:'URL', renderer:'module_url' },
		 { header:'Keterangan', renderer:'module_description' }
      ],
      to_excel: false,
	  resize_column:3,
	  extra_buttons: '<button title="Daftar Modul Non Aktif" onclick="window.location.href=\''+ _BASE_URL +'users/modulesr\'" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top"><i class="fa fa-recycle"></i></button>'
   });

   new FormBuilder( _form , {
      controller:'users/modules',
      fields: [
         { label:'Modul', name:'module_name' },
         { label:'URL', name:'module_url' },
		 { label:'Keterangan', name:'module_description' }
      ]
   });
</script>
