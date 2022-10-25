<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Lapbul_create extends Admin_Controller {

	/**
	 * Class Constructor
	 *
	 * @return Void
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('sekolah/m_lapbul');
		$this->pk = M_lapbul::$pk;
		$this->table = M_lapbul::$table;
	}

	/**
	 * Index
	 * @return Void
	 */
	public function index() {
		$this->vars['title'] = 'Laporan Bulanan';
		$this->vars['lapbul'] = $this->vars['buatlp'] = true;
		$this->vars['bulan'] = json_encode( bulan_dropdown(), JSON_HEX_APOS | JSON_HEX_QUOT);
		$this->vars['tahun_ajaran'] = json_encode( tahun_ajaran(), JSON_HEX_APOS | JSON_HEX_QUOT);
		$this->vars['content'] = 'sekolah/lapbul_create';
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
			$query = $this->m_lapbul->get_where($keyword, $limit, $offset);
			$total_rows = $this->m_lapbul->total_rows($keyword);
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
				$check['sp_npsn'] = $this->session->user_profile_id;
				$check['tahun'] = $this->session->tahun;
				$check['bulan'] = $this->input->post('bulan', true);
				if($this->model->is_exists_array($check, $this->table)){
					$this->vars['status'] = 'error';
					$this->vars['message'] = 'Tidak dapat membuat laporan untuk bulan yang sudah dilaporkan !';
				} else {
					$query = _isInteger( $id ) ? $this->model->update($id, $this->table, $fill_data) : $this->db->insert($this->table, $fill_data);
					$this->vars['status'] = $query ? 'success' : 'error';
					$this->vars['message'] = $query ? 'Data Anda berhasil disimpan.' : 'Terjadi kesalahan dalam menyimpan data';
				}				
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
		$data['bulan'] = $this->input->post('bulan', true);
		// $data['ta'] = $this->input->post('ta', true);
		$data['ta'] = ptahun_ajaran($this->input->post('bulan', true));
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
		// $val->set_rules('ta', 'Tahun Ajaran', 'trim|required');
		$val->set_rules('bulan', 'Bulan', 'trim|required');
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();
	}
	
	public function cetak_lapbul() {
		if ($this->input->is_ajax_request()) {
			$this->load->library('pdf');
			$tanggal = $this->input->post('tanggal', true);
			$id = $this->input->post('id', true);
			$query = $this->model->RowObject($this->pk, $id, $this->table);
			$data['tanggal'] = $tanggal;
			$data['lapbul_index'] = $this->model->ResultWhere('lapbul_index', 'id', $id);
			$data['form1'] = $this->model->ResultWhere('lapbul_form1', 'id_index', $id);
			$data['form2'] = $this->model->ResultWhere('lapbul_form2', 'id_index', $id);
			$data['form3'] = $this->model->ResultWhere('lapbul_form3', 'id_index', $id);
			$data['daftar_keadaan_guru'] = $this->model->ResultWhere('lapbul_daftar_keadaan_guru', 'id_index', $id);
			$data['pejabat'] = $this->model->ResultWhere('daftar_keadaan_guru', 'leader', 'true');
			$folder = 'LAPBUL';
			$file_name = 'LAPBUL'.$this->session->user_name.$this->session->tahun.$query->bulan;
			$template = 'cetak_lapbul';
			$html = $this->load->view('sekolah/'.$template,$data,true);
			// DOMPDF
			
			$this->pdf->loadHtml($html);
			$customPaper = array(0,0,812.60,1247.24);
			$this->pdf->set_paper($customPaper,'landscape');
			$this->pdf->get_canvas()->get_cpdf()->setEncryption('','Kotabaru123',array('copy','print','add','modify'));
			$this->pdf->get_canvas()->get_cpdf()->encrypted=true;			
			$this->pdf->render();
			$canvas = $this->pdf->get_canvas();
			$font = $this->pdf->getFontMetrics()->get_font("helvetica", "normal");
			$txtHeight = $this->pdf->getFontMetrics()->get_font_height($font, 8);
			$w = $canvas->get_width();
			$h = $canvas->get_height();
			$y = $h - 2 * $txtHeight - 10;
			$color = array(0, 0, 0);
			$text = "Printed by : E-LOLA GTK";
			$width = $this->pdf->getFontMetrics()->get_text_width($text, $font, 8);
			$canvas->page_text($w - $width - 16, $y, $text, $font, 8);
			$canvas->page_text(16, $y, 'Halaman : {PAGE_NUM} / {PAGE_COUNT}', $font, 8, array(0,0,0));
			
			$output = $this->pdf->output();
			file_put_contents(FCPATH . 'media_library/'.$folder.'/'.$file_name, $output);					
			
			$this->vars['status'] = 'success';
			$this->vars['file_name'] = $file_name;
			$this->vars['folder'] = $folder;
			$this->vars['message'] = 'Data berhasil di cetak.';
			$this->output
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($this->vars, JSON_PRETTY_PRINT))
				->_display();
			exit;
		}
	}
	
	public function upload() {
		if ($this->input->is_ajax_request()) {
			$id = (int) $this->input->post('id', true);
			if (_isInteger( $id )) {
				$query = $this->model->RowObject($this->pk, $id, $this->table);
				$file_name = $query->file;
				$config['upload_path'] = './media_library/lapbul_upload/';
				$config['allowed_types'] = 'pdf';
				$config['overwrite'] = TRUE;
				$config['file_name'] = 'LAPBUL'.$this->session->user_name.$this->session->tahun.$query->bulan;
				$config['max_size'] = 0;
				$config['remove_spaces'] = TRUE;
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('file') ) {
					$this->vars['status'] = 'error';
					$this->vars['message'] = $this->upload->display_errors();
				} else {
					$file = $this->upload->data();
					$update = $this->model->update($id, $this->table, ['file' => $file['raw_name'], 'status' => 2]);
					if ($update) {
						// chmood new file
						@chmod(FCPATH.'media_library/lapbul_upload/'.$file['file_name'], 0777);
						// chmood old file
						@chmod(FCPATH.'media_library/lapbul_upload/'.$file_name, 0777);
						// unlink old file
						@unlink(FCPATH.'media_library/lapbul_upload/'.$file_name);
						
						rename(FCPATH.'media_library/lapbul_upload/'.$file['file_name'], FCPATH.'media_library/lapbul_upload/'.$file['raw_name']);
						
					}
					$this->vars['status'] = 'success';
					$this->vars['message'] = 'uploaded';
				}
			} else {
				$this->vars['status'] = 'error';
				$this->vars['message'] = 'ID bukan merupakan tipe angka yang valid !';
			}

			$this->output
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($this->vars, JSON_HEX_APOS | JSON_HEX_QUOT))
				->_display();
			exit;
		}
	}
	
	public function preview() {
		if ($this->input->is_ajax_request()) {
			$id = (int) $this->input->post('id', true);
			$query = $this->model->RowObject($this->pk, $id, $this->table);
			if (_isInteger( $id )) {
				$folder = 'lapbul_upload';
				$file_name = $query->file;
				$this->vars['status'] = 'success';
				$this->vars['file_name'] = $file_name;
				$this->vars['folder'] = $folder;
				$this->vars['message'] = 'Data ditampilkan.';
			} else {
				$this->vars['status'] = 'error';
				$this->vars['message'] = 'File tidak ditemukan!';
			}
			$this->output
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($this->vars, JSON_PRETTY_PRINT))
				->_display();
			exit;
		}
	}
	
	public function xfinal() {
		if ($this->input->is_ajax_request()) {			
			$id = (int) $this->input->post('id', true);
			$data['status'] = 3;
			$update = $this->model->xupdate('id', $id, 'lapbul_index', $data);
			if($update){
				$this->vars['status'] = 'success';
				$this->vars['message'] = 'Berhasil merubah status laporan!';
			} else {
				$this->vars['status'] = 'error';
				$this->vars['message'] = 'Gagal merubah status laporan';
			}
			$this->output
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($this->vars, JSON_PRETTY_PRINT))
				->_display();
			exit;
		}
	}
	
	public function send() {
		if ($this->input->is_ajax_request()) {			
			$id = (int) $this->input->post('id', true);
			$data['status'] = 4;
			$update = $this->model->xupdate('id', $id, 'lapbul_index', $data);
			if($update){
				$this->vars['status'] = 'success';
				$this->vars['message'] = 'Berhasil mengirim laporan!';
			} else {
				$this->vars['status'] = 'error';
				$this->vars['message'] = 'Gagal mengirim laporan';
			}
			$this->output
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($this->vars, JSON_PRETTY_PRINT))
				->_display();
			exit;
		}
	}
}
