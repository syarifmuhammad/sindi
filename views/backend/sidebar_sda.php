<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section class="sidebar">
	<ul class="sidebar-menu" data-widget="tree" >
		<li class="header"><center><span style="color:gold;">DATA TAHUN <?=$this->session->tahun;?></span></center></li>
		<li class="<?=isset($dashboard) ? 'active':'';?>">
			<a href="<?=site_url('dashboard');?>">
				<i class="fa fa-home"></i> <span>Dashboard</span>
			</a>
		</li>
		<li class="treeview <?=isset($sda) ? 'active':'';?>">
			<a href="#">
				<i class="fa fa-tint"></i> <span>Sumber Daya Air</span> <i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<li class="treeview <?=isset($sda) ? 'active':'';?>">
					<a href="#">
						<i class="fa fa-tint"></i> <span>Irigasi dan Rawa</span> <i class="fa fa-angle-left pull-right"></i>
					</a>
					<ul class="treeview-menu">
						<li <?=isset($dir) ? 'class="active"':'';?>><a href="<?=site_url('sda/irigasi_rawa');?>"><i class="fa fa-sign-out"></i> Aset Irigasi</a></li>
						<li <?=isset($iks) ? 'class="active"':'';?>><a href="<?=site_url('sda/irigasi_rawa/iks');?>"><i class="fa fa-sign-out"></i> Indeks Kinerja Sistem</a></li>
					</ul>
				</li>
				<li <?=isset($embung_pal) ? 'class="active"':'';?>><a href="<?=site_url('sda/embung_pal');?>"><i class="fa fa-sign-out"></i> Embung & PAL</a></li>
				<li <?=isset($prasarana_sungai) ? 'class="active"':'';?>><a href="<?=site_url('sda/prasarana_sungai');?>"><i class="fa fa-sign-out"></i> Prasarana Sungai</a></li>
				<li <?=isset($pelindung_pantai) ? 'class="active"':'';?>><a href="<?=site_url('sda/pelindung_pantai');?>"><i class="fa fa-sign-out"></i> Pelindung Pantai</a></li>
			</ul>
		</li>
	</ul>
	<br>
</section>
