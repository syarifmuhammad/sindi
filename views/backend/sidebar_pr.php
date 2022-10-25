<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section class="sidebar">
	<ul class="sidebar-menu" data-widget="tree" >
		<li class="header"><center><span style="color:gold;">DATA TAHUN <?=$this->session->tahun;?></span></center></li>
		<li class="<?=isset($dashboard) ? 'active':'';?>">
			<a href="<?=site_url('dashboard');?>">
				<i class="fa fa-home"></i> <span>Dashboard</span>
			</a>
		</li>
		<li class="header">Master Data</li>
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
	</ul>
	<br>
</section>
