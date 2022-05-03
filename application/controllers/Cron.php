<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cron extends Home_Core_Controller {

    public function index($slug = '') {
        echo "This is cron.";
    }

    public function test($cron_key = '', $param2 = '') {
        // check cron key is sent
        if (!empty($cron_key) && $cron_key != '' && $cron_key != NULL) :
            // verify api secret key
            $verify_apps_cron_key =   $this->common_model->check_cron_key($cron_key);
            if ($verify_apps_cron_key) :
                print "Cron ok";
            else :
                echo 'Cron key is invalid.';
            endif;
        else :
            echo 'Cron key must not be null or empty.';
        endif;
    }
}
