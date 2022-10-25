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
		<li class="treeview <?=isset($bgjk) ? 'active':'';?>">
			<a href="#">
				<i class="fa fa-building"></i> <span>Gedung & Jaskon</span> <i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<li <?=isset($bangunan_gedung) ? 'class="active"':'';?>><a href="<?=site_url('bgjk/bangunan_gedung');?>"><i class="fa fa-sign-out"></i> Bangunan Gedung</a></li>
				<li class="treeview <?=isset($jaskon) ? 'active':'';?>">
				  <a href="#"><i class="fa fa-sign-out"></i> Jasa Konstruksi
					<span class="pull-right-container">
					  <i class="fa fa-angle-left pull-right"></i>
					</span>
				  </a>
				  <ul class="treeview-menu">
					<li <?=isset($badan_usaha) ? 'class="active"':'';?>>
					  <a href="<?=site_url('bgjk/jaskon/badan_usaha');?>"><i class="fa fa-table"></i> Badan Usaha</a>
					</li>
					<li <?=isset($tenaga_terampil) ? 'class="active"':'';?>>
					  <a href="<?=site_url('bgjk/jaskon/tenaga_terampil');?>"><i class="fa fa-table"></i> Tenaga Terampil</a>
					</li>
				  </ul>
				</li>
			</ul>
		</li>
	</ul>
	<br>
</section>
