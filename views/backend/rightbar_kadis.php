<aside class="control-sidebar control-sidebar-dark">
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li class="active"><a href="#user-control" data-toggle="tab"><i class="fa fa-user"></i></a></li>
        <li><a href="#info-user" data-toggle="tab"><i class="fa fa-info-circle"></i></a></li>
        <li><a href="<?=site_url('logout');?>" style="background:#ef5137; color:#FFFFFF;"><i class="fa fa-power-off"></i></a></li>
        
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="user-control">
            <ul class="control-sidebar-menu">
                <li>
                    <a href="<?=site_url('profile');?>">
                        <h4 class="control-sidebar-subheading">
                            Ubah Profil User
                            <span class="label label-success pull-right"><i class="fa fa-edit"></i></span>
                        </h4>
                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-success" style="width: 100%"></div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="<?=site_url('change_password');?>">
                        <h4 class="control-sidebar-subheading">
                            Ubah Password
                            <span class="label label-success pull-right"><i class="fa fa-key"></i></span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-success" style="width: 100%"></div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
        <div class="tab-pane" id="info-user">
            <ul class="control-sidebar-menu">
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon fa fa-user bg-light-blue"></i>
                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Username</h4>
                            <p><?=$this->session->user_name;?></p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon fa fa-credit-card bg-light-blue"></i>
                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Nama Lengkap</h4>
                            <p><?=get_value('users', 'user_full_name', 'id', $this->session->user_id);?></p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon fa fa-plug bg-light-blue"></i>
                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Hak Akses User</h4>
                            <p><?=$this->session->user_group == '' ? 'Super Admin' : strtoupper($this->session->user_group);?></p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon fa fa-envelope bg-light-blue"></i>
                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">E-Mail</h4>
                            <p><?=get_value('users', 'user_email', 'id', $this->session->user_id);?></p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon fa fa-globe bg-light-blue"></i>
                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Login IP Address</h4>
                            <p><?=get_value('users', 'ip_address', 'id', $this->session->user_id);?></p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon fa fa-globe bg-light-blue"></i>
                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Current IP Address</h4>
                            <p><?=get_ip_address();?></p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon fa fa-clock-o bg-light-blue"></i>
                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Last Login Time</h4>
                            <p><?=get_value('users', 'last_logged_in', 'id', $this->session->user_id);?></p>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>