<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Presentacion_model extends CI_Model {
	
  public function getPresentaciones(){ 
	$this->db->where("estado",1);
		$resultados = $this->db->get("presentacion");
			return $resultados->result();
	}
	
	public function save($data){
		return $this->db->insert("presentacion",$data);
	}

	public function update($id,$data){
		$this->db->where("id_presentacion",$id);
		return $this->db->update("presentacion",$data);
	}
}