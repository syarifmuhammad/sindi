<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section class="sidebar">
	<ul class="sidebar-menu" data-widget="tree" >
		<li class="header"><center><span style="color:gold;">DATA TAHUN <?=$this->session->tahun;?></span></center></li>
		<li class="<?=isset($dashboard) ? 'active':'';?>">
			<a href="<?=site_url('dashboard');?>">
				<i class="fa fa-home"></i> <span>Dashboard</span>
			</a>
		</li>
		<!--
		<li class="header">Master Data</li>
		<li class="treeview <?=isset($ampl) ? 'active':'';?>">
			<a href="#">
				<i class="fa fa-shower"></i> <span>Air Minum & Sanitasi</span> <i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<li <?=isset($ampl) ? 'class="active"':'';?>><a href="<?=site_url('users/modules');?>"><i class="fa fa-sign-out"></i> Air Minum</a></li>
				<li <?=isset($ampl) ? 'class="active"':'';?>><a href="<?=site_url('users/modules');?>"><i class="fa fa-sign-out"></i> Penyehatan Lingkungan</a></li>
			</ul>
		</li>
		<li class="treeview <?=isset($bgjk) ? 'active':'';?>">
			<a href="#">
				<i class="fa fa-building"></i> <span>Gedung & Jaskon</span> <i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<li <?=isset($ampl) ? 'class="active"':'';?>><a href="<?=site_url('users/modules');?>"><i class="fa fa-sign-out"></i> Bangunan Gedung</a></li>
				<li <?=isset($ampl) ? 'class="active"':'';?>><a href="<?=site_url('users/modules');?>"><i class="fa fa-sign-out"></i> Jasa Konstruksi</a></li>
			</ul>
		</li>
		<li class="treeview <?=isset($bm) ? 'active':'';?>">
			<a href="#">
				<i class="fa fa-road"></i> <span>Bina Marga</span> <i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<li <?=isset($ampl) ? 'class="active"':'';?>><a href="<?=site_url('users/modules');?>"><i class="fa fa-sign-out"></i> Jalan</a></li>
				<li <?=isset($ampl) ? 'class="active"':'';?>><a href="<?=site_url('users/modules');?>"><i class="fa fa-sign-out"></i> Jembatan</a></li>
			</ul>
		</li>
		<li class="treeview <?=isset($pr) ? 'active':'';?>">
			<a href="#">
				<i class="fa fa-map-o"></i> <span>Penataan Ruang</span> <i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<li <?=isset($ampl) ? 'class="active"':'';?>><a href="<?=site_url('users/modules');?>"><i class="fa fa-sign-out"></i> Dokumen Tata Ruang</a></li>
				<li <?=isset($ampl) ? 'class="active"':'';?>><a href="<?=site_url('users/modules');?>"><i class="fa fa-sign-out"></i> Ruang Terbuka Hijau</a></li>
				<li <?=isset($ampl) ? 'class="active"':'';?>><a href="<?=site_url('users/modules');?>"><i class="fa fa-sign-out"></i> Pemanfaatan Tata Ruang</a></li>
			</ul>
		</li>
		<li class="treeview <?=isset($ampl) ? 'active':'';?>">
			<a href="#">
				<i class="fa fa-tint"></i> <span>Sumber Daya Air</span> <i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<li <?=isset($ampl) ? 'class="active"':'';?>><a href="<?=site_url('users/modules');?>"><i class="fa fa-sign-out"></i> Irigasi dan Rasa</a></li>
				<li <?=isset($ampl) ? 'class="active"':'';?>><a href="<?=site_url('users/modules');?>"><i class="fa fa-sign-out"></i> Embung & PAL</a></li>
				<li <?=isset($ampl) ? 'class="active"':'';?>><a href="<?=site_url('users/modules');?>"><i class="fa fa-sign-out"></i> Sungai & Pantai</a></li>
			</ul>
		</li>
		-->
		<li class="header">Pelaporan</li>
		<li class="<?=isset($dashboard) ? 'active':'';?>">
			<a href="<?=site_url('dashboard');?>"><i class="fa fa-table"></i> <span>Infrastruktur Air Minum</span></a>
		</li>
		<li class="<?=isset($dashboard) ? 'active':'';?>">
			<a href="<?=site_url('dashboard');?>"><i class="fa fa-table"></i> <span>Infrastruktur Sanitasi</span></a>
		</li>
		<li class="<?=isset($dashboard) ? 'active':'';?>">
			<a href="<?=site_url('dashboard');?>"><i class="fa fa-table"></i> <span>Infrastruktur Gedung</span></a>
		</li>
		<li class="<?=isset($dashboard) ? 'active':'';?>">
			<a href="<?=site_url('dashboard');?>"><i class="fa fa-table"></i> <span>Infrastruktur Jalan</span></a>
		</li>
		<li class="<?=isset($dashboard) ? 'active':'';?>">
			<a href="<?=site_url('dashboard');?>"><i class="fa fa-table"></i> <span>Infrastruktur Jembatan</span></a>
		</li>
		<li class="<?=isset($dashboard) ? 'active':'';?>">
			<a href="<?=site_url('dashboard');?>"><i class="fa fa-table"></i> <span>Infrastruktur Irigasi</span></a>
		</li>
		<li class="<?=isset($dashboard) ? 'active':'';?>">
			<a href="<?=site_url('dashboard');?>"><i class="fa fa-table"></i> <span>Infrastruktur Embung & PAL</span></a>
		</li>
		<li class="<?=isset($dashboard) ? 'active':'';?>">
			<a href="<?=site_url('dashboard');?>"><i class="fa fa-table"></i> <span>Infrastruktur Sungai & Pantai</span></a>
		</li>
	</ul>
	<br>
</section>
