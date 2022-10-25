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
   <div class="box">
      <div class="box-body">
		<table id="table_embung" class="table table-hover table-bordered table-striped table-condensed">
			<thead id="thead">
				<tr>
					<th rowspan="2">No</th>
					<th class="hidden-print" rowspan="2"><center>Action</center></th>
					<th rowspan="2">Nama Bangunan</th>
					<th rowspan="2">Wilayah Sungai</th>
					<th rowspan="2">DAS</th>
					<th rowspan="2">Sungai</th>
					<th rowspan="2">Kab/Kec</th>
					<th colspan="2">Koordinat</th>
					<th rowspan="2">Luas Genangan Muka Air Normal (Ha)</th>
					<th rowspan="2">Air Baku (M3/dt)</th>
					<th rowspan="2">Irigasi (Ha)</th>
					<th rowspan="2">Reduksi Banjir (M3/dt)</th>
					<th rowspan="2">Tahun Dibangun</th>
					<th rowspan="2">Pengelola</th>
					<th rowspan="2">Keterangan</th>
				</tr>
				<tr>
					<th>X</th>
					<th>Y</th>
				</tr>
			</thead>
			<tbody id="tbody"></tbody>
		</table>
      </div>
   </div>
</section>
<script type="text/javascript">
	// $('#modal-form').modal('show')
	$(document).ready( function () {
		$('#table_embung').DataTable({
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
							newWin.document.write("<center><h1>DATA EMBUNG & PAL </h1><p>Tahun "+tahun+"</p> </center>");
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
							tambah_data()
						},
						className: "btn btn-success btn-sm add",
						init: function(api, node, config) {
							$(node).removeClass('dt-button')
						}
					}
				],
			},
			ajax: {
                "url": "<?php echo base_url('sda/embung_pal/pagination') ?>", // URL file untuk proses select datanya
                "type": "POST"
            },
			"columns": [
				{ "data": "index" },
				{ "render": function ( data, type, row ) { // Tampilkan kolom aksi
					var html  = "<a onclick='edit_data("+row.id+")' title='Edit'><i class='fa fa-edit' style='margin-right:20px; cursor:pointer; font-size:20px;'></i></a>"
					html += "<a onclick='delete_data("+row.id+")' title='Delete'><i class='fa fa-trash text-danger' style='cursor:pointer; font-size:20px;'></i></a>"
					return html
                    }
                },
                { "data": "nama_bangunan" },
                { "data": "wilayah_sungai" },
                { "data": "das" },
                { "data": "sungai" },
                { "data": "kab_kec" },
                { "data": "lat" },
                { "data": "lng" },
                { 
					"data" : "luas_genangan",
					"render": function ( data, type, row ) {
						var html = ""
                        html += data + ' Ha'
                        return html; 
                    }
                },
                { 
					"data" : "air_baku",
					"render": function ( data, type, row ) {
						var html = ""
                        html += data + ' M3/dt'
                        return html; 
                    }
                },
                { 
					"data" : "irigasi",
					"render": function ( data, type, row ) {
						var html = ""
                        html += data + ' Ha'
                        return html; 
                    }
                },
                { 
					"data" : "reduksi_banjir",
					"render": function ( data, type, row ) {
						var html = ""
                        html += data + ' M3/dt'
                        return html; 
                    }
                },
                { "data" : "tahun_dibangun" },
                { "data" : "pengelola" },
                { "data" : "keterangan" },
            ],
		});
	});
	
	function import_data() {
		$.fancybox.open({
			src  : _BASE_URL + 'sda/embung_pal/import',
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
               $('#table_embung').DataTable().ajax.reload(null, false);
            }
		});
    }
	
	function tambah_data() {
		$.fancybox.open({
			src  : _BASE_URL + 'sda/embung_pal/insert_form',
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
               $('#table_embung').DataTable().ajax.reload();
            }
		});
    }

	function edit_data(id) {
		$.fancybox.open({
			src  : _BASE_URL + 'sda/embung_pal/edit_form/'+id,
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
               $('#table_embung').DataTable().ajax.reload();
            }
		});
    }

	function delete_data(id) {
		var field = {id:id}
		_H.Loading( true );
		$.post(_BASE_URL + 'sda/embung_pal/deleted', field, function(response) {
			_H.Loading( false );
			var res = _H.StrToObject( response );
			if (res.status == 'success') {
				_H.Notify(res.status, _H.Message(res.message));
				$('#table_embung').DataTable().ajax.reload();
			} else {
				_H.Notify(res.status, _H.Message(res.message));
			}
		});
    }
</script>
