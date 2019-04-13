<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Entradas extends CI_Controller {
	public function __construct(){
		parent::__construct();
        $this->load->model("Entradas_model");
	}

	public function index(){
        $data = array(
            'entradas' => $this->Entradas_model->getEntradas(),
        );
        $this->load->view("layouts/header");
        $this->load->view('layouts/aside');
        $this->load->view("admin/entradas/list",$data);
        $this->load->view("layouts/footer");
	}
	
	public function add(){
        $this->load->view("layouts/header");
        $this->load->view('layouts/aside');
        $this->load->view("admin/entradas/add");
        $this->load->view("layouts/footer");
    }

    public function getProveedores(){
		$prov = $this->Entradas_model->getProveedores();
		echo json_encode($prov);
    }

    public function getProductos(){
        $valor = $this->input->post("valor");
		$producto = $this->Entradas_model->getProductos($valor);
		echo json_encode($producto);
    }
}