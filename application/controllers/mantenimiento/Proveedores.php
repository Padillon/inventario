<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proveedores extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("Proveedores_model");
    }

    public function index(){
        $data = array(
            'proveedores' => $this->Proveedores_model->getProveedores(),
        );
        $this->load->view("layouts/header");
        $this->load->view('layouts/aside');
        $this->load->view("admin/proveedores/list",$data);
        $this->load->view("layouts/footer");
        $this->load->view("js/proveedores_Script");
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
 
        $result = $this->Proveedores_model->save($data);
        if($result)
            echo json_encode(array('status'=>true));
        else 
            echo json_encode(array('status'=>false)); 
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
        $result = $this->Proveedores_model->update($id, $data);
        if($result)
            echo json_encode(array('status'=>true));
        else 
            echo json_encode(array('status'=>false)); 
    }

    public function delete(){
        $id = $this->input->post("idProveedorDelete");
        $data = array(
            'estado' =>0, 
        );
        $result = $this->Proveedores_model->update($id, $data);
        if($result)
            echo json_encode(array('status'=>true));
        else 
            echo json_encode(array('status'=>false)); 
    }

    public function active(){
        $id = $this->input->post("idProveedorActive");
        $data = array(
            'estado' =>1, 
        );
        $result = $this->Proveedores_model->update($id, $data);
        if($result)
            echo json_encode(array('status'=>true));
        else 
            echo json_encode(array('status'=>false)); 
    }
}