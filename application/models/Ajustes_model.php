<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ajustes_model extends CI_Model {
	public function getAjustes(){ 
		$resultados = $this->db->get("ajustes");
			return $resultados->result();
	}

	public function getUsuario(){ 
		$resultados = $this->db->get("usuarios");
			return $resultados->result();
	}

}