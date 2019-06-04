<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registros extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->model("Categorias_model");
        $this->load->library('toastr');
	}

	public function index(){
        $this->load->view("layouts/header");
        $this->load->view('layouts/aside');
        $this->load->view("admin/registros/list");
        $this->load->view("layouts/footer");
    }

}