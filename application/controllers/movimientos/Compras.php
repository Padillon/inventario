<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compras extends CI_Controller {
	public function __construct(){
		parent::__construct();
        $this->load->model("Compras_model");
	}

	public function index(){
        $data = array(
            'compras' => $this->Compras_model->getCompras(),
        );
        $this->load->view("layouts/header");
        $this->load->view('layouts/aside');
        $this->load->view("admin/compras/list",$data);
        $this->load->view("layouts/footer");
	}
	
	public function add(){
        $this->load->view("layouts/header");
        $this->load->view('layouts/aside');
        $this->load->view("admin/compras/add");
        $this->load->view("layouts/footer");
    }

    public function getProveedores(){
		$prov = $this->Compras_model->getProveedores();
		echo json_encode($prov);
    }

    public function getProductos(){
        $valor = $this->input->post("valor");
		$producto = $this->Compras_model->getProductos($valor);
		echo json_encode($producto);
    }
}