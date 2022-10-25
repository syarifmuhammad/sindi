<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Bangunan_gedung extends Admin_Controller {

	/**
	 * Class Constructor
	 *
	 * @return Void
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('bgjk/m_bangunan_gedung');
		$this->pk = M_bangunan_gedung::$pk;
		$this->table = M_bangunan_gedung::$table;
	}

	/**
	 * Index
	 * @return Void
	 */
	public function index() {
		$this->vars['title'] = 'Data Infrastruktur Bangunan Gedung';
		$this->vars['bgjk'] =  $this->vars['bangunan_gedung'] = true;
		$this->vars['content'] = 'bgjk/bangunan_gedung';
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
			$query = $this->m_bangunan_gedung->get_where($keyword, $limit, $offset);
			$total_rows = $this->m_bangunan_gedung->total_rows($keyword);
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
		$data['lokasi_jalan'] 				= $this->input->post('lokasi_jalan', true);
		$data['lokasi_desa'] 				= $this->input->post('lokasi_desa', true);
		$data['lokasi_kecamatan'] 			= $this->input->post('lokasi_kecamatan', true);
		$data['koor_x'] 					= $this->input->post('koor_x', true);
		$data['koor_y'] 					= $this->input->post('koor_y', true);
		$data['fungsi'] 					= $this->input->post('fungsi', true);
		$data['klas_kompleksitas'] 			= $this->input->post('klas_kompleksitas', true);
		$data['klas_permanensi'] 			= $this->input->post('klas_permanensi', true);
		$data['klas_tingkat_risiko'] 		= $this->input->post('klas_tingkat_risiko', true);
		$data['klas_tingkat_kepadatan'] 	= $this->input->post('klas_tingkat_kepadatan', true);
		$data['klas_kepemilikan'] 			= $this->input->post('klas_kepemilikan', true);
		$data['jumlah_lantai'] 				= $this->input->post('jumlah_lantai', true);
		$data['luas_lantai'] 				= $this->input->post('luas_lantai', true);
		$data['luas_tanah'] 				= $this->input->post('luas_tanah', true);
		$data['imb_no'] 					= $this->input->post('imb_no', true);
		$data['imb_tgl'] 					= $this->input->post('imb_tgl', true);
		$data['imb_penerbit'] 				= $this->input->post('imb_penerbit', true);
		$data['slf_no'] 					= $this->input->post('slf_no', true);
		$data['slf_tgl'] 					= $this->input->post('slf_tgl', true);
		$data['slf_penerbit'] 				= $this->input->post('slf_penerbit', true);
		$data['kondisi'] 					= $this->input->post('kondisi', true);
		$data['pemilik'] 					= $this->input->post('pemilik', true);
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
		$val->set_rules('nama', 'Nama Bangunan Gedung', 'trim|required');
		$val->set_rules('lokasi_jalan', 'Jalan', 'trim|required');
		$val->set_rules('lokasi_desa', 'Desa', 'trim|required');
		$val->set_rules('lokasi_kecamatan', 'Kecamatan', 'trim|required');
		$val->set_rules('koor_x', 'Koordinat (X)', 'trim|numeric');
		$val->set_rules('koor_y', 'Koordinat (Y)', 'trim|numeric');
		$val->set_rules('fungsi', 'Fungsi', 'trim|required');
		$val->set_rules('klas_kompleksitas', 'Kompleksitas', 'trim|required');
		$val->set_rules('klas_permanensi', 'Permanensi', 'trim|required');
		$val->set_rules('klas_tingkat_risiko', 'Tingkat Risiko thd Bahaya Kebakaran', 'trim|required');
		$val->set_rules('klas_tingkat_kepadatan', 'Tingkat Kepadatan Lokasi BG', 'trim|required');
		$val->set_rules('klas_kepemilikan', 'Kepemilikan', 'trim|required');
		$val->set_rules('jumlah_lantai', 'Jumlah Lantai', 'trim|required|numeric');
		$val->set_rules('luas_lantai', 'Luas Lantai (m2)', 'trim|required|numeric');
		$val->set_rules('luas_tanah', 'Luas Tanah (m2)', 'trim|required|numeric');
		$val->set_rules('kondisi', 'Kondisi', 'trim|required');
		$val->set_rules('pemilik', 'Pemilik', 'trim|required');
		
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();
	}
	
	public function import_excel_form() {
		$this->vars['title'] = 'Import Data Infrastruktur Bangunan Gedung';
		$this->vars['ampl'] = $this->vars['air_minum'] = true;
		$this->vars['save_action'] = 'bgjk/bangunan_gedung/save_ecxel';
		$this->vars['content'] = 'backend/import_excel';
		$this->load->view('backend/page', $this->vars);
	}
	
	public function save_ecxel() {
		if ($this->input->is_ajax_request()) {
			$rows = explode("\n", $this->input->post('data'));
			$success = $failed = $exist = 0;
			foreach($rows as $row) {
				$exp = explode("\t", $row);
				if (count($exp) != 23) continue;
				$fill_data = [];
				$fill_data['tahun'] 					= $this->session->tahun;
				$fill_data['nama'] 						= trim($exp[0]);
				$fill_data['lokasi_jalan'] 				= trim($exp[1]);
				$fill_data['lokasi_desa'] 				= trim($exp[2]);
				$fill_data['lokasi_kecamatan'] 			= trim($exp[3]);
				$fill_data['koor_x'] 					= str_replace(",",".",trim($exp[4]));
				$fill_data['koor_y'] 					= str_replace(",",".",trim($exp[5]));
				$fill_data['fungsi'] 					= trim($exp[6]);
				$fill_data['klas_kompleksitas'] 		= trim($exp[7]);
				$fill_data['klas_permanensi'] 			= trim($exp[8]);
				$fill_data['klas_tingkat_risiko'] 		= trim($exp[9]);
				$fill_data['klas_tingkat_kepadatan'] 	= trim($exp[10]);
				$fill_data['klas_kepemilikan'] 			= trim($exp[11]);
				$fill_data['jumlah_lantai'] 			= trim($exp[12]);
				$fill_data['luas_lantai'] 				= str_replace(",",".",trim($exp[13]));
				$fill_data['luas_tanah'] 				= str_replace(",",".",trim($exp[14]));
				$fill_data['imb_no'] 					= trim($exp[15]);
				$fill_data['imb_tgl'] 					= trim($exp[16]);
				$fill_data['imb_penerbit'] 				= trim($exp[17]);
				$fill_data['slf_no'] 					= trim($exp[18]);
				$fill_data['slf_tgl'] 					= trim($exp[19]);
				$fill_data['slf_penerbit'] 				= trim($exp[20]);
				$fill_data['kondisi'] 					= trim($exp[21]);
				$fill_data['pemilik'] 					= trim($exp[22]);
				$fill_data['created_at'] 				= date('Y-m-d H:i:s');
				$fill_data['created_by'] 				= $this->session->user_id;
				$query = $this->model->is_exists_array(['nama' => $fill_data['nama'], 'lokasi_jalan' => $fill_data['lokasi_jalan'], 'lokasi_desa' => $fill_data['lokasi_desa'], 'lokasi_kecamatan' => $fill_data['lokasi_kecamatan'], 'tahun' => $fill_data['tahun']], $this->table);
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
