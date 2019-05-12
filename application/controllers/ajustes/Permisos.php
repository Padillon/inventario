<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permisos extends CI_Controller {
	private $permisos;
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('usuario_log')=="") {
			redirect(base_url());
	} else{
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Permisos_model"); 
	}
		
	}

	public function index(){

		$data = array(
			'permisos' => $this->permisos,
			'permisos_list' => $this->Permisos_model->getPermisos(),
		);

		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('ajustes/permisos/list',$data);
		$this->load->view('layouts/footer');
	}

}