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
						<th style="text-align:center;" rowspan="4">No</th>
						<th style="text-align:center;" rowspan="4">Action</th>
						<th style="text-align:center;" rowspan="4">Nomeklatur/ Nama D.I.R.</th>
						<th style="text-align:center;" rowspan="4">Luas D.I.R. Sesuai Permen 14/15 (Ha)</th>
						<th style="text-align:center;" rowspan="4">Sawah/Fungsional (Pemetaan IGT) (Ha)</th>
						<th style="text-align:center;" colspan="<?=(((int) $jumlah_jar)*2)+2?>">Kondisi Fisik Jaringan Irigasi</th>
						<th style="text-align:center;" colspan="5" rowspan="2">Areal Terdampak Kondisi Jaringan Irigasi (Ha)</th>
						<th style="text-align:center;" colspan="8" rowspan="2">Indeks Kinerja Sistem Irigasi (%)</th>
						<th style="text-align:center;" rowspan="4">Keterangan</th>
					</tr>
					<tr>
						<?php foreach($jaringan_irigasi as $data){ ?>
							<th style="text-align:center;" colspan="<?=count($data->jaringan_irigasi)*2?>"><?=$data->jenis?></th>
						<?php } ?>
						<th style="text-align:center;" colspan="2" rowspan="2">Rata-Rata Jaringan</th>
					</tr>
					<tr>
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
								<th style="text-align:center;" colspan="2"><?=$jaringan->nama. " (".$satuan.")"?></th>
							<?php } ?>
						<?php } ?>
						<th style="text-align:center;" rowspan="2">Baik (Ha)</th>
						<th style="text-align:center;" rowspan="2">Rusak Ringan (Ha)</th>
						<th style="text-align:center;" rowspan="2">Rusak Sedang (Ha)</th>
						<th style="text-align:center;" rowspan="2">Rusak Berat (Ha)</th>
						<th style="text-align:center;" rowspan="2">Total (Ha)</th>
						<th style="text-align:center;">Prasarana Fisik</th>
						<th style="text-align:center;">Produktivitas (Padi)</th>
						<th style="text-align:center;">Sarana Penunjang</th>
						<th style="text-align:center;">Organisasi Personalia</th>
						<th style="text-align:center;">Dokumentasi</th>
						<th style="text-align:center;">P3A/GP3A/IP3A</th>
						<th style="text-align:center;">Jumlah</th>
						<th style="text-align:center;" rowspan="2">Kategori (SB/B/K/J)</th>
					</tr>
					<tr>
						<?php foreach($jaringan_irigasi as $data){ ?>
							<?php foreach($data->jaringan_irigasi as $jaringan){ ?>
								<th style="text-align:center;">B/RR/RS/RB</th>
								<th style="text-align:center;">% Kondisi Baik</th>
							<?php } ?>
						<?php } ?>
						<th style="text-align:center;">B/RR/RS/RB</th>
						<th style="text-align:center;">% Kondisi Baik</th>
						<th style="text-align:center;">Nilai Maks <br> 45%</th>
						<th style="text-align:center;">Nilai Maks <br> 15%</th>
						<th style="text-align:center;">Nilai Maks <br> 10%</th>
						<th style="text-align:center;">Nilai Maks <br> 15%</th>
						<th style="text-align:center;">Nilai Maks <br> 5%</th>
						<th style="text-align:center;">Nilai Maks <br> 15%</th>
						<th style="text-align:center;">Nilai Maks <br> 100%</th>
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
				{ "data":"index", order:false },
				{ "render": function ( data, type, row ) { // Tampilkan kolom aksi
                        var html  ="<a onclick='edit_data("+row.id+")' title='Edit'><i class='fa fa-edit' style='margin-right:20px; cursor:pointer; font-size:20px;'></i></a>"
						// html += "<a onclick='delete_data("+row.id+")' title='Delete'><i class='fa fa-trash text-danger' style='cursor:pointer; font-size:20px;'></i></a>"
                        return html
                    }
                },
                { "data": "nomenklatur" },
                { 
					"data" : "luas",
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
			var jumlah = JSON.parse('<?=json_encode($jumlah_jaringan)?>')
			for(var i=0; i<jumlah.length; i++){
				for(var j=0; j< jumlah[i].length; j++){
					column.push(
						{
							data:'jaringan_irigasi.'+i+".jaringan_irigasi."+j+".kondisi_baik",
							render: function ( data, type, row ) {
								var html = ""
								if(data>90){
									value = "B"
								}else if(data>80){
									value = "RR"
								}else if(data>60){
									value = "RS"
								}else{
									value = "RB"
								}
								html += value
								return html; 
							}
						}
					)
					column.push({data:'jaringan_irigasi.'+i+".jaringan_irigasi."+j+".kondisi_baik", order:false})
					
				}
			}
			column.push(
				{
					data:'rata_jaringan',
					order:false
				}
			)
			column.push(
				{
					data:'rata_jaringan',
					render: function ( data, type, row ) {
						var html = ""
						if(data>90){
							value = "B"
						}else if(data>80){
							value = "RR"
						}else if(data>60){
							value = "RS"
						}else{
							value = "RB"
						}
						html += value
						return html; 
					},
					order:false
				}
			)
			column.push({data:'baik'})
			column.push({data:'rusak_ringan'})
			column.push({data:'rusak_sedang'})
			column.push({data:'rusak_berat'})
			column.push(
				{
					"render": function ( data, type, row ) { // Tampilkan kolom aksi
                        html = parseInt(row.baik)+parseInt(row.rusak_ringan)+parseInt(row.rusak_sedang)+parseInt(row.rusak_berat)
                        return html
					},
					order:false
				}
			)
			column.push({data:'iks_prasarana'})
			column.push({data:'iks_produktivitas'})
			column.push({data:'iks_penunjang'})
			column.push({data:'iks_organisasi'})
			column.push({data:'iks_dokumentasi'})
			column.push({data:'iks_pppa'})
			column.push({data:'total_iks', order:false})
			column.push({data:'kategori_iks', order:false})
			column.push({data:'keterangan'})
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
					// {
					// 	text: "<i class='fa fa-upload'></i> IMPORT DATA",
					// 	action: function(){
					// 		import_data()
					// 	},
					// 	className: "btn btn-warning btn-sm",
					// 	init: function(api, node, config) {
					// 		$(node).removeClass('dt-button')
					// 	}
					// },
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
					// {
					// 	text: '<i class="fa fa-plus"></i>',
					// 	action: function () {
					// 		window.location.href = "<?=base_url('sda/irigasi_rawa/insert')?>"
					// 	},
					// 	className: "btn btn-success btn-sm add",
					// 	init: function(api, node, config) {
					// 		$(node).removeClass('dt-button')
					// 	}
					// }
				],
			},
			ajax: {
                "url": "<?php echo base_url('sda/irigasi_rawa/pagination/true') ?>", // URL file untuk proses select datanya
                "type": "POST"
            },
			columns:column
		});
	} );
	
	function edit_data(id) {
		$.fancybox.open({
			src  : _BASE_URL + 'sda/irigasi_rawa/edit_form_iks/'+id,
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
	
</script>
