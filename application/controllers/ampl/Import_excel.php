<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Import_excel extends Admin_Controller {

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
		$this->vars['title'] = 'Import Data Infrastruktur Air Minum';
		$this->vars['ampl'] = $this->vars['air_minum'] = true;
		$this->vars['content'] = 'ampl/import_excel';
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
				if (count($exp) != 16) continue;
				$fill_data = [];
				$fill_data['tahun'] = $this->session->tahun;
				$fill_data['kec'] = trim($exp[0]);
				$fill_data['desa'] = trim($exp[1]);
				$fill_data['jp_pedesaan'] = trim($exp[2]);
				$fill_data['jp_perkotaan'] = trim($exp[3]);
				$fill_data['akses_pdam_sr'] = trim($exp[4]);
				$fill_data['akses_pdam_jiwa'] = trim($exp[5]);
				$fill_data['akses_bm_dak_sr'] = trim($exp[6]);
				$fill_data['akses_bm_dak_jiwa'] = trim($exp[7]);
				$fill_data['akses_bm_swadaya_sr'] = trim($exp[8]);
				$fill_data['akses_bm_swadaya_jiwa'] = trim($exp[9]);
				$fill_data['akses_bm_pamsimas_sr'] = trim($exp[10]);
				$fill_data['akses_bm_pamsimas_jiwa'] = trim($exp[11]);
				$fill_data['akses_bm_pnpm_sr'] = trim($exp[12]);
				$fill_data['akses_bm_pnpm_jiwa'] = trim($exp[13]);
				$fill_data['penduduk_akses_perdesaan'] = trim($exp[14]);
				$fill_data['penduduk_akses_perkotaan'] = trim($exp[15]);
				$fill_data['created_at'] = date('Y-m-d H:i:s');
				$fill_data['created_by'] = $this->session->user_id;
				$query = $this->model->is_exists_array(['kec' => $fill_data['kec'], 'desa' => $fill_data['desa']], $table = 'air_minum');
				if (!$query) {
					$this->model->insert('air_minum', $fill_data) ? $success++ : $failed++;
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
