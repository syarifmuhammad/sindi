<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Kibc extends Admin_Controller {

	/**
	 * Class Constructor
	 *
	 * @return Void
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('sekre/aset/m_kib_c');
		$this->pk = M_kib_c::$pk;
		$this->table = M_kib_c::$table;
	}

	/**
	 * Index
	 * @return Void
	 */
	public function index() {
		$this->vars['title'] = 'Data KIB C';
		$this->vars['sub_title'] = 'Gedung dan Bangunan';
		$this->vars['aset'] = $this->vars['kibc'] = true;
		$this->vars['content'] = 'sekre/aset/kibc';
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
			$query = $this->m_kib_c->get_where($keyword, $limit, $offset);
			$total_rows = $this->m_kib_c->total_rows($keyword);
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
		$data['tahun'] 			= $this->session->tahun;
		$data['jenis'] 			= $this->input->post('jenis', true);
		$data['kode'] 			= $this->input->post('kode', true);
		$data['reg'] 			= $this->input->post('reg', true);
		$data['kondisi_bangunan'] 			= $this->input->post('kondisi_bangunan', true);
		$data['bertingkat']	= $this->input->post('bertingkat', true);
		$data['beton'] 			= $this->input->post('beton', true);
		$data['luas_lantai']			= $this->input->post('luas_lantai', true);
		$data['alamat']	= $this->input->post('alamat', true);
		$data['tanggal_dokumen']	= $this->input->post('tanggal_dokumen', true);
		$data['nomor_dokumen']		= $this->input->post('nomor_dokumen', true);
		$data['luas']		= $this->input->post('luas', true);
		$data['status_tanah']			= $this->input->post('status_tanah', true);
		$data['kode_tanah']			= $this->input->post('kode_tanah', true);
		$data['asal_usul']			= $this->input->post('asal_usul', true);
		$data['harga']			= $this->input->post('harga', true);
		$data['keterangan']			= $this->input->post('keterangan', true);
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
		$val->set_rules('jenis', 'Jenis Barang / Nama Barang', 'trim|required');
		$val->set_rules('kode', 'Nomor Kode Barang', 'trim|required');
		$val->set_rules('reg', 'Nomor Register', 'trim|required');
		$val->set_rules('kondisi_bangunan', 'Kondisi Bangunan', 'trim|required');
		$val->set_rules('bertingkat', 'Bertingkat', 'trim|required');
		$val->set_rules('beton', 'Beton', 'trim|required');
		$val->set_rules('luas_lantai', 'Luas Lantai', 'trim|required|numeric');
		$val->set_rules('alamat', 'Letak / Alamat', 'trim|required');
		$val->set_rules('tanggal_dokumen', 'Tanggal Dokumen', 'trim');
		$val->set_rules('nomor_dokumen', 'Nomor Dokumen', 'trim');
		$val->set_rules('luas', 'Luas', 'trim|required|numeric');
		$val->set_rules('status_tanah', 'Status Tanah', 'trim|required');
		$val->set_rules('kode_tanah', 'Kode Tanah', 'trim|required');
		$val->set_rules('asal_usul', 'Asal Usul', 'trim|required');
		$val->set_rules('harga', 'Harga', 'trim|required|numeric');
		$val->set_rules('keterangan', 'Keterangan', 'trim');
		
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();
	}
	
	public function import_excel_form() {
		$this->vars['title'] = 'Import Data KIB C';
		$this->vars['save_action'] = 'sekre/aset/kibc/save_ecxel';
		$this->vars['content'] = 'backend/import_excel';
		$this->load->view('backend/page', $this->vars);
	}
	
	public function save_ecxel() {
		if ($this->input->is_ajax_request()) {
			$rows = explode("\n", $this->input->post('data'));
			$success = $failed = $exist = 0;
			foreach($rows as $row) {
				$exp = explode("\t", $row);
				if (count($exp) != 13) continue;
				$fill_data = [];
				$fill_data['tahun'] 			= $this->session->tahun;
				$fill_data['jenis'] 			= trim($exp[1]);
				$fill_data['kode'] 				= trim($exp[2]);
				$fill_data['reg'] 				= trim($exp[3]);
				$fill_data['kondisi_bangunan'] 	= trim($exp[4]);
				$fill_data['bertingkat']		= trim($exp[5]);
				$fill_data['beton'] 			= trim($exp[6]);
				$fill_data['luas_lantai']		= trim($exp[7]);
				$fill_data['alamat']			= trim($exp[8]);
				$fill_data['tanggal_dokumen']	= trim($exp[9]);
				$fill_data['nomor_dokumen']		= trim($exp[10]);
				$fill_data['luas']				= trim($exp[11]);
				$fill_data['status_tanah']		= trim($exp[12]);
				$fill_data['kode_tanah']		= trim($exp[13]);
				$fill_data['asal_usul']			= trim($exp[14]);
				$fill_data['harga']				= trim($exp[15]);
				$fill_data['keterangan']		= trim($exp[16]);
				$fill_data['created_at'] 		= date('Y-m-d H:i:s');
				$fill_data['created_by'] 		= $this->session->user_id;
				$query = $this->model->is_exists_array(['tahun' => $fill_data['tahun'], 'kode' => $fill_data['kode'], 'reg' => $fill_data['reg']], $this->table);
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
