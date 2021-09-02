<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends Home_Core_Controller {
	public function __construct() {
		parent::__construct();
		/* cache control */
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
	}
	public function index() {
	    $this->load->view('theme/default/index');
	}
}

