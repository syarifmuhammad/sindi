<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section class="sidebar">
	<ul class="sidebar-menu" data-widget="tree" >
		<li class="header"><center><span style="color:gold;">DATA TAHUN <?=$this->session->tahun;?></span></center></li>
		<li class="<?=isset($dashboard) ? 'active':'';?>">
			<a href="<?=site_url('dashboard');?>">
				<i class="fa fa-home"></i> <span>Home</span>
			</a>
		</li>
		
		<li class="treeview <?=isset($userlp) ? 'active':'';?>">
			<a href="#">
				<i class="fa fa-cogs"></i> <span>User Manajemen</span> <i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<li <?=isset($user_list) ? 'class="active"':'';?>><a href="<?=site_url('dinas/user_list');?>"><i class="fa fa-sign-out"></i> Admin Sekolah</a></li>
			</ul>
		</li>
		
		<li class="treeview <?=isset($verifikasi) ? 'active':'';?>">
			<a href="#">
				<i class="fa fa-check-square"></i> <span>Verifikasi</span> <i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<li <?=isset($lapbul) ? 'class="active"':'';?>><a href="<?=site_url('dinas/lapbul');?>"><i class="fa fa-sign-out"></i> Laporan Bulanan</a></li>
			</ul>
		</li>
	</ul>
	<br>
</section>
