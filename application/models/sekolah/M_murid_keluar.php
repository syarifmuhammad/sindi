<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_Murid_keluar extends CI_Model {

	/**
	 * Primary key
	 * @var String
	 */
	public static $pk = 'id';

	/**
	 * Table
	 * @var String
	 */
	public static $table = 'lapbul_murid_keluar';

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
	public function get_where($id, $keyword, $limit = 0, $offset = 0) {
		$this->db->select('id, nama, kelas, alasan, is_deleted');
		$this->db->where('id_index', $id);
		if (!empty($keyword)) {
			
		}
		if ($limit > 0) $this->db->limit($limit, $offset);
		return $this->db->get(self::$table);
	}

	/**
	 * Get Total Rows
	 * @param 	String
	 * @return Int
	 */
	public function total_rows($id, $keyword) {
		$this->db->where('id_index', $id);
		if (!empty($keyword)) {
			
		}
		return $this->db->count_all_results(self::$table);
	}
}
