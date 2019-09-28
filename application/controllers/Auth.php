<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Usuarios_model");
		$this->load->model("Ajustes_model");
		
	}
    public function index()
	{
		$this->load->view('admin/login.php');
		
	} 
    public function login()
	{
        $correo = $this->input->post("correo");
        $contraseña = $this->input->post("pass");
		$res = $this->Usuarios_model->login($correo, sha1($contraseña));
		$ajuste =$this->Ajustes_model->getAjustes();


		if (!$res) {
			$this->session->set_flashdata("error","El usuario y/o contraseña son incorrectos");
			redirect(base_url());
		}
		else{
			
			$data  = array(
				'id' => $res->id_usuario, 
				'usuario_log' => $res->usuario,
				'rol' => $res->rol,
				'login' => TRUE,
				'logo' => $ajuste->logo,
				
			);
			$this->session->set_userdata($data);
			redirect(base_url()."Dashboard");
		}
    }
    public function logout(){
		$this->session->sess_destroy();
		redirect(base_url());
	}
}
	

