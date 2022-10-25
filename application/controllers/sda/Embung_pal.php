<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Embung_pal extends Admin_Controller {

	/**
	 * Class Constructor
	 *
	 * @return Void
	 */
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('date');
		$this->load->model('sda/m_embung_pal');
		$this->pk = M_embung_pal::$pk;
		$this->table = M_embung_pal::$table;
	}

	/**
	 * Index
	 * @return Void
	 */
	// public function mapping($id = null){
	// 	$this->db->distinct();
	// 	$this->db->select('jenis'); 
	// 	$query = $this->db->get('jaringan_irigasi')->result();
	// 	$jaringan_irigasi = array_map(function($v) use ($id) {
	// 		if($v->jenis=="Dokumentasi"){
	// 			$v->form = "radio";
	// 		}else{
	// 			$v->form = "number";
	// 		}
	// 		if($id!=null){
	// 			$this->db->select('jaringan_irigasi.id as jaringan_id, nama, satuan, kondisi_jaringan_irigasi.jumlah, kondisi_jaringan_irigasi.id');
	// 		}else{
	// 			$this->db->select('jaringan_irigasi.id as jaringan_id, nama, satuan');
	// 		}
	// 		$this->db->from("jaringan_irigasi");
	// 		$this->db->where("jenis", $v->jenis);
	// 		if($id!=null){
	// 			$this->db->join('kondisi_jaringan_irigasi', 'kondisi_jaringan_irigasi.jaringan_id = jaringan_irigasi.id AND kondisi_jaringan_irigasi.irigasi_id='.$id, "left");
	// 		}
	// 		$v->jaringan_irigasi = $this->db->get()->result();
	// 		for($i=0; $i<count($v->jaringan_irigasi); $i++){
	// 			$v->jaringan_irigasi[$i]->name_form = strtolower(str_replace(" ", "_", $v->jaringan_irigasi[$i]->nama));
	// 		}
	// 		return $v;
	// 	}, $query);
	// 	return $jaringan_irigasi;
	// }

	public function index() {
		$this->vars['title'] = 'Embung & PAL';
		$this->vars['sda'] =  $this->vars['embung_pal'] = true;
		$this->vars['content'] = 'sda/embung_pal';

		$this->vars["embung_pal"] = $this->db->get_where('embung_pal', [
			"tahun" => $this->session->tahun,
			"is_deleted" => 'false'
		])->result();
		
		// echo json_encode($this->vars["jaringan_irigasi"]);
		$this->load->view('backend/index', $this->vars);
	}

	public function edit($id) {
		$this->vars['title'] = 'Embung & PAL';
		$this->vars['sda'] =  $this->vars['dir'] = true;
		$this->vars['content'] = 'sda/edit_embung_pal';
		$data = $this->db->get_where('embung_pal', [
			"id" => $id,
			"tahun" => $this->session->tahun,
			"is_deleted" => 'false'
		])->result();
		if(count($data)>0){
			$this->vars['embung_pal'] = $data;
			$this->load->view('backend/index', $this->vars);
		}else{
			redirect(base_url('sda/embung_pal'), 'refresh');
		}

		
		// var_dump($this->vars["irigasi"]);
	}

	/**
	 * Pagination
	 * @return Object
	 */
	public function pagination() {
		$search = $_POST['search']['value']; // Ambil data yang di ketik user pada textbox pencarian
		$limit = $_POST['length']; // Ambil data limit per page
		$start = $_POST['start']; // Ambil data start
		$order_index = $_POST['order'][0]['column']; // Untuk mengambil index yg menjadi acuan untuk sorting
		$order_field = $_POST['columns'][$order_index]['data']; // Untuk mengambil nama field yg menjadi acuan untuk sorting
		$order_ascdesc = $_POST['order'][0]['dir']; // Untuk menentukan order by "ASC" atau "DESC"
		$sql_total = $this->m_embung_pal->count_all(); // Panggil fungsi count_all pada m_embung_pal
		$sql_data = $this->m_embung_pal->filter($search, $limit, $start, $order_field, $order_ascdesc); // Panggil fungsi filter pada m_embung_pal
        
		$sql_filter = $this->m_embung_pal->count_filter($search); // Panggil fungsi count_filter pada m_embung_pal
		$start = $this->input->post('start');
		for($i=0; $i<count($sql_data); $i++){
			$sql_data[$i]["index"] = $i+$start+1;
		}
		$callback = array(
			'draw'=>$_POST['draw'], // Ini dari datatablenya
			'recordsTotal'=>$sql_total,
			'recordsFiltered'=>$sql_filter,
			'data'=>$sql_data
		);
		header('Content-Type: application/json');
		echo json_encode($callback); // Convert array $callback ke json
	}

	public function update(){
		$id = $this->input->post('id');
		$data['nama_bangunan'] = $this->input->post('nama_bangunan', true);
		$data['wilayah_sungai'] = $this->input->post('wilayah_sungai', true);
		$data['das'] = $this->input->post('das', true);
		$data['sungai'] = $this->input->post('sungai', true);
		$data['kab_kec'] = $this->input->post('kab_kec', true);
		$data['lat'] = $this->input->post('lat', true);
		$data['lng'] = $this->input->post('lng', true);
		$data['luas_genangan'] = $this->input->post('luas_genangan', true);
		$data['air_baku'] = $this->input->post('air_baku', true);
		$data['irigasi'] = $this->input->post('irigasi', true);
		$data['reduksi_banjir'] = $this->input->post('reduksi_banjir', true);
		$data['tahun_dibangun'] = $this->input->post('tahun_dibangun', true);
		$data['pengelola'] = $this->input->post('pengelola', true);
		$data['keterangan'] = $this->input->post('keterangan', true);
		
		$this->db->where('id', $id);
		$this->db->update('embung_pal', $data);
		redirect(base_url('sda/embung_pal?success=true'), 'refresh');

	}

	public function deleted(){
		if ($this->input->is_ajax_request()) {
			$id = (int) $this->input->post('id', true);
			$this->db->where('id', $id);
			$data["is_deleted"] = 'true';
			$data["deleted_at"] = date('Y-m-d H:i:s');
			$query = $this->db->update('embung_pal', $data);
			$this->vars['status'] = $query ? 'success' : 'error';
			$this->vars['message'] = $query ? 'Data berhasil dihapus.' : 'Terjadi kesalahan dalam menghapus data';
			$this->output
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($this->vars, JSON_PRETTY_PRINT))
				->_display();
			exit;
		}
	}

	public function insert_ajax() {
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

	public function import() {
		$this->vars['title'] = 'Import Data Embung & PAL';
		$this->vars['sda'] = $this->vars['embung_pal'] = true;
		$this->vars['content'] = 'sda/import_excel_embung';
		$this->load->view('backend/page', $this->vars);
	}
	
	public function insert_form() {
		$this->vars['title'] = 'Tambah Data Embung & PAL';
		$this->vars['content'] = 'sda/insert_embung_pal';
		$this->load->view('backend/page', $this->vars);
	}

	public function edit_form($id) {
		$this->vars['title'] = 'Edit Data Embung & PAL';
		$this->vars['content'] = 'sda/edit_embung_pal';
		$data = $this->db->get_where('embung_pal', [
			"id" => $id,
			"tahun" => $this->session->tahun,
			"is_deleted" => 'false'
		])->result();
		$this->vars['embung_pal'] = $data;
		$this->load->view('backend/page', $this->vars);
	}

	/**
	 * Save
	 */
	public function importing() {
		if ($this->input->is_ajax_request()) {
			$rows = explode("\n", $this->input->post('data'));
			$success = $failed = $exist = 0;
			foreach($rows as $row) {
				$exp = explode("\t", $row);
				if (count($exp) != 14) continue;
				$fill_data = [];
				$fill_data['tahun'] = $this->session->tahun;
                $fill_data['nama_bangunan'] = trim($exp[0]);
                $fill_data['wilayah_sungai'] = trim($exp[1]);
                $fill_data['das'] = trim($exp[2]);
                $fill_data['sungai'] = trim($exp[3]);
                $fill_data['kab_kec'] = trim($exp[4]);
                $fill_data['lat'] = trim($exp[5]);
                $fill_data['lng'] = trim($exp[6]);
                $fill_data['luas_genangan'] = trim($exp[7]);
                $fill_data['air_baku'] = trim($exp[8]);
                $fill_data['irigasi'] = trim($exp[9]);
                $fill_data['reduksi_banjir'] = trim($exp[10]);
                $fill_data['tahun_dibangun'] = trim($exp[11]);
                $fill_data['pengelola'] = trim($exp[12]);
                $fill_data['keterangan'] = trim($exp[13]);
				$fill_data['created_at'] = date('Y-m-d H:i:s');
				$fill_data['created_by'] = $this->session->user_id;
				$query = $this->db->get_where('embung_pal', ["tahun" => $fill_data["tahun"], "nama_bangunan" => $fill_data["nama_bangunan"], "sungai" => $fill_data["sungai"]])->result();
				if (count($query)==0) {
					$insert = $this->db->insert('embung_pal', $fill_data);
					if($insert){
						$success++;
					}else{
						$failed++;
					}
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
	
	private function fill_data($id = 0) {
		$data = [];
		$data['tahun'] = $this->session->tahun;
		$data['nama_bangunan'] = $this->input->post('nama_bangunan', true);
		$data['wilayah_sungai'] = $this->input->post('wilayah_sungai', true);
		$data['das'] = $this->input->post('das', true);
		$data['sungai'] = $this->input->post('sungai', true);
		$data['kab_kec'] = $this->input->post('kab_kec', true);
		$data['lat'] = $this->input->post('lat', true);
		$data['lng'] = $this->input->post('lng', true);
		$data['luas_genangan'] = $this->input->post('luas_genangan', true);
		$data['air_baku'] = $this->input->post('air_baku', true);
		$data['irigasi'] = $this->input->post('irigasi', true);
		$data['reduksi_banjir'] = $this->input->post('reduksi_banjir', true);
		$data['tahun_dibangun'] = $this->input->post('tahun_dibangun', true);
		$data['pengelola'] = $this->input->post('pengelola', true);
		$data['keterangan'] = $this->input->post('keterangan', true);
		return $data;
	}

	// /**
	//  * Validations Form
	//  * @param int
	//  * @return Bool
	//  */
	private function validation($id = 0) {
		$this->load->library('form_validation');
		$val = $this->form_validation;
		$val->set_rules('nama_bangunan', 'Nama Bangunan', 'trim|required');
		$val->set_rules('tahun_dibangun', 'Tahun Dibangun', 'trim|required|numeric');
		$val->set_rules('pengelola', 'Pengelola', 'trim|required');
		$val->set_rules('keterangan', 'Keterangan', 'trim');
		$val->set_rules('wilayah_sungai', 'Wilayah Sungai', 'trim|required');
		$val->set_rules('das', 'DAS', 'trim|required');
		$val->set_rules('sungai', 'Sungai', 'trim|required');
		$val->set_rules('kab_kec', 'Kab/Kec', 'trim|required');
		$val->set_rules('lat', 'Kordinat X', 'trim');
		$val->set_rules('lng', 'Kordinat Y', 'trim');
		$val->set_rules('luas_genangan', 'Luas Genangan Muka Air Normal', 'trim|required|numeric');
		$val->set_rules('air_baku', 'Air Baku', 'trim|required|numeric');
		$val->set_rules('irigasi', 'Irigasi', 'trim|required|numeric');
		$val->set_rules('reduksi_banjir', 'Reduksi Banjir', 'trim|required|numeric');

		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();
	}
}
