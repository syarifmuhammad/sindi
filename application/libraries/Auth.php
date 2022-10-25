<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth {

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
        $this->CI = &get_instance();
        $this->CI->load->model([
            'm_users',
            'm_user_privileges'
        ]);
    }

    /**
     * Logged In()
     * @param String $user_name
     * @param String $user_password
     * @param String $ip_address
     * @return Boolean
     */
    public function logged_in($user_name, $user_password, $ip_address, $tahun) {
        $ip_banned = $this->ip_banned($ip_address);
        if ( ! $ip_banned ) {
            $query = $this->CI->m_users->logged_in($user_name);
            if ($query->num_rows() === 1) {
                $data = $query->row();
                if (cek_password($user_name, $user_password, $data->user_password)) {
                    $session_data = [
                        'user_id' => $data->id,
						'user_group_id' => $data->user_group_id,
                        'user_name' => $data->user_name,
                        'user_full_name' => $data->user_full_name,
                        'user_email' => $data->user_email,
                        'user_type' => $data->user_type,
                        'has_login' => true,
						'tahun' => $tahun,
                        'user_privileges' => $this->CI->m_user_privileges->module_by_user_group_id($data->user_group_id, $data->user_type),
						'user_group' => get_value('user_groups', 'user_group', 'id', $data->user_group_id) ? strtolower(get_value('user_groups', 'user_group', 'id', $data->user_group_id)) : 'adm'
                    ];
					
					if ($data->user_group_id == 2) {
						$session_data['user_profile_id'] = $data->user_profile_id;
					}					
                    $this->CI->session->set_userdata($session_data);
                    $this->last_logged_in($data->id);
                    return true;
                }
                return false;
            }
            $this->increase_login_attempts($ip_address);
            return false;
        }
        return false;
    }

    /**
     * Get User ID
     * @return Int | NULL
     **/
    public function get_user_id() {
        $id = (int) $this->CI->session->user_id;
        return !empty($id) ? $id : NULL;
    }

    /**
     * Last Logged In
     * Fungsi untuk mengupdate data login terakhir
     * @param Int $id
     * @return Void
     */
    private function last_logged_in($id) {
        $this->CI->m_users->last_logged_in($id);
    }

    /**
     * Has Login
     * Fungsi untuk mengecek apakah data session user id kosong / tidak
     * @return Boolean
     */
    public function hasLogin() {
        return (bool) $this->CI->session->has_login;
    }

    /**
     * Restrict
     * Fungsi untuk validasi status login
     * @return Boolean
     */
    public function restrict() {
        if ( ! $this->hasLogin()) {
            redirect('login', 'refresh');
        }
    }

    /**
     * check if user has ban by ip address
     * @param String $ip_address
     * @return Boolean
     */
    public function ip_banned($ip_address) {
        $max_attempts = 3;
        $banned_time = 60; // 600 || Banned at 10 minutes
        $query = $this->CI->m_users->get_attempts($ip_address);
        if (is_object($query) && $query->counter >= $max_attempts) {
            $datetime = timebyzone($query->updated_at);
            $time_diff = time() - $datetime;
            if ($time_diff >= $banned_time) {
                $this->reset_attempts($ip_address);
                return false;
            }
            return true;
        }
        return false;
    }

    /**
     * Increase Login Attempts
     * @param String $ip_address
     * @return Void
     */
    private function increase_login_attempts($ip_address) {
        $this->CI->m_users->increase_login_attempts($ip_address);
    }

    /**
     * Reset Login Attempts
     * Fungsi untuk menghapus data login attempts
     * @param String $ip_address
     * @return Void
     */
    private function reset_attempts($ip_address) {
        $this->CI->m_users->reset_attempts($ip_address);
    }
}
