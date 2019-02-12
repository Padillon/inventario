<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajustes extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("Ajustes_model");
	}

	public function index(){

		$data = array(
			'ajuste' => $this->Ajustes_model->getAjustes(), 
			'usuario' => $this->Ajustes_model->getUsuario(),
		);

		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('ajustes/ajustes',$data);
		$this->load->view('js/ajustes');
		$this->load->view('layouts/footer');
		

	}

	public function upload(){

		$mi_archivo = 'uploaded';
        $config['upload_path'] = "assets/images/ajuste";
        $config['file_name'] = " ";
        $config['allowed_types'] = "jpeg|png|jpg";
        $config['max_size'] = "5000";
        $config['max_width'] = "2000";
        $config['max_height'] = "2000";
        $this->load->library('upload', $config);
       $this->upload->do_upload($mi_archivo);
       $data = $this->upload->data();

       $data = array(
       	 'nombre' => $nombre, 
         'estado' => 1,
        );
    }
}