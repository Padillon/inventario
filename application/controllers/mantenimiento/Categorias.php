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
        $this->load->view("layouts/footer");
    }

    public function store(){
        $nombre  = $this->input->post("name");
        
        $data  = array(
            'nombre' => $nombre, 
            'estado' => 1,
        );
        $result = $this->Categorias_model->save($data);
        if($result)
            echo json_encode(array('status'=>true));
        else 
            echo json_encode(array('status'=>false)); 
    }

    public function update(){
        $id = $this->input->post("idCategoria");
        $nombre = $this->input->post("editName");
        $data = array(
            'nombre' =>$nombre, 
        );
        $result = $this->Categorias_model->update($id, $data);
        if($result)
            echo json_encode(array('status'=>true));
        else 
            echo json_encode(array('status'=>false));
    }

    public function delete(){
        $id = $this->input->post("idCategoriaDelete");
        $data = array(
            'estado' =>0, 
        );
        $result = $this->Categorias_model->update($id, $data);
        if($result)
            echo json_encode(array('status'=>true));
        else 
            echo json_encode(array('status'=>false));
    }

    public function active(){
        $id = $this->input->post("idCategoriaActive");
        $data = array(
            'estado' =>1, 
        );
        $result = $this->Categorias_model->update($id, $data);
        if($result)
            echo json_encode(array('status'=>true));
        else 
            echo json_encode(array('status'=>false));
    }
}