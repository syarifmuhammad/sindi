<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section class="content-header">
   <div class="row">
      <div class="col-xs-12">
         <h3 style="margin:0;"><i class="fa fa-sign-out text-green"></i> <span class="table-header"><?=isset($title) ? $title : ''?></span>
            <?=isset($sub_title) ? '<br><small style="margin-left:29px;">'.$sub_title.'</small>' : ''?>
         </h3>
      </div>
   </div>
</section>
<section class="content">
   <div class="box">
      <div class="box-header" style="margin-bottom: 20px; margin-top: 5px;">
         <div class="col-md-9 col-sm-6 col-xs-6">
            <div class="box-tools btn-group pull-left grid-button"></div>
         </div>
         <div class="col-md-3 col-sm-6 col-xs-6">
            <div class="box-tools">
               <div class="form-group has-info has-feedback">
                  <input type="text" class="form-control keyword input-sm" placeholder="Search">
                  <i class="fa fa-search form-control-feedback" id="search-icon" aria-hidden="true"></i>
               </div>
            </div>
         </div>
      </div>
      <div class="box-body">
         <div class="row"></div>
		 <div class="table-responsive">
            <table border="2px" class="table table-hover table-sm table-striped table-condensed" id="printTable">
               <thead>
				  <tr>
					<th rowspan="2" data-sort="ASC" width="30px"><center><small>No</small></center></th>
					<th rowspan="2" class="exclude_excel" data-sort="ASC" width="30px"><center><input type="checkbox" class="check-all"></center></th>
					<th rowspan="2" class="exclude_excel" data-sort="ASC" width="30px"><center><i class="fa fa-edit"></i></center></th>
					<th rowspan="2"><center><small>Nama Bangunan<br>Gedung</small></center></th>
					<th colspan="3"><center><small>Lokasi</small></center></th>
					<th colspan="2"><center><small>Koordinat</small></center></th>
					<th rowspan="2"><center><small>Fungsi</small></center></th>
					<th colspan="5"><center><small>Klasifikasi</small></center></th>
					<th rowspan="2"><center><small>Jumlah<br>Lantai</small></center></th>
					<th rowspan="2"><center><small>Luas Lantai<br>(m2)</small></center></th>
					<th rowspan="2"><center><small>Luas Tanah<br>(m2)</small></center></th>
					<th colspan="3"><center><small>IMB/PBG</small></center></th>
					<th colspan="3"><center><small>SLF</small></center></th>
					<th rowspan="2"><center><small>Kondisi (B/ <br>RR/ RS/ RB)</small></center></th>
					<th rowspan="2"><center><small>Pemilik</small></center></th>
				  </tr>
				  <tr>
					<th><center><small>Jalan</small></center></th>
					<th><center><small>Desa</small></center></th>
					<th><center><small>Kecamatan</small></center></th>
					<th><center><small>X</small></center></th>
					<th><center><small>Y</small></center></th>
					<th><center><small>Kompleksitas<br>(BG Sederhana/<br>BG Tidak<br>Sederhana/ BG<br>Khusus)</small></center></th>
					<th><center><small>Permanensi<br>(Permanen/ <br>Nonpermanen)</small></center></th>
					<th><center><small>Tingkat Risiko thd<br>Bahaya<br>Kebakaran<br>(Tinggi/ Sedang/ <br>Rendah)</small></center></th>
					<th><center><small>Tingkat<br>Kepadatan<br>Lokasi BG<br>(Padat/ Sedang/ <br>Renggang)</small></center></th>
					<th><center><small>Kepemilikan<br>(BG Negara/ <br>BG<br>NonNegara)</small></center></th>
					<th><center><small>Nomor</small></center></th>
					<th><center><small>Tanggal</small></center></th>
					<th><center><small>Penerbit</small></center></th>
					<th><center><small>Nomor</small></center></th>
					<th><center><small>Tanggal</small></center></th>
					<th><center><small>Penerbit</small></center></th>
				  </tr>
				</thead>
               <tbody class="tbody"></tbody>
            </table>
         </div>
      </div>
      <div class="box-footer">
         <div class="row">
            <div class="col-sm-7 col-xs-12">
               <em class="page-info"></em> <em class="search-info"></em>
            </div>
            <div class="col-sm-5 col-xs-12">
               <div class="btn-group pull-right">
                  <button type="button" class="btn bg-black btn-sm first" title="First"><i class="fa fa-angle-double-left"></i></button>
                  <button type="button" class="btn bg-black btn-sm previous" title="Prev"><i class="fa fa-angle-left"></i></button>
                  <button type="button" class="btn bg-black btn-sm next" title="Next"><i class="fa fa-angle-right"></i></button>
                  <button type="button" class="btn bg-black btn-sm last" title="Last"><i class="fa fa-angle-double-right"></i></button>
                  <div class="btn-group">
                     <select class="btn bg-black input-sm per-page" style="padding: 5px 5px"></select>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<div class="modal fade modal-form">
   <div class="modal-dialog modal-lg">
      <form class="form-horizontal form-dialog" role="form" method="post">
         <div class="modal-content">
            <div class="modal-header">
               <button class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               <h4 class="modal-title"><i class="fa fa-edit"></i>
                  <?=$title;?>
               </h4>
            </div>
            <div class="modal-body">
               <div class="box-body form-fields"></div>
               <div class="form-group" style="margin-top: 10px;padding: 10px 0;">
                  <div class="btn-group col-md-8 col-md-offset-4" id="container_upload">
                     <button class="btn btn-primary btn-sm submit"></button>
                     <button type="reset" class="btn btn-info btn-sm reset"><i class="fa fa-refresh"></i> RESET</button>
                     <button class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-mail-forward"></i>
                        CANCEL</button>
                  </div>
               </div>
            </div>
         </div>
      </form>
   </div>
</div>
<div class="modal fade modal-preview">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <button class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><i class="fa fa-edit"></i>
               <?=$title;?>
            </h4>
         </div>
         <div class="modal-body"></div>
      </div>
   </div>
</div>