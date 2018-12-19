<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Categorias_model extends CI_Model {
	
public function getCategorias(){ 
	#	$this->db->where("usuario",$user_id);s
		$resultados = $this->db->get("categoria");
			return $resultados->result();
    }
}