<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('backend/grid_index');?>
<div id="isfancy"></div>
<script type="text/javascript">
    var _grid = 'LAPBUL1', _form = _grid + '_FORM';
	new GridBuilder( _grid , {
        controller:'sekolah/lapbul_form/form1/pagination/' + <?=$id;?>,
        fields: [
            {
                header: '<i class="fa fa-edit"></i>',
                renderer: function( row ) {
                    return A(_form + '.OnEdit(' + row.id + ')', 'Edit');
                },
                exclude_excel: true,
                sorting: false
            },
			{
                header: '<center>Rencana Penerimaan</center>',
                renderer: function( row ) {
                    return '<center>'+row.rencana+'</center>';
                },
                exclude_excel: true,
                sorting: false
            },
			{
                header: '<center>Calon yang mendaftar</center>',
                renderer: function( row ) {
                    return '<center>'+row.daftar+'</center>';
                },
                exclude_excel: true,
                sorting: false
            },
			{
                header: '<center>Murid yang diterima</center>',
                renderer: function( row ) {
                    return '<center>'+row.terima+'</center>';
                },
                exclude_excel: true,
                sorting: false
            }
    	],
		to_excel: false,
		can_add: false,
		can_delete: false,
		can_restore: false,
		no_number: true,
		can_search:false,
		resize_column: 1,
		per_page: 1
		//extra_buttons: '<button title="IMPORT" onclick="import_adminsekolah()" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top"><i class="fa fa-upload"></i> IMPORT</button>'
    });

    new FormBuilder( _form , {
	    controller:'sekolah/lapbul_form/form1',
	    fields: [
            { label:'Rencana Penerimaan', name:'rencana', type:'number' },
			{ label:'Calon yang mendaftar', name:'daftar', type:'number' },
			{ label:'Murid yang diterima', name:'terima', type:'number' }
	    ],
		extra_params: {id_index:<?=$id;?>}
  	});
	
	$("#search-icon").hide();
	$(".box-footer").hide();
</script>
