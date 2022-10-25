<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Pelindung_pantai extends Admin_Controller {

	/**
	 * Class Constructor
	 *
	 * @return Void
	 */
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('date');
		$this->load->model('sda/m_pelindung_pantai');
		$this->pk = M_pelindung_pantai::$pk;
		$this->table = M_pelindung_pantai::$table;
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
		$this->vars['title'] = 'Pelindung pantai';
		$this->vars['sda'] =  $this->vars['pelindung_pantai'] = true;
		$this->vars['content'] = 'sda/pelindung_pantai';

		$this->vars["pelindung_pantai"] = $this->db->get('pelindung_pantai')->result();
		
		// echo json_encode($this->vars["jaringan_irigasi"]);
		$this->load->view('backend/index', $this->vars);
	}

	// public function edit($id) {
	// 	$this->vars['title'] = 'Pelindung pantai';
	// 	$this->vars['sda'] =  $this->vars['dir'] = true;
	// 	$this->vars['content'] = 'sda/edit_pelindung_pantai';
	// 	$data = $this->db->get_where('pelindung_pantai', [
	// 		'id' => $id,
	// 		"tahun" => $this->session->tahun,
	// 		"is_deleted" => 'false'
	// 	])->result();
	// 	if(count($data)>0){
	// 		$this->vars['pelindung_pantai'] = $data;
	// 		$this->load->view('backend/index', $this->vars);
	// 	}else{
	// 		redirect(base_url('sda/pelindung_pantai'), 'refresh');
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
		$sql_total = $this->m_pelindung_pantai->count_all(); // Panggil fungsi count_all pada m_pelindung_pantai
		$sql_data = $this->m_pelindung_pantai->filter($search, $limit, $start, $order_field, $order_ascdesc); // Panggil fungsi filter pada m_pelindung_pantai
        
		$sql_filter = $this->m_pelindung_pantai->count_filter($search); // Panggil fungsi count_filter pada m_pelindung_pantai
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
		$data['nama_pantai'] = $this->input->post('nama_pantai', true);
		$data['wilayah_sungai'] = $this->input->post('wilayah_sungai', true);
		$data['panjang_pantai'] = $this->input->post('panjang_pantai', true);
		$data['panjang_rawan_abrasi'] = $this->input->post('panjang_rawan_abrasi', true);
		$data['konstruksi_seawall'] = $this->input->post('konstruksi_seawall', true);
		$data['panjang_seawall'] = $this->input->post('panjang_seawall', true);
		$data['tinggi_seawall'] = $this->input->post('tinggi_seawall', true);
		$data['kondisi_seawall'] = $this->input->post('kondisi_seawall', true);
		$data['konstruksi_breakwater'] = $this->input->post('konstruksi_breakwater', true);
		$data['panjang_breakwater'] = $this->input->post('panjang_breakwater', true);
		$data['tinggi_breakwater'] = $this->input->post('tinggi_breakwater', true);
		$data['lebar_breakwater'] = $this->input->post('lebar_breakwater', true);
		$data['kondisi_breakwater'] = $this->input->post('kondisi_breakwater', true);
		$data['konstruksi_groin'] = $this->input->post('konstruksi_groin', true);
		$data['tinggi_groin'] = $this->input->post('tinggi_groin', true);
		$data['lebar_groin'] = $this->input->post('lebar_groin', true);
		$data['kondisi_groin'] = $this->input->post('kondisi_groin', true);
		$data['konstruksi_jetty'] = $this->input->post('konstruksi_jetty', true);
		$data['panjang_jetty'] = $this->input->post('panjang_jetty', true);
		$data['kondisi_jetty'] = $this->input->post('kondisi_jetty', true);
		$data['updated_at'] = date('Y-m-d H:i:s');
		$data['updated_by'] = $this->session->user_id;
		
		$this->db->where('id', $id);
		$this->db->update('pelindung_pantai', $data);
		redirect(base_url('sda/pelindung_pantai?success=true'), 'refresh');

	}

	public function deleted(){
		if ($this->input->is_ajax_request()) {
			$id = (int) $this->input->post('id', true);
			$this->db->where('id', $id);
			$data["is_deleted"] = 'true';
			$data["deleted_at"] = date('Y-m-d H:i:s');
			$query = $this->db->update('pelindung_pantai', $data);
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
		$this->vars['title'] = 'Import Data Pelindung pantai';
		$this->vars['sda'] = $this->vars['pelindung_pantai'] = true;
		$this->vars['content'] = 'sda/import_excel_pelindung_pantai';
		$this->load->view('backend/page', $this->vars);
	}

	public function insert_form() {
		$this->vars['title'] = 'Tambah Data Pelindung Pantai';
		$this->vars['content'] = 'sda/insert_pelindung_pantai';
		$this->load->view('backend/page', $this->vars);
	}

	public function edit_form($id) {
		$this->vars['title'] = 'Edit Data Pelindung Pantai';
		$this->vars['content'] = 'sda/edit_pelindung_pantai';
		$data = $this->db->get_where('pelindung_pantai', [
			'id' => $id,
			"tahun" => $this->session->tahun,
			"is_deleted" => 'false'
		])->result();
		$this->vars['pelindung_pantai'] = $data;
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
				if (count($exp) != 21) continue;
				$fill_data = [];
				$fill_data['tahun'] = $this->session->tahun;
                $fill_data['nama_pantai'] = trim($exp[1]);
				$fill_data['wilayah_sungai'] = trim($exp[2]);
				$fill_data['panjang_pantai'] = trim($exp[3]);
				$fill_data['panjang_rawan_abrasi'] = trim($exp[4]);
				$fill_data['konstruksi_seawall'] = trim($exp[5]);
				$fill_data['panjang_seawall'] =  trim($exp[6]);
				$fill_data['tinggi_seawall'] = trim($exp[7]);
				$fill_data['kondisi_seawall'] = trim($exp[8]);
				$fill_data['konstruksi_breakwater'] = trim($exp[9]);
				$fill_data['panjang_breakwater'] = trim($exp[10]);
				$fill_data['tinggi_breakwater'] = trim($exp[11]);
				$fill_data['lebar_breakwater'] = trim($exp[12]);
				$fill_data['kondisi_breakwater'] = trim($exp[13]);
				$fill_data['konstruksi_groin'] = trim($exp[14]);
				$fill_data['tinggi_groin'] = trim($exp[15]);
				$fill_data['lebar_groin'] = trim($exp[16]);
				$fill_data['kondisi_groin'] = trim($exp[17]);
				$fill_data['konstruksi_jetty'] = trim($exp[18]);
				$fill_data['panjang_jetty'] = trim($exp[19]);
				$fill_data['kondisi_jetty'] = trim($exp[20]);

				$fill_data['created_at'] = date('Y-m-d H:i:s');
				$fill_data['created_by'] = $this->session->user_id;
				$query = $this->db->get_where('pelindung_pantai', ["tahun" => $fill_data["tahun"], "nama_pantai" => $fill_data["nama_pantai"]])->result();
				if (count($query)==0) {
					$insert = $this->db->insert('pelindung_pantai', $fill_data);
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
		$fill_data['nama_pantai'] = $this->input->post('nama_pantai');
		$fill_data['wilayah_sungai'] = $this->input->post('wilayah_sungai');
		$fill_data['panjang_pantai'] = $this->input->post('panjang_pantai');
		$fill_data['panjang_rawan_abrasi'] = $this->input->post('panjang_rawan_abrasi');
		$fill_data['konstruksi_seawall'] = $this->input->post('konstruksi_seawall');
		$fill_data['panjang_seawall'] = $this->input->post('panjang_seawall');
		$fill_data['tinggi_seawall'] = $this->input->post('tinggi_seawall');
		$fill_data['kondisi_seawall'] = $this->input->post('kondisi_seawall');
		$fill_data['konstruksi_breakwater'] = $this->input->post('konstruksi_breakwater');
		$fill_data['panjang_breakwater'] = $this->input->post('panjang_breakwater');
		$fill_data['tinggi_breakwater'] = $this->input->post('tinggi_breakwater');
		$fill_data['lebar_breakwater'] = $this->input->post('lebar_breakwater');
		$fill_data['kondisi_breakwater'] = $this->input->post('kondisi_breakwater');
		$fill_data['konstruksi_groin'] = $this->input->post('konstruksi_groin');
		$fill_data['tinggi_groin'] = $this->input->post('tinggi_groin');
		$fill_data['lebar_groin'] = $this->input->post('lebar_groin');
		$fill_data['kondisi_groin'] = $this->input->post('kondisi_groin');
		$fill_data['konstruksi_jetty'] = $this->input->post('konstruksi_jetty');
		$fill_data['panjang_jetty'] = $this->input->post('panjang_jetty');
		$fill_data['kondisi_jetty'] = $this->input->post('kondisi_jetty');
		return $fill_data;
	}

	// /**
	//  * Validations Form
	//  * @param int
	//  * @return Bool
	//  */
	private function validation($id = 0) {
		$this->load->library('form_validation');
		$val = $this->form_validation;
		$val->set_rules('nama_pantai', 'Nama Pantai', "trim|required");
		$val->set_rules('wilayah_sungai', 'Wilayah Sungai', "trim|required");
		$val->set_rules('panjang_pantai', 'Panjang Pantai', "trim|required|numeric");
		$val->set_rules('panjang_rawan_abrasi', 'Panjang Rawan Abrasi', "trim|required|numeric");
		$val->set_rules('konstruksi_seawall', 'Konstruksi Seawall', "trim|required");
		$val->set_rules('panjang_seawall', 'Panjang Seawall', "trim|required|numeric");
		$val->set_rules('tinggi_seawall', 'Tinggi Seawall', "trim|required|numeric");
		$val->set_rules('kondisi_seawall', 'Kondisi Seawall', "trim|required");
		$val->set_rules('konstruksi_breakwater', 'Konstruksi Breakwater', "trim|required");
		$val->set_rules('panjang_breakwater', 'Panjang Breakwater', "trim|required|numeric");
		$val->set_rules('tinggi_breakwater', 'Tinggi Breakwater', "trim|required|numeric");
		$val->set_rules('lebar_breakwater', 'Lebar Breakwater', "trim|required|numeric");
		$val->set_rules('kondisi_breakwater', 'Kondisi Breakwater', "trim|required");
		$val->set_rules('konstruksi_groin', 'Konstruksi Groin', "trim|required");
		$val->set_rules('tinggi_groin', 'Tinggi Groin', "trim|required|numeric");
		$val->set_rules('lebar_groin', 'Lebar Groin', "trim|required|numeric");
		$val->set_rules('kondisi_groin', 'Kondisi Groin', "trim|required");
		$val->set_rules('konstruksi_jetty', 'Konstruksi Jetty', "trim|required");
		$val->set_rules('panjang_jetty', 'Panjang Jetty', "trim|required|numeric");
		$val->set_rules('kondisi_jetty', 'Kondisi Jetty', "trim|required");
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();
	}
}
