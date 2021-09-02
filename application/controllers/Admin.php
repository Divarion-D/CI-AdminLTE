<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends Admin_Core_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('common_model');
		$this->load->library('ion_auth');
		$this->load->database();
		//cache controlling
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	
	}
	//default index function, redirects to login/dashboard
	public function index() {
		if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) redirect(base_url() . 'login', 'refresh');
		if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) redirect(base_url() . 'admin/dashboard', 'refresh');
	}
	//dashboard
	function dashboard() {
		if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) redirect(base_url(), 'refresh');
		
		/* Title Page */
        $this->data['page_name'] = 'dashboard';
		$this->data['page_title'] = trans('admin_dashboard');

        /* Install */
        $this->data['dashboard_alert_file_install'] = $this->common_model->get_file_install();

        /* Data */
        $this->data['count_users']       = $this->common_model->get_count_record('users');
        $this->data['count_groups']      = $this->common_model->get_count_record('groups');
        $this->data['disk_totalspace']   = $this->common_model->disk_totalspace(DIRECTORY_SEPARATOR);
        $this->data['disk_freespace']    = $this->common_model->disk_freespace(DIRECTORY_SEPARATOR);
        $this->data['disk_usespace']     = $this->data['disk_totalspace'] - $this->data['disk_freespace'];
        $this->data['disk_usepercent']   = $this->common_model->disk_usepercent(DIRECTORY_SEPARATOR, FALSE);
        $this->data['memory_usage']      = $this->common_model->memory_usage();
        $this->data['memory_peak_usage'] = $this->common_model->memory_peak_usage(TRUE);
        $this->data['memory_usepercent'] = $this->common_model->memory_usepercent(TRUE, FALSE);
        
		/* start menu active/inactive section*/
		$this->session->unset_userdata('active_menu');
		$this->session->set_userdata('active_menu', '1');
		/* end menu active/inactive section*/
		$this->load->view('admin/index', $this->data);
	}
	function users() {
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) redirect(base_url(), 'refresh');
        
		/* Title Page */
        $this->data['page_name'] = 'users';
		$this->data['page_title'] = trans('users');
		$this->data['breadcrumb'] = trans('manager');

		/* Get all users */
		$this->data['users'] = $this->ion_auth->users()->result();
		foreach ($this->data['users'] as $k => $user)
		{
			$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
		}
		/* Load Template */
		$this->load->view('admin/index', $this->data);
	}
	function groups() {
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) redirect(base_url(), 'refresh');
        
		/* Title Page */
        $this->data['page_name'] = 'groups';
		$this->data['page_title'] = trans('groups');
		$this->data['breadcrumb'] = trans('groups');

        $this->data['groups'] = $this->ion_auth->groups()->result();

        /* Load Template */
        $this->load->view('admin/index', $this->data);
    }
	function prefs_interfaces($type = NULL) {
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) redirect(base_url(), 'refresh');
        
        $this->load->model('preferences_model');
        
		/* Title Page */
        $this->data['page_title'] = trans('prefs_interfaces');
		$this->data['breadcrumb'] = trans('prefs_interfaces');

        if ($type == 'admin')
        {
            $this->data['page_name'] = 'prefs_interfaces_admin';
            
            /* Validate form input */
            $this->form_validation->set_rules('user_panel', 'lang:prefs_user_panel', 'required|is_numeric');
            $this->form_validation->set_rules('sidebar_form', 'lang:prefs_sidebar_form', 'required|is_numeric');
            $this->form_validation->set_rules('messages_menu', 'lang:prefs_messages_menu', 'required|is_numeric');
            $this->form_validation->set_rules('notifications_menu', 'lang:prefs_notifications_menu', 'required|is_numeric');
            $this->form_validation->set_rules('tasks_menu', 'lang:prefs_tasks_menu', 'required|is_numeric');
            $this->form_validation->set_rules('user_menu', 'lang:prefs_user_menu', 'required|is_numeric');
            $this->form_validation->set_rules('ctrl_sidebar', 'lang:prefs_ctrl_sidebar', 'required|is_numeric');
            $this->form_validation->set_rules('transition_page', 'lang:prefs_transition_page', 'required|is_numeric');

            /* Data */
            $this->data['message_admin']        = (validation_errors()) ? validation_errors() : NULL;
            $this->data['admin_pref_interface'] = $this->preferences_model->get_interface('admin_preferences');

            if ($this->form_validation->run() == TRUE)
            {
                $data = array(
                    'user_panel'         => (bool) $this->input->post('user_panel'),
                    'sidebar_form'       => (bool) $this->input->post('sidebar_form'),
                    'messages_menu'      => (bool) $this->input->post('messages_menu'),
                    'notifications_menu' => (bool) $this->input->post('notifications_menu'),
                    'tasks_menu'         => (bool) $this->input->post('tasks_menu'),
                    'user_menu'          => (bool) $this->input->post('user_menu'),
                    'ctrl_sidebar'       => (bool) $this->input->post('ctrl_sidebar'),
                    'transition_page'    => (bool) $this->input->post('transition_page')
                );

                $this->preferences_model->update_interfaces('admin_preferences', $data);

                redirect('admin/prefs_interfaces/admin', 'refresh');
            }
            else
            {
                /* Load Template */
                $this->load->view('admin/index', $this->data);
            }
        }
        elseif ($type == 'public')
        {
            $this->data['page_name'] = 'prefs_interfaces_public';
            
            /* Validate form input */
            $this->form_validation->set_rules('transition_page', 'lang:prefs_transition_page', 'required|is_numeric');

            /* Data */
            $this->data['message_public']        = (validation_errors()) ? validation_errors() : NULL;
            $this->data['public_pref_interface'] = $this->preferences_model->get_interface('public_preferences');

            if ($this->form_validation->run() == TRUE)
            {
                $data = array(
                    'transition_page' => (bool) $this->input->post('transition_page')
                );

                $this->preferences_model->update_interfaces('public_preferences', $data);

                redirect('admin/prefs_interfaces/public', 'refresh');
            }
            else
            {
                /* Load Template */
		        $this->load->view('admin/index', $this->data);
            }
        }
        else
        {
            redirect('admin', 'refresh');
        }
	}
	function files() {
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) redirect(base_url(), 'refresh');
        
		/* Title Page */
        $this->data['page_name'] = 'files';
		$this->data['page_title'] = trans('files');
		$this->data['breadcrumb'] = trans('files');
            
        /* Data */
        $this->data['error'] = NULL;

        /* Load Template */
         $this->load->view('admin/index', $this->data);
	}
	function database() {
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) redirect(base_url(), 'refresh');
        
		/* Title Page */
        $this->data['page_name'] = 'database';
		$this->data['page_title'] = trans('database');
		$this->data['breadcrumb'] = trans('database');

        /* Data */
        $this->data['list_tables'] = $this->db->list_tables();
        $this->data['platform']    = $this->db->platform();
        $this->data['version']     = $this->db->version();

        /* Load Template */
        $this->load->view('admin/index', $this->data);

	}
	function license() {
		if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) redirect(base_url(), 'refresh');
		
		/* Title Page */
        $this->data['page_name'] = 'license';
		$this->data['page_title'] = trans('license');
		
        /* Breadcrumbs */
        $this->data['breadcrumb'] = trans('license');

        /* Load Template */
        $this->load->view('admin/index', $this->data);
	}
	function resources() {
		if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) redirect(base_url(), 'refresh');
		
		/* Title Page */
        $this->data['page_name'] = 'resources';
		$this->data['page_title'] = trans('resources');
		
        /* Breadcrumbs */
        $this->data['breadcrumb'] = trans('resources');

        /* Load Template */
        $this->load->view('admin/index', $this->data);
        
	}
	function do_upload() {
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) redirect(base_url(), 'refresh');
        
        /* Conf */
        $config['upload_path']      = './upload/';
        $config['allowed_types']    = 'gif|jpg|png';
        $config['max_size']         = 2048;
        $config['max_width']        = 1024;
        $config['max_height']       = 1024;
        $config['file_ext_tolower'] = TRUE;

        $this->load->library('upload', $config);

        /* Breadcrumbs */
		$this->data['breadcrumb'] = trans('do_upload');

        if (!$this->upload->do_upload('userfile')){
            /* Data */
            $this->data['error'] = $this->upload->display_errors();
            
            /* Title Page */
            $this->data['page_name'] = 'files';
		    $this->data['page_title'] = trans('files');

            /* Load Template */
            $this->load->view('admin/index', $this->data);
        }else{
            /* Data */
            $this->data['upload_data'] = $this->upload->data();
            
            /* Title Page */
            $this->data['page_name'] = 'uploads_files';
		    $this->data['page_title'] = trans('files');

            /* Load Template */
            $this->load->view('admin/index', $this->data);
        }
	}
	function reset_interfaces_admin() {
		if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) redirect(base_url(), 'refresh');
        
        $this->load->model('preferences_model');
        
        $data = array(
            'user_panel'         => '0',
            'sidebar_form'       => '0',
            'messages_menu'      => '0',
            'notifications_menu' => '0',
            'tasks_menu'         => '0',
            'user_menu'          => '1',
            'ctrl_sidebar'       => '0',
            'transition_page'    => '0'
        );

        $this->preferences_model->update_interfaces('admin_preferences', $data);

        redirect('admin/prefs_interfaces/admin', 'refresh');
	}
	function reset_interfaces_public() {
		if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) redirect(base_url(), 'refresh');
        
        $this->load->model('preferences_model');
        
        $data = array(
            'transition_page' => '0'
        );

        $this->preferences_model->update_interfaces('public_preferences', $data);

        redirect('admin/prefs_interfaces/public', 'refresh');
    }
	function groups_create() {
		if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) redirect(base_url(), 'refresh');
        
		/* Title Page */
        $this->data['page_name'] = 'groups_create';
		$this->data['page_title'] = trans('groups_create');
		$this->data['breadcrumb'] = trans('groups_create');

       	/* Validate form input */
		$this->form_validation->set_rules('group_name', 'lang:create_group_validation_name_label', 'required|alpha_dash');

		if ($this->form_validation->run() == TRUE)
		{
			$new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
			if ($new_group_id)
			{
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect('admin/groups', 'refresh');
			}
		}
		else
		{
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$this->data['group_name'] = array(
				'name'  => 'group_name',
				'id'    => 'group_name',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('group_name')
			);
			$this->data['description'] = array(
				'name'  => 'description',
				'id'    => 'description',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('description')
			);

            /* Load Template */
            $this->load->view('admin/index', $this->data);
		}
	}
	function groups_delete() {
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) redirect(base_url(), 'refresh');
        
		/* Title Page */
        $this->data['page_name'] = 'groups_delete';
		$this->data['page_title'] = trans('groups_delete');
		$this->data['breadcrumb'] = trans('groups_delete');
		
        if ( ! $this->ion_auth->is_admin())
		{
            return show_error('You must be an administrator to view this page.');
        }
        else
        {
            $this->load->view('admin/index', $this->data);
        }
	}
	function groups_edit($id) {
		if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) redirect(base_url(), 'refresh');
        
		/* Title Page */
        $this->data['page_name'] = 'groups_edit';
		$this->data['page_title'] = trans('groups_edit');
		$this->data['breadcrumb'] = trans('groups_edit');

        /* Variables */
		$group = $this->ion_auth->group($id)->row();

		/* Validate form input */
        $this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'), 'required|alpha_dash');

		if (isset($_POST) && ! empty($_POST))
		{
			if ($this->form_validation->run() == TRUE)
			{
				$group_update = $this->ion_auth->update_group($id, $_POST['group_name'], $_POST['group_description']);

				if ($group_update)
				{
					$this->session->set_flashdata('message', $this->lang->line('edit_group_saved'));

                    /* IN TEST */
                    $this->db->update('groups', array('bgcolor' => $_POST['group_bgcolor']), 'id = '.$id);
				}
				else
				{
					$this->session->set_flashdata('message', $this->ion_auth->errors());
				}

				redirect('admin/groups', 'refresh');
			}
		}

        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
        $this->data['group']   = $group;

		$readonly = $this->config->item('admin_group', 'ion_auth') === $group->name ? 'readonly' : '';

		$this->data['group_name'] = array(
			'type'    => 'text',
			'name'    => 'group_name',
			'id'      => 'group_name',
			'value'   => $this->form_validation->set_value('group_name', $group->name),
            'class'   => 'form-control',
			$readonly => $readonly
		);
		$this->data['group_description'] = array(
			'type'  => 'text',
			'name'  => 'group_description',
			'id'    => 'group_description',
			'value' => $this->form_validation->set_value('group_description', $group->description),
            'class' => 'form-control'
		);
		$this->data['group_bgcolor'] = array(
			'type'     => 'text',
			'name'     => 'group_bgcolor',
			'id'       => 'group_bgcolor',
			'value'    => $this->form_validation->set_value('group_bgcolor', $group->bgcolor),
			'data-src' => $group->bgcolor,
            'class'    => 'form-control'
		);

        /* Load Template */
        $this->load->view('admin/index', $this->data);
	}
	function users_create() {
		if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) redirect(base_url(), 'refresh');
        
		/* Title Page */
        $this->data['page_name'] = 'users_create';
		$this->data['page_title'] = trans('users_create');
		$this->data['breadcrumb'] = trans('users_create');

		/* Variables */
		$tables = $this->config->item('tables', 'ion_auth');

		/* Validate form input */
		$this->form_validation->set_rules('first_name', 'lang:users_firstname', 'required');
		$this->form_validation->set_rules('last_name', 'lang:users_lastname', 'required');
		$this->form_validation->set_rules('email', 'lang:users_email', 'required|valid_email|is_unique['.$tables['users'].'.email]');
		$this->form_validation->set_rules('phone', 'lang:users_phone', 'required');
		$this->form_validation->set_rules('company', 'lang:users_company', 'required');
		$this->form_validation->set_rules('password', 'lang:users_password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm', 'lang:users_password_confirm', 'required');

		if ($this->form_validation->run() == TRUE)
		{
			$username = strtolower($this->input->post('first_name')) . ' ' . strtolower($this->input->post('last_name'));
			$email    = strtolower($this->input->post('email'));
			$password = $this->input->post('password');

			$additional_data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name'  => $this->input->post('last_name'),
				'company'    => $this->input->post('company'),
				'phone'      => $this->input->post('phone'),
			);
		}

		if ($this->form_validation->run() == TRUE && $this->ion_auth->register($username, $password, $email, $additional_data))
		{
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect('admin/users', 'refresh');
		}
		else
		{
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$this->data['first_name'] = array(
				'name'  => 'first_name',
				'id'    => 'first_name',
				'type'  => 'text',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('first_name'),
			);
			$this->data['last_name'] = array(
				'name'  => 'last_name',
				'id'    => 'last_name',
				'type'  => 'text',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('last_name'),
			);
			$this->data['email'] = array(
				'name'  => 'email',
				'id'    => 'email',
				'type'  => 'email',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('email'),
			);
			$this->data['company'] = array(
				'name'  => 'company',
				'id'    => 'company',
				'type'  => 'text',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('company'),
			);
			$this->data['phone'] = array(
				'name'  => 'phone',
				'id'    => 'phone',
				'type'  => 'tel',
				'pattern' => '^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('phone'),
			);
			$this->data['password'] = array(
				'name'  => 'password',
				'id'    => 'password',
				'type'  => 'password',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('password'),
			);
			$this->data['password_confirm'] = array(
				'name'  => 'password_confirm',
				'id'    => 'password_confirm',
				'type'  => 'password',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('password_confirm'),
			);

			/* Load Template */
			$this->load->view('admin/index', $this->data);
		}
	}
	function users_delete() {
		if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) redirect(base_url(), 'refresh');
        
		/* Title Page */
        $this->data['page_name'] = 'users_delete';
		$this->data['page_title'] = trans('users_delete');
		$this->data['breadcrumb'] = trans('users_delete');
		
		$this->load->view('admin/index', $this->data);
	}
	function users_edit($id) {
	    if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) redirect(base_url(), 'refresh');
        
		/* Title Page */
        $this->data['page_name'] = 'users_edit';
		$this->data['page_title'] = trans('users_edit');
		$this->data['breadcrumb'] = trans('users_edit');
	    
		$id = (int) $id;

		/* Data */
		$user          = $this->ion_auth->user($id)->row();
		$groups        = $this->ion_auth->groups()->result_array();
		$currentGroups = $this->ion_auth->get_users_groups($id)->result();

		/* Validate form input */
		$this->form_validation->set_rules('first_name', 'lang:edit_user_validation_fname_label', 'required');
		$this->form_validation->set_rules('last_name', 'lang:edit_user_validation_lname_label', 'required');
		$this->form_validation->set_rules('phone', 'lang:edit_user_validation_phone_label', 'required');
		$this->form_validation->set_rules('company', 'lang:edit_user_validation_company_label', 'required');

		if (isset($_POST) && ! empty($_POST))
		{
			if ($this->common_model->_valid_csrf_nonce() === FALSE OR $id != $this->input->post('id'))
			{
				show_error($this->lang->line('error_csrf'));
			}

			if ($this->input->post('password'))
			{
				$this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
				$this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
			}

			if ($this->form_validation->run() == TRUE)
			{
				$data = array(
					'first_name' => $this->input->post('first_name'),
					'last_name'  => $this->input->post('last_name'),
					'company'    => $this->input->post('company'),
					'phone'      => $this->input->post('phone')
				);

				if ($this->input->post('password'))
				{
					$data['password'] = $this->input->post('password');
				}

				if ($this->ion_auth->is_admin())
				{
					$groupData = $this->input->post('groups');

					if (isset($groupData) && !empty($groupData))
					{
						$this->ion_auth->remove_from_group('', $id);

						foreach ($groupData as $grp)
						{
							$this->ion_auth->add_to_group($grp, $id);
						}
					}
				}

				if($this->ion_auth->update($user->id, $data))
				{
					$this->session->set_flashdata('message', $this->ion_auth->messages());

					if ($this->ion_auth->is_admin())
					{
						redirect('admin/users', 'refresh');
					}
					else
					{
						redirect('admin', 'refresh');
					}
				}
				else
				{
					$this->session->set_flashdata('message', $this->ion_auth->errors());

					if ($this->ion_auth->is_admin())
					{
						redirect('auth', 'refresh');
					}
					else
					{
						redirect('/', 'refresh');
					}
				}
			}
		}

		// display the edit user form
		$this->data['csrf'] = $this->common_model->_get_csrf_nonce();

		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		// pass the user to the view
		$this->data['user']          = $user;
		$this->data['groups']        = $groups;
		$this->data['currentGroups'] = $currentGroups;

		$this->data['first_name'] = array(
			'name'  => 'first_name',
			'id'    => 'first_name',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $this->form_validation->set_value('first_name', $user->first_name)
		);
		$this->data['last_name'] = array(
			'name'  => 'last_name',
			'id'    => 'last_name',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $this->form_validation->set_value('last_name', $user->last_name)
		);
		$this->data['company'] = array(
			'name'  => 'company',
			'id'    => 'company',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $this->form_validation->set_value('company', $user->company)
		);
		$this->data['phone'] = array(
			'name'  => 'phone',
			'id'    => 'phone',
			'type'  => 'tel',
			'pattern' => '^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$',
			'class' => 'form-control',
			'value' => $this->form_validation->set_value('phone', $user->phone)
		);
		$this->data['password'] = array(
			'name' => 'password',
			'id'   => 'password',
			'class' => 'form-control',
			'type' => 'password'
		);
		$this->data['password_confirm'] = array(
			'name' => 'password_confirm',
			'id'   => 'password_confirm',
			'class' => 'form-control',
			'type' => 'password'
		);


		/* Load Template */
		$this->load->view('admin/index', $this->data);
	}
	
    function users_activate($id, $code = FALSE) {
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) redirect(base_url(), 'refresh');
        
		/* Title Page */
		$this->data['page_title'] = trans('user_activate');
		$this->data['breadcrumb'] = trans('user_activate');
        
		$id = (int) $id;

		if ($code !== FALSE)
		{
			$activation = $this->ion_auth->activate($id, $code);
		}
		else if ($this->ion_auth->is_admin())
		{
			$activation = $this->ion_auth->activate($id);
		}

		if ($activation)
		{
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect('admin/users', 'refresh');
		}
		else
		{
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect('auth/forgot_password', 'refresh');
		}
	}
	function users_deactivate($id = NULL) {
		if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) redirect(base_url(), 'refresh');
        
		/* Title Page */
        $this->data['page_name'] = 'users_deactivate';
		$this->data['page_title'] = trans('users_deactivate');
		$this->data['breadcrumb'] = trans('users_deactivate');

		/* Validate form input */
		$this->form_validation->set_rules('confirm', 'lang:deactivate_validation_confirm_label', 'required');
		$this->form_validation->set_rules('id', 'lang:deactivate_validation_user_id_label', 'required|alpha_numeric');

		$id = (int) $id;

		if ($this->form_validation->run() === FALSE)
		{
			$user = $this->ion_auth->user($id)->row();

			$this->data['csrf']       = $this->common_model->_get_csrf_nonce();
			$this->data['id']         = (int) $user->id;
			$this->data['firstname']  = ! empty($user->first_name) ? htmlspecialchars($user->first_name, ENT_QUOTES, 'UTF-8') : NULL;
			$this->data['lastname']   = ! empty($user->last_name) ? ' '.htmlspecialchars($user->last_name, ENT_QUOTES, 'UTF-8') : NULL;

			/* Load Template */
			$this->load->view('admin/index', $this->data);
		}
		else
		{
			if ($this->input->post('confirm') == 'yes')
			{
				if ($this->common_model->_valid_csrf_nonce() === FALSE OR $id != $this->input->post('id'))
				{
					show_error($this->lang->line('error_csrf'));
				}

				if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
				{
					$this->ion_auth->deactivate($id);
				}
			}

			redirect('admin/users', 'refresh');
		}
	}
    function users_profile($id) {
		if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) redirect(base_url(), 'refresh');
        
		/* Title Page */
        $this->data['page_name'] = 'users_profile';
		$this->data['page_title'] = trans('users_profile');
		$this->data['breadcrumb'] = trans('users_profile');
		
		/* Data */
		$id = (int) $id;

		$this->data['user_info'] = $this->ion_auth->user($id)->result();
		foreach ($this->data['user_info'] as $k => $user)
		{
			$this->data['user_info'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
		}

		/* Load Template */
		$this->load->view('admin/index', $this->data);
	}
}

