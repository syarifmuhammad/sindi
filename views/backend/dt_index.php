<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<link href="<?=base_url();?>assets/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url();?>assets/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<script src="<?=base_url();?>assets/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?=base_url();?>assets/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<section class="content-header">
   <div class="row">
      <div class="col-xs-12">
         <h3 style="margin:0;"><i class="fa fa-sign-out text-green"></i> <span class="table-header" id="title"><?=isset($title) ? $title : ''?></span>
            <?=isset($sub_title) ? '<br><small style="margin-left:29px;" id="sub_title">'.$sub_title.'</small>' : '<br><small style="margin-left:29px;" id="sub_title">'.$this->session->game_server_name.'</small>'?>
         </h3>
      </div>
   </div>
</section>
<section class="content">
   <div class="box">
      <div class="box-body">         
         <table id="table" class="table table-striped table-bordered table-hover order-column" style="width:100%">
            <thead class="thead">
               <tr>
				<th style="width:10px;">#</th>
				<?	
					foreach ($colname as $col){
						echo '<th>'.$col.'</th>';
					}			
				?>
				</tr>
			   <tr>
               <th style="width:10px;"></th>
			   <?	
					foreach ($colname as $col){
						echo '<th class="select-filter"><select class="form-control input-sm input-xsmall input-inline"><option value=""></option></select></th>';
					}			
				?>
               </tr>
            </thead>
            <tbody class="tbody"></tbody>
         </table>
      </div>      
   </div>
</section>
<script type="text/javascript">
	$(document).ready(function() {
		var table = $('#table').DataTable({ 
            "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
            "pageLength": <?=$length;?>,
            "sort": false,
            "responsive": true,
            "ajax": {
               "dataSrc": function(json) {
							  if(json.status=='success'){
								return json.data;
							  } else {
								  _H.Notify(json.status, _H.Message(json.message));
								  return json.data;
							  }
						}
            },
			"language": {
               "search": '<i class="fa fa-search" aria-hidden="true"></i>',
               "searchPlaceholder": 'Search',
               "lengthMenu": "_MENU_"
            },
            "columnDefs": [{"targets": 0,"searchable": false,"orderable": false}],
			initComplete: function () {
				this.api().columns('.select-filter').every( function () {
					var column = this;
					var select = $('<select class="form-control input-sm input-xsmall input-inline"><option value=""></option></select>')
						.appendTo( $(column.header()).empty())
						.on( 'change', function () {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
							);
	 
							column
								.search( val ? '^'+val+'$' : '', true, false )
								.draw();
						} );
	 
					column.data().unique().sort().each( function ( d, j ) {
						select.append( '<option value="'+d+'">'+d+'</option>' )
					} );
				});
			}
		});
		
		table.on( 'draw.dt', function () {
		var PageInfo = $('#table').DataTable().page.info();
			 table.column(0, { page: 'current' }).nodes().each( function (cell, i) {
				cell.innerHTML = i + 1 + PageInfo.start;
			});
		});
		
		

	});
</script>
