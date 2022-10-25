<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Error404 extends Public_Controller {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Index
	 */
	public function index() {
		if(isset($this->session->user_group)){
			$this->vars['title'] = 'Error 404 - Page Not Found';
			$this->vars['content'] = 'backend/error404';
			$this->load->view('backend/index', $this->vars);
		} else {
			redirect(base_url('login'));
		}
	}
}
