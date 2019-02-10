<?php
defined('BASEPATH') OR exit('No dorect script access allowed');

class Productos extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model("Productos_model");
        $this->load->model("Categorias_model");
    }

    public function index(){
        $data = array(
            'producto' => $this->Productos_model->getProductos(), 
            'categoria' => $this->Categorias_model->getCategorias(), 
        );
        $this->load->view("layouts/header");
        $this->load->view('layouts/aside');
        $this->load->view("admin/productos/list",$data);
        $this->load->view("layouts/footer");
    }
}