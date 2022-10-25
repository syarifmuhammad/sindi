<?php defined('BASEPATH') or exit('No direct script access allowed');

 /**
  * Is Integer
  * Example : 3.5 -> 3, 4.2 -> 4
  * @param String $n
  * @return Boolean
  */
 if (! function_exists('_isInteger')) {
 	function _isInteger( $n ) {
 		return $n && $n > 0 && ctype_digit((string) $n);
 	}
 }

/**
 * Copyright
 * @param String $year
 * @param String $link
 * @param String $company
 * @return String
 */
if ( ! function_exists('copyright')) {
	function copyright($year = '', $link = '', $company = '') {
		if ($year != '') {
			if (strlen($year) != 4 || !is_numeric($year)) {
				return;
			}
		}
		$start_at = ! empty($year) ? $year : date('Y');
		$string = 'Copyright &copy; ';
		$string .= date('Y') > $start_at ? $start_at . ' - ' . date('Y') : $start_at;
		$string .= '<a href="';
		$string .= $link == '' ? base_url() : $link;
		$string .= '"> ';
		$string .= $company == '' ? str_replace(array('http://', 'https://'), '', rtrim(base_url(), '/')) : $company;
		$string .= '</a>';
		$string .= ' All rights reserved.';
		return $string;
	}
}

/**
 * Filesize Formatted
 * @param Int $size
 * @return String
 */
if ( ! function_exists('filesize_formatted')) {
	function filesize_formatted($size) {
		$units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
		$power = $size > 0 ? floor(log($size, 1024)) : 0;
		return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
	}
}

/**
 * Create Directory
 * @param String $dir
 * @return Void
 */
if ( ! function_exists('create_dir')) {
	function create_dir($dir) {
		if (!is_dir($dir)) {
			if (!mkdir($dir, 0777, true)) {
				die('Not create directory : ' . $dir);
			}
		}
	}
}

/**
 * Encode String
 * @param String $str
 * @return String
 */
if ( ! function_exists('encode_str')) {
	function encode_str($str) {
		$CI = &get_instance();
		$CI->load->library('encrypt');
		$ret = $CI->encrypt->encode($str, $CI->config->item('encryption_key'));
		$ret = strtr($ret, array('+' => '.', '=' => '-', '/' => '~'));
		return $ret;
	}
}

/**
 * Decode String
 * @param String
 * @return String
 */
if ( ! function_exists('decode_str')) {
	function decode_str($str) {
		$CI = &get_instance();
		$CI->load->library('encrypt');
		$str = strtr($str, array('.' => '+', '-' => '=', '~' => '/'));
		return $CI->encrypt->decode($str, $CI->config->item('encryption_key'));
	}
}

/**
 * Indonesian Date Formated
 * @param String $date
 * @return String
 */
if ( ! function_exists('indo_date')) {
	function indo_date($date) {
		if (is_valid_date($date)) {
			$parts = explode("-", $date);
			$result = $parts[2] . ' ' . bulan($parts[1]) . ' ' . $parts[0];
			return $result;
		}
		return '';
	}
}

/**
 * English Date Formated
 * @param String $date
 * @return String
 */
if ( ! function_exists('english_date')) {
	function english_date($date) {
		if (is_valid_date($date)) {
			$parts = explode("-", $date);
			$result = $parts[2] . ', ' . month($parts[1]) . ' ' . $parts[0];
			return $result;
		}
		return '';
	}
}

/**
 * Day Name
 * @param String $idx
 * @return String
 */
