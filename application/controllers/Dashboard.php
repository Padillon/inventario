<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	
	public function index()
	{
        $this->load->view('views/header.php');
        $this->load->view('views/aside.php');
        $this->load->view('admin/dashboard.php');
        $this->load->view('admin/footer.php');
		
	}
}
