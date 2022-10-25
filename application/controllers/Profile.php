<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Profile extends Admin_Controller {

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
		$id = NULL !== $this->session->user_id ? $this->session->user_id : 0;
		$this->vars['title'] = 'Ubah Profil User';
		$this->vars['user_profile'] = true;
		$this->vars['query'] = $this->model->RowObject('id', $id, 'users');
		$this->vars['content'] = 'users/profile';
		$this->load->view('backend/index', $this->vars);
	}

	/**
	 * Save | Update
	 * @return Object
	 */
	public function save() {
		if ($this->input->is_ajax_request()) {
			$id = NULL !== $this->session->user_id ? $this->session->user_id : 0;
			if (_isInteger( $id )) {
				if ($this->validation()) {
					$fill_data = $this->fill_data();					
					$fill_data['updated_by'] = $id;
					$this->vars['status'] = $this->model->update($id, 'users', $fill_data) ? 'success' : 'error';					
					$this->vars['message'] = $this->vars['status'] == 'success' ? 'updated' : 'not_updated';
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
			'user_full_name' => $this->input->post('user_full_name', true),
			'user_email' => $this->input->post('user_email', true)
		];
	}
	
	/**
	 * Validations Form
	 * @return Boolean
	 */
	private function validation() {
		$id = $this->session->user_id;
		$this->load->library('form_validation');
		$val = $this->form_validation;
		$val->set_rules('user_full_name', 'Nama Lengkap', 'trim|required');
		$val->set_rules('user_email', 'Email', 'trim|required|valid_email|callback_profile_mail_check');
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();
	}
	
	public function profile_mail_check($email) {
		$old_email = get_value('users', 'user_email', 'id', $this->session->user_id);
		$new_email = $this->input->post('user_email', true);
		if($new_email != $old_email){
			$is_exist = $this->model->is_exists('user_email', $email, 'users');
			if ($is_exist) {
				$this->form_validation->set_message('profile_mail_check', '{field} sudah digunakan');
				return FALSE;
			}
		}
		return TRUE;
	}
}
