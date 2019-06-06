<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CreatePdf extends CI_Controller {
	private $permisos;
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('usuario_log')=="") {
			redirect(base_url());
        }
    }

    function pdf()
    {
        $this->load->helper('pdf_helper');
        /*
            ---- ---- ---- ----
            your code here
            ---- ---- ---- ----
        */
        $this->load->view('pdfreport', $data);
    }
}