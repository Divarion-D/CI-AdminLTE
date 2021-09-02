<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Language_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set(CMS_config('timezone'));
    }
    public function language_id_exist($id=''){
        $result             = false;
        $query              = $this->db->get_where('language_list',array('id'=>$id));
        if($query->num_rows() > 0)
            $result         = true;
        return $result;
    }
    public function language_by_id($id=''){
        $language           = $this->db->get_where('config' , array('title'=>'language'))->row()->value;
        $this->db->limit(1);
        $query              = $this->db->get_where('language_list' , array('id'=>$id));
        if($query->num_rows()  > 0):
            $language       = $query->row()->folder_name;
        endif;
        return $language;
    }
    public function get_active_language(){
        $active_language_id         = $this->session->userdata('active_language_id');
        if($active_language_id =='' || !$this->language_id_exist($active_language_id))
            $active_language_id     = $this->common_model->get_config('active_language_id');
        $active_language            = $this->language_by_id($active_language_id);
        return $active_language;
    }
}