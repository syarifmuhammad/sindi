<?php defined('BASEPATH') OR exit('No direct script access allowed');



class M_data_gtk extends CI_Model {

	/**
	 * Primary key
	 * @var String
	 */
	public static $pk = 'id';

	/**
	 * Table
	 * @var String
	 */
	public static $table = 'daftar_keadaan_guru';

	/**
	 * Class Constructor
	 *
	 * @return Void
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Get Data
	 * @param String $keyword
	 * @param Int $limit
	 * @param Int $offset
	 * @return Resource
	 */
	public function get_where($keyword = '', $limit = 10, $offset = 0) {
		$this->db->select('*');
		$this->db->where('sp_npsn', $this->session->user_profile_id);
		$this->db->where('tahun', $this->session->tahun);
		// $this->db->where('is_deleted', 'false');
		if (!empty($keyword)) {
			$this->db->group_start();
			$this->db->like('nama', $keyword);
			$this->db->or_like('nip', $keyword);
			$this->db->or_like('nuptk', $keyword);
			$this->db->group_end();
		}
		return $this->db->get(self::$table, $limit, $offset);
	}

	/**
	 * Get Total Rows
	 * @param String $keyword
	 * @return Int
	 */
	public function total_rows($keyword = '') {
		$this->db->where('sp_npsn', $this->session->user_profile_id);
		$this->db->where('tahun', $this->session->tahun);
		// $this->db->where('is_deleted', 'false');
		if (!empty($keyword)) {
			$this->db->group_start();
			$this->db->like('nama', $keyword);
			$this->db->or_like('nip', $keyword);
			$this->db->or_like('nuptk', $keyword);
			$this->db->group_end();
		}
		return $this->db->count_all_results(self::$table);
	}
}
