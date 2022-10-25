<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Testing extends CI_Controller {

	/**
	 * Class Constructor
	 *
	 * @return Void
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Index
	 * @access  public
	 */
	public function index() {
		$send_data['q'] = 30303344;
		$url        = 'https://datadik.kemdikbud.go.id/refsp/q';
		$result    = httpsCurl($url,false,$send_data);

		
		echo $result;
	}
	
	public function rekapsp() {
		$url = 'https://datadik.kemdikbud.go.id/ma74/rekapsp';
		$needlogin = 'login';
		$methode = 'post';
		$post_data['postkolom'] = 'yes';
		$post_data['sp_nama'] = 'on';
		$post_data['sp_npsn'] = 'on';
		$post_data['sp_id'] = 'on';
		$post_data['bentukpendidikan'] = 5;
		$post_data['statussekolah'] = 0;
		$data = dapodik_data($url,$needlogin,$methode,$post_data);		
		$response = json_decode($data);
		if($response == null){
			$this->vars['status'] = 'error';
			$this->vars['message'] = 'Gagal terhubung ke server dapodik!';
			$this->vars['data'] = [];
		} else {
			$count = count($response[1]);
			$data_dapodik = [];
			for($x = 0; $x < $count; $x++){
				$data_dapodik[$x]['sp'] = $response[1][$x][0];
				$data_dapodik[$x]['npsn'] = $response[1][$x][1];
				$data_dapodik[$x]['ids'] = $response[1][$x][2];
			}
			
			$this->vars['status'] = 'success';
			$this->vars['message'] = 'Total '.$count.' Data';
			$this->vars['data'] = $data_dapodik;
			
		}
		$this->output
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($this->vars, JSON_PRETTY_PRINT))
			->_display();
		exit;
	}
	
	public function refsp($npsn) {
		$url = 'https://datadik.kemdikbud.go.id/refsp/q';
		$needlogin = 'nologin';
		$methode = 'post';
		$post_data['q'] = $npsn;
		$data = dapodik_data($url,$needlogin,$methode,$post_data);		
		$response = json_decode($data);
		if($response == null){
			$this->vars['status'] = 'error';
			$this->vars['message'] = 'Gagal terhubung ke server dapodik!';
			$this->vars['data'] = [];
		} else {
			$data_dapodik['ids'] = $response[0][0];
			$data_dapodik['sp'] = $response[0][1];
			$data_dapodik['npsn'] = $response[0][2];
			$data_dapodik['alamat'] = $response[0][3];	
			$data_dapodik['kec'] = $response[0][4];	
			$data_dapodik['kab'] = $response[0][5];	
			$data_dapodik['prov'] = $response[0][6];	
			$this->vars['status'] = 'success';
			$this->vars['message'] = 'Sukses terhubung ke server dapodik!';
			$this->vars['data'] = $data_dapodik;			
		}
		$this->output
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($this->vars, JSON_PRETTY_PRINT))
			->_display();
		exit;
	}
	
	public function sekolahptk($ids) {
		$url = 'https://datadik.kemdikbud.go.id/ma74/sekolahptk/'.$ids.'/1';
		$needlogin = 'nologin';
		$methode = 'get';
		$data = dapodik_data($url,$needlogin,$methode,false);		
		$response = json_decode($data);
		if($response == null){
			$this->vars['status'] = 'error';
			$this->vars['message'] = 'Gagal terhubung ke server dapodik!';
			$this->vars['data'] = [];
		} else {
			$this->vars['status'] = 'success';
			$this->vars['message'] = 'Sukses terhubung ke server dapodik!';
			$this->vars['data'] = $response;			
		}
		$this->output
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($this->vars, JSON_PRETTY_PRINT))
			->_display();
		exit;
	}
	
	public function sekolahpd($ids) {
		$url = 'https://datadik.kemdikbud.go.id/ma74/sekolahpd/'.$ids.'/1';
		$needlogin = 'nologin';
		$methode = 'get';
		$data = dapodik_data($url,$needlogin,$methode,false);		
		$response = json_decode($data);
		if($response == null){
			$this->vars['status'] = 'error';
			$this->vars['message'] = 'Gagal terhubung ke server dapodik!';
			$this->vars['data'] = [];
		} else {
			$this->vars['status'] = 'success';
			$this->vars['message'] = 'Sukses terhubung ke server dapodik!';
			$this->vars['data'] = $response;			
		}
		$this->output
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($this->vars, JSON_PRETTY_PRINT))
			->_display();
		exit;
	}
	
	public function rekap_sd() {
		$data = rekapsp();
		$status = $data['status'];
		if($status == 'success'){
			$this->vars['status'] = $data['status'];
			$this->vars['message'] = $data['message'];
			$this->vars['data'] = $data['data'];
		} else {
			$this->vars['status'] = $data['status'];
			$this->vars['message'] = $data['message'];
			$this->vars['data'] = [];
		}
		$this->output
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($this->vars, JSON_PRETTY_PRINT))
			->_display();
		exit;
	}
}