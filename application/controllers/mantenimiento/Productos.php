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
        $this->load->library("Pdf");
    }
    }

    public function index(){
        $data = array(
            'permisos' => $this->permisos,
            'producto' => $this->Productos_model->getProductos(), 
            'marcas' => $this->Marcas_model->getMarcas(),
            'categoria' => $this->Categorias_model->getCategorias(),
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

    public function getSerie(){
        $marca =$this->input->post('marca');
        $categoria =$this->input->post('categoria');
        $resultado = $this->Productos_model->getSerie($marca,$categoria);
        echo json_encode($resultado);
    }

    public function store(){
        $config['upload_path'] = "assets/images/productos/";
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['overwrite'] = true;
        $config['max_size'] = '4048';
        $config['max_width'] = '4080';


        $this->load->library('upload',$config);

            $this->upload->do_upload('create_img');
            $file_info = $this->upload->data();
            $imagen = $file_info['file_name'];
            if ($imagen != "") {
                $data_in['imagen'] =$imagen;

            }

     

        $id = $this->input->post('data_id');
        $id_stock = $this->input->post('id_stock');
        $data_in['id_marca'] = $this->input->post('create_marca');
        $data_in['id_categoria'] = $this->input->post('create_categoria');
        $data_in['nombre'] = $this->input->post('create_nombre');
        $data_in['descripcion'] = $this->input->post('create_descripcion');
        if ($this->input->post('create_perecedero') != "" ) {
            $data_in['perecedero'] =1;
        }else{
            $data_in['perecedero'] =0;
        }
     
        //datos para agregar presentaciones del producto
        $minimo = $this->input->post('create_stock_min');        
        $presentacion = $this->input->post('presentaciones');
        $id_present = $this->input->post('id_presentacion');
        $valor_unidades = $this->input->post('cantidad_prese');
        $P_compra= $this->input->post('precio_compra');
        $P_venta= $this->input->post('precio_venta');
        $COD = $this->input->post('codigos_de_barra');
        $data_stock['stock_minimo'] = 0;

        for ($i=0; $i < count($id_present); $i++) { 
           if ($id_present[$i] == $presentacion) {
            $data_stock['stock_minimo'] = (int)$valor_unidades[$i] * $minimo;
           }
        } 
        $this->db->trans_start(); // ******************************************************** iniciamos transaccion **************************************
                if($id != ""){ ///////////////////////zona de update
                    if ($this->Productos_model->updateStock($id_stock,$data_stock)){
                        $producto = $this->Productos_model->update($id,$data_in);
                        $prentaciones_producto = $this->Productos_model->getPresentacion_productos($id);
                        for ($i=0; $i < count($prentaciones_producto) ; $i++) {
                            $data = array(
                                'estado' => 0,
                            );
                            $this->Productos_model->updatePresentacio_producto($prentaciones_producto[$i]->id_presentacion_producto,$data);
                        }
                        
                        for ($p=0; $p < count($id_present) ; $p++) {
                            $noExiste = 0;
                            $idPresentacion = 0;
                            for ($i=0; $i < count($prentaciones_producto) ; $i++) {
                                if($prentaciones_producto[$i]->id_presentacion == $id_present[$p]){ 
                                $noExiste = 1;
                                $idPresentacion = $prentaciones_producto[$i]->id_presentacion_producto;

                                }
                            }

                            if($noExiste == 0){ 
                                    if ($id_present[$p] == $presentacion) {
                                        $data = array(
                                            'id_presentacion' => $id_present[$p],
                                            'id_producto' => $id,
                                            'valor' => $valor_unidades[$p],
                                            'precio_compra' => $P_compra[$p],
                                            'precio_venta' => $P_venta[$p],
                                            'codigo' => $COD[$p],
                                            'equivalencia' =>1,
            
                                        );
                                    }else{
                                        $data = array(
                                            'id_presentacion' => $id_present[$p],
                                            'id_producto' => $id,
                                            'valor' => $valor_unidades[$p],
                                            'precio_compra' => $P_compra[$p],
                                            'precio_venta' => $P_venta[$p],
                                            'codigo' => $COD[$p],
                                            'equivalencia' =>0,
                                        );
                                    }
                                    $this->Productos_model->addPresentacionesProducto($data);      
                            }else{
                                if ($id_present[$p] == $presentacion) {
                                    $data = array(
                                    //  'id_presentacion' => $id_present[$p],
                                        //'id_producto' => $id,
                                        'valor' => $valor_unidades[$p],
                                        'precio_compra' => $P_compra[$p],
                                        'precio_venta' => $P_venta[$p],
                                        'codigo' => $COD[$p],
                                        'equivalencia' =>1,
                                        'estado' =>1,
        
                                    );
                                }else{
                                    $data = array(
                                        //'id_presentacion' => $id_present[$p],
                                    //  'id_producto' => $id,
                                        'valor' => $valor_unidades[$p],
                                        'precio_compra' => $P_compra[$p],
                                        'precio_venta' => $P_venta[$p],
                                        'codigo' => $COD[$p],
                                        'equivalencia' =>0,
                                        'estado' =>1,

                                    );
                                }
                                $this->Productos_model->updatePresentacio_producto($idPresentacion,$data);      
                            }
                            
                        }
                    }
                    
                }else{ ///////////////////////zona de agregar
                    $id_stock=$this->Productos_model->addStok($data_stock);
                    $data_in['id_stock'] =$id_stock;
                    $producto = $this->Productos_model->add($data_in);         
                    for ($i=0; $i < count($id_present) ; $i++) { 
                        if ($id_present[$i] == $presentacion) {
                            $data = array(
                                'id_presentacion' => $id_present[$i],
                                'id_producto' => $producto,
                                'valor' => $valor_unidades[$i],
                                'precio_compra' => $P_compra[$i],
                                'precio_venta' => $P_venta[$i],
                                'codigo' => $COD[$i],
                                'equivalencia' =>1,

                            );
                           }else{
                            $data = array(
                                'id_presentacion' => $id_present[$i],
                                'id_producto' => $producto,
                                'valor' => $valor_unidades[$i],
                                'precio_compra' => $P_compra[$i],
                                'precio_venta' => $P_venta[$i],
                                'codigo' => $COD[$i],
                                'equivalencia' =>0,
                            );
                         }
                        $this->Productos_model->addPresentacionesProducto($data);
                        
                    }
                }
        $this->db ->trans_complete();// ******************************************************** completamos transaccion **************************************

        
        if($this->db->trans_status()){ // ******************************************************** Evaluamos estado **************************************
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
        $data2 = $this->Productos_model->get2($id);
        $data3 = $this->Productos_model->getStock($data2->id_stock);
        $id_stock = $data2->id_stock;
        $stock_minimo = $data3->stock_minimo;
        $data = array(
            'id_stock' => $id_stock,
          //  'stock_minimo'=> $stock_minimo,
            'producto' => $data2, 
            'categoria' => $this->Categorias_model->getCategorias(),
            'presentacion'=> $this->Presentacion_model->getPresentaciones(),
          //'presentaciones_producto' => $this->Productos_model->getPresentacion_productos($id),
            'marcas'=>$this->Marcas_model->getMarcas(),
            'imagen' => $imagen
        );
        $this->load->view("layouts/header");
        $this->load->view('layouts/aside');
        $this->load->view("admin/productos/edit",$data);
        $this->load->view("layouts/footer");
    }

    public function delete(){
        $id_producto= $this->input->post('id-pro-delete');
        $estado_producto= $this->input->post('estado-pro-delete');
            $data = array(
                'estado' =>0, 
            );
        if ($this->Productos_model->update($id_producto, $data)) {
            $this->toastr->success('Registro eliminado!');
            redirect(base_url()."mantenimiento/productos");
        }
        else{
            $this->toastr->error('No se pudo completar la operación.');
            redirect(base_url()."mantenimiento/productos");
        }
    }

    public function getReporteActivos(){
        $idusuario = $this->session->userdata('id');
        //trayendo informacion
        $data = array(
            'fecha' => date("d-m-Y"),
            'empresa' => $this->Productos_model->getAjustes(),
            'nomUsuario' => $this->Productos_model->getUsuario($idusuario),
            'productos' => $this->Productos_model->getProductos(),
            'estado' => "Activos"
        );
        //generando el pdf
        $this->load->view("admin/reportes/productos", $data);
    }

    public function getReporteInactivos(){
        $idusuario = $this->session->userdata('id');
        //trayendo informacion
        $data = array(
            'fecha' => date("d-m-Y"),
            'empresa' => $this->Productos_model->getAjustes(),
            'nomUsuario' => $this->Productos_model->getUsuario($idusuario),
            'productos' => $this->Productos_model->getProductosInactivos(),
            'estado' => "Inactivos"
        );
        //generando el pdf
        $this->load->view("admin/reportes/productos", $data);
    }

    public function getReporteMarca(){
        $valor = $this->input->get("valor");
        $idusuario = $this->session->userdata('id');
        //trayendo informacion
        $data = array(
            'fecha' => date("d-m-Y"),
            'empresa' => $this->Productos_model->getAjustes(),
            'nomUsuario' => $this->Productos_model->getUsuario($idusuario),
            'productos' => $this->Productos_model->getProductosMarca($valor),
            'estado' => "Por Marca"
        );
        //generando el pdf
        $this->load->view("admin/reportes/productos", $data);
    }

    public function getReporteCategoria(){
        $valor = $this->input->get("valor");
        $idusuario = $this->session->userdata('id');
        //trayendo informacion
        $data = array(
            'fecha' => date("d-m-Y"),
            'empresa' => $this->Productos_model->getAjustes(),
            'nomUsuario' => $this->Productos_model->getUsuario($idusuario),
            'productos' => $this->Productos_model->getProductosCategoria($valor),
            'estado' => "Por Categoria"
        );
        //generando el pdf
        $this->load->view("admin/reportes/productos", $data);
    }

    public function getReporteStock(){
        $valorCat = $this->input->get("valorCat");
        $valorMarca = $this->input->get("valorMar");
        $idusuario = $this->session->userdata('id');
        print_r($valorCat, $valorMarca);
        if($valorCat == "a"){
            if($valorMarca == "b"){
                $data = array(
                    'fecha' => date("d-m-Y"),
                    'empresa' => $this->Productos_model->getAjustes(),
                    'nomUsuario' => $this->Productos_model->getUsuario($idusuario),
                    'estado' => "Con Stock",
                    'productos' => $this->Productos_model->getProductos(),
                );
            } else {
                $data = array(
                    'fecha' => date("d-m-Y"),
                    'empresa' => $this->Productos_model->getAjustes(),
                    'nomUsuario' => $this->Productos_model->getUsuario($idusuario),
                    'estado' => "Con Stock",
                    'productos' => $this->Productos_model->getProductosMarca($valorMarca),
                );
            }
        }else{
            if($valorMarca == "b"){
                $data = array(
                    'fecha' => date("d-m-Y"),
                    'empresa' => $this->Productos_model->getAjustes(),
                    'nomUsuario' => $this->Productos_model->getUsuario($idusuario),
                    'estado' => "Con Stock",
                    'productos' => $this->Productos_model->getProductosCategoria($valorCat),
                );
            } else {
                $data = array(
                    'fecha' => date("d-m-Y"),
                    'empresa' => $this->Productos_model->getAjustes(),
                    'nomUsuario' => $this->Productos_model->getUsuario($idusuario),
                    'estado' => "Con Stock",
                    'productos' => $this->Productos_model->getProductosCategoriaMarca($valorCat, $valorMarca),
                );
            }
        }
        
        //generando el pdf
        $this->load->view("admin/reportes/productosStock", $data);
    }

    public function getExistente(){
        $nombre = $this->input->post('getExistente');
        $result = $this->Productos_model->getExistente($nombre);

        echo json_encode($result);
    }
    public function getPresentaciones_producto(){
        $id = $this->input->post('id');
        $result = $this->Productos_model->getPresentacion_productos($id);
        echo json_encode($result);
    }
    public function getExistenteCod(){
        $nombre = $this->input->post('getExistente');
        $result = $this->Productos_model->getExistenteCod($nombre);
        echo json_encode($result);
    }

    public function stock_minimo(){
        $data = array(
            'permisos' => $this->permisos,
            'producto' => $this->Productos_model->getProductos(), 
        );
        $this->load->view("layouts/header");
        $this->load->view('layouts/aside');
        $this->load->view("admin/productos/stock",$data);
        $this->load->view("layouts/footer");
    }
    public function update(){
        
    }
  /*  public function getPresentacion(){
        $valor = $this->input->post("nombre");
        $nombre = $this->Productos_model->getPresentacion($valor);
       echo json_encode($nombre);
    }*/
}