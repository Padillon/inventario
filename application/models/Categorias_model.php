<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Categorias_model extends CI_Model {
	
public function getCategorias(){ 
		$this->db->where('estado',1);
		$resultados = $this->db->get("categoria");
			return $resultados->result();
	}
	
	public function save($data){
		return $this->db->insert("categoria",$data);
	}

	public function update($id,$data){
		$this->db->where("id_categoria",$id);
		return $this->db->update("categoria",$data);
	}
}