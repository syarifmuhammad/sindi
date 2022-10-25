<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_profil extends CI_Model {

	/**
	 * Primary key
	 * @var String
	 */
	public static $pk = 'id';

	/**
	 * Table
	 * @var String
	 */
	public static $table = 'sp_profil';

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
	 * @param 	String
	 * @param 	Int
	 * @param 	Int
	 * @return 	Resource
	 */
	public function get_where($keyword, $limit = 0, $offset = 0) {
		$this->db->select('id, sp_description, sp_variable, sp_value, is_deleted');
		$this->db->where('sp_npsn', $this->session->user_profile_id);
		$this->db->where('tahun', $this->session->tahun);
		$this->db->where('is_show', 'true');
		if (!empty($keyword)) {
			$this->db->group_start();
			$this->db->like('sp_description', $keyword);
			$this->db->or_like('sp_value', $keyword);
			$this->db->group_end();
		}
		if ($limit > 0) $this->db->limit($limit, $offset);
		return $this->db->get(self::$table);
	}

	/**
	 * Get Total Rows
	 * @param 	String
	 * @return Int
	 */
	public function total_rows($keyword) {
		$this->db->where('sp_npsn', $this->session->user_profile_id);
		$this->db->where('tahun', $this->session->tahun);
		$this->db->where('is_show', 'true');
		if (!empty($keyword)) {
			$this->db->group_start();
			$this->db->like('sp_description', $keyword);
			$this->db->or_like('sp_value', $keyword);
			$this->db->group_end();
		}
		return $this->db->count_all_results(self::$table);
	}
}
