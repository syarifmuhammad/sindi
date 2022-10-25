<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section class="sidebar">
	<ul class="sidebar-menu" data-widget="tree" >
		<li class="header"><center><span style="color:gold;">DATA TAHUN <?=$this->session->tahun;?></span></center></li>
		<li class="<?=isset($dashboard) ? 'active':'';?>">
			<a href="<?=site_url('dashboard');?>">
				<i class="fa fa-home"></i> <span>Home</span>
			</a>
		</li>
		
		<li class="treeview <?=isset($users) ? 'active':'';?>">
			<a href="#">
				<i class="fa fa-cogs"></i> <span>Manajemen Akun</span> <i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<li <?=isset($modules) ? 'class="active"':'';?>><a href="<?=site_url('users/modules');?>"><i class="fa fa-sign-out"></i> Daftar Modul</a></li>
				<li <?=isset($user_groups) ? 'class="active"':'';?>><a href="<?=site_url('users/user_groups');?>"><i class="fa fa-sign-out"></i> User Group</a></li>
				<li <?=isset($user_privileges) ? 'class="active"':'';?>><a href="<?=site_url('users/user_privileges');?>"><i class="fa fa-sign-out"></i> Hak Akses</a></li>
				<li <?=isset($administrator) ? 'class="active"':'';?>><a href="<?=site_url('users/administrator');?>"><i class="fa fa-sign-out"></i> Daftar User</a></li>
			</ul>
		</li>
	</ul>
	<br>
</section>
