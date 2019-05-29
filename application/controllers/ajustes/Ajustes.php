<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajustes extends CI_Controller {
	private $permisos;
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('usuario_log')=="") {
			redirect(base_url());
	} else{
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Ajustes_model"); 
		$this->load->library('toastr');
	}
		
	}

	public function index(){

		$data = array(
			'permisos' => $this->permisos,
			'ajuste' => $this->Ajustes_model->getAjustes(), 
			'usuario' => $this->Ajustes_model->getUsuario(), 
		);

		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('ajustes/ajustes',$data);
		$this->load->view('layouts/footer');
	}

	public function upload(){

        $config['upload_path'] = "assets/images/ajuste/";
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['overwrite'] = true;
        $config['max_size'] = '2048';
        $config['max_width'] = '1080';
        $config['max_height'] = '720';

        $this->load->library('upload',$config);

        $this->upload->do_upload('uploaded');
          

            $file_info = $this->upload->data();
            $imagen = $file_info['file_name'];	

       		$nombre = $this->input->post('nempresa');
       		$direct = $this->input->post('direccion');
       		$registro = $this->input->post('registro');
       		$giro = $this->input->post('giro');
       		$telefono = $this->input->post('tel');
       		$correo = $this->input->post('correo');
       		$id = $this->input->post('idAjuste');

       		$data = array(
			  'direccion' => $direct, 
			  'nombre' => $nombre,
       		  'registro' => $registro,
       		  'giro' => $giro,
       		  'logo' => $imagen,
      		  'telefono' => $telefono,
       		  'correo' => $correo,
       		 );

       		$datos = array(
       			 'nombre_empresa' => $nombre, 
       		 );

       	
       		 if($this->Ajustes_model->updateAjus($id, $data)){
				$this->toastr->success('Registro guardado!');
       		     redirect(base_url()."ajustes/ajustes");
       		 }else{ 
				$this->toastr->error('No se pudo completar la operación.');
				redirect(base_url()."ajustes/ajustes");
    }
	}
}