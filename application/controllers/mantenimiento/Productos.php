<?php
defined('BASEPATH') OR exit('No dorect script access allowed');

class Productos extends CI_Controller {
    private $permisos;
    public function __construct(){
        parent::__construct();
        if($this->session->userdata('usuario_log')=="") {
            redirect(base_url());
    } else{
        $this->permisos = $this->backend_lib->control();
        $this->load->model("Productos_model");
        $this->load->model("Categorias_model");
        $this->load->model("Presentacion_model");
        $this->load->model("Marcas_model");
        $this->load->library('toastr');
    }
    }

    public function index(){
        $data = array(
            'permisos' => $this->permisos,
            'producto' => $this->Productos_model->getProductos(), 
        );
        $this->load->view("layouts/header");
        $this->load->view('layouts/aside');
        $this->load->view("admin/productos/list",$data);
        $this->load->view("layouts/footer");
    }

    public function agregar(){
          $data = array(
            'producto' => $this->Productos_model->getProductos(), 
            'categoria' => $this->Categorias_model->getCategorias(),
            'presentacion'=> $this->Presentacion_model->getPresentaciones(), 
            'marcas' => $this->Marcas_model->getMarcas(),
        );
        $this->load->view("layouts/header");
        $this->load->view('layouts/aside');
        $this->load->view("admin/productos/add",$data);
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
        $data_in['id_marca'] = $this->input->post('create_marca');
        $data_in['id_categoria'] = $this->input->post('create_categoria');
        $data_in['codigo'] = $this->input->post('create_codigo');
        $data_in['nombre'] = $this->input->post('create_nombre');
        $data_in['descripcion'] = $this->input->post('create_descripcion');
        $data_in['precio_compra'] = $this->input->post('create_precio_compra');
        $data_in['precio_venta'] = $this->input->post('create_precio_venta');
        $data_in['imagen'] =$imagen;
        if ($this->input->post('create_perecedero') != "" ) {
            $data_in['perecedero'] =1;
        }else{
            $data_in['perecedero'] =0;
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
            $this->toastr->success('Registro guardado!');
            redirect(base_url()."mantenimiento/productos");
        }
        else{
            $this->toastr->error('No se pudo completar la operación.');
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

    public function edit_get(){
        $config['upload_path'] = "assets/images/productos/";
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['overwrite'] = true;
        $config['max_size'] = '2048';
        $config['max_width'] = '1080';
        $config['max_height'] = '720';

        $this->load->library('upload',$config);

        $this->upload->do_upload('edit_img');
            $file_info = $this->upload->data();
            $imagen = $file_info['file_name'];

        $id =$this->input->post('id-pro-edit');
        $data2 = $this->Productos_model->get($id);
        $data3 = $this->Productos_model->getStock($data2->id_stock);
        $id_stock = $data2->id_stock;
        $stock_minimo = $data3->stock_minimo;
        $data = array(
            'id_stock' => $id_stock,
            'stock_minimo'=> $stock_minimo,
            'producto' => $data2, 
            'categoria' => $this->Categorias_model->getCategorias(),
            'presentacion'=> $this->Presentacion_model->getPresentaciones(),
            'marcas'=>$this->Marcas_model->getMarcas(),
            'imagen' => $imagen
        );
        $this->load->view("layouts/header");
        $this->load->view('layouts/aside');
        $this->load->view("admin/productos/edit",$data);
        $this->load->view("layouts/footer");
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
            $this->toastr->success('Registro guardado!');
            redirect(base_url()."mantenimiento/productos");
        }
        else{
            $this->toastr->error('No se pudo completar la operación.');
            redirect(base_url()."mantenimiento/productos");
        }
    }
}