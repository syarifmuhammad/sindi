<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Public_Controller {

	/**
	 * Class Constructor
	 *
	 * @return Void
	 */
	public function __construct() {
		parent::__construct();
		if ($this->auth->hasLogin())
			redirect('dashboard');
	}

	/**
	 * Index
	 * @access  public
	 */
	public function index() {
		unset($this->vars['menus']);
		$this->vars['page_title'] = config_item('apps').' LOGIN';
		$this->vars['ip_banned'] = $this->auth->ip_banned(get_ip_address());
		$this->vars['login_info'] = $this->vars['ip_banned'] ? 'Blocked for 10 minutes' : 'Masukkan Username dan Password';
		$this->vars['content'] = 'users/login';
		$this->load->view('users/index', $this->vars);
	}

	/**
	 * process
	 * @access  public
	 */
	public function process() {
		if ($this->input->is_ajax_request()) {
			unset($this->vars['menus']);
			if ($this->validation()) {
				$user_name = $this->input->post('user_name', TRUE);
				$user_password = $this->input->post('user_password', TRUE);
				$tahun = $this->input->post('tahun', TRUE);
				$ip_address = get_ip_address();
				$logged_in = $this->auth->logged_in($user_name, $user_password, $ip_address, $tahun) ? 'success' : 'error';
				$this->vars['status'] = $logged_in;
				$this->vars['message'] = $logged_in == 'success' ? 'logged_in' : 'not_logged_in';
				$this->vars['ip_banned'] = $this->auth->ip_banned($ip_address);
			} else {
				$this->vars['status'] = 'error';
				$this->vars['message'] = validation_errors();
				$this->vars['ip_banned'] = FALSE;
			}
			$this->output
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($this->vars, JSON_PRETTY_PRINT))
				->_display();
			exit;
		}
	}

	/**
	 * Validations Form
	 * @access  public
	 * @return Bool
	 */
	private function validation() {
		$this->load->library('form_validation');
		$val = $this->form_validation;
		$val->set_rules('user_name', 'Username', 'trim|required');
		$val->set_rules('user_password', 'Password', 'trim|required');
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();
	}
}
