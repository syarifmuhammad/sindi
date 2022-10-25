<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Irigasi_rawa extends Admin_Controller {

	/**
	 * Class Constructor
	 *
	 * @return Void
	 */
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('date');
		$this->load->model('sda/m_irigasi_rawa');
		$this->pk = M_irigasi_rawa::$pk;
		$this->table = M_irigasi_rawa::$table;
	}

	/**
	 * Index
	 * @return Void
	 */
	public function mapping($id = null, $iks=false){
		$this->db->distinct();
		$this->db->select('jenis'); 
		if($iks){
			$this->db->where('iks', 1);
		}
		$query = $this->db->get('jaringan_irigasi')->result();
		// $query = $this->db->get('jaringan_irigasi')->result();
		$jaringan_irigasi = array_map(function($v) use ($id, $iks) {
			if($v->jenis=="Dokumentasi"){
				$v->form = "radio";
			}else{
				$v->form = "number";
			}
			if($id!=null){
				$this->db->select('jaringan_irigasi.id as jaringan_id, nama, satuan, kondisi_jaringan_irigasi.jumlah, kondisi_jaringan_irigasi.kondisi_baik, kondisi_jaringan_irigasi.id');
			}else{
				$this->db->select('jaringan_irigasi.id as jaringan_id, nama, satuan');
			}
			$this->db->from("jaringan_irigasi");
			$this->db->where("jenis", $v->jenis);
			if($iks){
				$this->db->where("iks", 1);
			}
			if($id!=null){
				$this->db->join('kondisi_jaringan_irigasi', 'kondisi_jaringan_irigasi.jaringan_id = jaringan_irigasi.id AND kondisi_jaringan_irigasi.irigasi_id='.$id, "left");
			}
			$v->jaringan_irigasi = $this->db->get()->result();
			for($i=0; $i<count($v->jaringan_irigasi); $i++){
				$v->jaringan_irigasi[$i]->name_form = strtolower(str_replace(" ", "_", $v->jaringan_irigasi[$i]->nama));
			}
			return $v;
		}, $query);
		return $jaringan_irigasi;
	}

	public function rata_jaringan($id){
		$this->db->select('count(kondisi_jaringan_irigasi.id) as banyak');
		$this->db->select_sum('kondisi_jaringan_irigasi.kondisi_baik');
		$this->db->from('kondisi_jaringan_irigasi');
		$this->db->join('jaringan_irigasi', 'kondisi_jaringan_irigasi.jaringan_id = jaringan_irigasi.id');
		$this->db->where('jaringan_irigasi.iks', 1);
		$this->db->where('irigasi_id', $id);
		$data = $this->db->get()->row();
		return $data->kondisi_baik/$data->banyak;
	}

	public function index() {
		$this->vars['title'] = 'Irigasi Dan Rawa';
		$this->vars['sda'] =  $this->vars['dir'] = true;
		$this->vars['content'] = 'sda/irigasi_rawa';

		$this->vars["jaringan_irigasi"] = $this->mapping(null, false);
		
		// echo json_encode($this->vars["jaringan_irigasi"]);
		$this->load->view('backend/index', $this->vars);
	}

	public function iks() {
		$this->vars['title'] = 'Indeks Kinerja Sistem Irigasi';
		$this->vars['sda'] =  $this->vars['dir'] = true;
		$this->vars['content'] = 'sda/iks';

		$data = $this->mapping(null, true);
		$this->vars["jumlah_jenis"] = count($data);
		$this->vars['jumlah_jar'] = 0;
		$this->vars["jumlah_jaringan"] = [];
		for($i=0; $i<count($data); $i++){
			array_push($this->vars["jumlah_jaringan"], []);
			for($j=0; $j<count($data[$i]->jaringan_irigasi); $j++){
				array_push($this->vars["jumlah_jaringan"][$i], $j);
				$this->vars['jumlah_jar']++;
			}
		}
		$this->vars["jaringan_irigasi"] = $data;
		// echo json_encode($data);
		
		// echo json_encode($this->vars["jaringan_irigasi"]);
		$this->load->view('backend/index', $this->vars);
	}

	public function insert(){
		$this->vars['title'] = 'Daerah Irigasi Rawa';
		$this->vars['sda'] =  $this->vars['dir'] = true;
		$this->vars['content'] = 'sda/insert_irigasi_rawa';
		$this->vars["jaringan_irigasi"] = $this->mapping();
		$this->load->view('backend/index', $this->vars);
	}

	public function edit($id) {
		$this->vars['title'] = 'Daerah Irigasi Rawa';
		$this->vars['sda'] =  $this->vars['dir'] = true;
		$this->vars['content'] = 'sda/edit_irigasi_rawa';
		$data = $this->db->get_where('irigasi_rawa', [
			'id' => $id,
			"tahun" => $this->session->tahun,
			"is_deleted" => 'false'
		])->result();
		if(count($data)>0){
			$this->vars["jaringan_irigasi"] = $this->mapping($id);
			$this->vars['irigasi'] = $data;
			$this->load->view('backend/index', $this->vars);
		}else{
			redirect(base_url('sda/irigasi_rawa'), 'refresh');
		}

		
		// var_dump($this->vars["irigasi"]);
	}

	public function edit_form_iks($id) {
		$this->vars['title'] = 'Edit Data Indeks Kinerja Sistem Irigasi';
		$this->vars['content'] = 'sda/edit_iks';
		$data = $this->db->get_where('irigasi_rawa', [
			'id' => $id,
			"tahun" => $this->session->tahun,
			"is_deleted" => 'false'
		])->result();
		$this->vars["jaringan_irigasi"] = $this->mapping($id, true);
		$this->vars['irigasi'] = $data;
		$this->load->view('backend/page', $this->vars);
	}

	/**
	 * Pagination
	 * @return Object
	 */
	public function pagination($iks=false) {
		$search = $_POST['search']['value']; // Ambil data yang di ketik user pada textbox pencarian
		$limit = $_POST['length']; // Ambil data limit per page
		$start = $_POST['start']; // Ambil data start
		$order_index = $_POST['order'][0]['column']; // Untuk mengambil index yg menjadi acuan untuk sorting
		$order_field = $_POST['columns'][$order_index]['data']; // Untuk mengambil nama field yg menjadi acuan untuk sorting
		$order_ascdesc = $_POST['order'][0]['dir']; // Untuk menentukan order by "ASC" atau "DESC"
		$sql_total = $this->m_irigasi_rawa->count_all(); // Panggil fungsi count_all pada m_irigasi_rawa
		$sql_data = $this->m_irigasi_rawa->filter($search, $limit, $start, $order_field, $order_ascdesc); // Panggil fungsi filter pada m_irigasi_rawa
		$sql_filter = $this->m_irigasi_rawa->count_filter($search); // Panggil fungsi count_filter pada m_irigasi_rawa
		$start = $this->input->post('start');
		for($i=0; $i<count($sql_data); $i++){
			$sql_data[$i]["index"] = $i+$start+1;
		}
		for($i=0; $i<count($sql_data); $i++){
			$sql_data[$i]["jaringan_irigasi"] = $this->mapping($sql_data[$i]["id"], $iks);
			$sql_data[$i]["rata_jaringan"] = $this->rata_jaringan($sql_data[$i]["id"]);
			$iks = $sql_data[$i]["total_iks"];
			$sql_data[$i]["kategori_iks"] = $iks>=80 ? "SB" : ($iks>=70 ? "B" : ($iks>=55 ? "K" : "J"));
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

	public function save(){
		$fill_data['tahun'] = $this->session->tahun;
		$fill_data['nomenklatur'] = $this->input->post('nomenklatur');
		$fill_data['jenis_daerah'] = $this->input->post('jenis_daerah');
		$fill_data['luas'] = $this->input->post('luas');
		$fill_data['baku'] = $this->input->post('baku');
		$fill_data['potensial'] = $this->input->post('potensial');
		$fill_data['fungsional'] = $this->input->post('fungsional');
		$fill_data['created_at'] = date('Y-m-d H:i:s');
		$fill_data['created_by'] = $this->session->user_id;
		$query = $this->db->get_where('irigasi_rawa', ["tahun" => $fill_data["tahun"],"nomenklatur" => $fill_data["nomenklatur"]])->result();
		if (count($query)==0) {
			$this->db->trans_begin();

			$insert = $this->db->insert('irigasi_rawa', $fill_data);
			$id = $this->db->insert_id();
			$jaringan_irigasi = $this->input->post('jaringan_irigasi');
			// var_dump($jaringan);
			for($i=0; $i<count($jaringan_irigasi); $i++){
				$data_jaringan["irigasi_id"] = $id;
				$data_jaringan["jaringan_id"] = $jaringan_irigasi[$i]['jaringan_id'];
				$data_jaringan["jumlah"] = $jaringan_irigasi[$i]['jumlah'];
				$this->db->insert('kondisi_jaringan_irigasi', $data_jaringan);
			}

			if ($this->db->trans_status() === FALSE)
			{
					$this->db->trans_rollback();
					redirect(base_url('sda/irigasi_rawa?failed=true'), 'refresh');

			}else{
					$this->db->trans_commit();
					redirect(base_url('sda/irigasi_rawa?success=true'), 'refresh');
			}
		} else {
			redirect(base_url('sda/irigasi_rawa/insert?exists=true'), 'refresh');
		}

	}

	public function update(){
		$id = $this->input->post('id');
		$data['nomenklatur'] = $this->input->post('nomenklatur', true);
		$data['jenis_daerah'] = $this->input->post('jenis_daerah', true);
		$data['luas'] = $this->input->post('luas', true);
		$data['baku'] = $this->input->post('baku', true);
		$data['potensial'] = $this->input->post('potensial', true);
		$data['fungsional'] = $this->input->post('fungsional', true);
		$data['updated_at'] = date('Y-m-d H:i:s');
		$data['updated_by'] = $this->session->user_id;
		
		$this->db->where('id', $id);
		$this->db->update('irigasi_rawa', $data);
		$jaringan_irigasi = $this->input->post('jaringan_irigasi');
		for($i=0; $i<count($jaringan_irigasi); $i++){
			$data_jaringan["jumlah"] = $jaringan_irigasi[$i]["jumlah"];
			$this->db->where('id', $jaringan_irigasi[$i]["id"]);
			$this->db->update('kondisi_jaringan_irigasi', $data_jaringan);
		}
		redirect(base_url('sda/irigasi_rawa?success=true'), 'refresh');

	}

	public function edit_iks() {
		if ($this->input->is_ajax_request()) {
			$id = $this->input->get('id');
			$this->db->trans_begin();
			$data['iks_prasarana'] = $this->input->get('iks_prasarana', true);
			$data['iks_produktivitas'] = $this->input->get('iks_produktivitas', true);
			$data['iks_penunjang'] = $this->input->get('iks_penunjang', true);
			$data['iks_organisasi'] = $this->input->get('iks_organisasi', true);
			$data['iks_dokumentasi'] = $this->input->get('iks_dokumentasi', true);
			$data['iks_pppa'] = $this->input->get('iks_pppa', true);
			$data['keterangan'] = $this->input->get('keterangan', true);
			$data['updated_at'] = date('Y-m-d H:i:s');
			$data['updated_by'] = $this->session->user_id;
			
			$this->db->where('id', $id);
			$this->db->update('irigasi_rawa', $data);
			$jaringan_irigasi = $this->input->get('jaringan_irigasi');
			for($i=0; $i<count($jaringan_irigasi); $i++){
				$data_jaringan["kondisi_baik"] = $jaringan_irigasi[$i]["kondisi_baik"];
				$this->db->where('id', $jaringan_irigasi[$i]["id"]);
				$this->db->update('kondisi_jaringan_irigasi', $data_jaringan);
			}

			if ($this->db->trans_status() === FALSE)
			{
					$this->db->trans_rollback();
					$query = false;
			}else{
					$this->db->trans_commit();
					$query = true;
			}
			$this->vars['status'] = $query ? 'success' : 'error';
			$this->vars['message'] = $query ? 'Data berhasil diedit.' : 'Terjadi kesalahan dalam mengedit data';
			$this->output
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($this->vars, JSON_PRETTY_PRINT))
				->_display();
			exit;
		}
	}

	public function deleted(){
		if ($this->input->is_ajax_request()) {
			$id = (int) $this->input->post('id', true);
			$this->db->where('id', $id);
			$data["is_deleted"] = 'true';
			$data["deleted_at"] = date('Y-m-d H:i:s');
			$query = $this->db->update('irigasi_rawa', $data);
			$this->vars['status'] = $query ? 'success' : 'error';
			$this->vars['message'] = $query ? 'Data berhasil dihapus.' : 'Terjadi kesalahan dalam menghapus data';
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
	// public function save() {
	// 	if ($this->input->is_ajax_request()) {
	// 		$id = (int) $this->input->post('id', true);
	// 		if ($this->validation($id)) {
	// 			$fill_data = $this->fill_data($id);
	// 			$fill_data[(_isInteger( $id ) ? 'updated_by' : 'created_by')] = $this->session->user_id;
	// 			if (!_isInteger( $id )) $fill_data['created_at'] = date('Y-m-d H:i:s');
	// 			$query = _isInteger( $id ) ? $this->model->update($id, $this->table, $fill_data) : $this->db->insert($this->table, $fill_data);
	// 			// if($query){
	// 			// 	$jumlah = $this->input->post('jaringan', true);
	// 			// 	$jaringan = [
	// 			// 		"Bendung", "Kantong Lumpur", "Free Intake", "Embung", "Pompa", 
	// 			// 		"Primer", "Sekunder", "Tersier", "Pembuang", "Bangunan Outlet", "Bangunan Bagi",
	// 			// 		"Bangunan Bagi Sadap", "Rumah Pompa", "Mesin", "Pintu Air", "Bangunan Ukur",
	// 			// 		"Mistar Ukur", "Tanggul", "Gorong", "Sipon", "Talang", "Terjun", "Terowongan",
	// 			// 		"Bangunan Pertemuan", "Krib", "Jalan Masuk ke Bangunan Utama/ Pelengkap", "Jalan Inspeksi",
	// 			// 		"Jembatan", "Dermaga", "Kantor Pengamat", "Gudang", "Rumah Jaga", "Peta/ Gambar",
	// 			// 		"Skema Jaringan", "Buku Data Daerah Irigasi"
	// 			// 	];
	// 			// 	for($i=0; $i<count($jaringan); $i++){

	// 			// 	}
	// 			// }

	// 			$this->vars['status'] = $query ? 'success' : 'error';
	// 			$this->vars['message'] = $query ? 'Data berhasil disimpan.' : 'Terjadi kesalahan dalam menyimpan data';
	// 		} else {
	// 			$this->vars['status'] = 'error';
	// 			$this->vars['message'] = validation_errors();
	// 		}
	// 		$this->output
	// 			->set_content_type('application/json', 'utf-8')
	// 			->set_output(json_encode($this->vars, JSON_PRETTY_PRINT))
	// 			->_display();
	// 		exit;
	// 	}
	// }
	public function import() {
		$this->vars['title'] = 'Import Data Irigasi Rawa';
		$this->vars['sda'] = $this->vars['irigasi_rawa'] = true;
		$this->vars['content'] = 'sda/import_excel';
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
				if (count($exp) != 43) continue;
				$fill_data = [];
				$fill_data['tahun'] = $this->session->tahun;
				$fill_data['nomenklatur'] = trim($exp[0].$exp[1]);
				$fill_data['jenis_daerah'] = trim($exp[2]);
				$fill_data['luas'] = trim($exp[3]);
				$fill_data['baku'] = trim($exp[4]);
				$fill_data['potensial'] = trim($exp[5]);
				$fill_data['fungsional'] = trim($exp[6]);
				$fill_data['created_at'] = date('Y-m-d H:i:s');
				$fill_data['created_by'] = $this->session->user_id;
				$query = $this->db->get_where('irigasi_rawa', ["tahun" => $fill_data["tahun"],"nomenklatur" => $fill_data["nomenklatur"]])->result();
				if (count($query)==0) {
					$insert = $this->db->insert('irigasi_rawa', $fill_data);
					if($insert){
						$id = $this->db->insert_id();
						$jaringan = $this->db->get('jaringan_irigasi')->result();
						// var_dump($jaringan);
						for($i=0; $i<count($jaringan); $i++){
							$data_jaringan["irigasi_id"] = $id;
							$data_jaringan["jaringan_id"] = $jaringan[$i]->id;
							if(7+$i>40){
								if($exp[7+$i] == "Ada"){
									$data_jaringan["jumlah"] = 1;	
								}else{
									$data_jaringan["jumlah"] = 0;
								}
							}else{
								$data_jaringan["jumlah"] = trim($exp[7+$i]);
							}
							// var_dump($data_jaringan);
							$this->db->insert('kondisi_jaringan_irigasi', $data_jaringan);
						}
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
	// private function fill_data($id = 0) {
	// 	$data = [];
	// 	$data['tahun'] = $this->session->tahun;
	// 	$data['nomenklatur'] = $this->input->post('nomenklatur', true);
	// 	$data['luas'] = $this->input->post('luas', true);
	// 	$data['baku'] = $this->input->post('baku', true);
	// 	$data['potensial'] = $this->input->post('potensial', true);
	// 	$data['fungsional'] = $this->input->post('fungsional', true);
	// 	$data['baik'] = $this->input->post('baik', true);
	// 	$data['rusak_ringan'] = $this->input->post('rusak_ringan', true);
	// 	$data['rusak_sedang'] = $this->input->post('rusak_sedang', true);
	// 	$data['rusak_berat'] = $this->input->post('rusak_berat', true);
	// 	$data['iks_prasarana'] = $this->input->post('iks_prasarana', true);
	// 	$data['iks_produktivitas'] = $this->input->post('iks_produktivitas', true);
	// 	$data['iks_penunjang'] = $this->input->post('iks_penunjang', true);
	// 	$data['iks_organisasi'] = $this->input->post('iks_organisasi', true);
	// 	$data['iks_dokumentasi'] = $this->input->post('iks_dokumentasi', true);
	// 	$data['iks_pppa'] = $this->input->post('iks_pppa', true);
	// 	return $data;
	// }

	// /**
	//  * Validations Form
	//  * @param int
	//  * @return Bool
	//  */
	// private function validation($id = 0) {
	// 	$this->load->library('form_validation');
	// 	$val = $this->form_validation;
	// 	$val->set_rules('nomenklatur', 'nomenklatur', 'trim|required');
	// 	$val->set_rules('luas', 'luas', 'trim|required|numeric');
	// 	$val->set_rules('baku', 'baku', 'trim|required|numeric');
	// 	$val->set_rules('potensial', 'potensial', 'trim|required|numeric');
	// 	$val->set_rules('fungsional', 'fungsional', 'trim|required|numeric');
	// 	$val->set_rules('baik', 'baik', 'trim|required|numeric');
	// 	$val->set_rules('rusak_ringan', 'rusak_ringan', 'trim|required|numeric');
	// 	$val->set_rules('rusak_sedang', 'rusak_sedang', 'trim|required|numeric');
	// 	$val->set_rules('rusak_berat', 'rusak_berat', 'trim|required|numeric');
	// 	$val->set_rules('iks_prasarana', 'iks_prasarana', 'trim|required|numeric');
	// 	$val->set_rules('iks_produktivitas', 'iks_produktivitas', 'trim|required|numeric');
	// 	$val->set_rules('iks_penunjang', 'iks_penunjang', 'trim|required|numeric');
	// 	$val->set_rules('iks_organisasi', 'iks_organisasi', 'trim|required|numeric');
	// 	$val->set_rules('iks_dokumentasi', 'iks_dokumentasi', 'trim|required|numeric');
	// 	$val->set_rules('iks_pppa', 'iks_pppa', 'trim|required|numeric');
	// 	$val->set_error_delimiters('<div>&sdot; ', '</div>');
	// 	return $val->run();
	// }
	
	// public function set_leader() {
	// 	if ($this->input->is_ajax_request()) {			
	// 		$id = (int) $this->input->post('id', true);
	// 		$unset['leader'] = 'false';
	// 		$do_unset = $this->model->xupdate('leader', 'true', 'daftar_keadaan_guru', $unset);
	// 		if($do_unset){
	// 			$set['leader'] = 'true';
	// 			$do_set = $this->model->xupdate('id', $id, 'daftar_keadaan_guru', $set);
	// 			$this->vars['status'] = $do_set ? 'success' : 'error';
	// 			$this->vars['message'] = $do_set ? 'Pejabat Penandatangan Telah dipilih' : 'Terjadi kesalahan dalam menyimpan data';
	// 		}
			
	// 		$this->output
	// 			->set_content_type('application/json', 'utf-8')
	// 			->set_output(json_encode($this->vars, JSON_PRETTY_PRINT))
	// 			->_display();
	// 		exit;
			
	// 	}
	// }
}
