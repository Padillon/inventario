<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	
	public function index()
	{
        $this->load->view('layouts/header');
        $this->load->view('layouts/aside');
        $this->load->view('admin/dashboard');
        $this->load->view('layouts/footer');
		
	}
}
