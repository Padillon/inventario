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
        //we keep the new brand.
        if ($this->Clientes_model->save($data)) {
            redirect(base_url()."mantenimiento/clientes");
        }
        else{
            $this->session->set_flashdata("error","No se pudo guardar la informacion");
            redirect(base_url()."mantenimiento/clientes");
        }
        $this->load->view("layouts/header");
        $this->load->view('layouts/aside');
        $this->load->view("admin/clientes/list",$data);
        $this->load->view("layouts/footer");
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
        if ($this->Clientes_model->update($id, $data)) {
            redirect(base_url()."mantenimiento/clientes");
        }
        else{
            $this->session->set_flashdata("error","No se puede eliminar la categoria.");
            redirect(base_url()."mantenimiento/clientes");
        }
        $this->load->view("layouts/header");
        $this->load->view('layouts/aside');
        $this->load->view("admin/clientes/list",$data);
        $this->load->view("layouts/footer");
    }

    public function delete(){
        $id = $this->input->post("idCliente");
        $data = array(
            'estado' =>0, 
        );
        if ($this->Clientes_model->update($id, $data)) {
            redirect(base_url()."mantenimiento/clientes");
        }
        else{
            $this->session->set_flashdata("error","No se puede eliminar la marca.");
            redirect(base_url()."mantenimiento/clientes");
        }
        $this->load->view("layouts/header");
        $this->load->view('layouts/aside');
        $this->load->view("admin/clientes/list",$data);
        $this->load->view("layouts/footer");
    }
	
}