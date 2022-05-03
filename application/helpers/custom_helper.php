<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// translation
if ( ! function_exists('trans')):
	function trans($phrase){
        $translate_phrase = $phrase;
	    $ci =& get_instance();
		$ci->load->helper('language');
		$active_language = $ci->language_model->get_active_language();
		$ci->lang->load('site_lang',$active_language);
		$ci->config->set_item('language', $active_language);
        if($ci->lang->line($phrase) === FALSE):
            $ci->language_model->create_phrase($active_language,$phrase);
            $translate_phrase = ucfirst(str_replace("_", " ", $phrase));         
        else:
            $translate_phrase = $ci->lang->line($phrase,FALSE);
        endif;
	    return $translate_phrase;
    }
endif;

// configuration helper
if (! function_exists('CMS_config')):
	function CMS_config($title)
    {
    	$ci =& get_instance();
        return $ci->common_model->get_config($title);
    }
endif;

// theme helper
if (! function_exists('active_theme')):
	function active_theme()
    {
    	$ci =& get_instance();
        return $ci->common_model->get_active_theme();
    }
endif;