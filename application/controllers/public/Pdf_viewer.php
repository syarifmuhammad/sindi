<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Pdf_viewer extends Public_Controller {

	/**
	 * Class Constructor
	 *
	 * @return Void
	 */
	public function __construct() {
		parent::__construct();
	}	

	public function view_pdf($folder, $file_name) {
		$this->vars['title'] = $file_name;
		$this->vars['folder'] = $folder;
		$this->vars['file_name'] = $file_name;
		$this->load->view('public/pdf_viewer', $this->vars);
	}
	
	public function pdf_content($folder, $file_name) {
		$path = FCPATH.'media_library/'.$folder.'/'.$file_name;
		// header('Content-Type: application/pdf');
		@readfile($path);
	}
}
