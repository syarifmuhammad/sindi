<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Dashboard extends Admin_Controller {

	/**
	 * Class Constructor
	 *
	 * @return Void
	 */
	public function __construct() {
		parent::__construct();
		$this->model->clear_expired_session();
		$this->model->add_sp_profil();
		$this->model->set_offline_user();
		$this->load->model([
			'm_users',
			'm_configs'
		]);
		$this->load->library('user_agent');
		$this->load->helper(['form']);
	}

	/**
	 * Index
	 * @return Void
	 */
	public function index() {
		$this->vars['title'] = 'Home';
		$this->vars['dashboard'] = true;
		$this->vars['last_logged_in'] = $this->m_users->get_last_logged_in();
		$this->vars['content'] = 'backend/dashboard';
		$this->load->view('backend/index', $this->vars);
	}

	/**
	 * Sidebar Collapse
	 */
	public function sidebar_collapse() {
		$collapse = $this->session->sidebar_collapse ? false : true;
		$this->session->set_userdata('sidebar_collapse', $collapse);
	}
	
	/**
	 * Print Sessions
	 */
	public function print_sessions() {
		echo '<pre>';
		print_r($this->session->all_userdata());
		echo '</pre>';
	}
		
}
