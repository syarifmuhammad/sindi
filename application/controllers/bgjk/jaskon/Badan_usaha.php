<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Badan_usaha extends Admin_Controller {

	/**
	 * Class Constructor
	 *
	 * @return Void
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('bgjk/jaskon/m_badan_usaha');
		$this->pk = M_badan_usaha::$pk;
		$this->table = M_badan_usaha::$table;
	}

	/**
	 * Index
	 * @return Void
	 */
	public function index() {
		$this->vars['title'] = 'Data Badan Usaha Jasa Konstruksi';
		$this->vars['bgjk'] =  $this->vars['jaskon'] = $this->vars['badan_usaha'] = true;
		$this->vars['content'] = 'bgjk/jaskon/badan_usaha';
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
			$query = $this->m_badan_usaha->get_where($keyword, $limit, $offset);
			$total_rows = $this->m_badan_usaha->total_rows($keyword);
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
				$this->vars['message'] = $query ? 'Data berhasil disimpan.' : 'Terjadi kesalahan dalam menyimpan data';
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
		$data 								= [];
		$data['tahun'] 						= $this->session->tahun;
		$data['nama'] 						= $this->input->post('nama', true);
		$data['jenis'] 						= $this->input->post('jenis', true);
		$data['sifat'] 						= $this->input->post('sifat', true);
		$data['no_izin'] 					= $this->input->post('no_izin', true);
		$data['tgl_izin'] 					= $this->input->post('tgl_izin', true);
		$data['penerbit_izin'] 				= $this->input->post('penerbit_izin', true);
		$data['no_sbu'] 					= $this->input->post('no_sbu', true);
		$data['tgl_sbu'] 					= $this->input->post('tgl_sbu', true);
		$data['penerbit_sbu'] 				= $this->input->post('penerbit_sbu', true);
		$data['kualifikasi'] 				= $this->input->post('kualifikasi', true);
		$data['penanggung_jawab'] 			= $this->input->post('penanggung_jawab', true);
		$data['penanggung_jawab_teknis']	= $this->input->post('penanggung_jawab_teknis', true);
		$data['alamat'] 					= $this->input->post('alamat', true);
		$data['email'] 						= $this->input->post('email', true);
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
		$val->set_rules('nama', 'Nama Badan Usaha Jasa Konstruksi', 'trim|required');
		$val->set_rules('jenis', 'Jenis Usaha', 'trim|required');
		$val->set_rules('sifat', 'Sifat Klasifikasi Usaha', 'trim|required');
		$val->set_rules('no_izin', 'Nomor Izin Usaha', 'trim|required');
		$val->set_rules('tgl_izin', 'Tanggal Izin Usaha', 'trim|required');
		$val->set_rules('penerbit_izin', 'Penerbit Izin Usaha', 'trim|required');
		$val->set_rules('no_sbu', 'Nomor SBU', 'trim|required');
		$val->set_rules('tgl_sbu', 'Tanggal SBU', 'trim|required');
		$val->set_rules('penerbit_sbu', 'Penerbit SBU', 'trim|required');
		$val->set_rules('kualifikasi', 'Kualifikasi', 'trim|required');
		$val->set_rules('penanggung_jawab', 'Penanggung Jawab', 'trim|required');
		$val->set_rules('penanggung_jawab_teknis', 'Penanggung Jawab Teknis', 'trim|required');
		$val->set_rules('alamat', 'Alamat', 'trim|required');
		
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();
	}
	
	public function import_excel_form() {
		$this->vars['title'] = 'Import Data Badan Usaha Jasa Konstruksi';
		$this->vars['save_action'] = 'bgjk/jaskon/badan_usaha/save_ecxel';
		$this->vars['content'] = 'backend/import_excel';
		$this->load->view('backend/page', $this->vars);
	}
	
	public function save_ecxel() {
		if ($this->input->is_ajax_request()) {
			$rows = explode("\n", $this->input->post('data'));
			$success = $failed = $exist = 0;
			foreach($rows as $row) {
				$exp = explode("\t", $row);
				if (count($exp) != 14) continue;
				$fill_data = [];
				$fill_data['tahun'] 					= $this->session->tahun;
				$fill_data['nama'] 						= trim($exp[0]);
				$fill_data['jenis'] 					= trim($exp[1]);
				$fill_data['sifat'] 					= trim($exp[2]);
				$fill_data['no_izin'] 					= trim($exp[3]);
				$fill_data['tgl_izin'] 					= trim($exp[4]);
				$fill_data['penerbit_izin'] 			= trim($exp[5]);
				$fill_data['no_sbu'] 					= trim($exp[6]);
				$fill_data['tgl_sbu'] 					= trim($exp[7]);
				$fill_data['penerbit_sbu'] 				= trim($exp[8]);
				$fill_data['kualifikasi'] 				= trim($exp[9]);
				$fill_data['penanggung_jawab'] 			= trim($exp[10]);
				$fill_data['penanggung_jawab_teknis']	= trim($exp[11]);
				$fill_data['alamat'] 					= trim($exp[12]);
				$fill_data['email'] 					= trim($exp[13]);
				$fill_data['created_at'] 				= date('Y-m-d H:i:s');
				$fill_data['created_by'] 				= $this->session->user_id;
				$query = $this->model->is_exists_array(['tahun' => $fill_data['tahun'], 'nama' => $fill_data['nama'], 'no_izin' => $fill_data['no_izin']], $this->table);
				if (!$query) {
					$this->model->insert($this->table, $fill_data) ? $success++ : $failed++;
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
