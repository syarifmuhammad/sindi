<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Import_adminsekolah extends Admin_Controller {

	/**
	 * Class Constructor
	 *
	 * @return Void
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Index
	 * @return Void
	 */
	public function index() {
		$this->vars['title'] = 'Import Admin Sekolah';
		$this->vars['userlp'] = $this->vars['user_list'] = true;
		$this->vars['content'] = 'dinas/import_adminsekolah';
		$this->load->view('backend/page', $this->vars);
	}

	/**
	 * Save
	 */
	public function save() {
		if ($this->input->is_ajax_request()) {
			$rows = explode("\n", $this->input->post('adminsekolah'));
			$success = $failed = $exist = 0;
			foreach($rows as $row) {
				$exp = explode("\t", $row);
				if (count($exp) != 2) continue;
				$fill_data = [];
				$fill_data['user_name'] = trim($exp[1]);
				$fill_data['user_password'] = xpassword(trim($exp[1]), trim($exp[1]));
				$fill_data['user_full_name'] = trim($exp[0]);
				$fill_data['user_profile_id'] = trim($exp[1]);
				$fill_data['user_group_id'] = 2;
				$fill_data['created_at'] = date('Y-m-d H:i:s');
				$fill_data['created_by'] = $this->session->user_id;
				$query = $this->model->is_exists('user_name', trim($exp[1]), 'users');
				if (!$query) {
					$this->model->insert('users', $fill_data) ? $success++ : $failed++;
				} else {
					$exist++;
				}
			}
			$this->vars['status'] = 'info';
			$this->vars['message'] = 'Success : ' . $success. ' rows, Failed : '. $failed .', Exist : ' . $exist;
			$this->output
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($this->vars, JSON_PRETTY_PRINT))
				->_display();
			exit;
		}
	}
}
