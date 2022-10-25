<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Form_lapbul extends Admin_Controller {

	/**
	 * Class Constructor
	 *
	 * @return Void
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('sekolah/m_lapbul_form');
	}

	/**
	 * Index
	 * @return Void
	 */
	public function buat($id) {
		$this->m_lapbul_form->set_form('lapbul_form1', $id);
		$this->m_lapbul_form->set_form('lapbul_form2', $id);
		$this->m_lapbul_form->set_form('lapbul_form3', $id);
		$this->m_lapbul_form->set_gtk($id);
		$this->vars['title'] = 'Form Laporan Bulanan';
		$this->vars['lapbul'] = $this->vars['buatlp'] = true;
		$this->vars['content'] = 'sekolah/form_lapbul';
		$this->vars['id_index'] = $id;
		$this->vars['query'] = $this->model->RowObject('id', $id, 'lapbul_index');
		$this->vars['form1'] = $this->model->RowObject('id_index', $id, 'lapbul_form1');
		$this->vars['form2'] = $this->model->RowObject('id_index', $id, 'lapbul_form2');
		$this->vars['form3'] = $this->model->RowObject('id_index', $id, 'lapbul_form3');
		$this->vars['daftar_keadaan_guru'] = $this->model->ResultWhere('lapbul_daftar_keadaan_guru', ['sp_npsn','tahun','id_index'], [$this->session->user_profile_id,$this->session->tahun,$id]);
		$this->load->view('backend/page', $this->vars);
	}

	/**
	 * Pagination
	 * @return Object
	 */
	public function pagination() {
		if ($this->input->is_ajax_request()) {
			$this->vars['total_page'] = 0;
			$this->vars['total_rows'] = 0;
			$this->vars['rows'] = [];
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
			$id_index = (int) $this->input->post('id_index', true);
			$data_form1 = $this->data_form1();
			$data_form2 = $this->data_form2();
			$data_form3 = $this->data_form3();
			$data_form1['updated_by'] = $this->session->user_id;
			$data_form2['updated_by'] = $this->session->user_id;
			$data_form3['updated_by'] = $this->session->user_id;
			$jumlah_form1 = $data_form1['form1_3'];
			$jumlah_form2 = $data_form2['form2_9'];
			$jumlah_form3 = $data_form3['form3_5'];
			if($jumlah_form1 == 0){
				$this->vars['status'] = 'error';
				$this->vars['message'] = 'Data Rombongan Belajar belum dimasukkan !';
			} elseif($jumlah_form3 != $jumlah_form2){
				$this->vars['status'] = 'error';
				$this->vars['message'] = 'Jumlah murid berdasarkan umur dan Jumlah Murid berdasarkan Jenis Kelamin tidak sesuai !';
			} else {
				$save_form1 = $this->model->xupdate('id_index', $id_index, 'lapbul_form1', $data_form1);
				$save_form2 = $this->model->xupdate('id_index', $id_index, 'lapbul_form2', $data_form2);
				$save_form3 = $this->model->xupdate('id_index', $id_index, 'lapbul_form3', $data_form3);
				$save_index = $this->model->xupdate('id', $id_index, 'lapbul_index', ['status' => 1]);				
				$this->vars['status'] = 'success';
				$this->vars['message'] = 'Laporan berhasil disimpan.';
			}
			
			$this->output
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($this->vars, JSON_PRETTY_PRINT))
				->_display();
			exit;
		}
	}
	
		
	private function data_form1() {
		$data = [];
		$data['form1_1'] = $this->input->post('form1_1', true);
		$data['form1_2'] = $this->input->post('form1_2', true);
		$data['form1_3'] = $this->input->post('form1_3', true);
		return $data;
	}
	
	private function data_form2() {
		$data = [];
		$data['form2_1'] = $this->input->post('form2_1', true);
		$data['form2_2'] = $this->input->post('form2_2', true);
		$data['form2_3'] = $this->input->post('form2_3', true);
		$data['form2_4'] = $this->input->post('form2_4', true);
		$data['form2_5'] = $this->input->post('form2_5', true);
		$data['form2_6'] = $this->input->post('form2_6', true);
		$data['form2_7'] = $this->input->post('form2_7', true);
		$data['form2_8'] = $this->input->post('form2_8', true);
		$data['form2_9'] = $this->input->post('form2_9', true);
		return $data;
	}
	
	private function data_form3() {
		$data = [];
		$data['form3_1'] = $this->input->post('form3_1', true);
		$data['form3_2'] = $this->input->post('form3_2', true);
		$data['form3_3'] = $this->input->post('form3_3', true);
		$data['form3_4'] = $this->input->post('form3_4', true);
		$data['form3_5'] = $this->input->post('form3_5', true);
		return $data;
	}
	
	private function data_form3_resume() {
		$data = [];
		$data['form3_1'] = $this->input->post('form3_1', true);
		$data['form3_2'] = $this->input->post('form3_2', true);
		$data['form3_3'] = $this->input->post('form3_3', true);
		$data['form3_4'] = $this->input->post('form3_4', true);
		$data['form3_5'] = $this->input->post('form3_5', true);
		$data['form3_6'] = $this->input->post('form3_6', true);		
		$data['form3_53'] = $this->input->post('form3_53', true);
		$data['form3_54'] = $this->input->post('form3_54', true);
		$data['form3_55'] = $this->input->post('form3_55', true);
		$data['form3_56'] = $this->input->post('form3_56', true);
		$data['form3_57'] = $this->input->post('form3_57', true);
		$data['form3_58'] = $this->input->post('form3_58', true);
		$data['form3_59'] = $this->input->post('form3_59', true);
		$data['form3_60'] = $this->input->post('form3_60', true);
		$data['form3_61'] = $this->input->post('form3_61', true);
		$data['form3_62'] = $this->input->post('form3_62', true);
		$data['form3_63'] = $this->input->post('form3_63', true);
		$data['form3_64'] = $this->input->post('form3_64', true);
		return $data;
	}
	
	private function data_form4() {
		$data = [];
		$data['form4_1'] = $this->input->post('form4_1', true);
		$data['form4_2'] = $this->input->post('form4_2', true);
		$data['form4_3'] = $this->input->post('form4_3', true);
		$data['form4_4'] = $this->input->post('form4_4', true);
		$data['form4_5'] = $this->input->post('form4_5', true);
		$data['form4_6'] = $this->input->post('form4_6', true);
		return $data;
	}
	
	private function data_form5() {
		$data = [];
		$data['form5_1'] = $this->input->post('form5_1', true);
		$data['form5_2'] = $this->input->post('form5_2', true);
		$data['form5_3'] = $this->input->post('form5_3', true);
		return $data;
	}
	
	private function data_form6() {
		$data = [];
		$data['form6_1'] = $this->input->post('form6_1', true);
		$data['form6_2'] = $this->input->post('form6_2', true);
		$data['form6_3'] = $this->input->post('form6_3', true);
		return $data;
	}
	
	private function data_form7() {
		$data = [];
		$data['form7_1'] = $this->input->post('form7_1', true);
		$data['form7_2'] = $this->input->post('form7_2', true);
		$data['form7_3'] = $this->input->post('form7_3', true);
		$data['form7_4'] = $this->input->post('form7_4', true);
		$data['form7_5'] = $this->input->post('form7_5', true);
		$data['form7_6'] = $this->input->post('form7_6', true);
		return $data;
	}
	
	private function data_form9() {
		$data = [];
		$data['form9_1'] = $this->input->post('form9_1', true);
		$data['form9_2'] = $this->input->post('form9_2', true);
		return $data;
	}
	
	private function data_form10() {
		$data = [];
		$data['form10_1'] = $this->input->post('form10_1', true);
		$data['form10_2'] = $this->input->post('form10_2', true);
		$data['form10_3'] = $this->input->post('form10_3', true);
		$data['form10_4'] = $this->input->post('form10_4', true);
		return $data;
	}
	
	private function data_form11() {
		$data = [];
		$data['form11_1'] = $this->input->post('form11_1', true);
		$data['form11_2'] = $this->input->post('form11_2', true);
		$data['form11_3'] = $this->input->post('form11_3', true);
		$data['form11_4'] = $this->input->post('form11_4', true);
		return $data;
	}
	
	private function data_form12() {
		$data = [];
		$data['form12_1'] = $this->input->post('form12_1', true);
		$data['form12_2'] = $this->input->post('form12_2', true);
		$data['form12_3'] = $this->input->post('form12_3', true);
		return $data;
	}
	
	private function data_form13() {
		$data = [];
		$data['form13_1'] = $this->input->post('form13_1', true);
		$data['form13_2'] = $this->input->post('form13_2', true);
		$data['form13_3'] = $this->input->post('form13_3', true);
		return $data;
	}
	
	public function data_bulan_lalu($tabel, $bulan) {
		$data = index_sebelum($tabel, $bulan);
		if($data['status'] == 'error'){
			$this->vars['status'] = 'error';
			$this->vars['message'] = 'Data laporan bulan yang lalu tidak ditemukan, silahkan melakukan pengisian data manual pada tabel !';
			$this->vars['data'] = [];
		} else {
			$this->vars['status'] = 'success';
			$this->vars['data'] = $data['data'];
		}
		$this->output
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($this->vars, JSON_PRETTY_PRINT))
			->_display();
		exit;
	}
	
	public function update_gtk() {
		$id_index = (int) $this->input->post('id_index', true);
		$delete = $this->model->delete_permanently(['sp_npsn','tahun','id_index'], [$this->session->user_profile_id,$this->session->tahun,$id_index], 'lapbul_daftar_keadaan_guru');
		if($delete){
			$count_data_gtk = count_where('daftar_keadaan_guru', ['sp_npsn','tahun'], [$this->session->user_profile_id,$this->session->tahun]);
			if($count_data_gtk == 0){
				$this->vars['status'] = 'error';
				$this->vars['message'] = 'Data GTK tidak ditemukan, silahkan input data GTK terlebih dahulu pada menu GTK !';
			} else {
				$list_data_gtk = $this->model->ResultWhere('daftar_keadaan_guru', ['sp_npsn','tahun'], [$this->session->user_profile_id,$this->session->tahun]);
				$data = [];
				foreach($list_data_gtk as $list){
					$data['sp_npsn'] = $this->session->user_profile_id;
					$data['tahun'] = $this->session->tahun;
					$data['id_index'] = $id_index;
					$data['id_gtk'] = $list->id;
					$data['nama'] = $list->nama;
					$data['nip'] = $list->nip;
					$data['nuptk'] = $list->nuptk;
					$data['tmp_lahir'] = $list->tmp_lahir;
					$data['tgl_lahir'] = $list->tgl_lahir;
					$data['jenis_kelamin'] = $list->jenis_kelamin;
					$data['golru'] = $list->golru;
					$data['jab'] = $list->jab;
					$data['ijazah'] = $list->ijazah;
					$data['agama'] = $list->agama;
					$data['tmt'] = $list->tmt;
					$data['mk_tahun'] = $list->mk_tahun;
					$data['mk_bulan'] = $list->mk_bulan;
					$data['mengajar_kel'] = $list->mengajar_kel;
					$data['ket_guru'] = $list->ket_guru;
					$data['created_at'] = date('Y-m-d H:i:s');
					$data['created_by'] = $this->session->user_id;			
					$this->model->insert('lapbul_daftar_keadaan_guru', $data);
				}
				$this->vars['status'] = 'success';
				$this->vars['message'] = 'Data GTK berhasil di perbaharui.';
			}
		}
		$this->output
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($this->vars, JSON_PRETTY_PRINT))
			->_display();
		exit;
	}
	
	public function update_sakit() {
		if ($this->input->is_ajax_request()) {			
			$id = (int) $this->input->post('id', true);
			$data['sakit'] = (int) $this->input->post('jumlah', true);
			$this->model->xupdate('id', $id, 'lapbul_daftar_keadaan_guru', $data);
		}
	}
	
	public function update_izin() {
		if ($this->input->is_ajax_request()) {			
			$id = (int) $this->input->post('id', true);
			$data['izin'] = (int) $this->input->post('jumlah', true);
			$this->model->xupdate('id', $id, 'lapbul_daftar_keadaan_guru', $data);
		}
	}
	
	public function update_alfa() {
		if ($this->input->is_ajax_request()) {			
			$id = (int) $this->input->post('id', true);
			$data['alfa'] = (int) $this->input->post('jumlah', true);
			$this->model->xupdate('id', $id, 'lapbul_daftar_keadaan_guru', $data);
		}
	}
}
