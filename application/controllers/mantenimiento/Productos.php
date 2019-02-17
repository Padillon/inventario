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

        $id = $this->input->post('data_id');
        $data_in['id_categoria'] = $this->input->post('create_categoria');
        $data_in['codigo'] = $this->input->post('create_codigo');
        $data_in['id_stock'] =1;
        $data_in['nombre'] = $this->input->post('create_nombre');
        $data_in['descripcion'] = $this->input->post('create_descripcion');
        $data_in['precio_compra'] = $this->input->post('create_precio_compra');
        $data_in['precio_venta'] = $this->input->post('create_precio_venta');
     //  $data_in['imagen'] ="";
        $data_in['perecedero'] = $this->input->post('create_perecedero');
        $data_in['id_presentacion'] = $this->input->post('create_presentacion');

        if($id != ""){
            $producto = $this->Productos_model->update($id,$data_in);
        }else{
            $producto = $this->Productos_model->add($data_in);
        }
        if($producto){
            echo json_encode(array('status'=>true));
            //redirect(base_url()."mantenimiento/productos");
        }
        else{
            echo json_encode(array('status'=>false));
        }
    }

    public function get(){
        $id =$this->input->post('id');
        $id =$id;
        $data = $this->Productos_model->get($id);
        echo json_encode($data);
    }

    public function active(){
        $id_producto= $this->input->post('id-pro-active');
        $estado_producto= $this->input->post('estado-pro-active');
        if ($estado_producto!=0) {
            $data = array(
                'estado' =>0, 
            );
        }else{
            $data = array(
                'estado' =>1, 
            );
        }
        if ($this->Productos_model->update($id_producto, $data)) {
            redirect(base_url()."mantenimiento/productos");
        }
        else{
            $this->session->set_flashdata("error","No se puede eliminar la marca.");
            redirect(base_url()."mantenimiento/productos");
        }
        
    }
}