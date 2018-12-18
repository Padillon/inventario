<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias extends CI_Controller {

	public function index(){
        $this->load->view("layouts/header");
        $this->load->view("layouts/aside");
        $this->load->view("admin/categorias/list");
        $this->load->view("layouts/footer");
    }
	
}