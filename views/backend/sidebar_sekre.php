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
		<li class="<?=isset($pegawai) ? 'active':'';?>">
			<a href="<?=site_url('sekre/pegawai');?>"><i class="fa fa-user-secret"></i> <span>Kepegawaian</span></a>
		</li>
		<li class="treeview <?=isset($aset) ? 'active':'';?>">
			<a href="#">
				<i class="fa fa-puzzle-piece"></i> <span>Aset Daerah</span> <i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<li <?=isset($kiba) ? 'class="active"':'';?>><a href="<?=site_url('sekre/aset/kiba');?>"><i class="fa fa-sign-out"></i> KIB A</a></li>
				<li <?=isset($kibb) ? 'class="active"':'';?>><a href="<?=site_url('sekre/aset/kibb');?>"><i class="fa fa-sign-out"></i> KIB B</a></li>
				<li <?=isset($kibc) ? 'class="active"':'';?>><a href="<?=site_url('sekre/aset/kibc');?>"><i class="fa fa-sign-out"></i> KIB C</a></li>
				<li <?=isset($kibd) ? 'class="active"':'';?>><a href="<?=site_url('sekre/aset/kibd');?>"><i class="fa fa-sign-out"></i> KIB D</a></li>
				<li <?=isset($kibe) ? 'class="active"':'';?>><a href="<?=site_url('sekre/aset/kibe');?>"><i class="fa fa-sign-out"></i> KIB E</a></li>
				<li <?=isset($kibf) ? 'class="active"':'';?>><a href="<?=site_url('sekre/aset/kibf');?>"><i class="fa fa-sign-out"></i> KIB F</a></li>
			</ul>
		</li>
		
		<!-- <li class="header">Pelaporan</li>
		<li class="<?=isset($dashboard) ? 'active':'';?>">
			<a href="<?=site_url('dashboard');?>"><i class="fa fa-table"></i> <span>Data Pegawai</span></a>
		</li>
		<li class="<?=isset($dashboard) ? 'active':'';?>">
			<a href="<?=site_url('dashboard');?>"><i class="fa fa-table"></i> <span>KIB A</span></a>
		</li>
		<li class="<?=isset($dashboard) ? 'active':'';?>">
			<a href="<?=site_url('dashboard');?>"><i class="fa fa-table"></i> <span>KIB B</span></a>
		</li>
		<li class="<?=isset($dashboard) ? 'active':'';?>">
			<a href="<?=site_url('dashboard');?>"><i class="fa fa-table"></i> <span>KIB C</span></a>
		</li>
		<li class="<?=isset($dashboard) ? 'active':'';?>">
			<a href="<?=site_url('dashboard');?>"><i class="fa fa-table"></i> <span>KIB D</span></a>
		</li>
		<li class="<?=isset($dashboard) ? 'active':'';?>">
			<a href="<?=site_url('dashboard');?>"><i class="fa fa-table"></i> <span>KIB E</span></a>
		</li>
		<li class="<?=isset($dashboard) ? 'active':'';?>">
			<a href="<?=site_url('dashboard');?>"><i class="fa fa-table"></i> <span>KIB F</span></a>
		</li> -->
	</ul>
	<br>
</section>
