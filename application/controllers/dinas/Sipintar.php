<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Sipintar extends Admin_Controller {

	/**
	 * Class Constructor
	 *
	 * @return Void
	 */
	public function __construct() {
		parent::__construct();
	}

	public function index($npsn){
		$this->vars['title'] = 'Rekap Usulan PIP Sekolah';
		$this->vars['sub_title'] = sekolahbynpsn($npsn).' / '.$npsn;
		$this->vars['sipintar'] = $this->vars['usulan'] = true;
		$this->vars['content'] = 'dinas/sipintar';
		$this->vars['ajax'] = $this->ajax($npsn);
		$this->vars['npsn'] = $npsn;
		$this->vars['colname'] = ['Nama', 'NISN', 'Tgl Lahir', 'Kelas', 'Alasan Layak', ''];
		$this->vars['length'] = 5;
		$this->load->view('backend/page', $this->vars);
	}
	
	private function ajax($npsn) {
		if ($this->input->is_ajax_request()) {
			ini_set('max_execution_time', 0); 
			ini_set('memory_limit','2048M');
			$url = 'https://pip.kemdikbud.go.id/enterprise/datatables/siswadinas/';
			$needlogin = 'login';
			$methode = 'post';			
			$send_data['draw'] = 2;
			$send_data['columns[0][data]'] = '';
			$send_data['columns[0][name]'] = '';
			$send_data['columns[0][searchable]'] = true;
			$send_data['columns[0][orderable]'] = false;
			$send_data['columns[0][search][value]'] = '';
			$send_data['columns[0][search][regex]'] = false;
			$send_data['columns[1][data]'] = 'nama_pd';
			$send_data['columns[1][name]'] = '';
			$send_data['columns[1][searchable]'] = true;
			$send_data['columns[1][orderable]'] = true;
			$send_data['columns[1][search][value]'] = '';
			$send_data['columns[1][search][regex]'] = false;
			$send_data['columns[2][data]'] = 'nisn';
			$send_data['columns[2][name]'] = '';
			$send_data['columns[2][searchable]'] = true;
			$send_data['columns[2][orderable]'] = true;
			$send_data['columns[2][search][value]'] = '';
			$send_data['columns[2][search][regex]'] = false;
			$send_data['columns[3][data]'] = 'tanggal_lahir';
			$send_data['columns[3][name]'] = '';
			$send_data['columns[3][searchable]'] = true;
			$send_data['columns[3][orderable]'] = true;
			$send_data['columns[3][search][value]'] = '';
			$send_data['columns[3][search][regex]'] = false;
			$send_data['columns[4][data]'] = 'kelas';
			$send_data['columns[4][name]'] = '';
			$send_data['columns[4][searchable]'] = true;
			$send_data['columns[4][orderable]'] = true;
			$send_data['columns[4][search][value]'] = '';
			$send_data['columns[4][search][regex]'] = false;
			$send_data['columns[5][data]'] = 'nama_ibu_kandung';
			$send_data['columns[5][name]'] = '';
			$send_data['columns[5][searchable]'] = true;
			$send_data['columns[5][orderable]'] = true;
			$send_data['columns[5][search][value]'] = '';
			$send_data['columns[5][search][regex]'] = false;
			$send_data['columns[6][data]'] = '';
			$send_data['columns[6][name]'] = '';
			$send_data['columns[6][searchable]'] = true;
			$send_data['columns[6][orderable]'] = false;
			$send_data['columns[6][search][value]'] = '';
			$send_data['columns[6][search][regex]'] = false;
			$send_data['columns[7][data]'] = 'peserta_didik_id';
			$send_data['columns[7][name]'] = '';
			$send_data['columns[7][searchable]'] = true;
			$send_data['columns[7][orderable]'] = true;
			$send_data['columns[7][search][value]'] = '';
			$send_data['columns[7][search][regex]'] = false;
			$send_data['columns[8][data]'] = 'alasan_layak';
			$send_data['columns[8][name]'] = '';
			$send_data['columns[8][searchable]'] = true;
			$send_data['columns[8][orderable]'] = true;
			$send_data['columns[8][search][value]'] = '';
			$send_data['columns[8][search][regex]'] = false;
			$send_data['columns[9][data]'] = 'no_KIP';
			$send_data['columns[9][name]'] = '';
			$send_data['columns[9][searchable]'] = true;
			$send_data['columns[9][orderable]'] = true;
			$send_data['columns[9][search][value]'] = '';
			$send_data['columns[9][search][regex]'] = false;
			$send_data['columns[10][data]'] = 'no_KKS';
			$send_data['columns[10][name]'] = '';
			$send_data['columns[10][searchable]'] = true;
			$send_data['columns[10][orderable]'] = true;
			$send_data['columns[10][search][value]'] = '';
			$send_data['columns[10][search][regex]'] = false;
			$send_data['columns[11][data]'] = 'no_KPS';
			$send_data['columns[11][name]'] = '';
			$send_data['columns[11][searchable]'] = true;
			$send_data['columns[11][orderable]'] = true;
			$send_data['columns[11][search][value]'] = '';
			$send_data['columns[11][search][regex]'] = false;
			$send_data['columns[12][data]'] = 'penghasilan_ayah';
			$send_data['columns[12][name]'] = '';
			$send_data['columns[12][searchable]'] = true;
			$send_data['columns[12][orderable]'] = true;
			$send_data['columns[12][search][value]'] = '';
			$send_data['columns[12][search][regex]'] = false;
			$send_data['columns[13][data]'] = 'kebutuhan_khusus';
			$send_data['columns[13][name]'] = '';
			$send_data['columns[13][searchable]'] = true;
			$send_data['columns[13][orderable]'] = true;
			$send_data['columns[13][search][value]'] = '';
			$send_data['columns[13][search][regex]'] = false;
			$send_data['order[0][column]'] = 1;
			$send_data['order[0][dir]'] = 'asc';
			$send_data['start'] = 0;
			$send_data['length'] = 150;
			$send_data['search[value]'] = '';
			$send_data['search[regex]'] = false;
			$send_data['npsn'] = $npsn;
			$send_data['status_data'] = 'bisa';
			$send_data['alasan_layak'] = 'all';
			
			$data = sipintar_data($url,$needlogin,$methode,$send_data);		
			if($data['status'] == 'error'){
				$this->vars['status'] = 'error';
				$this->vars['message'] = 'Error '.$data['code'].'. '.$data['message'].' !';
				$this->vars['data'] = [];
			} else {
				$response = json_decode($data['data']);
				if($response == null){
					$this->vars['status'] = 'error';
					$this->vars['message'] = 'Data tidak ditemukan pada server Sipintar Enterprise !';
					$this->vars['data'] = [];
				} else {
					// $count = count($response[1]);
					$sipintar = $response->data->data;
					$x = 1;
					$data_dapodik = [];
					foreach($sipintar as $datax){
						$data_dapodik[$x][] = $x; // No Urut
						$data_dapodik[$x][] = $datax->nama_pd; // Nama Peserta Didik
						$data_dapodik[$x][] = $datax->nisn; // NISN
						$data_dapodik[$x][] = $datax->tanggal_lahir; // Tgl Lahir
						$data_dapodik[$x][] = $datax->kelas; // Kelas
						$data_dapodik[$x][] = $datax->alasan_layak == null ? 'Kosong' : $datax->alasan_layak; // Alasan Usul PIP
						$data_dapodik[$x][] = '<button class="btn btn-info btn-xs" onclick="verifikasi(\''.$datax->peserta_didik_id.'\');">Verifikasi</button>'; // Alasan Usul PIP
						$x++;
					}
									
					usort($data_dapodik, function ($t1, $t2) {
						return $t1[0] - $t2[0];
					});		
					$this->vars['status'] = 'success';
					$this->vars['message'] = 'Data berhasil diambil dari server dapodik.';
					$this->vars['data'] = $data_dapodik;				
				}
			}			
			$this->output
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($this->vars, JSON_PRETTY_PRINT))
				->_display();
			exit;
		}
	}
	
	public function usulkan($npsn) {
		if ($this->input->is_ajax_request()) {
			ini_set('max_execution_time', 0); 
			ini_set('memory_limit','2048M');
			$url = 'https://pip.kemdikbud.go.id/enterprise/usulan/usulkan';
			$needlogin = 'login';
			$methode = 'post';			
			$send_data['npsn'] = $npsn;
			$send_data['status_data'] = 'bisa';
			$send_data['alasan_layak'] = 'all';
			$send_data['dataTables-siswa-sk_length'] =  150;
			$send_data['usulan-id[]'] =  $this->input->post('usul_id', true);
			$send_data['usulan-all[]'] =  $this->input->post('usul_id', true);
			
			$data = sipintar_data($url,$needlogin,$methode,$send_data);		
			if($data['status'] == 'error'){
				$this->vars['status'] = 'error';
				$this->vars['message'] = 'Error '.$data['code'].'. '.$data['message'].' !';
				$this->vars['data'] = [];
			} else {
				$response = json_decode($data['data']);
				if($response == null){
					$this->vars['status'] = 'error';
					$this->vars['message'] = 'Data tidak ditemukan pada server Sipintar Enterprise !';
					$this->vars['data'] = [];
				} else {
					// $count = count($response[1]);
					$sipintar = $response->data->data;
					$x = 1;
					$data_dapodik = [];
					/*
					foreach($sipintar as $datax){
						$data_dapodik[$x][] = $x; // No Urut
						$data_dapodik[$x][] = $datax->nama_pd; // Nama Peserta Didik
						$data_dapodik[$x][] = $datax->nisn; // NISN
						$data_dapodik[$x][] = $datax->tanggal_lahir; // Tgl Lahir
						$data_dapodik[$x][] = $datax->kelas; // Kelas
						$data_dapodik[$x][] = $datax->alasan_layak == null ? 'Kosong' : $datax->alasan_layak; // Alasan Usul PIP
						$data_dapodik[$x][] = '<button class="btn btn-info btn-xs" onclick="verifikasi(\''.$datax->peserta_didik_id.'\');">Verifikasi</button>'; // Alasan Usul PIP
						$x++;
					}
									
					usort($data_dapodik, function ($t1, $t2) {
						return $t1[0] - $t2[0];
					});
					*/					
					$this->vars['status'] = 'success';
					$this->vars['message'] = 'Data berhasil diambil dari server dapodik.';
					$this->vars['data'] = $data_dapodik;				
				}
			}			
			$this->output
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($this->vars, JSON_PRETTY_PRINT))
				->_display();
			exit;
		}
	}

}
