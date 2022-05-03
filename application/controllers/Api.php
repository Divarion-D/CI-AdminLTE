<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require(APPPATH . '/libraries/RestController.php');

use chriskacerguis\RestServer\RestController;

class Api extends RestController {

    function __construct() {
        parent::__construct();
        $this->load->model('common_model');
        $this->load->database();

        /*cache controling*/
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        ('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }

    // index function
    public function index() {
        echo "Method is not defined.";
    }

    //test api function
    public function test_get() {
        $response['status']     = 'success';
        $response['message']    = 'Rest API is working...';
        $this->response($response, 200);
    }

    public function test_post() {
        $response['status']     = 'success';
        $response['message']    = 'Rest API is working...';
        $this->response($response, 200);
    }
}
