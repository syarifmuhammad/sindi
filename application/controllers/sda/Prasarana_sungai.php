<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Prasarana_sungai extends Admin_Controller {

	/**
	 * Class Constructor
	 *
	 * @return Void
	 */
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('date');
		$this->load->model('sda/m_prasarana_sungai');
		$this->pk = M_prasarana_sungai::$pk;
		$this->table = M_prasarana_sungai::$table;
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
		$this->vars['title'] = 'Prasarana Sungai';
		$this->vars['sda'] =  $this->vars['prasarana_sungai'] = true;
		$this->vars['content'] = 'sda/prasarana_sungai';

		$this->vars["prasarana_sungai"] = $this->db->get('prasarana_sungai')->result();
		
		// echo json_encode($this->vars["jaringan_irigasi"]);
		$this->load->view('backend/index', $this->vars);
	}

	// public function edit($id) {
	// 	$this->vars['title'] = 'Prasarana Sungai';
	// 	$this->vars['sda'] =  $this->vars['dir'] = true;
	// 	$this->vars['content'] = 'sda/edit_prasarana_sungai';
	// 	$data = $this->db->get_where('prasarana_sungai', [
	// 		'id' => $id,
	// 		'tahun' => $this->session->tahun,
	// 		'is_deleted' => 'false'
	// 	])->result();
	// 	if(count($data)>0){
	// 		$this->vars['prasarana_sungai'] = $data;
	// 		$this->load->view('backend/index', $this->vars);
	// 	}else{
	// 		redirect(base_url('sda/prasarana_sungai'), 'refresh');
	// 	}

		
	// 	// var_dump($this->vars["irigasi"]);
	// }

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
		$sql_total = $this->m_prasarana_sungai->count_all(); // Panggil fungsi count_all pada m_prasarana_sungai
		$sql_data = $this->m_prasarana_sungai->filter($search, $limit, $start, $order_field, $order_ascdesc); // Panggil fungsi filter pada m_prasarana_sungai
        $start = $this->input->post('start');
		for($i=0; $i<count($sql_data); $i++){
			$sql_data[$i]["index"] = $i+$start+1;
		}
		$sql_filter = $this->m_prasarana_sungai->count_filter($search); // Panggil fungsi count_filter pada m_prasarana_sungai
		$callback = array(
			'draw'=>$_POST['draw'], // Ini dari datatablenya
			'recordsTotal'=>$sql_total,
			'recordsFiltered'=>$sql_filter,
			'data'=>$sql_data
		);
		header('Content-Type: application/json');
		echo json_encode($callback); // Convert array $callback ke json
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

	public function update(){
		$id = $this->input->post('id');
		$data['nama_sungai'] = $this->input->post('nama_sungai', true);
		$data['wilayah_sungai'] = $this->input->post('wilayah_sungai', true);
		$data['das'] = $this->input->post('das', true);
		$data['panjang_sungai'] = $this->input->post('panjang_sungai', true);
		$data['konstruksi_perkuatan_tebing'] = $this->input->post('konstruksi_perkuatan_tebing', true);
		$data['panjang_perkuatan_tebing'] = $this->input->post('panjang_perkuatan_tebing', true);
		$data['tinggi_perkuatan_tebing'] = $this->input->post('tinggi_perkuatan_tebing', true);
		$data['kondisi_perkuatan_tebing'] = $this->input->post('kondisi_perkuatan_tebing', true);
		$data['konstruksi_tanggul'] = $this->input->post('konstruksi_tanggul', true);
		$data['panjang_tanggul'] = $this->input->post('panjang_tanggul', true);
		$data['tinggi_tanggul'] = $this->input->post('tinggi_tanggul', true);
		$data['lebar_tanggul'] = $this->input->post('lebar_tanggul', true);
		$data['kondisi_tanggul'] = $this->input->post('kondisi_tanggul', true);
		$data['konstruksi_dam'] = $this->input->post('konstruksi_dam', true);
		$data['tinggi_dam'] = $this->input->post('tinggi_dam', true);
		$data['lebar_dam'] = $this->input->post('lebar_dam', true);
		$data['kondisi_dam'] = $this->input->post('kondisi_dam', true);
		$data['konstruksi_pintu_air'] = $this->input->post('konstruksi_pintu_air', true);
		$data['kondisi_pintu_air'] = $this->input->post('kondisi_pintu_air', true);
		$data['updated_at'] = date('Y-m-d H:i:s');
		$data['updated_by'] = $this->session->user_id;
		$this->db->where('id', $id);
		$this->db->update('prasarana_sungai', $data);
		redirect(base_url('sda/prasarana_sungai?success=true'), 'refresh');

	}

	public function deleted(){
		if ($this->input->is_ajax_request()) {
			$id = (int) $this->input->post('id', true);
			$this->db->where('id', $id);
			$data["is_deleted"] = 'true';
			$data["deleted_at"] = date('Y-m-d H:i:s');
			$query = $this->db->update('prasarana_sungai', $data);
			$this->vars['status'] = $query ? 'success' : 'error';
			$this->vars['message'] = $query ? 'Data berhasil dihapus.' : 'Terjadi kesalahan dalam menghapus data';		
			$this->output
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($this->vars, JSON_PRETTY_PRINT))
				->_display();
			exit;
		}
	}

	public function import() {
		$this->vars['title'] = 'Import Data Prasarana Sungai';
		$this->vars['sda'] = $this->vars['prasarana_sungai'] = true;
		$this->vars['content'] = 'sda/import_excel_prasarana_sungai';
		$this->load->view('backend/page', $this->vars);
	}

	public function insert_form() {
		$this->vars['title'] = 'Tambah Data Prasarana Sungai';
		$this->vars['content'] = 'sda/insert_prasarana_sungai';
		$this->load->view('backend/page', $this->vars);
	}

	public function edit_form($id) {
		$this->vars['title'] = 'Edit Data Prasarana Sungai';
		$this->vars['content'] = 'sda/edit_prasarana_sungai';
		$data = $this->db->get_where('prasarana_sungai', [
			'id' => $id,
			'tahun' => $this->session->tahun,
			'is_deleted' => 'false'
		])->result();
		$this->vars['prasarana_sungai'] = $data;
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
				if (count($exp) != 19) continue;
				$fill_data = [];
				$fill_data['tahun'] = $this->session->tahun;
                $fill_data['nama_sungai'] = trim($exp[0]);
				$fill_data['wilayah_sungai'] = trim($exp[1]);
				$fill_data['das'] = trim($exp[2]);
				$fill_data['panjang_sungai'] = trim($exp[3]);
				$fill_data['konstruksi_perkuatan_tebing'] = trim($exp[4]);
				$fill_data['panjang_perkuatan_tebing'] =  trim($exp[5]);
				$fill_data['tinggi_perkuatan_tebing'] = trim($exp[6]);
				$fill_data['kondisi_perkuatan_tebing'] = trim($exp[7]);
				$fill_data['konstruksi_tanggul'] = trim($exp[8]);
				$fill_data['panjang_tanggul'] = trim($exp[9]);
				$fill_data['tinggi_tanggul'] = trim($exp[10]);
				$fill_data['lebar_tanggul'] = trim($exp[11]);
				$fill_data['kondisi_tanggul'] = trim($exp[12]);
				$fill_data['konstruksi_dam'] = trim($exp[13]);
				$fill_data['tinggi_dam'] = trim($exp[14]);
				$fill_data['lebar_dam'] = trim($exp[15]);
				$fill_data['kondisi_dam'] = trim($exp[16]);
				$fill_data['konstruksi_pintu_air'] = trim($exp[17]);
				$fill_data['kondisi_pintu_air'] = trim($exp[18]);

				$fill_data['created_at'] = date('Y-m-d H:i:s');
				$fill_data['created_by'] = $this->session->user_id;
				$query = $this->db->get_where('prasarana_sungai', ["tahun" => $fill_data["tahun"], "nama_sungai" => $fill_data["nama_sungai"]])->result();
				if (count($query)==0) {
					$insert = $this->db->insert('prasarana_sungai', $fill_data);
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
		$fill_data = [];
		$fill_data['tahun'] = $this->session->tahun;
		$fill_data['nama_sungai'] = $this->input->post('nama_sungai');
		$fill_data['wilayah_sungai'] = $this->input->post('wilayah_sungai');
		$fill_data['das'] = $this->input->post('das');
		$fill_data['panjang_sungai'] = $this->input->post('panjang_sungai');
		$fill_data['konstruksi_perkuatan_tebing'] = $this->input->post('konstruksi_perkuatan_tebing');
		$fill_data['panjang_perkuatan_tebing'] = $this->input->post('panjang_perkuatan_tebing');
		$fill_data['tinggi_perkuatan_tebing'] = $this->input->post('tinggi_perkuatan_tebing');
		$fill_data['kondisi_perkuatan_tebing'] = $this->input->post('kondisi_perkuatan_tebing');
		$fill_data['konstruksi_tanggul'] = $this->input->post('konstruksi_tanggul');
		$fill_data['panjang_tanggul'] = $this->input->post('panjang_tanggul');
		$fill_data['tinggi_tanggul'] = $this->input->post('tinggi_tanggul');
		$fill_data['lebar_tanggul'] = $this->input->post('lebar_tanggul');
		$fill_data['kondisi_tanggul'] = $this->input->post('kondisi_tanggul');
		$fill_data['konstruksi_dam'] = $this->input->post('konstruksi_dam');
		$fill_data['tinggi_dam'] = $this->input->post('tinggi_dam');
		$fill_data['lebar_dam'] = $this->input->post('lebar_dam');
		$fill_data['kondisi_dam'] = $this->input->post('kondisi_dam');
		$fill_data['konstruksi_pintu_air'] = $this->input->post('konstruksi_pintu_air');
		$fill_data['kondisi_pintu_air'] = $this->input->post('kondisi_pintu_air');
		return $fill_data;
	}

	private function validation($id = 0) {
		$this->load->library('form_validation');
		$val = $this->form_validation;
		$val->set_rules('nama_sungai', 'Nama Sungai', "trim|required");
		$val->set_rules('wilayah_sungai', 'Wilayah Sungai', "trim|required");
		$val->set_rules('das', 'DAS', "trim|required");
		$val->set_rules('panjang_sungai', 'Panjang Sungai', "trim|required|numeric");
		$val->set_rules('konstruksi_perkuatan_tebing', 'Konstruksi Perkuatan Tebing', "trim|required");
		$val->set_rules('panjang_perkuatan_tebing', 'Panjang Perkuatan Tebing', "trim|required|numeric");
		$val->set_rules('tinggi_perkuatan_tebing', 'Tinggi Perkutan Tebing', "trim|required|numeric");
		$val->set_rules('kondisi_perkuatan_tebing', 'Kondisi Perkuatan Tebing', "trim|required");
		$val->set_rules('konstruksi_tanggul', 'Konstruksi Tanggul', "trim|required");
		$val->set_rules('panjang_tanggul', 'Panjang Tanggul', "trim|required|numeric");
		$val->set_rules('tinggi_tanggul', 'Tinggi Tanggul', "trim|required|numeric");
		$val->set_rules('lebar_tanggul', 'Lebar Tanggul', "trim|required|numeric");
		$val->set_rules('kondisi_tanggul', 'Kondisi Tanggul', "trim|required");
		$val->set_rules('konstruksi_dam', 'Konstruksi Dam', "trim|required");
		$val->set_rules('tinggi_dam', 'Tinggi Dam', "trim|required|numeric");
		$val->set_rules('lebar_dam', 'Lebar Dam', "trim|required|numeric");
		$val->set_rules('kondisi_dam', 'Kondisi Dam', "trim|required");
		$val->set_rules('konstruksi_pintu_air', 'Konstruksi Pintu Air', "trim|required");
		$val->set_rules('kondisi_pintu_air', 'Kondisi Pintu Air', "trim|required");
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();
	}
}
