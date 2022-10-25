<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Admin_Controller extends MY_Controller {

	/**
	 * Primary key
	 * @var String
	 */
	protected $pk;

	/**
	 * Table
	 * @var String
	 */
	protected $table;

	/**
	 * Class Constructor
	 *
	 * @return Void
	 */
	public function __construct() {
		parent::__construct();

		// Restrict
		$this->auth->restrict();

		// Check privileges Users
		if (!in_array($this->uri->segment(1), $this->session->user_privileges)) {
			redirect(base_url());
		}

		// $this->output->enable_profiler();
	}

	/**
	 * deleted data | SET is_deleted to true
	 */
	public function delete() {
		if ($this->input->is_ajax_request()) {
			$this->vars['status'] = 'warning';
			$this->vars['message'] = 'not_selected';
			$ids = explode(',', $this->input->post($this->pk));
			if (count($ids) > 0) {
				if($this->model->delete($ids, $this->table)) {
					$this->vars = [
						'status' => 'success',
						'message' => 'deleted',
						'id' => $ids
					];
				} else {
					$this->vars = [
						'status' => 'error',
						'message' => 'not_deleted'
					];
				}
			}

			$this->output
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($this->vars, JSON_PRETTY_PRINT))
				->_display();
			exit;
		}
	}

	/**
	 * Restored data | SET is_deleted to false
	 */
	public function restore() {
		if ($this->input->is_ajax_request()) {
			$this->vars['status'] = 'warning';
			$this->vars['message'] = 'not_selected';
			$ids = explode(',', $this->input->post($this->pk));
			if (count($ids) > 0) {
				if($this->model->restore($ids, $this->table)) {
					$this->vars = [
						'status' => 'success',
						'message' => 'restored',
						'id' => $ids
					];
				} else {
					$this->vars = [
						'status' => 'error',
						'message' => 'not_restored'
					];
				}
			}

			$this->output
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($this->vars, JSON_PRETTY_PRINT))
				->_display();
			exit;
		}
	}

	/**
	 * Email Check
	 * @param String
	 * @param Int
	 * @return Boolean
	 */
	public function email_check($str, $id) {
		$query = $this->model->is_email_exist($str, $id);
		if ($query['is_exist'] === TRUE) {
			$this->form_validation->set_message('email_check', 'Email sudah digunakan oleh ' . $query['used_by'] . '. Silahkan gunakan email lain');
			return FALSE;
		}
		return TRUE;
	}
}
