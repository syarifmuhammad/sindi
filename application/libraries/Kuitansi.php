<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH.'/third_party/tcpdf/tcpdf.php';

class Kuitansi extends TCPDF {

   /**
    * Reference to CodeIgniter instance
    *
    * @var object
    */
   protected $CI;

	/**
	 * Class Constructor
	 *
	 * @return Void
	 */
	public function __construct() {
		parent::__construct('P', 'mm', array(  210,   400), true, 'UTF-8', false);
		$this->CI = &get_instance();
	}

	/**
	 * Overide Header
	 */
	public function Header() {

	}

	/**
	 * Overide Footer
	 */
	public function Footer() {
    	
	}

	/**
	 * Create Admission PDF Form
	 * @param Array $result
	 */
	public function create_pdf(array $result) {
		$this->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$this->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$this->SetAutoPageBreak(TRUE, 1);
		$this->setImageScale(PDF_IMAGE_SCALE_RATIO);
		// Set Properties
		$this->SetTitle('KUITANSI-'.$result['id']);
		$this->SetAuthor('SISTAS Versi 0.1');
		$this->SetSubject('SISTAS Versi 0.1');
		$this->SetKeywords('SISTAS Versi 0.1');
		$this->SetCreator("Balai KIPM Semarang");
		$this->SetMargins(5, 5, 5, true);
		
		$this->AddPage();
		$this->SetFont('times', '', 10);

		// Get HTML Template
		$content = file_get_contents(VIEWPATH.'surat/kuitansi.html');
		// $content = str_replace('[KODE_KEGIATAN]', $result['kd_keg'], $content);
		// $content = str_replace('[NO_URUT_KWITANSI]', $result['nomor_kwitansi'], $content);
		// $content = str_replace('[KODE_REKENING]', $result['kd_rek'], $content);
		// $content = str_replace('[TAHUN_ANGGARAN]', $result['tahun'], $content);
		// $content = str_replace('[YAITU]', $result['uraian'], $content);
		// $content = str_replace('[QRCODE]', base_url('media_library/qr_code/'.$result['nomor_kwitansi'].'.png'), $content);
		// $content = str_replace('[NILAI_KWITANSI]', number_format($result['nilai_kwitansi'],2,",","."), $content);
		// $content = str_replace('[PPN/PD]', $result['ket_ppnpd'] == '' ? 'PPN' : $result['ket_ppnpd'], $content);
		// $content = str_replace('[NILAI_PPN]', number_format($result['nilai_ppnpd'],2,",","."), $content);
		// $content = str_replace('[NILAI_SETELAH_PPN]', number_format($result['nilai_kwitansi']-$result['nilai_ppnpd'],2,",","."), $content);
		// $content = str_replace('[PPH]', $result['ket_pph'] == '' ? 'PPh' : $result['ket_pph'], $content);
		// $content = str_replace('[NILAI_PPH]', number_format($result['nilai_pph'],2,",","."), $content);
		// $content = str_replace('[JUMLAH_BERSIH]', number_format(($result['nilai_kwitansi']-$result['nilai_ppnpd'])-$result['nilai_pph'],2,",","."), $content);
		// $content = str_replace('[BANYAKNYA_UANG]', '=='.ucwords($result['terbilang'].' rupiah').' ==', $content);
		// $content = str_replace('[REKENING]', $result['nama_rekening'], $content);
		// $content = str_replace('[KEGIATAN]', $result['nama_kegiatan'], $content);
		// $content = str_replace('[KOTA]', 'Kotabaru', $content);
		// $content = str_replace('[TGL_KWITANSI]', '................................................', $content);
		// $content = str_replace('[NAMA_PENERIMA]', '...............................................................', $content);
		// $content = str_replace('[PANGKAT_PENERIMA]', '...............................................................', $content);
		// $content = str_replace('[ALAMAT_PENERIMA]', '...............................................................', $content);
		// $content = str_replace('PPh Pasal 4(2) Konstruksi', 'PPh Pasal 4(2)', $content);
		// $content = str_replace('PPh Pasal 4(2) Konsultan', 'PPh Pasal 4(2)', $content);
		// $content = str_replace('Lunas dibayar :', $result['nama_bpp'] == NULL ? '' :  'Lunas dibayar :', $content);
		// $content = str_replace('Bendahara Pengeluaran Pembantu,', $result['nama_bpp'] == NULL ? '' :  'Bendahara Pengeluaran Pembantu,', $content);
		// $content = str_replace('[BENDAHARA_PENGELUARAN_PEMBANTU]', $result['nama_bpp'] == NULL ? '' :  $result['nama_bpp'], $content);
		// $content = str_replace('[NIP_BENDAHARA_PENGELUARAN_PEMBANTU]', $result['nip_bpp'] == NULL ? '' :  'NIP.'.$result['nip_bpp'], $content);
		// $content = str_replace('[JABATAN_PA/KPA]', $result['jab_pakpa'], $content);
		// $content = str_replace('[NAMA_PA/KPA]', $result['nama_pakpa'], $content);
		// $content = str_replace('[NIP_PA/KPA]', $result['nip_pakpa'] == NULL ? '' : 'NIP.'.$result['nip_pakpa'], $content);
		// $content = str_replace('Telah diperiksa :', $result['nama_pptk'] == NULL ? '' :  'Telah diperiksa :', $content);
		// $content = str_replace('Pejabat Pelaksana Teknis Kegiatan (PPTK),', $result['nama_pptk'] == NULL ? '' :  'Pejabat Pelaksana Teknis Kegiatan (PPTK),', $content);
		// $content = str_replace('[NAMA_PPTK]', $result['nama_pptk'], $content);
		// $content = str_replace('[NIP_PPTK]', $result['nip_pptk'] == NULL ? '' : 'NIP.'.$result['nip_pptk'], $content);
		// $content = str_replace('[NAMA_BENDAHARA_PENGELUARAN]', $result['nama_bp'], $content);
		// $content = str_replace('[NIP_BENDAHARA_PENGELUARAN]', $result['nip_bp'] == NULL ? '' : 'NIP.'.$result['nip_bp'], $content);
		// $content = str_replace('[SCHOOL_NAME]', strtoupper($this->CI->session->school_name), $content);
		// $content = str_replace('[SCHOOL_STREET_ADDRESS]', $this->CI->session->street_address, $content);
		// $content = str_replace('[SCHOOL_PHONE]', $this->CI->session->phone, $content);
		// $content = str_replace('[SCHOOL_FAX]', $this->CI->session->fax, $content);
		// $content = str_replace('[SCHOOL_POSTAL_CODE]', $this->CI->session->postal_code, $content);
		// $content = str_replace('[SCHOOL_EMAIL]', $this->CI->session->email, $content);
		// $content = str_replace('[SCHOOL_WEBSITE]', str_replace(['http://', 'https://', 'www.'], '', $this->CI->session->website), $content);
		// $content = str_replace('[TITLE]', 'Formulir Penerimaan ' . ucwords(strtolower($this->CI->session->_student)) .' Baru Tahun '.$this->CI->session->admission_year, $content);
		// Registrasi Peserta Didik
		// $content = str_replace('[STUDENT_TYPE]', ($this->CI->session->school_level >= 5 ? 'Calon Mahasiswa' : 'Calon Peserta Didik'), $content);
		// $content = str_replace('[IS_TRANSFER]', ($result['is_transfer'] == 'true' ? 'Pindahan':'Baru'), $content);
		// $content = str_replace('[ADMISSION_TYPE]', $result['admission_type'], $content);
		// $content = str_replace('[REGISTRATION_NUMBER]', $result['registration_number'], $content);
		// $content = str_replace('[CREATED_AT]', $result['created_at'], $content);
		// if ($this->CI->session->school_level >= 3) {
			// $content = str_replace('[FIRST_CHOICE]', $result['first_choice'], $content);
			// $content = str_replace('[SECOND_CHOICE]', $result['second_choice'], $content);
		// } else {
			// $replace = '<tr><td align="right">Pilihan I</td><td align="center">:</td><td align="left">[FIRST_CHOICE]</td></tr>';
			// $content = str_replace($replace, '', $content);
			// $replace = '<tr><td align="right">Pilihan II</td><td align="center">:</td><td align="left">[SECOND_CHOICE]</td></tr>';
			// $content = str_replace($replace, '', $content);
		// }

		// $content = str_replace('[PREV_SCHOOL_NAME]', $result['prev_school_name'], $content);
		// $content = str_replace('[PREV_SCHOOL_ADDRESS]', $result['prev_school_address'], $content);
		// Profile
		// $content = str_replace('[FULL_NAME]', $result['full_name'], $content);
		// $content = str_replace('[GENDER]', $result['gender'], $content);

		// if ($this->CI->session->school_level == 2 || $this->CI->session->school_level == 3 || $this->CI->session->school_level == 4) {
			// $content = str_replace('[NISN]', $result['nisn'], $content);
		// } else {
			// $replace = '<tr><td align="right">NISN</td><td align="center">:</td><td align="left">[NISN]</td></tr>';
			// $content = str_replace($replace, '', $content);
		// }
		// if ($this->CI->session->school_level > 1) {
			// $content = str_replace('[NIK]', $result['nik'], $content);
		// } else {
			// $replace = '<tr><td align="right">NIK</td><td align="center">:</td><td align="left">[NIK]</td></tr>';
			// $content = str_replace($replace, '', $content);
		// }
		// $content = str_replace('[BIRTH_PLACE]', $result['birth_place'], $content);
		// $content = str_replace('[BIRTH_DATE]', indo_date($result['birth_date']), $content);
		// $content = str_replace('[RELIGION]', $result['religion'], $content);
		// $content = str_replace('[SPECIAL_NEEDS]', $result['special_needs'], $content);
		// Alamat
		// $content = str_replace('[STREET_ADDRESS]', $result['street_address'], $content);
		// $content = str_replace('[RT]', $result['rt'], $content);
		// $content = str_replace('[RW]', $result['rw'], $content);
		// $content = str_replace('[SUB_VILLAGE]', $result['sub_village'], $content);
		// $content = str_replace('[VILLAGE]', $result['village'], $content);
		// $content = str_replace('[SUB_DISTRICT]', $result['sub_district'], $content);
		// $content = str_replace('[DISTRICT]', $result['district'], $content);
		// $content = str_replace('[POSTAL_CODE]', $result['postal_code'], $content);
		// $content = str_replace('[EMAIL]', $result['email'], $content);
		// $content = str_replace('[FOOTER_DATE]', $result['district'].', '. indo_date(substr($result['created_at'], 0, 10)), $content);
		// $content = str_replace('[FOOTER_FULL_NAME]', $result['full_name'], $content);
		$file_name = $result['id'];
		$this->writeHTML($content, true, false, true, false, 'C');
		$this->Output(FCPATH . 'media_library/kwitansi/'.$file_name, 'F');
	}

	
}

/* End of file Kuitansi.php */
/* Location: ./application/libraries/Kuitansi.php */
