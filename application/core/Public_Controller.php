<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Public_Controller extends MY_Controller {

	/**
	 * General Variable
	 * @var Array
	 */
	protected $vars = [];

	/**
	 * Class Constructor
	 *
	 * @return Void
	 */
	public function __construct() {
		parent::__construct();

		// Load Text Helper
		$this->load->helper(['text']);

		// redirect if under construction
		if ($this->session->site_maintenance == 'true' &&
			$this->session->site_maintenance_end_date >= date('Y-m-d') &&
			$this->uri->segment(1) !== 'login') {
			redirect('under-construction');
		}

		//  cache file
		if ($this->session->site_cache == 'true' && (int) $this->session->site_cache_time > 0) {
			$this->output->cache($this->session->site_cache_time);
		}

	}
}
