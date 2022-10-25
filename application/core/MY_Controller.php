<?php defined('BASEPATH') OR exit('No direct script access allowed');



class MY_Controller extends CI_Controller {

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
		$timezone = NULL !== $this->session->timezone ? $this->session->timezone : config_item('timezone');
		date_default_timezone_set($timezone);
	}
}

require_once(APPPATH.'/core/Public_Controller.php');
require_once(APPPATH.'/core/Admin_Controller.php');
