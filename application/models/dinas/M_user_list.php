<?php defined('BASEPATH') OR exit('No direct script access allowed');



class M_user_list extends CI_Model {

	/**
	 * Primary key
	 * @var String
	 */
	public static $pk = 'id';

	/**
	 * Table
	 * @var String
	 */
	public static $table = 'users';

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
		$this->db->select('
			x1.id
			, x1.user_name
			, x1.user_full_name
			, x1.user_email
			, x1.has_login
			, x1.last_logged_in
			, x1.ip_address
			, x1.user_url
			, x2.user_group
			, x1.is_deleted
		');
		$this->db->join('user_groups x2', 'x1.user_group_id = x2.id', 'LEFT');
		$this->db->where('user_type', 'administrator');
		$this->db->where('user_group_id', 2);
		if (!empty($keyword)) {
			$this->db->group_start();
			$this->db->like('x1.user_name', $keyword);
			$this->db->or_like('x1.user_name', $keyword);
			$this->db->or_like('x1.user_full_name', $keyword);
			$this->db->or_like('x1.user_email', $keyword);
			$this->db->or_like('x1.user_url', $keyword);
			$this->db->or_like('x2.user_group', $keyword);
			$this->db->group_end();
		}
		$this->db->order_by('x1.last_logged_in desc');	
		return $this->db->get(self::$table.' x1', $limit, $offset);
	}

	/**
	 * Get Total Rows
	 * @param String $keyword
	 * @return Int
	 */
	public function total_rows($keyword = '') {
		$this->db->join('user_groups x2', 'x1.user_group_id = x2.id', 'LEFT');
		$this->db->where('user_type', 'administrator');
		$this->db->where('user_group_id', 2);
		if (!empty($keyword)) {
			$this->db->group_start();
			$this->db->like('x1.user_name', $keyword);
			$this->db->or_like('x1.user_name', $keyword);
			$this->db->or_like('x1.user_full_name', $keyword);
			$this->db->or_like('x1.user_email', $keyword);
			$this->db->or_like('x1.user_url', $keyword);
			$this->db->or_like('x2.user_group', $keyword);
			$this->db->group_end();
		}
		return $this->db->count_all_results(self::$table. ' x1');
	}
}
