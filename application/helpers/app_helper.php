<?php defined('BASEPATH') or exit('No direct script access allowed');

if ( ! function_exists('tahun_ajaran')) {
	function tahun_ajaran() {
		$CI =& get_instance();
		$tahun = $CI->session->tahun;
		$ta1 = ($tahun-1).'/'.$tahun;
		$ta2 = $tahun.'/'.($tahun+1);
		$data = [
			"$ta1" => "$ta1",
			"$ta2" => "$ta2"
		];
		return $data;
	}
}

if ( ! function_exists('ptahun_ajaran')) {
	function ptahun_ajaran($bln) {
		$CI =& get_instance();
		$tahun = $CI->session->tahun;
		$ta = $bln > 6 ? $tahun.'/'.($tahun+1) : ($tahun-1).'/'.$tahun;		
		return $ta;
	}
}

if ( ! function_exists('sekolahbynpsn')) {
	function sekolahbynpsn($npsn) {
		return get_value('users', 'user_full_name', 'user_profile_id', $npsn);
	}
}