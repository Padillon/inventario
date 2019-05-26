<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Marcas_model extends CI_Model {
	
public function getMarcas(){ 
		$this->db->where("estado",1);
		$resultados = $this->db->get("marcas");
		return $resultados->result();
	}
	
public function save($data){
	return $this->db->insert("marcas",$data);
}


}