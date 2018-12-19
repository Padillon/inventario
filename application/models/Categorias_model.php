<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Categorias_model extends CI_Model {
	
public function agregar($correo, $password){ 
		$this->db->where("correo", $correo); 
		$this->db->where("password", $password);

		$resultados = $this->db->get("usuarios");
		if ($resultados->num_rows() > 0) {
			return $resultados->row();
		}
		else{
			return false; 
		}
    }
}