<?php defined('BASEPATH') OR exit('No direct script access allowed');



class M_helper extends CI_Model {

	
	
	/**
	 * Primary key
	 * @var String
	 */
	public static $pk = 'id';

	/**
	 * Class Constructor
	 *
	 * @return Void
	 */
	public function __construct() {
		date_default_timezone_set(config_item('timezone'));
	}

	/**
	 *  Insert
	 * @param String $table
	 * @param Array $fill_data
	 * @return Boolean
	 */
	public function insert($table, array $fill_data) {
		$this->db->trans_start();
		$this->db->insert($table, $fill_data);
		$this->db->trans_complete();
		return $this->db->trans_status();
	}

	/**
	 * Update
	 * @param Int $id
	 * @param String $table
	 * @param Array $fill_data
	 * @return Boolean
	 */
	public function update($id, $table, array $fill_data) {
		$this->db->trans_start();
		$this->db->where(self::$pk, $id)->update($table, $fill_data);
		$this->db->trans_complete();
		return $this->db->trans_status();
	}

	public function xupdate($wfield, $wvalue, $table, array $fill_data) {
		$this->db->trans_start();
		$this->db->where($wfield, $wvalue)->update($table, $fill_data);
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	public function update_array(array $where, $table, array $fill_data) {
		$this->db->trans_start();
		$this->db->where($where)->update($table, $fill_data);
		$this->db->trans_complete();
		return $this->db->trans_status();
	}

	/**
	 *  Update Or Insert
	 * @param Int $id
	 * @param String $table
	 * @param Array $fill_data
	 * @return Boolean
	 */
	public function upsert($id, $table, array $fill_data) {
		$this->db->trans_start();
		_isInteger( $id ) ?
		 	$this->db->where(self::$pk, $id)->update($table, $fill_data) :
			$this->db->insert($table, $fill_data);
		$this->db->trans_complete();
		return $this->db->trans_status();
	}

	/**
	* Delete Permanently
	* @param String $key
   * @param String $value
   * @param String $table
	 * @return Bool
	 */
	public function delete_permanently($key, $value, $table) {
		$this->db->trans_start();
		$where = is_array($key) == true ? array_combine($key,$value) : array($key => $value);
		$this->db->where($where)->delete($table);
		$this->db->trans_complete();
		return $this->db->trans_status();
	}

	/**
	 * Delete
	 * @param Array $ids
	 * @param String $table
	 * @return Boolean
	 */
	public function delete(array $ids, $table) {
		$this->db->trans_start();
		$this->db->where_in(self::$pk, $ids)
			->update($table, [
				'is_deleted' => 'true',
				'deleted_by' => $this->session->user_id,
				'deleted_at' => date('Y-m-d H:i:s')
			]
		);
		$this->db->trans_complete();
		return $this->db->trans_status();
	}

	/**
	 * Truncate Table
	 * @param String $table
	 * @return Boolean
	 */
	public function truncate($table) {
		$this->db->trans_start();
		$this->db->truncate($table);
		$this->db->trans_complete();
		return $this->db->trans_status();
	}

	/**
	* Restore
	 * @param Array $ids
	 * @param String $table
	 * @return Boolean
	 */
	public function restore(array $ids, $table) {
		$this->db->trans_start();
		$this->db->where_in(self::$pk, $ids)
			->update($table, [
				'is_deleted' => 'false',
				'restored_by' => $this->session->user_id,
				'restored_at' => date('Y-m-d H:i:s')
			]
		);
		$this->db->trans_complete();
		return $this->db->trans_status();
	}

	/**
	* Check value if exists
	* @param String $key
	* @param String $value
	* @param String $table
	 * @return Bool
	 */
	public function is_exists($key, $value, $table) {
		$count = $this->db
			->where($key, $value)
			->count_all_results($table);
		return $count > 0;
	}
	
	/**
	* Check value in multiple condition if exists
	* @param String $array
	* @param String $table
	 * @return Bool
	 */
	public function is_exists_array($array, $table) {
		$count = $this->db
			->where($array)
			->count_all_results($table);
		return $count > 0;
	}

	/**
	 * Row Object
	 * @param String $key
	 * @param String $value
	 * @param String $table
	 * @return Object
	 */
	public function RowObject($key, $value, $table) {
		return $this->db
			->where($key, $value)
			->get($table)
			->row();
	}
	
	/**
	 * Results Object
	 * @param String $table
	 * @return Array of Object
	 */
	public function ResultsObject($table) {
		return $this->db->get($table)->result();
	}
	
	
	public function ResultWhere($table, $key_field, $cond) {
		$where = is_array($key_field) == true ? array_combine($key_field,$cond) : array($key_field => $cond);
		return $this->db
			->where($where)
			->get($table)
			->result();
	}
	/**
	 * Row Array
	 * @param String $table
	 * @param String $key
	 * @param String $value
	 * @return Array
	 */
	public function RowArray($table, $key, $value) {
		return $this->db
			->where($key, $value)
			->get($table)
			->row_array();
	}

	/**
	 * Results Array
	 * @param String $table
	 * @return Array of Array
	 */
	public function ResultsArray($table) {
		return $this->db->get($table)->result_array();
	}

	/**
	 * Chek if email exist
	 * @param String $email
	 * @param Int $id
	 * @return Boolean
	 */
	public function is_email_exist($email, $id) {
		// Var Initialize
		$response['is_exist'] = false;
		$response['used_by'] = '';

		// Check from users administrator or super users
		$user = $this->db
			->where('user_email', $email)
			->where('id !=', $id)
			->where_in('user_type', ['administrator', 'super_user'])
			->count_all_results('users');
		if ($user > 0) {
			$response['is_exist'] = true;
			$response['used_by'] = 'Administrator';
			return $response;
		}
		return $response;
	}

	/**
	 * Clear Expired Session and Login Attemps
	 * @return Void
	 */
	public function clear_expired_session() {
		$this->db->query("DELETE FROM `_sessions` WHERE DATE_FORMAT(FROM_UNIXTIME(timestamp), '%Y-%m-%d') < CURRENT_DATE");
		$this->db->query("DELETE FROM `login_attempts` WHERE DATE_FORMAT(created_at, '%Y-%m-%d') < CURRENT_DATE");
	}


	public function set_offline_user() {
		$this->db->query("UPDATE `users` SET has_login=false WHERE DATE_FORMAT(last_logged_in, '%Y-%m-%d') < CURRENT_DATE");
	}


	/**
	* Delete Permanently
	* @param String $key
   * @param String $value
   * @param String $table
	 * @return Bool
	 */
	public function delete_data($key, $value, $table) {
		$where = is_array($key) == true ? array_combine($key,$value) : array($key => $value);
		$this->db->trans_start();
		$this->db->where($where)->delete($table);
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	/**
	 * Delete
	 * @param Array $ids
	 * @param String $table
	 * @return Boolean
	 */
	public function set_deleted($key, $value, $table) {
		$where = is_array($key) == true ? array_combine($key,$value) : array($key => $value);
		$this->db->trans_start();
		$this->db->where($where)
			->update($table, [
				'is_deleted' => 'true',
				'deleted_by' => $this->session->user_id ? $this->session->user_id : 0,
				'deleted_at' => date('Y-m-d H:i:s')
			]
		);
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	public function add_sp_profil() {
		if($this->session->user_group_id == 2){
			if(!$this->is_exists_array(['sp_npsn' => $this->session->user_profile_id, 'tahun' => $this->session->tahun], 'sp_profil')){
				$url = 'https://datadik.kemdikbud.go.id/refsp/q';
				$needlogin = 'nologin';
				$methode = 'post';
				$post_data['q'] = $this->session->user_profile_id;
				$data = dapodik_data($url,$needlogin,$methode,$post_data);		
				$response = json_decode($data['data']);
				if($response != null){
					$sp_id['sp_npsn'] = $this->session->user_profile_id;
					$sp_id['tahun'] = $this->session->tahun;					
					$sp_id['sp_description'] = 'ID Sekolah';
					$sp_id['sp_variable'] = 'sp_id';
					$sp_id['sp_value'] = $response[0][0];
					$sp_id['sumber_data'] = 'DAPODIK';
					$sp_id['is_show'] = 'false';
					$sp_id['created_at'] = date('Y-m-d H:i:s');
					$sp_id['created_by'] = $this->session->user_id;
					
					$sp_nama['sp_npsn'] = $this->session->user_profile_id;
					$sp_nama['tahun'] = $this->session->tahun;
					$sp_nama['sp_description'] = 'Nama Satuan Pendidikan';
					$sp_nama['sp_variable'] = 'sp_nama';
					$sp_nama['sp_value'] = $response[0][1];
					$sp_nama['sumber_data'] = 'DAPODIK';
					$sp_nama['created_at'] = date('Y-m-d H:i:s');
					$sp_nama['created_by'] = $this->session->user_id;
					
					$sp_alamat['sp_npsn'] = $this->session->user_profile_id;
					$sp_alamat['tahun'] = $this->session->tahun;
					$sp_alamat['sp_description'] = 'Alamat';
					$sp_alamat['sp_variable'] = 'sp_alamat';
					$sp_alamat['sp_value'] = $response[0][3];
					$sp_alamat['sumber_data'] = 'DAPODIK';
					$sp_alamat['created_at'] = date('Y-m-d H:i:s');
					$sp_alamat['created_by'] = $this->session->user_id;
					
					$sp_kec['sp_npsn'] = $this->session->user_profile_id;
					$sp_kec['tahun'] = $this->session->tahun;
					$sp_kec['sp_description'] = 'Kecamatan';
					$sp_kec['sp_variable'] = 'sp_kec';
					$sp_kec['sp_value'] = $response[0][4];
					$sp_kec['sumber_data'] = 'DAPODIK';
					$sp_kec['created_at'] = date('Y-m-d H:i:s');
					$sp_kec['created_by'] = $this->session->user_id;
					
					$sp_kab['sp_npsn'] = $this->session->user_profile_id;
					$sp_kab['tahun'] = $this->session->tahun;
					$sp_kab['sp_description'] = 'Kabupaten';
					$sp_kab['sp_variable'] = 'sp_kab';
					$sp_kab['sp_value'] = $response[0][5];
					$sp_kab['sumber_data'] = 'DAPODIK';
					$sp_kab['created_at'] = date('Y-m-d H:i:s');
					$sp_kab['created_by'] = $this->session->user_id;
					
					$sp_prov['sp_npsn'] = $this->session->user_profile_id;
					$sp_prov['tahun'] = $this->session->tahun;
					$sp_prov['sp_description'] = 'Provinsi';
					$sp_prov['sp_variable'] = 'sp_prov';
					$sp_prov['sp_value'] = $response[0][6];
					$sp_prov['sumber_data'] = 'DAPODIK';
					$sp_prov['created_at'] = date('Y-m-d H:i:s');
					$sp_prov['created_by'] = $this->session->user_id;
					
					$this->insert('sp_profil', $sp_id);
					$this->insert('sp_profil', $sp_nama);
					$this->insert('sp_profil', $sp_alamat);
					$this->insert('sp_profil', $sp_kec);
					$this->insert('sp_profil', $sp_kab);
					$this->insert('sp_profil', $sp_prov);
				}					
			} else {
				if(!$this->is_exists_array(['sp_npsn' => $this->session->user_profile_id, 'tahun' => $this->session->tahun, 'sp_variable' => 'sp_id'], 'sp_profil')){
					$url = 'https://datadik.kemdikbud.go.id/refsp/q';
					$needlogin = 'nologin';
					$methode = 'post';
					$post_data['q'] = $this->session->user_profile_id;
					$data = dapodik_data($url,$needlogin,$methode,$post_data);		
					$response = json_decode($data['data']);
					if($response != null){
						$sp_id['sp_npsn'] = $this->session->user_profile_id;
						$sp_id['tahun'] = $this->session->tahun;
						$sp_id['sp_description'] = 'ID Sekolah';
						$sp_id['sp_variable'] = 'sp_id';
						$sp_id['sp_value'] = $response[0][0];
						$sp_id['sumber_data'] = 'DAPODIK';
						$sp_id['is_show'] = 'false';
						$sp_id['created_at'] = date('Y-m-d H:i:s');
						$sp_id['created_by'] = $this->session->user_id;
						$this->insert('sp_profil', $sp_id);
					}
				} else {
					if(get_value('sp_profil', 'sp_value', ['sp_npsn', 'tahun', 'sp_variable'], [$this->session->user_profile_id, $this->session->tahun, 'sp_id']) == NULL){
						$url = 'https://datadik.kemdikbud.go.id/refsp/q';
						$needlogin = 'nologin';
						$methode = 'post';
						$post_data['q'] = $this->session->user_profile_id;
						$data = dapodik_data($url,$needlogin,$methode,$post_data);
						$response = json_decode($data['data']);
						if($response != null){
							$sp_id['sp_value'] = $response[0][0];
							$sp_id['sumber_data'] = 'DAPODIK';
							$sp_id['updated_by'] = $this->session->user_id;
							$this->update_array(['sp_npsn' => $this->session->user_profile_id, 'tahun' => $this->session->tahun, 'sp_variable' => 'sp_id'], 'sp_profil', $sp_id);
						}
					}
				}
			}
				
		}			
	}
	
}
