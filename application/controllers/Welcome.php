<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	
	public function index()
	{
		$this->load->view('layouts/header.php');
		$this->load->view('layouts/aside.php');
		$this->load->view('welcome_message');
		$this->load->view('layouts/footer.php');
	}
}
