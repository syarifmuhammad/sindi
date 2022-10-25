<?php defined('BASEPATH') OR exit('No direct script access allowed');



class M_embung_pal extends CI_Model {

	/**
	 * Primary key
	 * @var String
	 */
	public static $pk = 'id';

	/**
	 * Table
	 * @var String
	 */
	public static $table = 'embung_pal';

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
		if(!empty($search)){
			$this->db->like('nama_bangunan', $search); // Untuk menambahkan query where LIKE
		}
		if($order_field!="index"){
			$this->db->order_by($order_field, $order_ascdesc); // Untuk menambahkan query ORDER BY
		}
		$this->db->limit($limit, $start); // Untuk menambahkan query LIMIT
		return $this->db->get('embung_pal')->result_array(); // Eksekusi query sql sesuai kondisi diatas
	  }
	public function count_all(){
		$this->db->where('tahun', $this->session->tahun);
		$this->db->where('is_deleted', 'false');
		return $this->db->count_all('embung_pal'); // Untuk menghitung semua data rawa
	}
	public function count_filter($search){
		$this->db->where('tahun', $this->session->tahun);
		$this->db->where('is_deleted', 'false');
		$this->db->like('nama_bangunan', $search); // Untuk menambahkan query where LIKE
		return $this->db->get('embung_pal')->num_rows(); // Untuk menghitung jumlah data sesuai dengan filter pada textbox pencarian
	}
}
