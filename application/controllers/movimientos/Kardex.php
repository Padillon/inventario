<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kardex extends CI_Controller {
    private $permisos;
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('usuario_log')=="") {
			redirect(base_url());
	} else{
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Entradas_model");
		$this->load->model("Productos_model");
		$this->load->model("Proveedores_model");
		$this->load->model("Kardex_model");
	}
	}

    public function index(){
        $data = array(
			'permisos' => $this->permisos,
			'kardex' => $this->Kardex_model->getKardex(),
        );
        $this->load->view("layouts/header");
        $this->load->view('layouts/aside');
        $this->load->view("admin/kardex/list",$data);
        $this->load->view("layouts/footer");
	}
}
