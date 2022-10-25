<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_user_privileges extends CI_Model {

	/**
	 * Primary key
	 * @var String
	 */
	public static $pk = 'id';

	/**
	 * Table
	 * @var String
	 */
	public static $table = 'user_privileges';

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
		$this->db->select('x1.id, x2.user_group, x3.module_name, x3.module_description, x3.module_url, x1.is_deleted');
		$this->db->join('user_groups x2', 'x1.user_group_id = x2.id', 'LEFT');
		$this->db->join('modules x3', 'x1.module_id = x3.id', 'LEFT');
		if (!empty($keyword)) {
			$this->db->like('x2.user_group', $keyword);
			$this->db->or_like('x3.module_name', $keyword);
			$this->db->or_like('x3.module_description', $keyword);
			$this->db->or_like('x3.module_url', $keyword);
		}
		return $this->db->get(self::$table.' x1', $limit, $offset);
	}

	/**
	 * Get Total Rows
	 * @param String $keyword
	 * @return Int
	 */
	public function total_rows($keyword = '') {
		$this->db->join('user_groups x2', 'x1.user_group_id = x2.id', 'LEFT');
		$this->db->join('modules x3', 'x1.module_id = x3.id', 'LEFT');
		if (!empty($keyword)) {
			$this->db->like('x2.user_group', $keyword);
			$this->db->or_like('x3.module_name', $keyword);
			$this->db->or_like('x3.module_description', $keyword);
			$this->db->or_like('x3.module_url', $keyword);
		}
		return $this->db->count_all_results(self::$table.' x1');
	}

	/**
	 * Module by user group id
	 * @param Int $user_group_id
	 * @param String $user_type
	 * @return Int
	 */
	public function module_by_user_group_id($user_group_id, $user_type) {
		$user_privileges = ['dashboard', 'change_password'];
		if ($user_type == 'administrator') {
			array_push($user_privileges, 'profile');
			$query = $this->db
				->select('x2.module_url')
				->join('modules x2', 'ON x1.module_id = x2.id', 'LEFT')
				->where('x1.user_group_id', $user_group_id)
				->where('x1.is_deleted', 'false')
				->get(self::$table.' x1');
			foreach ($query->result() as $row) {
				array_push($user_privileges, $row->module_url);
			}
		} else {
			array_push($user_privileges, 'users', 'profile', 'keu', 'surat', 'pegawai');
		}
		return $user_privileges;
	}
}
