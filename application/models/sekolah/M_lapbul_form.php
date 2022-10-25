<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_lapbul_form extends CI_Model {

	public function set_form($table, $id) {
		$check['id_index'] = $id;
		if(!$this->model->is_exists_array($check, $table)){				
			$data['sp_npsn'] = $this->session->user_profile_id;
			$data['tahun'] = $this->session->tahun;
			$data['id_index'] = $id;
			$data['created_at'] = date('Y-m-d H:i:s');
			$data['created_by'] = $this->session->user_id;			
			$this->model->insert($table, $data);									
		}
	}
	
	public function set_gtk($id) {
		$check_gtk['sp_npsn'] = $this->session->user_profile_id;
		$check_gtk['tahun'] = $this->session->tahun;
		$data_gtk = $this->model->is_exists_array($check_gtk, 'daftar_keadaan_guru');
		if($data_gtk){
			//$count_data_gtk = count_where('daftar_keadaan_guru', ['sp_npsn','tahun'], [$this->session->user_profile_id,$this->session->tahun]);
			$count_lapbul_data_gtk = count_where('lapbul_daftar_keadaan_guru', ['sp_npsn','tahun','id_index'], [$this->session->user_profile_id,$this->session->tahun,$id]);
			if($count_lapbul_data_gtk == 0){
				$list_data_gtk = $this->model->ResultWhere('daftar_keadaan_guru', ['sp_npsn','tahun'], [$this->session->user_profile_id,$this->session->tahun]);
				$data = [];
				foreach($list_data_gtk as $list){
					$data['sp_npsn'] = $this->session->user_profile_id;
					$data['tahun'] = $this->session->tahun;
					$data['id_index'] = $id;
					$data['id_gtk'] = $list->id;
					$data['nama'] = $list->nama;
					$data['nip'] = $list->nip;
					$data['nuptk'] = $list->nuptk;
					$data['tmp_lahir'] = $list->tmp_lahir;
					$data['tgl_lahir'] = $list->tgl_lahir;
					$data['jenis_kelamin'] = $list->jenis_kelamin;
					$data['golru'] = $list->golru;
					$data['jab'] = $list->jab;
					$data['ijazah'] = $list->ijazah;
					$data['agama'] = $list->agama;
					$data['tmt'] = $list->tmt;
					$data['mk_tahun'] = $list->mk_tahun;
					$data['mk_bulan'] = $list->mk_bulan;
					$data['mengajar_kel'] = $list->mengajar_kel;
					$data['ket_guru'] = $list->ket_guru;
					$data['created_at'] = date('Y-m-d H:i:s');
					$data['created_by'] = $this->session->user_id;			
					$this->model->insert('lapbul_daftar_keadaan_guru', $data);
				}
			}
		}
	}
}
