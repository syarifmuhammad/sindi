<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Trigger {

	/**
     * The CodeIgniter super object
     *
     * @var Object
     * @access private
     */
    private $CI;

	/**
     * Class constructor
     */
    public function __construct() {
		$this->CI = &get_instance();
        $this->CI->load->model([
			'm_configs'
		]);
	}

	/**
     * Set Session Here
     */
	public function index() {
		$session_data = [];
		$user_type = !$this->CI->auth->hasLogin() ? 'public' : $this->CI->session->user_type;
		$configs = $this->CI->m_configs->get_config_values($user_type);
		foreach($configs as $config_variable => $config_value) {
			$session_value = $config_value;
			$session_data[ $config_variable ] = $session_value;
		}		
		$this->CI->session->set_userdata($session_data);
	}
}
