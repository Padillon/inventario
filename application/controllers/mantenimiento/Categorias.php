<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias extends CI_Controller {
	public function __construct(){
        parent::__construct();
        if($this->session->userdata('usuario_log')=="") {
            redirect(base_url());
    } else{
        $this->load->model("Categorias_model");
        $this->load->library('toastr');
        $this->load->library("Pdf");
    }
	}

	public function index(){
        $data = array(
            'categoria' => $this->Categorias_model->getCategorias(),
        );
        $this->load->view("layouts/header");
        $this->load->view('layouts/aside');
        $this->load->view("admin/categorias/list",$data);
        $this->load->view("layouts/footer");
    }

    public function store(){
        $nombre  = $this->input->post("name");
        
        $data  = array(
            'nombre' => $nombre, 
            'estado' => 1,
        );
        if ($this->Categorias_model->save($data)) {
            $this->toastr->success('Registro guardado!');
            redirect(base_url()."mantenimiento/categorias");
            
        }
        else{
            $this->toastr->error('No se pudo completar la operación.');
            redirect(base_url()."mantenimiento/categorias");
        }
    }

    public function update(){
        $id = $this->input->post("idCategoria");
        $nombre = $this->input->post("editName");
        $data = array(
            'nombre' =>$nombre, 
        );
        if ($this->Categorias_model->update($id, $data)) {
            $this->toastr->success('Registro guardado!');
            redirect(base_url()."mantenimiento/categorias");
            
        }
        else{
            $this->toastr->error('No se pudo completar la operación.');
            redirect(base_url()."mantenimiento/categorias");
        }
    }

    public function delete(){
        $id = $this->input->post("idCategoriaDelete");
        $data = array(
            'estado' =>0, 
        );
        if ($this->Categorias_model->update($id, $data)) {
            $this->toastr->success('Registro guardado!');
            redirect(base_url()."mantenimiento/categorias");
            
        }
        else{
            $this->toastr->error('No se pudo completar la operación.');
            redirect(base_url()."mantenimiento/categorias");
        }
    }

    public function getReporteActivos(){
        $idusuario = $this->session->userdata('id');
        //trayendo informacion
        $data = array(
            'fecha' => date("d-m-Y"),
            'empresa' => $this->Categorias_model->getAjustes(),
            'nomUsuario' => $this->Categorias_model->getUsuario($idusuario),
            'categorias' => $this->Categorias_model->getCategorias(),
            'estado' => "Activas"
        );
        //generando el pdf
        $this->load->view("admin/reportes/categorias", $data);
    }

    public function getReporteInactivos(){
        $idusuario = $this->session->userdata('id');
        //trayendo informacion
        $data = array(
            'fecha' => date("d-m-Y"),
            'empresa' => $this->Categorias_model->getAjustes(),
            'nomUsuario' => $this->Categorias_model->getUsuario($idusuario),
            'categorias' => $this->Categorias_model->getCategoriasInactivos(),
            'estado' => "Inactivas"
        );
        //generando el pdf
        $this->load->view("admin/reportes/categorias", $data);
    }
}