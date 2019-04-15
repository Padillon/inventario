<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marcas extends CI_Controller {
	public function __construct(){
		parent::__construct();
        $this->load->model("Marcas_model");
        $this->load->library('toastr');
	}

	public function index(){
        $data = array(
            'marcas' => $this->Marcas_model->getMarcas(),
        );
        $this->load->view("layouts/header");
        $this->load->view('layouts/aside');
        $this->load->view("admin/marcas/list",$data);
        $this->load->view("layouts/footer");
    }
    
    public function store(){
        $nombre  = $this->input->post("name");
        
        $data  = array(
            'nombre' => $nombre, 
        );
        //we keep the new brand.
        if ($this->Marcas_model->save($data)) {
            $this->toastr->success('Registro guardado!');
            redirect(base_url()."mantenimiento/marcas");
            
        }
        else{
            $this->toastr->error('No se pudo completar la operación.');
            redirect(base_url()."mantenimiento/marcas");
        }
    }

    public function delete(){
        $id = $this->input->post("id_marca_delete");
        $data = array(
            'estado' =>0, 
        );
        if ($this->Marcas_model->update($id, $data)) {
            $this->toastr->success('Registro eliminado!');
            redirect(base_url()."mantenimiento/marcas");
        }
        else{
            $this->toastr->error('No se pudo completar la operación.');
            redirect(base_url()."mantenimiento/marcas");
        }
        $this->load->view("layouts/header");
        $this->load->view('layouts/aside');
        $this->load->view("admin/marcas/list",$data);
        $this->load->view("layouts/footer");
    }

    public function update(){
        $id = $this->input->post("id_marca_update");
        $nombre = $this->input->post("nombre_marca_update");
        $data = array(
            'nombre' =>$nombre, 
        );
        if ($this->Marcas_model->update($id, $data)) {
            $this->toastr->success('Registro guardado!');
            redirect(base_url()."mantenimiento/marcas");
        }
        else{
            $this->toastr->error('No se pudo completar la operación.');
            redirect(base_url()."mantenimiento/marcas");
        }
        $this->load->view("layouts/header");
        $this->load->view('layouts/aside');
        $this->load->view("admin/marcas/list",$data);
        $this->load->view("layouts/footer");
    }

    public function active(){
        $id = $this->input->post("id_marca_active");
        $data = array(
            'estado' =>1, 
        );
        if ($this->Marcas_model->update($id, $data)) {
            $this->toastr->success('Registro activado!');
            redirect(base_url()."mantenimiento/marcas");
        }
        else{
            $this->toastr->error('No se pudo completar la operación.');
            redirect(base_url()."mantenimiento/marcas");
        }
        $this->load->view("layouts/header");
        $this->load->view('layouts/aside');
        $this->load->view("admin/marcas/list",$data);
        $this->load->view("layouts/footer");
    }
}