<?php defined('BASEPATH') OR exit('No direct script access allowed');



class M_irigasi_rawa extends CI_Model {

	/**
	 * Primary key
	 * @var String
	 */
	public static $pk = 'id';

	/**
	 * Table
	 * @var String
	 */
	public static $table = 'irigasi_rawa';

	/**
	 * Class Constructor
	 *
	 * @return Void
	 */
	public function __construct() {
		parent::__construct();
	}

	public function filter($search, $limit, $start, $order_field, $order_ascdesc){
		$this->db->where('tahun', $this->session->tahun);
		$this->db->where('is_deleted', 'false');
		$this->db->select('*, (iks_prasarana+iks_produktivitas+iks_penunjang+iks_organisasi+iks_dokumentasi+iks_pppa) as total_iks');
		if(!empty($search)){
			$this->db->like('nomenklatur', $search); // Untuk menambahkan query where LIKE
		}
		if($order_field != "index"){
			$this->db->order_by($order_field, $order_ascdesc); // Untuk menambahkan query ORDER BY
		}
		$this->db->limit($limit, $start); // Untuk menambahkan query LIMIT
		return $this->db->get('irigasi_rawa')->result_array(); // Eksekusi query sql sesuai kondisi diatas
	  }
	public function count_all(){
		$this->db->where('tahun', $this->session->tahun);
		$this->db->where('is_deleted', 'false');
		return $this->db->count_all('irigasi_rawa'); // Untuk menghitung semua data rawa
	}
	public function count_filter($search){
		$this->db->where('tahun', $this->session->tahun);
		$this->db->where('is_deleted', 'false');
		$this->db->like('nomenklatur', $search); // Untuk menambahkan query where LIKE
		return $this->db->get('irigasi_rawa')->num_rows(); // Untuk menghitung jumlah data sesuai dengan filter pada textbox pencarian
	}
}
