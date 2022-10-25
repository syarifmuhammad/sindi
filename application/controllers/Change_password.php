<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Change_password extends Admin_Controller {

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
		$this->vars['title'] = 'Ubah Password';
		$this->vars['change_password'] = true;
		$this->vars['content'] = 'users/change_password';
		$this->load->view('backend/index', $this->vars);
	}

	/**
	 * Save | Update
	 * @return Object
	 */
	public function save() {
		if ($this->input->is_ajax_request()) {
			$id = (int) $this->session->user_id;
			if (_isInteger( $id )) {
				if ($this->validation()) {
					$query = $this->model->RowObject('id', $id, 'users');
					if (cek_password($query->user_name, $this->input->post('current_password', true), $query->user_password)) {
						$fill_data = $this->fill_data();
						$fill_data['updated_by'] = $id;
						$this->vars['status'] = $this->model->update($id, 'users', $fill_data) ? 'success' : 'error';
						$this->vars['message'] = $this->vars['status'] == 'success' ? 'updated' : 'not_updated';
					} else {
						$this->vars['status'] = 'error';
						$this->vars['message'] = 'not_updated';
					}
				} else {
					$this->vars['status'] = 'error';
					$this->vars['message'] = validation_errors();
				}
			} else {
				$this->vars['status'] = 'error';
				$this->vars['message'] = 'not_updated';
			}

			$this->output
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($this->vars, JSON_PRETTY_PRINT))
				->_display();
			exit;
		}
	}

	/**
	 * Fill Data
	 * @return Array
	 */
	private function fill_data() {
		return [
			'user_password' => xpassword($this->session->user_name, $this->input->post('new_password', true))
		];
	}

	/**
	 * Validation Form
	 * @return Boolean
	 */
	private function validation() {
		$this->load->library('form_validation');
		$val = $this->form_validation;
		$val->set_rules('current_password', 'Password Lama', 'trim|required');
		$val->set_rules('new_password', 'Password Baru', 'trim|required|min_length[4]|max_length[10]|alpha_numeric');
		$val->set_rules('retype_new_password', 'Ulang Password Baru', 'trim|required|matches[new_password]');
		$val->set_message('required', '{field} harus diisi');
		$val->set_message('matches', 'Password tidak sama');
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();
	}
}