if (! function_exists('day_name')) {
	function day_name($idx) {
		$arr = ['', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu', 'Minggu'];
		return $arr[$idx];
	}
}

/**
 * Check Is Valid Date ?
 * @param String $date
 * @return String
 */
if ( ! function_exists('is_valid_date')) {
	function is_valid_date($date) {
		if (preg_match("/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/", $date, $parts)) {
			return checkdate($parts[2], $parts[3], $parts[1]) ? true : false;
		}
		return false;
	}
}

/**
 * Bulan
 * @param String $key
 * @return String
 */
if ( ! function_exists('bulan')) {
	function bulan($key = '') {
		$data = [
			'01' => 'Januari',
			'02' => 'Februari',
			'03' => 'Maret',
			'04' => 'April',
			'05' => 'Mei',
			'06' => 'Juni',
			'07' => 'Juli',
			'08' => 'Agustus',
			'09' => 'September',
			'10' => 'Oktober',
			'11' => 'November',
			'12' => 'Desember',
		];
		return $key === '' ? $data : $data[$key];
	}
}

if ( ! function_exists('xbulan')) {
	function xbulan($key = '') {
		$data = [
			1 => 'Januari',
			2 => 'Februari',
			3 => 'Maret',
			4 => 'April',
			5 => 'Mei',
			6 => 'Juni',
			7 => 'Juli',
			8 => 'Agustus',
			9 => 'September',
			10 => 'Oktober',
			11 => 'November',
			12 => 'Desember',
		];
		return $key === '' ? $data : $data[$key];
	}
}

if ( ! function_exists('bulan_dropdown')) {
	function bulan_dropdown() {
		$data = [
			1 => 'Januari',
			2 => 'Februari',
			3 => 'Maret',
			4 => 'April',
			5 => 'Mei',
			6 => 'Juni',
			7 => 'Juli',
			8 => 'Agustus',
			9 => 'September',
			10 => 'Oktober',
			11 => 'November',
			12 => 'Desember',
		];
		return $data;
	}
}

/**
 * Month
 * @param String $key
 * @return String
 */
if ( ! function_exists('month')) {
	function month($key = '') {
		$data = [
			'01' => 'January',
			'02' => 'February',
			'03' => 'March',
			'04' => 'April',
			'05' => 'May',
			'06' => 'June',
			'07' => 'July',
			'08' => 'August',
			'09' => 'September',
			'10' => 'October',
			'11' => 'November',
			'12' => 'December',
		];
		return $key === '' ? $data : $data[$key];
	}
}

/**
 * Get IP Address
 * @return String
 */
if (! function_exists('get_ip_address')) {
	function get_ip_address() {
		$ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
	}
}

/**
 * check_internet_connection
 * @return Boolean
 */
if (! function_exists('check_internet_connection')) {
	function check_internet_connection() {
		return checkdnsrr('google.com');
	}
}

/**
 * Array Date
 * @param String $start_date
 * @param String $end_Date
 * @return Array
 */
if ( ! function_exists('array_date')) {
   function array_date($start_date, $end_date) {
      if (!is_valid_date($start_date)) return [];
      if (!is_valid_date($end_date)) return [];
      $start_date = strtotime($start_date);
      $end_date = strtotime($end_date);
      if ($start_date > $end_date) return array_date($end_date, $start_date);
      $range = [];
      do {
         $range[] = date('Y-m-d', $start_date);
         $start_date = strtotime("+ 1 day", $start_date);
      }
      while($start_date <= $end_date);
      return $range;
   }
}

/**
 * Delete Cache
 * @return void
 */
if (! function_exists('delete_cache')) {
	function delete_cache() {
		$CI = &get_instance();
		$CI->load->helper('directory');
		$path = APPPATH . 'cache';
		$files = directory_map($path, FALSE, TRUE);
		foreach ($files as $file) {
			if ($file !== 'index.html' && $file !== '.htaccess') {
				@chmod($path . '/' . $file, 0777);
				@unlink($path . '/' . $file);
			}
		}
	}
}

/**
 * Alpha Dash
 * Check if a-z or 0-9 or _-
 * @param String
 * @return Boolean
 */
if (! function_exists('alpha_dash')) {
	function alpha_dash($str) {
		return ( ! preg_match("/^([-a-z0-9_])+$/i", $str)) ? FALSE : TRUE;
	}
}

/**
 * Slugify
 * @param String
 * @return String
 */
 if (! function_exists('slugify')) {
    function slugify( $str ) {
      $lettersNumbersSpacesHyphens = '/[^\-\s\pN\pL]+/u';
      $spacesDuplicateHypens = '/[\-\s]+/';
      $str = preg_replace($lettersNumbersSpacesHyphens, '', $str);
      $str = preg_replace($spacesDuplicateHypens, '-', $str);
      $str = trim($str, '-');
      return strtolower($str);
   }
}

/**
 * Timezone List
 * @return String
 */
if (! function_exists('timezone_list')) {
	function timezone_list() {
		static $regions = array(DateTimeZone::ASIA);
	    $timezones = [];
	    foreach( $regions as $region ) {
	        $timezones = array_merge($timezones, DateTimeZone::listIdentifiers($region));
	    }
	    $timezone_offsets = [];
	    foreach($timezones as $timezone) {
	        $tz = new DateTimeZone($timezone);
	        $timezone_offsets[$timezone] = $tz->getOffset(new DateTime);
	    }
	    asort($timezone_offsets);
	    $timezone_list = [];
	    foreach( $timezone_offsets as $timezone => $offset ) {
	        $offset_prefix = $offset < 0 ? '-' : '+';
	        $offset_formatted = gmdate( 'H:i', abs($offset) );
	        $pretty_offset = "UTC${offset_prefix}${offset_formatted}";
	        $timezone_list[$timezone] = "(${pretty_offset}) $timezone";
	    }
	    return $timezone_list;
	}
}

if (! function_exists('string2hex')) {
	function string2hex($string){
		$hex='';
		for ($i=0; $i < strlen($string); $i++){
			$hex .= dechex(ord($string[$i]));
		}
		return $hex;
	}
}
	 
if (! function_exists('hex2string')) {	 
	function hex2string($hex){
		$string='';
		for ($i=0; $i < strlen($hex)-1; $i+=2){
			$string .= chr(hexdec($hex[$i].$hex[$i+1]));
		}
		return $string;
	}
}

if (! function_exists('timebyzone')) {	 
	function timebyzone($date){
		$timezone=date_default_timezone_get();
		$time = new DateTime($date, new DateTimeZone($timezone));
		return $time->format('U');
	}
}

if (!function_exists('xpassword')) {
	function xpassword($login, $pass) {
		$pass = base64_encode(md5($login.$pass, true));
		return $pass;
	}
}

if (!function_exists('cek_password')) {
	function cek_password($login, $pass, $data) {
		$pass = base64_encode(md5($login.$pass, true));
		if($pass==$data){
			return true;
		} else {
			return false;
		}
	}
}

if (!function_exists('salam')) {
	function salam()
	{
		$b = time();
		$hour = date("G",$b);
		$result = "";
		if ($hour>=0 && $hour<=11)
		{
		$result = "Selamat pagi";
		}
		elseif ($hour >=12 && $hour<=14)
		{
		$result = "Selamat siang";
		}
		elseif ($hour >=15 && $hour<=17)
		{
		$result = "Selamat sore";
		}
		elseif ($hour >=17 && $hour<=18)
		{
		$result = "Selamat petang";
		}
		elseif ($hour >=19 && $hour<=23)
		{
		$result = "Selamat malam";
		}
		return $result;
	}
}

if (!function_exists('get_string_between')) {
	function get_string_between($string, $start, $end){
		$string = ' ' . $string;
		$ini = strpos($string, $start);
		if ($ini == 0) return '';
		$ini += strlen($start);
		$len = strpos($string, $end, $ini) - $ini;
		return substr($string, $ini, $len);
	}
}

if (!function_exists('parseToXML')) {
	function parseToXML($htmlStr){
		$xmlStr=str_replace('<','&lt;',$htmlStr);
		$xmlStr=str_replace('>','&gt;',$xmlStr);
		$xmlStr=str_replace('"','&quot;',$xmlStr);
		$xmlStr=str_replace("'",'&#39;',$xmlStr);
		$xmlStr=str_replace("&",'&amp;',$xmlStr);
		return $xmlStr;
	}
}

if (!function_exists('terbilang')) {
	function terbilang($x) {
	$angka = ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"];
	if ($x < 12)
		return " " . $angka[$x];
	elseif ($x < 20)
		return terbilang($x - 10) . " belas ";
	elseif ($x < 100)
		return terbilang($x / 10) . " puluh " . terbilang($x % 10);
	elseif ($x < 200)
		return "seratus" . terbilang($x - 100);
	elseif ($x < 1000)
		return terbilang($x / 100) . " ratus " . terbilang($x % 100);
	elseif ($x < 2000)
		return "seribu" . terbilang($x - 1000);
	elseif ($x < 1000000)
		return terbilang($x / 1000) . " ribu " . terbilang($x % 1000);
	elseif ($x < 1000000000)
		return terbilang($x / 1000000) . " juta " . terbilang($x % 1000000);
	}
}

if (!function_exists('lama_hari')) {
	function lama_hari($dari, $sampai) {
		$date1 = new DateTime(date('Y-m-d', strtotime($sampai)));
		$date2 = new DateTime(date('Y-m-d', strtotime($dari)));
		$diff = $date1->diff($date2);
		return $diff->days + 1;
	}
}


if (!function_exists('httpsCurl')) {
	function httpsCurl($url,$urlref=false,$fields=false) {
		$agent		= "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:10.0.2) Gecko/20100101 Firefox/10.0.2";
		$fcookie	= dirname( __FILE__ ) . "/cookie/httpsCurl.cookie.txt";
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		if($urlref) {
			curl_setopt($ch, CURLOPT_REFERER, $urlref);
		}
		if($fields) {
			$fields_string = '';
			foreach($fields as $key=>$value) { 
				$fields_string .= $key.'='.$value.'&'; 
			}
			curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
			curl_setopt($ch,CURLOPT_POST,count($fields));    
		} else {
			curl_setopt($ch,CURLOPT_HTTPGET, TRUE);
		}
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,TRUE);
		curl_setopt($ch, CURLOPT_COOKIEJAR, $fcookie);
		curl_setopt($ch, CURLOPT_COOKIEFILE, $fcookie);
		curl_setopt($ch, CURLOPT_USERAGENT, $agent);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		$result = curl_exec($ch);
		$curl_errno = curl_errno($ch);
		$curl_error = curl_error($ch);
		curl_close($ch);
		$showtime = [];
		if ($curl_errno > 0) {
			$showtime['status'] = 'error';
			$showtime['code'] = $curl_errno;
			$showtime['message'] = $curl_error;
		} else {
			$showtime['status'] = 'success';
			$showtime['data'] = $result;
		}
		return $showtime;
	}
}