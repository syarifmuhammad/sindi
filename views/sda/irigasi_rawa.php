<?php defined('BASEPATH') OR exit('No direct script access allowed');
// $this->load->view('backend/grid_index');?>
<section class="content-header">
   <div class="row">
      <div class="col-xs-12">
         <h3 style="margin:0;"><i class="fa fa-sign-out text-green"></i> <span class="table-header"><?=isset($title) ? $title : ''?></span>
            <?=isset($sub_title) ? '<br><small style="margin-left:29px;">'.$sub_title.'</small>' : ''?>
         </h3>
      </div>
   </div>
</section>
<section class="content irigasi">
	<!-- <a href="javascript:;" onclick="import_data();" class="btn btn-primary">Import Data</a> -->
	<div class="box">
		<div class="box-body">
			<table id="table_id" class="table table-hover table-bordered table-striped table-condensed">
				<thead id="thead">
					<tr>
						<th rowspan="2">No</th>
						<th class="hidden-print" rowspan="2"><center>Action</center></th>
						<th rowspan="2">Nama Daerah Irigasi</th>
						<th rowspan="2">Jenis Daerah Irigasi</th>
						<th colspan="4" style="text-align:center;">Luas Areal (Ha)</th>
						<?php foreach($jaringan_irigasi as $data){ ?>
							<th colspan="<?=count($data->jaringan_irigasi)?>"><?=$data->jenis?></th>
						<?php } ?>
					</tr>
					<tr>
						<th>Berdasarkan Permen 14/2015</th>
						<th>Baku (Pemetaan IGT)</th>
						<th>Potensial (Pemetaan IGT)</th>
						<th>Sawah/ Fungsional (Pemetaan IGT)</th>
						<?php foreach($jaringan_irigasi as $data){ ?>
							<?php foreach($data->jaringan_irigasi as $jaringan){ ?>
								<?php 
								    $satuan = "";
									switch ($jaringan->satuan) {
										case "buah":
										  $satuan = "Bh";
										  break;
										case "kilometer":
										  $satuan = "Km";
										  break;
										case "meter":
										  $satuan = "M";
										  break;
										case "0/1":
											$satuan = "Ada/Tidak Ada";
											break;
									}	
								?>
								<th><?=$jaringan->nama. " (".$satuan.")"?></th>
							<?php } ?>
						<?php } ?>
					</tr>
				</thead>
				<tbody id="tbody"></tbody>
			</table>
		</div>
	</div>
   <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
  Launch demo modal
</button> -->

<!-- Modal -->
</section>

