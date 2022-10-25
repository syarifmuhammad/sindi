<?php defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('get_value')) {	
	function get_value($table, $field, $key_field, $cond) {
		$where = is_array($key_field) == true ? array_combine($key_field,$cond) : array($key_field => $cond);
		$CI =& get_instance();
		$count = $CI->db->where($where)->count_all_results($table);
        $result = $CI->db->where($where)->get($table)->row($field);
		
        return $count > 0 ? $result : '';
	}
}

if (!function_exists('get_sum')) {	
	function get_sum($table, $field){
		$CI =& get_instance();
		$CI->db->select_sum($field);
		$query = $CI->db->get($table);
		return $query->row()->$field;
	}
}

if (!function_exists('get_sum_where')) {	
	function get_sum_where($table, $field, $key_field, $cond){
		$where = is_array($key_field) == true ? array_combine($key_field,$cond) : array($key_field => $cond);
		$CI =& get_instance();
		$count = $CI->db->where($where)->count_all_results($table);
		$result = $CI->db->select_sum($field)->where($where)->get($table)->row($field);

		return $count > 0 ? $result : 0;
	}
}

if (!function_exists('count_where')) {	
	function count_where($table, $key_field, $cond) {
		$where = is_array($key_field) == true ? array_combine($key_field,$cond) : array($key_field => $cond);
		$CI =& get_instance();
		$count = $CI->db->where($where)->count_all_results($table);		
        return $count > 0 ? $count : 0;
	}
}

if (!function_exists('count_saja')) {	
	function count_saja($table) {
		$CI =& get_instance();
		$count = $CI->db->count_all_results($table);		
        return $count > 0 ? $count : 0;
	}
}

if (!function_exists('index_sebelum')) {	
	function index_sebelum($tabel, $bulan_sekarang) {
		$CI =& get_instance();
		$tahun = $CI->session->tahun;
		$npsn = $CI->session->user_profile_id;
		$bulan = $bulan_sekarang == 1 ? 12 : $bulan_sekarang - 1;
		$count = $CI->db->where(['sp_npsn' => $npsn, 'tahun' => $tahun, 'bulan' => $bulan])->count_all_results('lapbul_index');
		if($count > 0){
			$id_index = get_value('lapbul_index', 'id', ['sp_npsn', 'tahun', 'bulan'], [$npsn, $tahun, $bulan]);
			$result['status'] = 'success';
			$result['data'] = $CI->model->RowObject('id_index', $id_index, $tabel);
		} else {
			$result['status'] = 'error';
			$result['data'] = [];
		}
        return $result;
	}
}