<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("Categorias_model");
	}

	public function index(){
        $data = array(
            'categoria' => $this->Categorias_model->getCategorias(),
        );
        $this->load->view("layouts/header");
        $this->load->view('layouts/aside');
        $this->load->view("admin/categorias/list",$data);
        $this->load->view("js/categoriasScript");
        $this->load->view("layouts/footer");
    }

    public function store(){
        $nombre  = $this->input->post("name");
        
        $data  = array(
            'nombre' => $nombre, 
            'estado' => 1,
        );
        //we keep the new brand.
        if ($this->Categorias_model->save($data)) {
            redirect(base_url()."mantenimiento/categorias");
        }
        else{
            $this->session->set_flashdata("error","No se pudo guardar la informacion");
            redirect(base_url()."mantenimiento/categorias");
        }
        $this->load->view("layouts/header");
        $this->load->view('layouts/aside');
        $this->load->view("admin/categorias/list",$data);
        $this->load->view("layouts/footer");
    }

    public function update(){
        $id = $this->input->post("idCategoria");
        $nombre = $this->input->post("editName");
        $data = array(
            'nombre' =>$nombre, 
        );
        if ($this->Categorias_model->update($id, $data)) {
            redirect(base_url()."mantenimiento/categorias");
        }
        else{
            $this->session->set_flashdata("error","No se puede eliminar la categoria.");
            redirect(base_url()."mantenimiento/categorias");
        }
        $this->load->view("layouts/header");
        $this->load->view('layouts/aside');
        $this->load->view("admin/categorias/list",$data);
        $this->load->view("layouts/footer");
    }

    public function delete(){
        $id = $this->input->post("idCategoriaDelete");
        $data = array(
            'estado' =>0, 
        );
        if ($this->Categorias_model->update($id, $data)) {
            redirect(base_url()."mantenimiento/categorias");
        }
        else{
            $this->session->set_flashdata("error","No se puede eliminar la marca.");
            redirect(base_url()."mantenimiento/categorias");
        }
        $this->load->view("layouts/header");
        $this->load->view('layouts/aside');
        $this->load->view("admin/categorias/list",$data);
        $this->load->view("layouts/footer");
    }

    public function active(){
        $id = $this->input->post("idCategoria");
        $data = array(
            'estado' =>1, 
        );
        if ($this->Categorias_model->update($id, $data)) {
            redirect(base_url()."mantenimiento/categorias");
        }
        else{
            $this->session->set_flashdata("error","No se puede eliminar la marca.");
            redirect(base_url()."mantenimiento/categorias");
        }
        $this->load->view("layouts/header");
        $this->load->view('layouts/aside');
        $this->load->view("admin/categorias/list",$data);
        $this->load->view("layouts/footer");
    }
}