<script type="text/javascript">
	var col = new Array(43)
	for(var i=0; i<col.length; i++){
		col[i] = i;
	}
	// $('#modal-form').modal('show')
	$(document).ready( function () {
		var column = [
				{ "data":"index" },
				{ "render": function ( data, type, row ) { // Tampilkan kolom aksi
                        var html  = "<a href='<?=base_url('sda/irigasi_rawa/edit/')?>"+row.id+"' title='Edit'><i class='fa fa-edit' style='margin-right:20px; cursor:pointer; font-size:20px;'></i></a>"
						html += "<a onclick='delete_data("+row.id+")' title='Delete'><i class='fa fa-trash text-danger' style='cursor:pointer; font-size:20px;'></i></a>"
                        return html
                    }
                },
                { "data": "nomenklatur" },
                { "data": "jenis_daerah" },
                { 
					"data" : "luas",
					"render": function ( data, type, row ) {
						var html = ""
                        html += data + ' Ha'
                        return html; 
                    }
                },
                { 
					"data" : "baku",
					"render": function ( data, type, row ) {
						var html = ""
                        html += data + ' Ha'
                        return html; 
                    }
                },
                { 
					"data" : "potensial",
					"render": function ( data, type, row ) {
						var html = ""
                        html += data + ' Ha'
                        return html; 
                    }
                },
                { 
					"data" : "fungsional",
					"render": function ( data, type, row ) {
						var html = ""
                        html += data + ' Ha'
                        return html; 
                    }
                }
            ];
			var jumlah = [
				[1,2,3,4,5],[1,2,3,4],[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17],[1,2,3,4,5,6,7],[1,2,3]
			]
			for(var i=0; i<jumlah.length; i++){
				for(var j=0; j< jumlah[i].length; j++){
					if(i<4){
						column.push({data:'jaringan_irigasi.'+i+".jaringan_irigasi."+j+".jumlah"})
					}else{
						column.push({
							data:'jaringan_irigasi.'+i+".jaringan_irigasi."+j+".jumlah",
							render:function(data, type, row){
								var html = ""
								html += data==0 ? "Tidak Ada" : "Ada"
								return html; 
							}
						})
					}
					
				}
			}
		$('#table_id').DataTable({
			scrollX: true,
			processing: true,
			serverSide: true,
			dom: 'Bfrtip',
			buttons:{
				dom: {
					container: {
						tag: 'div',
						className:'btn-group'
					}
				},
				buttons: [
					{
						text: "<i class='fa fa-upload'></i> IMPORT DATA",
						action: function(){
							import_data()
						},
						className: "btn btn-warning btn-sm",
						init: function(api, node, config) {
							$(node).removeClass('dt-button')
						}
					},
					{
						text: '<i class="fa fa-print"></i> PDF',
						action: function () {
							var table = document.createElement('table')
							table.setAttribute('border', 1)
							var thead = document.getElementById('thead').cloneNode(true)
							var tbody = document.getElementById('tbody').cloneNode(true)
							table.appendChild(thead)
							table.appendChild(tbody)
							var c = table
							c.firstElementChild.firstElementChild.children[1].remove()
							var l = c.lastElementChild
							for(var i=0; i<l.children.length; i++){
								l.children[i].children[1].remove()
							}
							var tahun = "<?=$this->session->tahun;?>";
							newWin= window.open("");
							newWin.document.write("<center><h1>DATA IRGASI DAN RAWA </h1><p>Tahun "+tahun+"</p> </center>");
							newWin.document.write(table.outerHTML);
							newWin.document.write("<style> table {width:100%;border-collapse: collapse; text-align: center} table, th, td {border: 1px solid black;} td.exclude_excel, th.exclude_excel{display:none;} </style>");
							newWin.print();
							newWin.close();
						},
						className: "btn btn-danger btn-sm",
						init: function(api, node, config) {
							$(node).removeClass('dt-button')
						}
					},
					{
						text: '<i class="fa fa-file-excel-o"></i> Export Excel',
						action: function () {
							var table = document.createElement('table')
							table.setAttribute('border', 1)
							var thead = document.getElementById('thead').cloneNode(true)
							var tbody = document.getElementById('tbody').cloneNode(true)
							table.appendChild(thead)
							table.appendChild(tbody)
							var c = table
							c.firstElementChild.firstElementChild.children[1].remove()
							var l = c.lastElementChild
							for(var i=0; i<l.children.length; i++){
								l.children[i].children[1].remove()
							}
							window.open('data:application/vnd.ms-excel,' + encodeURIComponent(table.outerHTML));
						},
						className: "btn btn-info btn-sm",
						init: function(api, node, config) {
							$(node).removeClass('dt-button')
						}
					},
					{
						text: '<i class="fa fa-plus"></i>',
						action: function () {
							window.location.href = "<?=base_url('sda/irigasi_rawa/insert')?>"
						},
						className: "btn btn-success btn-sm add",
						init: function(api, node, config) {
							$(node).removeClass('dt-button')
						}
					}
				],
			},
			ajax: {
                "url": "<?php echo base_url('sda/irigasi_rawa/pagination') ?>", // URL file untuk proses select datanya
                "type": "POST"
            },
			columns:column
		});
	} );
	
	function import_data() {
		$.fancybox.open({
			src  : _BASE_URL + 'sda/irigasi_rawa/import',
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
			afterClose: function () {
               $('#table_id').DataTable().ajax.reload();
            }
		});
    }

	function delete_data(id) {
		var field = {id:id}
		_H.Loading( true );
		$.post(_BASE_URL + 'sda/irigasi_rawa/deleted', field, function(response) {
			_H.Loading( false );
			var res = _H.StrToObject( response );
			if (res.status == 'success') {
				_H.Notify(res.status, _H.Message(res.message));
				$('#table_id').DataTable().ajax.reload(null, false);
			} else {
				_H.Notify(res.status, _H.Message(res.message));
			}
		});
	}
	
</script>
