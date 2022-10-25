<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Import_pegawai extends Admin_Controller {

	/**
	 * Class Constructor
	 *
	 * @return Void
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Index
	 * @return Void
	 */
	public function index() {
		$this->vars['title']	= 'Import Data Kepegawaian';
		$this->vars['sekre']	= $this->vars['pegawai'] = true;
		$this->vars['content']	= 'sekre/import_pegawai';
		$this->load->view('backend/page', $this->vars);
	}

	/**
	 * Save
	 */
	public function save() {
		if ($this->input->is_ajax_request()) {
			$rows = explode("\n", $this->input->post('data'));
			$success = $failed = $exist = 0;
			foreach($rows as $row) {
				$exp = explode("\t", $row);
				if (count($exp) != 20) continue;
				$fill_data = [];
				$fill_data['tahun']			= $this->session->tahun;
				$fill_data['nama']			= trim($exp[0]);
				$fill_data['nip']			= trim($exp[1]);
				$fill_data['tempat_lahir']	= trim($exp[2]);
				$fill_data['tanggal_lahir']	= trim($exp[3]);
				$fill_data['pangkat']		= trim($exp[4]);
				$fill_data['golongan']		= trim($exp[5]);
				$fill_data['tmt_gol']		= trim($exp[6]);
				$fill_data['jabatan']		= trim($exp[7]);
				$fill_data['tmt_jabatan']	= trim($exp[8]);
				$fill_data['kerja_tahun']	= trim($exp[9]);
				$fill_data['kerja_bulan']	= trim($exp[10]);
				$fill_data['pendidikan']	= trim($exp[11]);
				$fill_data['tahun_lulus']	= trim($exp[12]);
				$fill_data['sekolah']		= trim($exp[13]);
				$fill_data['lulus_sekolah']	= trim($exp[14]);
				$fill_data['usia_tahun']	= trim($exp[15]);
				$fill_data['usia_bulan']	= trim($exp[16]);
				$fill_data['jenis_kelamin']	= trim($exp[17]);
				$fill_data['agama']			= trim($exp[18]);
				$fill_data['tahun_pensiun']	= trim($exp[19]);
				$fill_data['created_at']	= date('Y-m-d H:i:s');
				$fill_data['created_by']	= $this->session->user_id;
				$query = $this->model->is_exists_array(['nip' => $fill_data['nip'], 'tahun' => $fill_data['tahun']], $table = 'pegawai');
				if (!$query) {
					$this->model->insert('pegawai', $fill_data) ? $success++ : $failed++;
				} else {
					$exist++;
				}
			}
			$this->vars['status']	= 'info';
			$this->vars['message']	= 'Success : ' . $success. ' rows, Failed : '. $failed .', Exist : ' . $exist;
			$this->output
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($this->vars, JSON_PRETTY_PRINT))
				->_display();
			exit;
		}
	}
}
