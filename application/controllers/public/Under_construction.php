<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Under_construction extends CI_Controller {

	/**
	 * Class Constructor
	 *
	 * @return Void
	 */
	public function __construct() {
		parent::__construct();
		$site_maintenance = $this->session->site_maintenance;
		if (NULL !== $site_maintenance && !filter_var($site_maintenance, FILTER_VALIDATE_BOOLEAN)) {
			redirect(base_url(), 'refresh');
		}
	}

	/**
	 * Index
	 * @access  public
	 */
	public function index() {
		$this->load->view('frontend/under_construction');
	}
}