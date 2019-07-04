<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {
    private $permisos;
	public function __construct(){
        parent::__construct();
        if($this->session->userdata('usuario_log')=="") {
            redirect(base_url());
    } else{
		$this->permisos = $this->backend_lib->control();
        $this->load->model("Clientes_model");
        $this->load->library('toastr');
    }
	}

	public function index(){
        $data = array(
            'permisos' => $this->permisos,
            'clientes' => $this->Clientes_model->getClientes(),
        );
        $this->load->view("layouts/header");
        $this->load->view('layouts/aside');
        $this->load->view("admin/clientes/list",$data);
        $this->load->view("layouts/footer");
    }

    public function store(){
        $nombre  = $this->input->post("nombre");
        $apellido  = $this->input->post("apellido");
        $nit  = $this->input->post("nit");
        $telefono  = $this->input->post("telefono");
        $registro  = $this->input->post("registro");
        $direccion  = $this->input->post("direccion");
        
        $data  = array(
            'nombre' => $nombre,
            'apellido' => $apellido,
            'nit' => $nit,
            'telefono' => $telefono,
            'registro' => $registro,
            'direccion' => $direccion,
            'estado' => 1,
        );
 
        if($this->Clientes_model->save($data)){
            $this->toastr->success('Registro guardado!');
            redirect(base_url()."mantenimiento/clientes");
        }else{
            $this->toastr->error('No se pudo completar la operación.');
            redirect(base_url()."mantenimiento/clientes");
        }
    }

    public function update(){
        $id = $this->input->post("idCliente");
        $nombre  = $this->input->post("nombre");
        $apellido  = $this->input->post("apellido");
        $nit  = $this->input->post("nit");
        $telefono  = $this->input->post("telefono");
        $registro  = $this->input->post("registro");
        $direccion  = $this->input->post("direccion");

        $data = array(
            'nombre' => $nombre,
            'apellido' => $apellido,
            'nit' => $nit,
            'telefono' => $telefono,
            'registro' => $registro,
            'direccion' => $direccion,
        );
        if($this->Clientes_model->update($id, $data)){
            $this->toastr->success('Registro guardado!');
            redirect(base_url()."mantenimiento/clientes");
        }else{
            $this->toastr->error('No se pudo completar la operación.');
            redirect(base_url()."mantenimiento/clientes");
        }
    }

    public function delete(){
        $id = $this->input->post("idClienteDelete");
        $data = array(
            'estado' =>0, 
        );
        if($this->Clientes_model->update($id, $data)){
            $this->toastr->success('Registro borrado!');
            redirect(base_url()."mantenimiento/clientes");
        }else{
            $this->toastr->error('No se pudo completar la operación.');
            redirect(base_url()."mantenimiento/clientes");
        }
        
    }
	
}