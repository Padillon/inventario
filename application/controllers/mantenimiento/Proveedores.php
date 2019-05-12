<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proveedores extends CI_Controller {
    private $permisos;
	public function __construct(){
        parent::__construct();
        if($this->session->userdata('usuario_log')=="") {
            redirect(base_url());
    } else{
        $this->permisos = $this->backend_lib->control();
        $this->load->model("Proveedores_model");
        $this->load->library('toastr');
}
    }

    public function index(){
        $data = array(
            'permisos' => $this->permisos,
            'proveedores' => $this->Proveedores_model->getProveedores(),
        );
        $this->load->view("layouts/header");
        $this->load->view('layouts/aside');
        $this->load->view("admin/proveedores/list",$data);
        $this->load->view("layouts/footer");
    }

    public function store(){
        $nombre  = $this->input->post("nombre");
        $empresa  = $this->input->post("empresa");
        $telefono  = $this->input->post("telefono");
        
        $data  = array(
            'nombre' => $nombre,
            'empresa' => $empresa,
            'telefono' => $telefono,
            'estado' => 1,
        );
 
        if($result = $this->Proveedores_model->save($data)){
            $this->toastr->success('Registro guardado!');
            redirect(base_url()."mantenimiento/proveedores");
        }else{
            $this->toastr->error('No se pudo completar la operación.');
            redirect(base_url()."mantenimiento/proveedores");
        }
    }

    public function update(){
        $id = $this->input->post("idProveedor");
        $nombre  = $this->input->post("nombre");
        $empresa  = $this->input->post("empresa");
        $telefono  = $this->input->post("telefono");

        $data = array(
            'nombre' => $nombre,
            'empresa' => $empresa,
            'telefono' => $telefono,
        );
        if($this->Proveedores_model->update($id, $data)){
            $this->toastr->success('Registro guardado!');
            redirect(base_url()."mantenimiento/proveedores");
        }else{
            $this->toastr->error('No se pudo completar la operación.');
            redirect(base_url()."mantenimiento/proveedores");
        }
    }

    public function delete(){
        $id = $this->input->post("idProveedorDelete");
        $data = array(
            'estado' =>0, 
        );
        if($this->Proveedores_model->update($id, $data)){
            $this->toastr->success('Registro borrado!');
            redirect(base_url()."mantenimiento/proveedores");
        }else{
            $this->toastr->error('No se pudo completar la operación.');
            redirect(base_url()."mantenimiento/proveedores");
        } 
    }

    public function active(){
        $id = $this->input->post("idProveedorActive");
        $data = array(
            'estado' =>1, 
        );
        
        if($result = $this->Proveedores_model->update($id, $data)){
            $this->toastr->success('Registro activado!');
            redirect(base_url()."mantenimiento/proveedores");
        }else{
            $this->toastr->error('No se pudo completar la operación.');
            redirect(base_url()."mantenimiento/proveedores");
        } 
    }
}