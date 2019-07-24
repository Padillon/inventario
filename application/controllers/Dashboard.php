<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
        public function __construct(){
                parent::__construct();
                if($this->session->userdata('usuario_log')=="") {
                        redirect(base_url());
                }  
                $this->load->model("Dashboard_model");   
        }
	
	public function index(){     
             /*   $data = array(
                        'fechas' => $this->Dashboard_model->getVentas(),
                );*/
        $this->load->view('layouts/header');
        $this->load->view('layouts/aside');
        $this->load->view('admin/dashboard');
        $this->load->view('layouts/footer');
        }

        public function getVentas(){
                $fechas = $this->Dashboard_model->getVentas();
                echo json_encode($fechas);
        }
}
