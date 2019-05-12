<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permisos extends CI_Controller {
	private $permisos;
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('usuario_log')=="") {
			redirect(base_url());
	} else{
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Permisos_model"); 
	}
		
	}

	public function index(){

		$data = array(
			'permisos' => $this->permisos,
			'permisos_list' => $this->Permisos_model->getPermisos(),
		);

		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('ajustes/permisos/list',$data);
		$this->load->view('layouts/footer');
	}

	public function store(){
		$id_permiso = $this->input->post('id_permiso');
		$leer = $this->input->post('radio_leer');
		$insertar =$this->input->post('radio_insertar');
		$actualizar = $this->input->post('radio_actualizar');
		$eliminar = $this->input->post('radio_eliminar');

		$data = array(
			'read' => $leer, 
			'insert' => $insertar,
			   'update' => $actualizar,
			   'delete' => $eliminar,
			  );
		
		if ($this->Permisos_model->insertar($data,$id_permiso)) {
			# code...
			redirect(base_url()."ajustes/permisos");
		}
	}

}