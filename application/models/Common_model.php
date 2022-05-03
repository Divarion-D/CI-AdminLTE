<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Common_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_config($title = '') {
        if ($title == 'active_theme') {
            $result = $this->get_active_theme();
        } else {
            $query = $this->db->get_where('config', array('title' => $title));
            if ($query->num_rows() > 0) :
                $result = $query->row()->value;
            else :
                $data['title'] = $title;
                $data['value'] = $title;
                $this->db->insert('config', $data);
            endif;
        }
        return $result;
    }
    /**
     * get_active_theme.
     *
     * @access	public
     * @return	mixed
     */
    public function get_active_theme() {

        $user_id = $this->session->userdata('user_id');
        if ($user_id == NULL) {
            $theme = 'default';
            $query = $this->db->get_where('config', array('title' => "active_theme"));
            if ($query->num_rows() > 0) :
                $db_theme_name = $query->row()->value;
                if (is_dir(APPPATH . 'views/theme/' . $db_theme_name)) :
                    $theme = $query->row()->value;
                endif;
            endif;
        } else {
            $theme = $this->db->get_where('users', array('id' => $user_id))->row()->theme;
        }
        return $theme;
    }

    public function _get_csrf_nonce() {
        $this->load->helper('string');
        $key   = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return array($key => $value);
    }

    public function _valid_csrf_nonce() {
        if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE && $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue')) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * check_cron_key.
     *
     * @access	public
     * @param	mixed	$user_cron_ke
     * @return	mixed
     */
    public function check_cron_key($user_cron_key = '') {
        $result = FALSE;
        $cron_key = CMS_config('cron_key');
        if ($cron_key == $user_cron_key) :
            $result = TRUE;
        endif;
        return $result;
    }
}
