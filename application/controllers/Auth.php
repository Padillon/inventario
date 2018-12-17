<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __contruct(){
        parent::__contruct();
        $this->load->model("Usuarios_model");
    }

    public function index()
	{
		$this->load->view('admin/login.php');
		
	} 
    public function login()
	{
        $correo = $this->input->post("correo");
        $contraseña = $this->input->post("contraseña");
		$res = $this->Usuarios_model->login($correo, sha1($contraseña));

		if (!$res) {
			$this->session->set_flashdata("error","El usuario y/o contraseña son incorrectos");
			redirect(base_url());
		}
		else{
			$data  = array(
				'id' => $res->id, 
				'nombre' => $res->nombres,
				'login' => TRUE
			);
			$this->session->set_userdata($data);
			redirect(base_url()."dashboard");
		}
	}
	}

