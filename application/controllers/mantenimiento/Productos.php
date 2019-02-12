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

    public function store(){
        $data_in['id_categoria'] = $this->input->post('create_categoria');
        $data_in['codigo'] = $this->input->post('create_codigo');
        $data_in['id_stock'] =1;
        $data_in['nombre'] = $this->input->post('create_nombre');
        $data_in['descripcion'] = $this->input->post('create_descripcion');
        $data_in['precio_compra'] = $this->input->post('create_precio_compra');
        $data_in['precio_venta'] = $this->input->post('create_precio_venta');
       // $data_in['imagen'] = $this->input->post('create_img');
        $data_in['inventariable'] = $this->input->post('create_inventariable');
        $data_in['id_presentacion'] = $this->input->post('create_presentacion');    
         $producto = $this->Productos_model->add($data_in);
        if($producto){
            echo json_encode(array('status'=>true));
        }
        else{
            echo json_encode(array('status'=>false));
        }
    }
}