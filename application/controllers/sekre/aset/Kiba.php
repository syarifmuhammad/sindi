<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Kiba extends Admin_Controller {

	/**
	 * Class Constructor
	 *
	 * @return Void
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('sekre/aset/m_kib_a');
		$this->pk = M_kib_a::$pk;
		$this->table = M_kib_a::$table;
	}

	/**
	 * Index
	 * @return Void
	 */
	public function index() {
		$this->vars['title'] = 'Data KIB A';
		$this->vars['sub_title'] = 'Tanah';
		$this->vars['aset'] = $this->vars['kiba'] = true;
		$this->vars['content'] = 'sekre/aset/kiba';
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
			$query = $this->m_kib_a->get_where($keyword, $limit, $offset);
			$total_rows = $this->m_kib_a->total_rows($keyword);
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
		$data['luas'] 			= $this->input->post('luas', true);
		$data['th_pengadaan']	= $this->input->post('th_pengadaan', true);
		$data['letak'] 			= $this->input->post('letak', true);
		$data['hak']			= $this->input->post('hak', true);
		$data['tgl_sertifikat']	= $this->input->post('tgl_sertifikat', true);
		$data['no_sertifikat']	= $this->input->post('no_sertifikat', true);
		$data['penggunaan']		= $this->input->post('penggunaan', true);
		$data['asal_usul']		= $this->input->post('asal_usul', true);
		$data['harga']			= $this->input->post('harga', true);
		$data['ket']			= $this->input->post('ket', true);
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
		$val->set_rules('luas', 'Luas', 'trim|required|numeric');
		$val->set_rules('th_pengadaan', 'Tahun Pengadaan', 'trim|required|numeric');
		$val->set_rules('letak', 'Letak / Alamat', 'trim|required');
		$val->set_rules('hak', 'Hak', 'trim|required');
		$val->set_rules('tgl_sertifikat', 'Tanggal Sertifikat', 'trim');
		$val->set_rules('no_sertifikat', 'Nomor Sertifikat', 'trim');
		$val->set_rules('penggunaan', 'Penggunaan', 'trim|required');
		$val->set_rules('asal_usul', 'Asal Usul', 'trim|required');
		$val->set_rules('harga', 'Harga', 'trim|required|numeric');
		$val->set_rules('ket', 'Keterangan', 'trim');
		
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();
	}
	
	public function import_excel_form() {
		$this->vars['title'] = 'Import Data KIB A';
		$this->vars['save_action'] = 'sekre/aset/kiba/save_ecxel';
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
				$fill_data['jenis'] 			= trim($exp[0]);
				$fill_data['kode'] 				= trim($exp[1]);
				$fill_data['reg'] 				= trim($exp[2]);
				$fill_data['luas'] 				= trim($exp[3]);
				$fill_data['th_pengadaan'] 		= trim($exp[4]);
				$fill_data['letak'] 			= trim($exp[5]);
				$fill_data['hak'] 				= trim($exp[6]);
				$fill_data['tgl_sertifikat']	= trim($exp[7]);
				$fill_data['no_sertifikat']		= trim($exp[8]);
				$fill_data['penggunaan'] 		= trim($exp[9]);
				$fill_data['asal_usul']			= trim($exp[10]);
				$fill_data['harga'] 			= trim($exp[11]);
				$fill_data['ket']				= trim($exp[12]);
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
