<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("Clientes_model");
	}

	public function index(){
        $data = array(
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
 
        $result = $this->Clientes_model->save($data);
        if($result)
            echo json_encode(array('status'=>true));
        else 
            echo json_encode(array('status'=>false)); 
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
        $result = $this->Clientes_model->update($id, $data);
        if($result)
            echo json_encode(array('status'=>true));
        else 
            echo json_encode(array('status'=>false)); 
    }

    public function delete(){
        $id = $this->input->post("idClienteDelete");
        $data = array(
            'estado' =>0, 
        );
        $result = $this->Clientes_model->update($id, $data);
        if($result)
            echo json_encode(array('status'=>true));
        else 
            echo json_encode(array('status'=>false)); 
    }

    public function active(){
        $id = $this->input->post("idClienteActive");
        $data = array(
            'estado' =>1, 
        );
        $result = $this->Clientes_model->update($id, $data);
        if($result)
            echo json_encode(array('status'=>true));
        else 
            echo json_encode(array('status'=>false)); 
    }
	
}