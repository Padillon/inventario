<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Presentaciones extends CI_Controller {
	public function __construct(){
        parent::__construct();
        if($this->session->userdata('usuario_log')=="") {
            redirect(base_url());
    } else{
        $this->load->model("Presentacion_model");
        $this->load->library('toastr');}
	}

	public function index(){
        $data = array(
            'presentacion' => $this->Presentacion_model->getPresentaciones(),
        );
        $this->load->view("layouts/header");
        $this->load->view('layouts/aside');
        $this->load->view("admin/presentaciones/list",$data);
        $this->load->view("layouts/footer");
    }
    
    public function store(){
        $nombre  = $this->input->post("name");
        
        $data  = array(
            'nombre' => $nombre, 
            'estado' =>1
        );
        //we keep the new brand.
        if ($this->Presentacion_model->save($data)) {
            $this->toastr->success('Registro guardado!');
            redirect(base_url()."mantenimiento/presentaciones");
        }
        else{
            $this->toastr->error('No se pudo completar la operación.');
            redirect(base_url()."mantenimiento/presentaciones");
        }
    }

    public function delete(){
        $id = $this->input->post("id_presentacion_delete");
        $data = array(
            'estado' =>0, 
        );
        if ($this->Presentacion_model->update($id, $data)) {
            $this->toastr->success('Registro guardado!');
            redirect(base_url()."mantenimiento/presentaciones");
        }
        else{
            $this->toastr->error('No se pudo completar la operación.');
            redirect(base_url()."mantenimiento/presentaciones");
        }
    }

    public function update(){
        $id = $this->input->post("id_presentacion_update");
        $nombre = $this->input->post("nombre_presentacion_update");
        $data = array(
            'nombre' =>$nombre, 
        );
        if ($this->Presentacion_model->update($id, $data)) {
            $this->toastr->success('Registro guardado!');
            redirect(base_url()."mantenimiento/presentaciones");
        }
        else{
            $this->toastr->error('No se pudo completar la operación.');
            redirect(base_url()."mantenimiento/presentaciones");
        }
    }

    public function active(){
        $id = $this->input->post("id_presentacion_active");
        $data = array(
            'estado' =>1, 
        );
        if ($this->Presentacion_model->update($id, $data)) {
            $this->toastr->success('Registro guardado!');
            redirect(base_url()."mantenimiento/presentaciones");
        }
        else{
            $this->toastr->error('No se pudo completar la operación.');
            redirect(base_url()."mantenimiento/presentaciones");
        }
    }
}