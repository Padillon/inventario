<?php
defined('BASEPATH') OR exit('No dorect script access allowed');

class Productos extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model("Productos_model");
        $this->load->model("Categorias_model");
        $this->load->model("Presentacion_model");
    }

    public function index(){
        $data = array(
            'producto' => $this->Productos_model->getProductos(), 
            'categoria' => $this->Categorias_model->getCategorias(),
            'presentacion'=> $this->Presentacion_model->getPresentaciones(),
        );
        $this->load->view("layouts/header");
        $this->load->view('layouts/aside');
        $this->load->view("admin/productos/list",$data);
        $this->load->view("layouts/footer");
    }

    public function store(){
        $config['upload_path'] = "assets/images/productos/";
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['overwrite'] = true;
        $config['max_size'] = '2048';
        $config['max_width'] = '1080';
        $config['max_height'] = '720';

        $this->load->library('upload',$config);

        $this->upload->do_upload('create_img');
          

            $file_info = $this->upload->data();
            $imagen = $file_info['file_name'];	

        $id = $this->input->post('data_id');
        $id_stock = $this->input->post('id_stock');
        $data_stock['stock_minimo'] = $this->input->post('create_stock_min');
        $data_in['id_categoria'] = $this->input->post('create_categoria');
        $data_in['codigo'] = $this->input->post('create_codigo');
        $data_in['nombre'] = $this->input->post('create_nombre');
        $data_in['descripcion'] = $this->input->post('create_descripcion');
        $data_in['precio_compra'] = $this->input->post('create_precio_compra');
        $data_in['precio_venta'] = $this->input->post('create_precio_venta');
        $data_in['imagen'] =$imagen;
        if ($this->input->post('create_perecedero')) {
            $data_in['perecedero'] = $this->input->post('create_perecedero');
        }
        $data_in['id_presentacion'] = $this->input->post('create_presentacion');

        if($id != ""){
            if ($this->Productos_model->updateStock($id_stock,$data_stock)) {
                $producto = $this->Productos_model->update($id,$data_in);
            }
        }else{
            $id_stock=$this->Productos_model->addStok($data_stock);
            $data_in['id_stock'] =$id_stock;
            $producto = $this->Productos_model->add($data_in);
        }
        if($producto){
            redirect(base_url()."mantenimiento/productos");
        }
        else{
            $this->session->set_flashdata("error","No se pudo actualizar la informacion");
            redirect(base_url()."mantenimiento/productos");
        }
    }

    public function get(){
        $id =$this->input->post('id');
        $data = $this->Productos_model->get($id);
        $data2 = $this->Productos_model->getStock($data->id_stock);
        $data->id_stock = $data->id_stock.'*'.$data2->stock_minimo;
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