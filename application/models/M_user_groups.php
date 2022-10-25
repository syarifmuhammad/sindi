<?php defined('BASEPATH') OR exit('No direct script access allowed');



class M_user_groups extends CI_Model {

	/**
	 * Primary key
	 * @var String
	 */
	public static $pk = 'id';

	/**
	 * Table
	 * @var String
	 */
	public static $table = 'user_groups';

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
		$this->db->select('id, user_group, is_deleted');
		if (!empty($keyword)) $this->db->like('user_group', $keyword);
		return $this->db->get(self::$table, $limit, $offset);
	}

	/**
	 * Get Total Rows
	 * @param String $keyword
	 * @return Int
	 */
	public function total_rows($keyword = '') {
		if (!empty($keyword)) $this->db->like('user_group', $keyword);
		return $this->db->count_all_results(self::$table);
	}

	/**
	 * Dropdown
	 * @return Array
	 */
	public function dropdown() {
		$query = $this->db
			->select('id, user_group')
			->where('is_deleted', 'false')
			->get(self::$table);
		$data = [];
		if ($query->num_rows() > 0) {
			foreach($query->result() as $row) {
				$data[$row->id] = $row->user_group;
			}
		}
		return $data;
	}
}
