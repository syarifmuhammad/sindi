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
		<li class="treeview <?=isset($ampl) ? 'active':'';?>">
			<a href="#">
				<i class="fa fa-shower"></i> <span>Air Minum & Sanitasi</span> <i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<li <?=isset($air_minum) ? 'class="active"':'';?>><a href="<?=site_url('ampl/air_minum');?>"><i class="fa fa-sign-out"></i> Air Minum</a></li>
				<li <?=isset($sanitasi) ? 'class="active"':'';?>><a href="<?=site_url('users/modules');?>"><i class="fa fa-sign-out"></i> Sanitasi</a></li>
			</ul>
		</li>
		<li class="header">Pelaporan</li>
		<li class="<?=isset($dashboard) ? 'active':'';?>">
			<a href="<?=site_url('dashboard');?>"><i class="fa fa-table"></i> <span>Infrastruktur Air Minum</span></a>
		</li>
		<li class="<?=isset($dashboard) ? 'active':'';?>">
			<a href="<?=site_url('dashboard');?>"><i class="fa fa-table"></i> <span>Infrastruktur Sanitasi</span></a>
		</li>
	</ul>
	<br>
</section>
