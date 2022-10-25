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
		<table id="table_pelindung_pantai" class="table table-hover table-bordered table-striped table-condensed">
			<thead id="thead">
				<tr>
					<th rowspan="2">No</th>
					<th class="hidden-print" rowspan="2"><center>Action</center></th>
					<th rowspan="2">Nama Pantai</th>
					<th rowspan="2">Wilayah Sungai</th>
					<th rowspan="2">Panjang Pantai</th>
					<th rowspan="2">Panjang Pantai Rawan Abrasi</th>
					<th style="text-align:center;" colspan="4">Bangunan Seawall</th>
					<th style="text-align:center;" colspan="5">Breakwater</th>
					<th style="text-align:center;" colspan="4">Groin</th>
					<th style="text-align:center;" colspan="3">Jetty</th>
				</tr>
				<tr>
					<th>Konstruksi</th>
					<th>Panjang</th>
					<th>Tinggi</th>
					<th>Kondisi (B, RR, RS, RB)</th>
					<th>Konstruksi</th>
					<th>Panjang</th>
					<th>Tinggi</th>
					<th>Lebar</th>
					<th>Kondisi (B, RR, RS, RB)</th>
					<th>Konstruksi</th>
					<th>Tinggi</th>
					<th>Lebar</th>
					<th>Kondisi (B, RR, RS, RB)</th>
					<th>Konstruksi</th>
					<th>Panjang</th>
					<th>Kondisi (B, RR, RS, RB)</th>
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
	<!-- <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<form class="modal-content" action="tes" method="POST">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
					<h4 style="font-weight:bold;">Data Embung & PAL</h4>
					<hr>
					<div class="form-group mb-4">
						<h5 style="font-weight:bold;">Umum</h5>
						<hr>
						<label for="nama_bangunan">Nama Bangunan</label>
						<input type="text" name="nama_bangunan" class="form-control" id="nama_bangunan" placeholder="Nama Bangunan">
						<label for="tahun_dibangun">Tahun Dibangun</label>
						<input type="year" name="tahun_dibangun" class="form-control" id="tahun_dibangun" placeholder="Tahun Dibangun">
						<label for="pengelola">Pengelola</label>
						<input type="text" name="pengelola" class="form-control" id="pengelola" placeholder="Pengelola">
						<label for="keterangan">Keterangan</label>
						<textarea name="keterangan" class="form-control" id="keterangan" placeholder="Keterangan"></textarea>
						
					</div>
					<div class="form-group mb-4">
						<h5 style="font-weight:bold;">Lokasi Embung & PAL</h5>
						<hr>
						<label for="wilayah_sungai">Wilayah Sungai</label>
						<input type="text" name="wilayah_sungai" class="form-control" id="wilayah_sungai" placeholder="Wilayah Sungai">
						<label for="das">DAS</label>
						<input type="text" name="das" class="form-control" id="das" placeholder="DAS">
						<label for="sungai">Sungai</label>
						<input type="text" name="sungai" class="form-control" id="sungai" placeholder="Sungai">
						<label for="kab_kec">Kab/Kec</label>
						<input type="text" name="kab_kec" class="form-control" id="kab_kec" placeholder="Kab/Kec">
						<div class="row">
							<div class="col">
								<label for="lat">Kordinat X</label>
								<input type="text" name="lat" class="form-control" id="lat" placeholder="Kordinat X">
							</div>
							<div class="col">
								<label for="lng">Kordinat Y</label>
								<input type="text" name="lng" class="form-control" id="lng" placeholder="Kordinat Y">
							</div>
						</div>
					</div>
					<h4 style="font-weight:bold;">Fisik Embung & PAL</h4>
					<hr>
					<label for="luas_genangan">Luas Genangan Muka Air Normal (Ha)</label>
					<input step="0.01" type="number" name="luas_genangan" class="form-control" id="luas_genangan" placeholder="Luas Genangan Muka Air Normal (Ha)">
					<label for="air_baku">Air Baku (M3/dt)</label>
					<input step="0.01" type="number" name="air_baku" class="form-control" id="air_baku" placeholder="Air Baku (M3/dt)">
					<label for="irigasi">Irigasi (Ha)</label>
					<input step="0.01" type="number" name="irigasi" class="form-control" id="irigasi" placeholder="Irigasi (Ha)">
					<label for="reduksi_banjir">Reduksi Banjir (M3/dt)</label>
					<input step="0.01" type="number" name="reduksi_banjir" class="form-control" id="reduksi_banjir" placeholder="Reduksi Banjir (M3/dt)">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save changes</button>
			</div>
			</form>
		</div>
	</div> -->
