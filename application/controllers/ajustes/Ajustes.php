<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajustes extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("Ajustes_model");
	}

	public function index(){

		$data = array(
			'ajuste' => $this->Ajustes_model->getAjustes(), 
			'usuario' => $this->Ajustes_model->getUsuario(),
		);

		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('ajustes/ajustes',$data);
		$this->load->view('layouts/footer');
		

	}

}