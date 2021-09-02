<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Common_model extends CI_Model {
	/**
	 * __construct.
	 *
	 * @return	void
	 */
	function __construct() {
		parent::__construct();
	}
	/* clear cache*/
	/**
	 * clear_cache.
	 *
	 * @return	void
	 */
	public function get_config($title = '') {
        if ($title == 'active_theme'){
            $result = $this->get_active_theme();
        }else{
            $query = $this->db->get_where('config', array('title' => $title));
		    if ($query->num_rows() > 0):
			    $result = $query->row()->value;
		    else:
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
        if ($user_id == NULL){
            $theme = 'default';
		    $query = $this->db->get_where('config', array('title' => "active_theme"));
		    if ($query->num_rows() > 0):
			    $db_theme_name = $query->row()->value;
			    if (is_dir(APPPATH . 'views/theme/' . $db_theme_name)):
				    $theme = $query->row()->value;
			    endif;
	    	endif;
        }else{
            $theme = $this->db->get_where('users', array('id' => $user_id))->row()->theme;
        }
		return $theme;
	}
	
	public function get_count_record($table)
    {
        $query = $this->db->count_all($table);

        return $query;
    }


    public function disk_totalspace($dir = DIRECTORY_SEPARATOR)
    {
        return disk_total_space($dir);
    }


    public function disk_freespace($dir = DIRECTORY_SEPARATOR)
    {
        return disk_free_space($dir);
    }


    public function disk_usespace($dir = DIRECTORY_SEPARATOR)
    {
        return $this->disk_totalspace($dir) - $this->disk_freespace($dir);
    }


    public function disk_freepercent($dir = DIRECTORY_SEPARATOR, $display_unit = FALSE)
    {
        if ($display_unit === FALSE)
        {
            $unit = NULL;
        }
        else
        {
            $unit = ' %';
        }

        return round(($this->disk_freespace($dir) * 100) / $this->disk_totalspace($dir), 0).$unit;
    }


    public function disk_usepercent($dir = DIRECTORY_SEPARATOR, $display_unit = FALSE)
    {
        if ($display_unit === FALSE)
        {
            $unit = NULL;
        }
        else
        {
            $unit = ' %';
        }

        return round(($this->disk_usespace($dir) * 100) / $this->disk_totalspace($dir), 0).$unit;
    }


    public function memory_usage()
    {
        return memory_get_usage();
    }


    public function memory_peak_usage($real = TRUE)
    {
        if ($real)
        {
            return memory_get_peak_usage(TRUE);
        }
        else
        {
            return memory_get_peak_usage(FALSE);
        }
    }


    public function memory_usepercent($real = TRUE, $display_unit = FALSE)
    {
        if ($display_unit === FALSE)
        {
            $unit = NULL;
        }
        else
        {
            $unit = ' %';
        }

        return round(($this->memory_usage() * 100) / $this->memory_peak_usage($real), 0).$unit;
    }
    public function get_file_install()
    {     
        if (file_exists('install.php'))
        {
            $val = '<div class="row">';
            $val.= '<div class="col-md-12">';
            $val.= '<div class="alert alert-danger">';
            $val.= '<h4><i class="icon fa fa-warning"></i>' . trans('actions_security_error') . '</h4>';
            $val.= '<p>' . sprintf(trans('actions_file_install_exist'), '<a href="#" class="btn btn-warning btn-flat btn-xs">' . strtolower(trans('actions_delete')) . '</a>') . '</p>';
            $val.= '</div>';
            $val.= '</div>';
            $val.= '</div>';

            return $val;
        }
    }
    public function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key   = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}
	public function _valid_csrf_nonce()
	{
		if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE && $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}

