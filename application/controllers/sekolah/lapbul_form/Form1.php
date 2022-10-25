<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Form1 extends Admin_Controller {

	/**
	 * Class Constructor
	 *
	 * @return Void
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('sekolah/m_lapbul_form1');
		$this->pk = M_lapbul_form1::$pk;
		$this->table = M_lapbul_form1::$table;
	}

	/**
	 * Index
	 * @return Void
	 */
	public function input($id) {
		$this->m_lapbul_form1->lapbul_penerimaan($id);
		$query = $this->model->RowObject('id', $id, 'lapbul_index');
		$this->vars['title'] = 'Form Laporan Bulan '.xbulan($query->bulan);
		$this->vars['sub_title'] = 'Penerimaan Murid Kelas 1 Tahun Pelajaran '.$query->ta;		
		$this->vars['lapbul'] = $this->vars['buatlp'] = true;
		$this->vars['query'] = $query;
		$check['sp_npsn'] = $this->session->user_profile_id;
		$check['tahun'] = $this->session->tahun;
		$check['bulan'] = $query->bulan;
		$this->vars['id'] = $id;
		$this->vars['content'] = 'sekolah/lapbul_form/form1';
		$this->load->view('backend/page', $this->vars);
	}

	/**
	 * Pagination
	 * @return Object
	 */
	public function pagination($id, $pagination='') {
		if ($this->input->is_ajax_request()) {
			$keyword = trim($this->input->post('keyword', true));
			$page_number = (int) $this->input->post('page_number', true);
			$limit = (int) $this->input->post('per_page', true);
			$offset = ($page_number * $limit);
			$query = $this->m_lapbul_form1->get_where($id, $keyword, $limit, $offset);
			$total_rows = $this->m_lapbul_form1->total_rows($id, $keyword);
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
				$query = _isInteger( $id ) ? $this->model->update($id, $this->table, $fill_data) : $this->db->insert($this->table, $fill_data);
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
		$data['sp_npsn'] = $this->session->user_profile_id;
		$data['tahun'] = $this->session->tahun;
		$data['id_index'] =$this->input->post('id_index', true);
		$data['rencana'] = $this->input->post('rencana', true);
		$data['daftar'] = $this->input->post('daftar', true);
		$data['terima'] = $this->input->post('terima', true);
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
		$val->set_rules('rencana', 'Rencana Penerimaan', 'trim|required');
		$val->set_rules('daftar', 'Calon yang mendaftar', 'trim|required');
		$val->set_rules('terima', 'Murid yang diterima', 'trim|required');
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();
	}
}
