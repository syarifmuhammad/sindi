<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Home extends Public_Controller {

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
		redirect(base_url('login'));
	}
}
