<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Data_gtk extends Admin_Controller {

	/**
	 * Class Constructor
	 *
	 * @return Void
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('sekolah/m_data_gtk');
		$this->pk = M_data_gtk::$pk;
		$this->table = M_data_gtk::$table;
	}

	/**
	 * Index
	 * @return Void
	 */
	public function index() {
		$this->vars['title'] = 'Data GTK';
		$this->vars['gtk'] =  true;
		$this->vars['content'] = 'sekolah/data_gtk';
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
			$query = $this->m_data_gtk->get_where($keyword, $limit, $offset);
			$total_rows = $this->m_data_gtk->total_rows($keyword);
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
		$data['sp_npsn'] = $this->session->user_profile_id;
		$data['tahun'] = $this->session->tahun;
		$data['nama'] =$this->input->post('nama', true);
		$data['nip'] = $this->input->post('nip', true);
		$data['nuptk'] = $this->input->post('nuptk', true);
		$data['tmp_lahir'] = $this->input->post('tmp_lahir', true);
		$data['tgl_lahir'] = $this->input->post('tgl_lahir', true);
		$data['jenis_kelamin'] = $this->input->post('jenis_kelamin', true);
		$data['golru'] = $this->input->post('golru', true);
		$data['jab'] = $this->input->post('jab', true);
		$data['ijazah'] = $this->input->post('ijazah', true);
		$data['agama'] = $this->input->post('agama', true);
		$data['tmt'] = $this->input->post('tmt', true);
		$data['mk_tahun'] = $this->input->post('mk_tahun', true);
		$data['mk_bulan'] = $this->input->post('mk_bulan', true);
		$data['mengajar_kel'] = $this->input->post('mengajar_kel', true);
		$data['ket_guru'] = $this->input->post('ket_guru', true);
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
		$val->set_rules('nama', 'Nama', 'trim|required');
		if($this->input->post('nip', true) == ''){
			$val->set_rules('nuptk', 'NUPTK', 'trim|required');
		}
		if($this->input->post('nuptk', true) == ''){
			$val->set_rules('nip', 'NIP', 'trim|required');
		}
		$val->set_rules('tmp_lahir', 'Tempat Lahir', 'trim|required');
		$val->set_rules('tgl_lahir', 'Tanggal Lahir', 'trim|required');
		$val->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required');
		if($this->input->post('nip', true) != ''){
			$val->set_rules('golru', 'Golongan/Ruang', 'trim|required');
		}
		$val->set_rules('jab', 'Jabatan', 'trim|required');
		$val->set_rules('ijazah', 'Ijazah Terakhir', 'trim|required');
		$val->set_rules('agama', 'Agama', 'trim|required');
		$val->set_rules('tmt', 'Tgl. Mulai Bekerja di Sekolah ini', 'trim|required');
		$val->set_rules('mk_tahun', 'Masa Kerja Tahun', 'trim|required');
		$val->set_rules('mk_bulan', 'Masa Kerja Bulan', 'trim|required');
		$val->set_rules('mengajar_kel', 'Mengajar Kelompok', 'trim|required');
		$val->set_rules('ket_guru', 'Keterangan Guru', 'trim|required');
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
