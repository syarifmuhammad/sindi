<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Lost_password extends Public_Controller {

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
	 * @return Void
	 */
	public function index() {
		$this->vars['page_title'] = 'Lost Password';
		$this->vars['content'] = 'users/lost_password';
		$this->load->view('users/index', $this->vars);
	}

	/**
	 * process
	 * @access  public
	 */
	public function process() {
		if ($this->input->is_ajax_request()) {
			if ($this->validation()) {
				$user_email = $this->input->post('email', TRUE);
				$this->load->model('m_users');
				$query = $this->m_users->get_user_by_email($user_email);
				if (NULL == $query) {
					$this->vars['status'] = 'warning';
					$this->vars['message'] = 'Email anda tidak terdaftar pada database kami';
				} else {
					$forgot_password_key = sha1($user_email . uniqid(mt_rand(), true));
					$sendgrid_api_key = "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";
					$from = new \SendGrid\Email('XPerfect Admin', 'ramadhan1787@gmail.com');
					$to = new SendGrid\Email($query['user_full_name'], $query['user_email']);
					$message = "Hi " . $query['user_full_name'];
					$message .= "<br><br>";
					$message .= "Silahkan klik tautan berikut untuk melakukan perubahan kata sandi Anda.";
					$message .= "<br>";
					$message .= "<a href=".base_url() . 'reset-password/' . $forgot_password_key.">".base_url() . 'reset-password/' . $forgot_password_key."</a>";
					$message .= "<br><br>";
					$message .= "Abaikan email ini jika Anda tidak mengajukan perubahan kata sandi ini.";
					$message .= "<br><br>";
					$message .= "Terima Kasih.";
					$message .= "<br><br>";
					$message .= "Admin";
					$message .= "<br>";
					$message .= "XPerfect Dev";
					$content = new SendGrid\Content("text/html", $message);
					$mail = new SendGrid\Mail($from, 'Lost Password', $to, $content);
					$sendgrid = new \SendGrid($sendgrid_api_key);
					$send_mail = $sendgrid->client->mail()->send()->post($mail);
					if ($send_mail->statusCode() == 202) {
						// update users tables
						$update = $this->m_users->set_forgot_password_key($user_email, $forgot_password_key);
						if ($update) {
							$this->vars['status'] = 'success';
							$this->vars['message'] = 'Tautan untuk mengubah kata sandi sudah kami kirimkan melalui email. Jika email tidak ditemukan, silahkan periksa pada folder spam.';
						} else {
							$this->vars['status'] = 'warning';
							$this->vars['message'] = 'Terjadi kesalahan dalam proses ubah kata sandi. Silahkan hubungi operator website untuk konfirmasi.';
						}
					} else {
						$this->vars['status'] = 'warning';
						$this->vars['message'] = 'Tautan untuk mengubah kata sandi tidak terkirim. Silahkan kirim email ke ' . $this->session->email;
					}
				}
			} else {
				$this->vars['status'] = 'error';
				$this->vars['message'] = validation_errors();
			}
			$this->output
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($this->vars, JSON_PRETTY_PRINT))
				->_display();
			exit;
		}
	}

	/**
	 * Validations Form
	 * @access  public
	 * @return Bool
	 */
	private function validation() {
		$this->load->library('form_validation');
		$val = $this->form_validation;
		$val->set_rules('email', 'Email', 'trim|required|valid_email');
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();
	}
}
