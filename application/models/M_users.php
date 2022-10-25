<?php defined('BASEPATH') OR exit('No direct script access allowed');



class M_users extends CI_Model {

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
     * logged_in()
     * @param String $user_name
     * @return Boolean
     */
	public function logged_in($user_name) {
		return $this->db
			->select('id
				, user_name
				, user_password
				, user_full_name
				, user_email
				, user_type
				, user_group_id
				, user_profile_id
				, has_login
			')
         ->where('user_name', $user_name)
         ->where('is_deleted', 'false')
         ->limit(1)
         ->get(self::$table);
	}

	/**
     * last_logged_in()
     * @param Int $id
     * @return void
     */
	public function last_logged_in($id) {
		$fields = [
			'last_logged_in' => date('Y-m-d H:i:s'),
			'ip_address' => get_ip_address(),
			'has_login' => 'true'
		];
		$this->db
			->where(self::$pk, $id)
			->update(self::$table, $fields);
	}

	/**
     * reset_logged_in
     * set has_login to false
     * @param Int $id
     * @return Void
     */
	public function reset_logged_in($id) {
		$this->db
			->where(self::$pk, $id)
			->update(self::$table, ['has_login' => 'false']);
	}

	/**
     * get_attempts
     * @param String $ip_address
     * @return Object
     */
	public function get_attempts($ip_address) {
		$query = $this->db
			->where('ip_address', $ip_address)
			->get('login_attempts');
		if ($query->num_rows() === 1) {
			return $query->row();
		}
		return NULL;
	}

	/**
     * increase_login_attempts
     * @param String $ip_address
     * @return Void
     */
	public function increase_login_attempts($ip_address) {
		$query = $this->db
			->where('ip_address', $ip_address)
			->get('login_attempts');
		if ($query->num_rows() === 1) {
			$result = $query->row();
			$this->db
				->where('ip_address', $ip_address)
				->update('login_attempts', ['counter' => ($result->counter + 1)]);
		} else {
			$this->db
				->insert('login_attempts', [
					'created_at' => date('Y-m-d H:i:s'),
					'ip_address' => $ip_address,
					'counter' => 1
				]);
		}
	}

	/**
     * reset_attempts
     * @param String $ip_address
     * @return Void
     */
	public function reset_attempts($ip_address) {
		$this->db
			->where('ip_address', $ip_address)
			->delete('login_attempts');
	}

	/**
     * get last logged in
     * @return Resource
     */
	public function get_last_logged_in() {
		return $this->db
			->select("user_full_name AS full_name, last_logged_in")
			->where('user_type !=', 'super_user')
			->where('last_logged_in IS NOT NULL')
			->order_by('last_logged_in', 'DESC')
			->limit(10)
			->get(self::$table);
	}

	/**
     * change_user_name
     * @param 	String $user_name
     * @return  Boolean
     */
	public function change_user_name($user_name) {
		return $this->db
			->where('user_name', $this->session->user_name)
			->update(self::$table, ['user_name' => $user_name]);
	}

	/**
     * set_forgot_password_key
     * @param 	String $user_email
     * @param 	String $user_forgot_password_key
     * @return  Boolean
     */
	public function set_forgot_password_key($user_email, $user_forgot_password_key) {
		$fill_data = [
			'user_forgot_password_key' => $user_forgot_password_key,
			'user_forgot_password_request_date' => date('Y-m-d H:i:s')
		];
		return $this->db
			->where('user_email', $user_email)
			->update(self::$table, $fill_data);
	}

	/**
     * remove activation key
     * @param Int $id
     * @return Boolean
     */
	public function remove_forgot_password_key($id) {
		return $this->db
			->where(self::$pk, $id)
			->update(self::$table, ['user_forgot_password_key' => NULL, 'user_forgot_password_request_date' => NULL]);
	}

	/**
     * Reset Password
     * @param String $id
	  * @param Array $fill_data
     * @return Boolean
     */
	public function reset_password($id, array $fill_data) {
		return $this->db
			->where(self::$pk, $id)
			->update(self::$table, $fill_data);
	}

	/**
     * Get user by email
     * @param 	String $user_email
     * @return Any
     */
	public function get_user_by_email($user_email) {
		$query = $this->db
			->where('user_email', $user_email)
			->get(self::$table);
		if ($query->num_rows() === 1) {
			$result = $query->row();
			return [
				'user_email' => $result->user_email,
				'user_full_name' => $result->user_full_name
			];
		}
		return NULL;
	}
	
	/**
	 * Dropdown
	 * @return Array
	 */
	public function dropdown($group_id=0) {
		$query = $this->db
			->select("id, user_full_name")
			->where('is_deleted', 'false')
			->where('user_group_id', $group_id)
			->order_by('id', 'ASC')
			->get(self::$table. ' x1');
		$data = [];
		if ($query->num_rows() > 0) {
			foreach($query->result() as $row) {
				$data[$row->id] = $row->user_full_name;
			}
		}
		return $data;
	}
	
	/**
	 * Dropdown
	 * @return Array
	 */
	public function delegasi_dropdown($group_name) {
		$group_id = get_value('user_groups', 'id', 'user_group', $group_name);
		$query = $this->db
			->select("id, user_full_name")
			->where('is_deleted', 'false')
			->where('user_group_id', $group_id)
			->order_by('id', 'ASC')
			->get(self::$table. ' x1');
		$data = [];
		if ($query->num_rows() > 0) {
			foreach($query->result() as $row) {
				$data[$row->id] = $row->user_full_name;
			}
		}
		return $data;
	}
}