</section>

<script type="text/javascript">
	// $('#modal-form').modal('show')
	$(document).ready( function () {
		var t = $('#table_pelindung_pantai').DataTable({
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
							newWin.document.write("<center><h1>DATA PELINDUNG PANTAI </h1><p>Tahun "+tahun+"</p> </center>");
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
                "url": "<?php echo base_url('sda/pelindung_pantai/pagination') ?>", // URL file untuk proses select datanya
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
                { "data": "nama_pantai" },
                { "data": "wilayah_sungai" },
                { 
					"data" : "panjang_pantai",
					"render": function ( data, type, row ) {
						var html = ""
                        html += data + ' Km'
                        return html; 
                    }
                },
                { 
					"data" : "panjang_rawan_abrasi",
					"render": function ( data, type, row ) {
						var html = ""
                        html += data + ' Km'
                        return html; 
                    }
                },
                { "data": "konstruksi_seawall" },
				{ 
					"data" : "panjang_seawall",
					"render": function ( data, type, row ) {
						var html = ""
                        html += data + ' m'
                        return html; 
                    }
                },
				{ 
					"data" : "tinggi_seawall",
					"render": function ( data, type, row ) {
						var html = ""
                        html += data + ' m'
                        return html; 
                    }
                },
                { "data": "kondisi_seawall" },
                { "data": "konstruksi_breakwater" },
				{ 
					"data" : "panjang_breakwater",
					"render": function ( data, type, row ) {
						var html = ""
                        html += data + ' m'
                        return html; 
                    }
                },
				{ 
					"data" : "tinggi_breakwater",
					"render": function ( data, type, row ) {
						var html = ""
                        html += data + ' m'
                        return html; 
                    }
                },
				{ 
					"data" : "lebar_breakwater",
					"render": function ( data, type, row ) {
						var html = ""
                        html += data + ' m'
                        return html; 
                    }
                },
                { "data": "kondisi_breakwater" },
                { "data": "konstruksi_groin" },
				{ 
					"data" : "tinggi_groin",
					"render": function ( data, type, row ) {
						var html = ""
                        html += data + ' m'
                        return html; 
                    }
                },
				{ 
					"data" : "lebar_groin",
					"render": function ( data, type, row ) {
						var html = ""
                        html += data + ' m'
                        return html; 
                    }
                },
                { "data": "kondisi_groin" },
                { "data": "konstruksi_jetty" },
				{ 
					"data" : "panjang_jetty",
					"render": function ( data, type, row ) {
						var html = ""
                        html += data + ' m'
                        return html; 
                    }
                },
                { "data": "kondisi_jetty" }
            ],
		});
	});
	
	function import_data() {
		$.fancybox.open({
			src  : _BASE_URL + 'sda/pelindung_pantai/import',
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
               $('#table_pelindung_pantai').DataTable().ajax.reload();
            }
		});
    }

	function tambah_data() {
		$.fancybox.open({
			src  : _BASE_URL + 'sda/pelindung_pantai/insert_form',
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
               $('#table_pelindung_pantai').DataTable().ajax.reload();
            }
		});
    }

	function edit_data(id) {
		$.fancybox.open({
			src  : _BASE_URL + 'sda/pelindung_pantai/edit_form/'+id,
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
               $('#table_pelindung_pantai').DataTable().ajax.reload();
            }
		});
    }

	function delete_data(id) {
		var field = {id:id}
		_H.Loading( true );
		$.post(_BASE_URL + 'sda/pelindung_pantai/deleted', field, function(response) {
			_H.Loading( false );
			var res = _H.StrToObject( response );
			if (res.status == 'success') {
				_H.Notify(res.status, _H.Message(res.message));
				$('#table_pelindung_pantai').DataTable().ajax.reload(null, false);
			} else {
				_H.Notify(res.status, _H.Message(res.message));
			}
		});
	}
</script>
