<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('sekre/aset/kibb_grid');?>
<script type="text/javascript">
    var _grid = 'KIB_B', _form = _grid + '_FORM';
	new GridBuilder( _grid , {
        controller:'sekre/aset/kibb',
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
			{ header:'', renderer:'kode' },
			{ header:'', renderer:'nama' },
			{ header:'', renderer:'reg' },
			{ header:'', renderer:'merk_type' },
			{ header:'', renderer:'ukuran' },
			{ header:'', renderer:'bahan' },
			{ header:'', renderer:'th_pembelian' },
			{ header:'', renderer:'no_pabrik' },
			{ header:'', renderer:'no_rangka' },
			{ header:'', renderer:'no_mesin' },
			{ header:'', renderer:'no_polisi' },
			{ header:'', renderer:'no_bpkb' },
			{ header:'', renderer:'asal_usul' },
			{ header:'', renderer:'harga' },
			{ header:'', renderer:'ket' }
    	],
		to_excel: false,
		resize_column: 3,
		extra_buttons: 	'<button title="IMPORT" onclick="import_excel()" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top"><i class="fa fa-upload"></i> IMPORT DATA</button>'+
						'<button title="CETAK" onclick="printData()" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top"><i class="fa fa-print"></i> CETAK</button>'+
						'<button title="Export Excel" onclick="KIB_B.ExportExcel()" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top"><i class="fa fa-file-excel-o"></i> EXPORT EXCEL</button>'
    });
	
    new FormBuilder( _form , {
	    controller:'sekre/aset/kibb',
	    fields: [
            {label:'Kode Barang', name:'kode'},
			{label:'Jenis Barang / Nama Barang', name:'nama'},
			{label:'Nomor Register', name:'reg'},
			{label:'Merk / Type', name:'merk_type'},
			{label:'Ukuran / CC', name:'ukuran'},
			{label:'Bahan', name:'bahan'},
			{label:'Tahun Pembelian', name:'th_pembelian'},
			{label:'Nomor Pabrik', name:'no_pabrik'},
			{label:'Nomor Rangka', name:'no_rangka'},
			{label:'Nomor Mesin', name:'no_mesin'},
			{label:'Nomor Polisi', name:'no_polisi'},
			{label:'Nomor BPKB', name:'no_bpkb'},
			{label:'Asal Usul', name:'asal_usul'},
			{label:'Harga', name:'harga'},
			{label:'Keterangan', name:'ket', type:'textarea'}

	    ]
  	});
	

	function import_excel() {
		$.fancybox.open({
			src  : _BASE_URL + 'sekre/aset/kibb/import_excel_form',
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
               KIB_B.OnReload();  
            }
		});
    }
	var ee = $("#printTable").find(".exclude_excel").length;
	console.log(ee);
	function printData()
	{
	   var divToPrint=document.getElementById("printTable");
	   var tahun = "<?=$this->session->tahun;?>";
	   newWin= window.open("");
	   newWin.document.write("<center><h1>DATA KIB B<br>PERALATAN DAN MESIN</h1><p>Tahun "+tahun+"</p> </center>");
	   newWin.document.write(divToPrint.outerHTML);
	   newWin.document.write("<style> table {width:100%;border-collapse: collapse;} table, th, td {border: 1px solid black;} td.exclude_excel, th.exclude_excel{display:none;} </style>");
	   newWin.print();
	}
</script>
