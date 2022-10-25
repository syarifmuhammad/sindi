<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_lapbul_form1 extends CI_Model {

	/**
	 * Primary key
	 * @var String
	 */
	public static $pk = 'id';

	/**
	 * Table
	 * @var String
	 */
	public static $table = 'lapbul_penerimaan';

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
		$this->db->select('id, rencana, daftar, terima, status, is_deleted');
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
	
	public function lapbul_penerimaan($id) {
		$check['id_index'] = $id;
		if(!$this->model->is_exists_array($check, self::$table)){				
			$sp_id['sp_npsn'] = $this->session->user_profile_id;
			$sp_id['tahun'] = $this->session->tahun;
			$sp_id['id_index'] = $id;
			$sp_id['created_at'] = date('Y-m-d H:i:s');
			$sp_id['created_by'] = $this->session->user_id;			
			$this->model->insert(self::$table, $sp_id);									
		}
	}
}
