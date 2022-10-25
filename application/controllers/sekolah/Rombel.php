<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Rombel extends Admin_Controller {

	/**
	 * Class Constructor
	 *
	 * @return Void
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('sekolah/m_rombel');
		$this->pk = M_rombel::$pk;
		$this->table = M_rombel::$table;
	}

	/**
	 * Index
	 * @return Void
	 */
	public function index() {
		$this->vars['title'] = 'Data Rombel';
		$this->vars['rombel'] = true;
		$this->vars['content'] = 'sekolah/rombel';
		$this->load->view('backend/index', $this->vars);
	}

	/**
	 * Pagination
	 * @return Object
	 */
	public function pagination() {
		if ($this->input->is_ajax_request()) {
			$keyword = trim($this->input->post('keyword', true));
			$page_number = (int) $this->input->post('page_number', true);
			$limit = (int) $this->input->post('per_page', true);
			$offset = ($page_number * $limit);
			$query = $this->m_rombel->get_where($keyword, $limit, $offset);
			$total_rows = $this->m_rombel->total_rows($keyword);
			$total_page = $limit > 0 ? ceil($total_rows / $limit) : 1;
			$this->vars['total_page'] = (int) $total_page;
			$this->vars['total_rows'] = (int) $total_rows;
			$this->vars['rows'] = $query->result();
			$this->output
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($this->vars, JSON_PRETTY_PRINT))
				->_display();
			exit;
		}
	}

	/**
	 * Find by ID
	 * @return Object
	 */
	public function find_id() {
		if ($this->input->is_ajax_request()) {
			$id = (int) $this->input->post('id', true);
			$query = _isInteger( $id ) ? $this->model->RowObject($this->pk, $id, $this->table) : [];
			$this->output
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($query, JSON_PRETTY_PRINT))
				->_display();
			exit;
		}
	}

	/**
	 * Save | Update
	 * @return Object
	 */
	public function save() {
		if ($this->input->is_ajax_request()) {
			$id = (int) $this->input->post('id', true);
			if ($this->validation($id)) {
				$fill_data = $this->fill_data($id);
				$fill_data[(_isInteger( $id ) ? 'updated_by' : 'created_by')] = $this->session->user_id;
				if (!_isInteger( $id )) $fill_data['created_at'] = date('Y-m-d H:i:s');
				$query = _isInteger( $id ) ? $this->model->update($id, 'users', $fill_data) : $this->db->insert($this->table, $fill_data);
				$this->vars['status'] = $query ? 'success' : 'error';
				$this->vars['message'] = $query ? 'Data Anda berhasil disimpan.' : 'Terjadi kesalahan dalam menyimpan data';
			} else {
				$this->vars['status'] = 'error';
				$this->vars['message'] = validation_errors();
			}
			$this->output
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($this->vars, JSON_PRETTY_PRINT))
				->_display();
			exit;
		}
	}
	
	 /**
	 * fill_data
	 * @param int
	 * @return array
	 */
	private function fill_data($id = 0) {
		$data = [];
		if (_isInteger( $id )) {
			$username = get_value($this->table, 'user_name', $this->pk, $id);
		} else {
			$username = $this->input->post('user_name', true);
		}
		$data['user_name'] = $username;
		$user_password = $this->input->post('user_password', true);
		if (!empty($user_password)) $data['user_password'] = xpassword($username, $user_password);
		$data['user_group_id'] = 2;
		$data['user_full_name'] = $this->input->post('user_full_name', true);
		return $data;
	}

	/**
	 * Validations Form
	 * @param int
	 * @return Bool
	 */
	private function validation($id = 0) {
		$this->load->library('form_validation');
		$val = $this->form_validation;		
		if (_isInteger( $id )) {
			$val->set_rules('user_password', 'Password', 'trim|min_length[6]');
		} else {
			$val->set_rules('user_password', 'Password', 'trim|required|min_length[6]');
			$val->set_rules('user_name', 'User Name', 'trim|required');
		}
		$val->set_rules('user_full_name', 'Nama Sekolah', 'trim|required');
		$val->set_message('required', '{field} harus diisi');
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();
	}
}
