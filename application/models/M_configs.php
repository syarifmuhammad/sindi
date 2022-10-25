<?php defined('BASEPATH') OR exit('No direct script access allowed');



class M_configs extends CI_Model {

	/**
	 * Primary key
	 * @var String
	 */
	public static $pk = 'id';

	/**
	 * Table
	 * @var String
	 */
	public static $table = 'configs';

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
	public function get_where($keyword, $limit = 0, $offset = 0, $group = 'general') {
		$this->db->select('id, config_variable, COALESCE(config_value, config_default_value) AS config_value, config_description, is_deleted');
		$this->db->where('config_group', $group);
		if (!empty($keyword)) {
			$this->db->group_start();
			$this->db->like('config_description', $keyword);
			$this->db->or_like('config_value', $keyword);
			$this->db->group_end();
		}
		$this->db->order_by('id', 'ASC');
		if ($limit > 0) $this->db->limit($limit, $offset);
		return $this->db->get(self::$table);
	}

	/**
	 * Get Total Rows
	 * @param 	String
	 * @return Int
	 */
	public function total_rows($keyword, $group) {
		$this->db->where('config_group', $group);
		if (!empty($keyword)) {
			$this->db->group_start();
			$this->db->like('config_description', $keyword);
			$this->db->or_like('config_value', $keyword);
			$this->db->group_end();
		}
		$this->db->order_by('id', 'ASC');
		return $this->db->count_all_results(self::$table);
	}

	/**
	 * Get Setting Values By Access Group
	 * @param array
	 * @return array
	 */
	public function get_config_values($access_group = 'public') {
		$query = $this->db
			->select('config_variable, COALESCE(config_value, config_default_value) AS config_value')
			->like('config_access_group', $access_group)
			->get(self::$table);
		$configs = [];
		foreach($query->result() as $row) {
			$configs[$row->config_variable] = $row->config_value;
		}
		return $configs;
	}

	/**
	 * Get Setting Values By Group
	 * @param array
	 * @return array
	 */
	public function get_config_values_by_group($group) {
		$query = $this->db
			->select('config_variable, COALESCE(config_value, config_default_value) AS config_value')
			->like('config_group', $group)
			->get(self::$table);
		$configs = [];
		foreach($query->result() as $row) {
			$configs[$row->config_variable] = $row->config_value;
		}
		return $configs;
	}


}
