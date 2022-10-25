<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Kibb extends Admin_Controller {

	/**
	 * Class Constructor
	 *
	 * @return Void
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('sekre/aset/m_kib_b');
		$this->pk = M_kib_b::$pk;
		$this->table = M_kib_b::$table;
	}

	/**
	 * Index
	 * @return Void
	 */
	public function index() {
		$this->vars['title'] = 'Data KIB B';
		$this->vars['sub_title'] = 'Peralatan dan Mesin';
		$this->vars['aset'] = $this->vars['kibb'] = true;
		$this->vars['content'] = 'sekre/aset/kibb';
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
			$query = $this->m_kib_b->get_where($keyword, $limit, $offset);
			$total_rows = $this->m_kib_b->total_rows($keyword);
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
		$data 					= [];
		$data['tahun'] 			= $this->session->tahun;
		$data['kode']			= $this->input->post('kode', true);
		$data['nama']			= $this->input->post('nama', true);
		$data['reg']			= $this->input->post('reg', true);
		$data['merk_type']		= $this->input->post('merk_type', true);
		$data['ukuran']			= $this->input->post('ukuran', true);
		$data['bahan']			= $this->input->post('bahan', true);
		$data['th_pembelian']	= $this->input->post('th_pembelian', true);
		$data['no_pabrik']		= $this->input->post('no_pabrik', true);
		$data['no_rangka']		= $this->input->post('no_rangka', true);
		$data['no_mesin']		= $this->input->post('no_mesin', true);
		$data['no_polisi']		= $this->input->post('no_polisi', true);
		$data['no_bpkb']		= $this->input->post('no_bpkb', true);
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
		$val->set_rules('kode', 'Kode Barang', 'trim|required');
		$val->set_rules('nama', 'Jenis Barang / Nama Barang', 'trim|required');
		$val->set_rules('reg', 'Nomor Register', 'trim|required');
		$val->set_rules('merk_type', 'Merk / Type', 'trim|required');
		$val->set_rules('ukuran', 'Ukuran / CC', 'trim');
		$val->set_rules('bahan', 'Bahan', 'trim|required');
		$val->set_rules('th_pembelian', 'Tahun Pembelian', 'trim|required|numeric');
		$val->set_rules('no_pabrik', 'Nomor Pabrik', 'trim');
		$val->set_rules('no_rangka', 'Nomor Rangka', 'trim');
		$val->set_rules('no_mesin', 'Nomor Mesin', 'trim');
		$val->set_rules('no_polisi', 'Nomor Polisi', 'trim');
		$val->set_rules('no_bpkb', 'Nomor BPKB', 'trim');
		$val->set_rules('asal_usul', 'Asal Usul', 'trim|required');
		$val->set_rules('harga', 'Harga', 'trim|required|numeric');
		$val->set_rules('ket', 'Keterangan', 'trim');

		
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();
	}
	
	public function import_excel_form() {
		$this->vars['title'] = 'Import Data KIB B';
		$this->vars['save_action'] = 'sekre/aset/kibb/save_ecxel';
		$this->vars['content'] = 'backend/import_excel';
		$this->load->view('backend/page', $this->vars);
	}
	
	public function save_ecxel() {
		if ($this->input->is_ajax_request()) {
			$rows = explode("\n", $this->input->post('data'));
			$success = $failed = $exist = 0;
			foreach($rows as $row) {
				$exp = explode("\t", $row);
				if (count($exp) != 15) continue;
				$fill_data = [];
				$fill_data['tahun'] 		= $this->session->tahun;
				$fill_data['kode']			= trim($exp[0]);
				$fill_data['nama']			= trim($exp[1]);
				$fill_data['reg']			= trim($exp[2]);
				$fill_data['merk_type']		= trim($exp[3]);
				$fill_data['ukuran']		= trim($exp[4]);
				$fill_data['bahan']			= trim($exp[5]);
				$fill_data['th_pembelian']	= trim($exp[6]);
				$fill_data['no_pabrik']		= trim($exp[7]);
				$fill_data['no_rangka']		= trim($exp[8]);
				$fill_data['no_mesin']		= trim($exp[9]);
				$fill_data['no_polisi']		= trim($exp[10]);
				$fill_data['no_bpkb']		= trim($exp[11]);
				$fill_data['asal_usul']		= trim($exp[12]);
				$fill_data['harga']			= trim($exp[13]);
				$fill_data['ket']			= trim($exp[14]);
				$fill_data['created_at'] 	= date('Y-m-d H:i:s');
				$fill_data['created_by'] 	= $this->session->user_id;
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
