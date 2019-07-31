<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {
    private $permisos;
	public function __construct(){
        parent::__construct();
        if($this->session->userdata('usuario_log')=="") {
            redirect(base_url());
    } else{
        $this->permisos = $this->backend_lib->control();
        $this->load->model("Usuarios_model");
        $this->load->library('toastr');
    }
	}

	public function index(){
        $data = array(
            'permisos' => $this->permisos,
            'usuarios' => $this->Usuarios_model->getUsuarios(),
            'roles' => $this->Usuarios_model->getRoles(),
        );
        $this->load->view("layouts/header");
        $this->load->view('layouts/aside');
        $this->load->view("admin/usuarios/list",$data);
        $this->load->view("layouts/footer");
    }

  
    public function store(){
        $nombre  = $this->input->post("nombre");
        $correo  = $this->input->post("correo");
        $cargo  = $this->input->post("cargo");
        $usuario = $this->session->userdata('id');
        $PASSWORD = sha1($this->input->post("pass"));
        $data = array(
            'id_usuario_creacion' => $usuario,
            'rol' => $cargo,
            'usuario' => $nombre,
            'correo' => $correo,
            'password' => $PASSWORD,
            'estado' => 1,
        );
        
        if($result = $this->Usuarios_model->save($data)){
        
        redirect(base_url()."mantenimiento/usuarios");

		
		}else{
			redirect(base_url()."dashboard");
		}

    }

    
    public function update(){
        $id = $this->input->post('id_usuarioE');
        $usuario = $this->input->post("nombreE");
        $rol  = $this->input->post("cargoE");
        $correo  = $this->input->post("correoE");


        $data = array(
            'usuario' => $usuario,
            'rol' => $rol,
            'correo' => $correo,
        );
        $result = $this->Usuarios_model->update($id, $data);
        echo $result;
        if($result){
            $this->toastr->success('Cambios guardados.');
            redirect(base_url()."mantenimiento/usuarios");
        }
        else{
            $this->toastr->error('No se pudo completar la operación.');
            redirect(base_url()."mantenimiento/usuario");
        }
    }

    public function delete(){
        $id = $this->input->post("id_usuario_delete");
        $data = array(
            'estado' =>0, 
        );
        $result = $this->Usuarios_model->update($id, $data);
        if($result){
            $this->toastr->success('Cambios guardados.');
            redirect(base_url()."mantenimiento/usuarios");
        }
        else{
            $this->toastr->error('No se pudo completar la operación.');
            redirect(base_url()."mantenimiento/usuario");
        }
    }

    public function active(){
        $id = $this->input->post("id_usuario_active");
        $data = array(
            'estado' =>1, 
        );
        $result = $this->Usuarios_model->update($id, $data);
        if($result){
            $this->toastr->success('Cambios guardados.');
            redirect(base_url()."mantenimiento/usuarios");
        }
        else{
            $this->toastr->error('No se pudo completar la operación.');
            redirect(base_url()."mantenimiento/usuario");
        }
    }

    public function comprobar(){
        $nombre = $this->input->post('nombre');
        $result = $this->Usuarios_model->comprobar($nombre);

        echo json_encode($result);
    }
	
}