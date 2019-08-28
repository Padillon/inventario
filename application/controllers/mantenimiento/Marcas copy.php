<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marcas extends CI_Controller {
    private $permisos;
	public function __construct(){
        parent::__construct();
        if($this->session->userdata('usuario_log')=="") {
            redirect(base_url());
        } else{
            $this->permisos = $this->backend_lib->control();
            $this->load->model("Marcas_model");
            $this->load->library('toastr');
            $this->load->library("Pdf");
        }
	}

	public function index(){
        $data = array(
            'permisos' => $this->permisos,
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

        $this->db->trans_start(); // ******************************************************** iniciamos transaccion **************************************
        $this->Marcas_model->save($data)) 

        $this->db ->trans_complete();// ******************************************************** icompletamos transaccion **************************************
              
        if($this->db->trans_status()){ // ******************************************************** iniciamos transaccion **************************************
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

    public function getReporteActivos(){
        $idusuario = $this->session->userdata('id');
        //trayendo informacion
        $data = array(
            'fecha' => date("d-m-Y"),
            'empresa' => $this->Marcas_model->getAjustes(),
            'nomUsuario' => $this->Marcas_model->getUsuario($idusuario),
            'marcas' => $this->Marcas_model->getMarcas(),
            'estado' => "Activas"
        );
        //generando el pdf
        $this->load->view("admin/reportes/marcas", $data);
    }

    public function getReporteInactivos(){
        $idusuario = $this->session->userdata('id');
        //trayendo informacion
        $data = array(
            'fecha' => date("d-m-Y"),
            'empresa' => $this->Marcas_model->getAjustes(),
            'nomUsuario' => $this->Marcas_model->getUsuario($idusuario),
            'marcas' => $this->Marcas_model->getMarcasInactivos(),
            'estado' => "Inactivas"
        );
        //generando el pdf
        $this->load->view("admin/reportes/marcas", $data);
    }
}