<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Pegawai extends Admin_Controller {

	/**
	 * Class Constructor
	 *
	 * @return Void
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('sekre/m_pegawai');
		$this->pk = M_pegawai::$pk;
		$this->table = M_pegawai::$table;
	}

	/**
	 * Index
	 * @return Void
	 */
	public function index() {
		$this->vars['title'] = 'Kepegawaian';
		$this->vars['sekre'] =  $this->vars['pegawai'] = true;
		$this->vars['content'] = 'sekre/pegawai';
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
			$query = $this->m_pegawai->get_where($keyword, $limit, $offset);
			$total_rows = $this->m_pegawai->total_rows($keyword);
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
		$data = [];
		$data['tahun']          = $this->session->tahun;
		$data['nama']           = $this->input->post('nama', true);
		$data['nip']            = $this->input->post('nip', true);
		$data['tempat_lahir']	= $this->input->post('tempat_lahir', true);
		$data['tanggal_lahir']	= $this->input->post('tanggal_lahir', true);
		$data['pangkat']        = $this->input->post('pangkat', true);
		$data['golongan']       = $this->input->post('golongan', true);
		$data['tmt_gol']        = $this->input->post('tmt_gol', true);
		$data['jabatan']        = $this->input->post('jabatan', true);
		$data['tmt_jabatan']	= $this->input->post('tmt_jabatan', true);
		$data['kerja_tahun']	= $this->input->post('kerja_tahun', true);
		$data['kerja_bulan']	= $this->input->post('kerja_bulan', true);
		$data['pendidikan']     = $this->input->post('pendidikan', true);
		$data['tahun_lulus']	= $this->input->post('tahun_lulus', true);
		$data['sekolah']        = $this->input->post('sekolah', true);
		$data['lulus_sekolah']	= $this->input->post('lulus_sekolah', true);
		$data['usia_tahun']     = $this->input->post('usia_tahun', true);
		$data['usia_bulan']     = $this->input->post('usia_bulan', true);
		$data['jenis_kelamin']	= $this->input->post('jenis_kelamin', true);
		$data['agama']          = $this->input->post('agama', true);
		$data['tahun_pensiun']	= $this->input->post('tahun_pensiun', true);
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
		$val->set_rules('nama', 'Pola Ruang RTRW', 'trim|required');
        $val->set_rules('nip', 'Luas (Ha)', 'trim|required');
		$val->set_rules('tempat_lahir', 'Persentase (%)', 'trim|required');
		$val->set_rules('tanggal_lahir', 'Persentase (%)', 'trim|required');
		$val->set_rules('pangkat', 'Persentase (%)', 'trim|required');
		$val->set_rules('golongan', 'Persentase (%)', 'trim|required');
		$val->set_rules('tmt_gol', 'TMT Gol. Ruang', 'trim|required');
		$val->set_rules('jabatan', 'Jabatan', 'trim|required');
		$val->set_rules('tmt_jabatan', 'TMT Jabatan', 'trim|required');
		$val->set_rules('kerja_tahun', 'Masa Kerja Tahun', 'trim|required');
		$val->set_rules('kerja_bulan', 'Masa Kerja Bulan', 'trim|required');
		$val->set_rules('pendidikan', 'Nama Pendidikan', 'trim|required');
		$val->set_rules('tahun_lulus', 'Tahun Lulus Pendidikan', 'trim|required');
		$val->set_rules('sekolah', 'Nama Sekolah', 'trim|required');
		$val->set_rules('lulus_sekolah', 'Tahun Lulus Sekolah', 'trim|required');
		$val->set_rules('usia_tahun', 'Usia Tahun', 'trim|required');
		$val->set_rules('usia_bulan', 'Usia Bulan', 'trim|required');
		$val->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required');
		$val->set_rules('agama', 'Agama', 'trim|required');
		$val->set_rules('tahun_pensiun', 'Tahun Pensiun', 'trim|required');
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();
	}
	
	public function set_leader() {
		if ($this->input->is_ajax_request()) {			
			$id = (int) $this->input->post('id', true);
			$unset['leader'] = 'false';
			$do_unset = $this->model->xupdate('leader', 'true', 'daftar_keadaan_guru', $unset);
			if($do_unset){
				$set['leader'] = 'true';
				$do_set = $this->model->xupdate('id', $id, 'daftar_keadaan_guru', $set);
				$this->vars['status'] = $do_set ? 'success' : 'error';
				$this->vars['message'] = $do_set ? 'Pejabat Penandatangan Telah dipilih' : 'Terjadi kesalahan dalam menyimpan data';
			}
			
			$this->output
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($this->vars, JSON_PRETTY_PRINT))
				->_display();
			exit;
			
		}
	}
}
