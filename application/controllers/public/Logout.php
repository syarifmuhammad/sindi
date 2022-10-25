<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Logout extends CI_Controller {

	/**
	 * Class Constructor
	 *
	 * @return Void
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('m_users');
	}

	/**
	 * index()
	 * Fungsi untuk menghapus data session users
	 * @access  public
	 * @return   void
	 */
	public function index() {
		if (!$this->auth->hasLogin())
			redirect(base_url());
		$id = (int) $this->session->user_id;
		if (!empty($id)) {
			$this->session->sess_destroy();
			$this->m_users->reset_logged_in($id);
		}
		redirect('login', 'refresh');
	}
 }