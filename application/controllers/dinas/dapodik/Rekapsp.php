<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Rekapsp extends Admin_Controller {

	/**
	 * Class Constructor
	 *
	 * @return Void
	 */
	public function __construct() {
		parent::__construct();
	}

	public function index(){
		$this->vars['title'] = 'Rekap Satuan Pendidikan (SD)';
		$this->vars['sub_title'] = 'Rekap Dapodik sesuai singkron terakhir sekolah';
		$this->vars['dapodik'] = $this->vars['rekapsp'] = true;
		$this->vars['content'] = 'dinas/dapodik/rekapsp';
		$this->vars['ajax'] = $this->ajax();
		$this->vars['colname'] = ['Nama Sekolah', 'NPSN', 'Status', 'Kecamatan', 'Jumlah Siswa'];
		$this->vars['length'] = 10;
		$this->load->view('backend/index', $this->vars);
	}
	
	private function ajax() {
		if ($this->input->is_ajax_request()) {
			ini_set('max_execution_time', 0); 
			ini_set('memory_limit','2048M');
			$url = 'https://datadik.kemdikbud.go.id/ma74/rekapsp';
			$needlogin = 'login';
			$methode = 'post';
			$post_data['postkolom'] = 'yes';
			$post_data['sp_nama'] = 'on'; // Nama Sekolah
			$post_data['sp_npsn'] = 'on'; // NPSN
			$post_data['sp_status'] = 'on'; // Status
			$post_data['sp_kecamatan'] = 'on'; // Kecamatan
			$post_data['r7_total'] = 'on'; // Total Siswa Aktif
			$post_data['sp_id'] = 'on'; // Sekolah ID
			$post_data['bentukpendidikan'] = 5;
			$post_data['statussekolah'] = 0;
			$data = dapodik_data($url,$needlogin,$methode,$post_data);		
			if($data['status'] == 'error'){
				$this->vars['status'] = 'error';
				$this->vars['message'] = 'Error '.$data['code'].'. '.$data['message'].' !';
				$this->vars['data'] = [];
			} else {
				$response = json_decode($data['data']);
				if($response == null){
					$this->vars['status'] = 'error';
					$this->vars['message'] = 'Data tidak ditemukan pada server dapodik !';
					$this->vars['data'] = [];
				} else {
					$count = count($response[1]);
					$data_dapodik = [];
					for($x = 0; $x < $count; $x++){
						$data_dapodik[$x][] = $x+1; // No Urut
						$data_dapodik[$x][] = $response[1][$x][0]; // Nama Sekolah
						$data_dapodik[$x][] = '<button class="btn btn-xs btn-info" onclick="usulan_pip('.$response[1][$x][1].');">'.$response[1][$x][1].'</button>'; // NPSN
						$data_dapodik[$x][] = $response[1][$x][2]; // Status
						$data_dapodik[$x][] = $response[1][$x][3]; // Kecamatan
						$data_dapodik[$x][] = $response[1][$x][4] == null ? 0 : $response[1][$x][4]; // Total Siswa Aktif
						$data_dapodik[$x][] = $response[1][$x][5]; // Sekolah ID
					}					
					usort($data_dapodik, function ($t1, $t2) {
						return $t1[2] - $t2[2];
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
	
	public function rkpsatuan() {
		if ($this->input->is_ajax_request()) {
			ini_set('max_execution_time', 0); 
			ini_set('memory_limit','2048M');
			$url = 'https://datadik.kemdikbud.go.id/ma74/rekapsp';
			$needlogin = 'login';
			$methode = 'post';
			$post_data['postkolom'] = 'yes';
			$post_data['sp_nama'] = 'on'; // Nama Sekolah
			$post_data['sp_npsn'] = 'on'; // NPSN
			$post_data['sp_status'] = 'on'; // Status
			$post_data['sp_kecamatan'] = 'on'; // Kecamatan
			$post_data['r7_total'] = 'on'; // Total Siswa Aktif
			$post_data['sp_id'] = 'on'; // Sekolah ID
			$post_data['bentukpendidikan'] = 5;
			$post_data['statussekolah'] = 0;
			/*
			postkolom: yes
			sp_nama: on
			sp_npsn: on
			sp_bentuk: on
			sp_status: on
			sp_koreg: on
			sp_alamat: on
			sp_desa: on
			sp_kecamatan: on
			sp_kab: on
			sp_propinsi: on
			sp_pos: on
			sp_koordinat: on
			sp_telepon: on
			sp_npwp: on
			r1_nama: on
			r1_nip: on
			r1_hp: on
			r1_email: on
			r1_plt: on
			r16_nama: on
			r2_semester_id: on
			r13_akreditasi: on
			r3_nama: on
			r3_email: on
			r3_handphone: on
			r4_last_sync: on
			r5_kurikulum: on
			r6_pertingkat: on
			r6_total: on
			r9_jumlah: on
			r10_jumlah: on
			r11_jumlah: on
			r12_jumlah: on
			r7_pertingkat: on
			r7_total: on
			r7_usia: on
			r7_agama: on
			r7_keluar: on
			r8_kelas_rusak: on
			r8_kelas_total: on
			r8_perpus_rusak: on
			r8_perpus_total: on
			r8_labkom_rusak: on
			r8_labkom_total: on
			r8_labbahasa_rusak: on
			r8_labbahasa_total: on
			r8_labipa_rusak: on
			r8_labipa_total: on
			r8_labfisika_rusak: on
			r8_labfisika_total: on
			r8_labbiologi_rusak: on
			r8_labbiologi_total: on
			r8_kepsek_rusak: on
			r8_kepsek_total: on
			r8_guru_rusak: on
			r8_guru_total: on
			r8_tu_rusak: on
			r8_tu_total: on
			r8_wc_guru_laki_rusak: on
			r8_wc_guru_laki_total: on
			r8_wc_guru_perempuan_rusak: on
			r8_wc_guru_perempuan_total: on
			r8_wc_siswa_laki_rusak: on
			r8_wc_siswa_laki_total: on
			r8_wc_siswa_perempuan_rusak: on
			r8_wc_siswa_perempuan_total: on
			r14_meja_siswa: on
			r14_kursi_siswa: on
			r14_papan_tulis: on
			r14_komputer: on
			r15_guru: on
			r15_tendik: on
			sp_id: on
			*/
			$data = dapodik_data($url,$needlogin,$methode,$post_data);		
			if($data['status'] == 'error'){
				$this->vars['status'] = 'error';
				$this->vars['message'] = 'Error '.$data['code'].'. '.$data['message'].' !';
				$this->vars['data'] = [];
			} else {
				$response = json_decode($data['data']);
				if($response == null){
					$this->vars['status'] = 'error';
					$this->vars['message'] = 'Data tidak ditemukan pada server dapodik !';
					$this->vars['data'] = [];
				} else {
					$count = count($response[1]);
					$data_dapodik = [];
					for($x = 0; $x < $count; $x++){
						$data_dapodik[$x][] = $x+1; // No Urut
						$data_dapodik[$x][] = $response[1][$x][0]; // Nama Sekolah
						$data_dapodik[$x][] = '<button class="btn btn-xs btn-info" onclick="usulan_pip('.$response[1][$x][1].');">'.$response[1][$x][1].'</button>'; // NPSN
						$data_dapodik[$x][] = $response[1][$x][2]; // Status
						$data_dapodik[$x][] = $response[1][$x][3]; // Kecamatan
						$data_dapodik[$x][] = $response[1][$x][4] == null ? 0 : $response[1][$x][4]; // Total Siswa Aktif
						$data_dapodik[$x][] = $response[1][$x][5]; // Sekolah ID
					}					
					usort($data_dapodik, function ($t1, $t2) {
						return $t1[2] - $t2[2];
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

}
